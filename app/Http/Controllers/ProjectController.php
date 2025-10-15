<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Unit;
use App\Models\User;
use App\Models\Partner;
use App\Models\Phase;
use App\Models\Subphase;
use App\Models\Project;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Role;
use App\Models\DevelopmentDetail;
use App\Mail\ProjectDeletionRequestMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Models\ProjectDeletionRequest;
use App\Models\Report;
use App\Models\Task;
use App\Mail\PhaseCompletedMail;
use App\Models\ProjectDocument;
use Illuminate\Support\Facades\Storage;
use App\Models\Document;


class ProjectController extends Controller
{
    public function index(Request $r)
    {
        
        // dd('All Projects Page');
        $status = $r->query('status');
        $managerName = $r->query('manager');

        $deletionRequests = ProjectDeletionRequest::with('project', 'requester')
                        ->where('approved', false)
                        ->get();

        $q = Project::with('partners');

        if ($status) {
            $q->where('status', $status);
        }
       

        if ($r->filled('title')) {
            $q->where('title', 'like', '%' . $r->title . '%');
        }

        if ($r->filled('start_date')) {
            $q->whereDate('start_date', $r->start_date);
        }

        if ($r->filled('budget_min')) {
            $q->where('budget', '>=', $r->budget_min);
        }

        // if ($r->filled('partner_id')) {
        //     $q->whereHas('partners', fn($query) => $query->where('partner_id', $r->partner_id));
        // }
      
        if ($r->filled('partner_id')) {
            $q->whereHas('partners', fn($query) => $query->where('id', $r->partner_id));
        }

        if ($r->filled('manager_id')) {
            $q->where('project_manager_id', $r->manager_id);
        }

        if ($r->filled('search')) {
            $search = $r->search;
            $q->where(function ($query) use ($search) {
                $query->where('title', 'like', "%$search%")
                    ->orWhereHas('partners', function ($q2) use ($search) {
                        $q2->where('name', 'like', "%$search%");
                    })
                    ->orWhereHas('projectManager', function ($q3) use ($search) {
                        $q3->where('firstname', 'like', "%$search%")
                            ->orWhere('lastname', 'like', "%$search%");
                    });
            });
        }
     // Passons $partners et $managers à la vue
        $partners = Partner::all();
        $managers = User::has('projectsManaged')->get();

            $projects = Project::with('partners', 'projectManager')->latest()->get();
            // $projects = $q->with('partners', 'projectManager')->latest()->get();
            $projects = $q->latest()->get();
            $counts = [
                'all'         => Project::count(),
                'Not started' => Project::where('status', 'Not started')->count(),
                'In progress' => Project::where('status', 'In progress')->count(),
                'Completed'   => Project::where('status', 'Completed')->count(),
                'Cancelled'   => Project::where('status', 'Cancelled')->count(),
                'Closed'   => Project::where('status', 'Closed')->count(),
            ];

            return view('allprojects', compact('projects', 'status', 'counts','partners', 'managers','deletionRequests'));
    }


    
    public function create()
    {
        // dd('Create Project Page');
        $units = Unit::all();
        $afcftaSubphases = Subphase::whereHas('phase', function ($q) {
            $q->where('name', 'procurement');
        })->where('type', 'afcfta')->get();

        $phases = Phase::with('subphases')->get();
        $managers = User::whereHas('role', function ($q) {
            $q->whereIn('name', ['Project Manager', 'Admin']);
        })->get();
        $partners = Partner::all();

        return view('newproject', compact('units', 'managers', 'partners', 'phases', 'afcftaSubphases'));
    }

    
    public function store(Request $request)
    {
        
        // 1. Validation basique (tu peux l'améliorer selon ton besoin)
        $validated = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'start_date' => 'required|date',
        'end_date' => 'required|date|after_or_equal:start_date',
        'priority' => 'required|in:Low,Medium,High',
        'status' => 'required|in:Not started,In progress,Completed,Cancelled,Waiting Approval,Delayed,Under review',
        'unit_id' => 'required|exists:units,id',
        'project_manager_id' => 'required|exists:users,id',
        'type' => 'required|in:HRM,Admin',
        'partner' => 'nullable|array',
        'partner.*' => 'exists:partners,id',
        'phases' => 'nullable|array',
        'budget' => 'nullable|numeric|min:0',
        'subphases' => 'nullable|array',
        'procurement_type' => 'nullable|in:afcfta,partner',
        'budget_code' => 'nullable|string|max:50', // Ajout du budget code
        'supporting_documents.*' => 'file|max:5120|mimes:pdf,doc,docx,xlsx,xls,png,jpg,jpeg',
        ]);
        $validated['created_by'] = Auth::id();
        //   dd($validated); 

        $validated['start_date'] = Carbon::createFromFormat('m/d/Y', $validated['start_date'])->format('Y-m-d');
        $validated['end_date'] = Carbon::createFromFormat('m/d/Y', $validated['end_date'])->format('Y-m-d');
        $validated['unit_id'] = $request->input('unit');
        //   dd($validated['start_date'], $validated['end_date']);
        // 2. Création du projet
        $project = Project::create([
            'title' => $request->title,
            'description' => $request->description,
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'priority' => $request->priority,
            'status' => $request->status,
            'unit_id' => $request->unit_id,
            'manager_id' => $request->manager,
            'project_manager_id' => $validated['project_manager_id'],
            'type' => $request->type,
            'budget' => $request->budget ?? null,
            'created_by' => Auth::id(),
            'budget_code' => $request->budget_code, // Ajout du budget code
        ]);
        //  dd($project);
        // 3. Attacher les partenaires (many-to-many)
        if ($request->has('partners') && is_array($request->partners)) {
            $project->partners()->sync($request->partners); // Met à jour les partenaires
        } else {
            $project->partners()->detach(); // Aucun partenaire sélectionné, on vide la relation
        }
       //    Si le projet a un partenaire spécifique, on l'ajoute
        if ($request->input('procurement_type') === 'partner' && $request->has('partner_id')) {
            $partnerId = $request->input('partner_id');
            $project->partners()->syncWithoutDetaching([$partnerId]);
        }

        // 3.2 Si le projet a des partenaires généraux, on les ajoute
        if ($request->has('partners')) {
            foreach ($request->input('partners') as $partnerId) {
                $project->partners()->syncWithoutDetaching([$partnerId]);
            }
        }

        // 4. Gérer les sous-phases cochées
        $subphaseSyncData = [];

        // a) Sous-phases générales
        if ($request->has('subphases')) {
            foreach ($request->input('subphases') as $phaseId => $subIds) {
                foreach ($subIds as $subId) {
                    $subphaseSyncData[$subId] = ['percentage' => 0];
                }
            }
        }

       
        $selectedSubphases = $request->input('subphases', []); 
        $selectedPhaseIds = array_filter(array_keys($selectedSubphases), fn($id) => is_numeric($id));
        // Enregistrer les phases sélectionnées
        if (!empty($selectedPhaseIds)) {
            $project->phases()->sync($selectedPhaseIds); // Enregistre les phases dans project_phase
        }

        // Aplanir toutes les sous-phases cochées
        $flatSubphases = collect($selectedSubphases)->flatMap(function ($ids, $phaseId) {
            return collect($ids)->map(function ($id) use ($phaseId) {
                return ['subphase_id' => $id, 'phase_id' => $phaseId];
            });
        });

        // Grouper par phase_id
        $grouped = $flatSubphases->groupBy('phase_id');

        // Pour chaque groupe de sous-phases sélectionnées (par phase), on répartit 100%
        foreach ($grouped as $phaseId => $subphaseGroup) {
            $count = $subphaseGroup->count();
            $equalPercent = round(100 / $count, 2); // ex: 3 sous-phases => 33.33%

            foreach ($subphaseGroup as $entry) {
                $subphase = Subphase::where('id', $entry['subphase_id'])->first();

                if ($subphase) {
                    $project->subphases()->attach($subphase->id, [
                        'percentage' => $equalPercent,
                    ]);
                }
            }
        }
        
        // b) Sous-phases AfCFTA Procurement
        if ($request->procurement_type === 'afcfta' && $request->has('subphases.procurement_afcfta')) {
            
            foreach ($request->input('subphases.procurement_afcfta') as $subId) {
                $subphaseSyncData[$subId] = ['percentage' => 0];
            }
        }

        if ($request->procurement_type === 'partner' && $request->has('subphases.procurement_partner')) {
            foreach ($request->input('subphases.procurement_partner') as $subId) {
                $subphaseSyncData[$subId] = ['percentage' => 100]; // ou 0 selon ta logique
            }
        }

      

        if (!empty($subphaseSyncData)) {
            foreach ($subphaseSyncData as $subId => $data) {
                $project->subphases()->syncWithoutDetaching([$subId => $data]);
            }
        }

       

        if ($request->has('development_activities')) {
            foreach ($request->input('development_activities') as $activity) {
                if (!empty($activity['title'])) {
                    $project->developmentDetails()->create([
                        'title' => $activity['title'],
                        'budget_activity' => $activity['budget'] ?? null,
                        'subphase_id' => Subphase::where('name', 'development')->value('id'),
                    ]);
                }
            }
        }

        if ($request->hasFile('supporting_documents')) {
            foreach ($request->file('supporting_documents') as $file) {
                $path = $file->store('projects/documents', 'public'); // stocke dans storage/app/public/projects/documents
                $project->documents()->create([
                    'filename'  => $file->getClientOriginalName(),
                    'path'      => $path,
                    'mime_type' => $file->getMimeType(),
                    'size'      => $file->getSize(),
                ]);
            }
        }

        return redirect()->route('allprojects')->with('success', 'Project created successfully.');
    }


    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'priority' => 'required|in:Low,Medium,High',
            'status' => 'required',
            'unit_id' => 'required|exists:units,id',
            'project_manager_id' => 'required|exists:users,id',
            'type' => 'required|in:HRM,Admin',
            'budget' => 'nullable|numeric',
            'budget_code' => 'nullable|string|max:50',
        ]);

        $validated['start_date'] = Carbon::parse($validated['start_date'])->format('Y-m-d');
        $validated['end_date'] = Carbon::parse($validated['end_date'])->format('Y-m-d');

        $project->update($validated);

        // Synchronisation des partenaires
        $project->partners()->sync($request->input('partners', []));

        // Mise à jour des sous-phases
        $project->subphases()->detach();
        $subphaseSyncData = [];
        foreach ($request->input('subphases', []) as $phaseId => $subIds) {
            $count = count($subIds);
            $equalPercent = round(100 / $count, 2);
            foreach ($subIds as $subId) {
                $subphaseSyncData[$subId] = ['percentage' => $equalPercent];
            }
        }
        $project->subphases()->attach($subphaseSyncData);

        // Mise à jour des activités de développement
        $project->developmentDetails()->delete();
        foreach ($request->input('development_activities', []) as $activity) {
            $project->developmentDetails()->create([
                'title' => $activity['title'],
                'budget' => $activity['budget'] ?? null,
                'payment_status' => $activity['payment_status'] ?? 'Unpaid',
                'payment_date' => $activity['payment_date'] ?? null,
                'subphase_id' => Subphase::where('name', 'development')->value('id'),
            ]);
        }

        // Affectation des assistants (PMA)
        if ($request->has('assistant_ids')) {
            $project->assistants()->sync($request->assistant_ids);
        }

        // Affectation des membres
        if ($request->has('member_ids')) {
            $project->members()->sync($request->member_ids);
        }

        return redirect()->route('allprojects')->with('success', 'Project updated successfully.');
    }



    public function show($encryptedId)
{
    $id = decrypt($encryptedId); // Décrypter l'ID
    $project = Project::with([
        'unit',
        'projectManager',
        'partners',
        'phases',
        'subphases',
        'subphases.phase',
        'developmentDetails',
        'assistants',
        'members'
    ])->findOrFail($id);

    $completionPercentage = $project->getCompletionPercentageAttribute();

    $units = \App\Models\Unit::all();
    $projectManagers = \App\Models\User::whereHas('role', function ($query) {
        $query->whereIn('name', ['Admin', 'Project Manager']);
    })->get();

    return view('projectshow', compact('project', 'completionPercentage', 'units', 'projectManagers'));
}


     public function edit($encryptedId)
    {
      $projectId = decrypt($encryptedId);
        // Charger les relations du projet
       $project = Project::with([
        'unit',
        'projectManager',
        'partners',
        'subphases',
        'phases',
        'developmentDetails'
       ])->findOrFail($projectId);
        // Données nécessaires pour les listes déroulantes et sélections
        $units = Unit::all();
        $users = User::all();
        // dd($users);
        // Utilisateurs avec rôle Project Manager ou Admin
        $roleIds = Role::whereIn('name', ['Project Manager', 'Admin'])->pluck('id')->toArray();

        $projectManagers = User::whereIn('role_id', $roleIds)->get();
        $partners = Partner::all();

        // Subphases sélectionnées
        $selectedSubphases = $project->subphases->pluck('id')->toArray();

        // Phase "development"
        $developmentSubphaseId = \App\Models\Subphase::where('name', 'development')->value('id');
        $developmentActivities = $project->developmentDetails;

        // Toutes les phases
        $phases = \App\Models\Phase::with('subphases')->get();

        return view('editproject', compact(
            
            'project',
            'units',
            'projectManagers',
            'partners',
            'selectedSubphases',
            'developmentSubphaseId',
            'developmentActivities',
            'phases',
            'users'
        ));
    }

    public function updateField(Request $request, $id)
    {
       
        $project = Project::findOrFail($id);
        $field = $request->input('field');
        $value = $request->input('value');
        // dd($field, $value);
        // Liste des champs autorisés
        $allowedFields = [
            'title', 'description', 'start_date', 'end_date',
            'priority', 'status', 'budget', 'type','budget_code',
            'unit_id', 'project_manager_id', 'partners', 'procurement_type'
        ];
        
         // Validation basique
        if (!in_array($field, $allowedFields)) {
            return redirect()->back()->with('error', 'Invalid field.');
        }

        // Cas spécial : mise à jour des partenaires (many-to-many)
        if ($field === 'partners') {
            $partnerIds = is_array($value) ? $value : [];
            $project->partners()->sync($partnerIds);

        } elseif ($field === 'procurement_type') {
            // Gère le changement de type de procurement
            $partnerSub = \App\Models\Subphase::where('name', 'partner_procurement')->first();
            $afcftaSub = \App\Models\Subphase::where('name', 'afcfta_procurement')->first();

            // Detach les deux
            if ($partnerSub) $project->subphases()->detach($partnerSub->id);
            if ($afcftaSub) $project->subphases()->detach($afcftaSub->id);

            // Attach celui sélectionné
            $selected = $value === 'partner_procurement' ? $partnerSub : $afcftaSub;
            if ($selected) {
                $project->subphases()->attach($selected->id, ['percentage' => 0]);
            }

        } else {
            // Ajout du 9/7/2025
          if ($field === 'budget' && empty($request->input('reason'))) {
            return redirect()->back()->with('error', 'Please provide a reason for the budget change.');
        }

        // Stocker l'ancienne valeur du budget avant modification
        if ($field === 'budget') {
            $oldBudget = $project->budget;

            // Stocker raison + date + ancienne valeur
            $project->budget_change_reason = $request->input('reason');
            $project->budget_changed_at = now();
            $project->previous_budget = $oldBudget;
        }
        // dd($field, $value);
            $project->$field = $value;
            $project->save();
        }

        $fieldNames = [
            'title' => 'Title',
            'description' => 'Description',
            'start_date' => 'Start Date',
            'end_date' => 'End Date',
            'priority' => 'Priority',
            'status' => 'Status',
            'budget' => 'Budget',
            'type' => 'Project Type',
            'unit_id' => 'Unit',
            'project_manager_id' => 'Project Manager',
            'partners' => 'Partners',
            'procurement_type' => 'Procurement Type',
        ];

        $label = $fieldNames[$field] ?? ucfirst(str_replace('_', ' ', $field));

        return redirect()->back()->with('success', "$label updated successfully.");
    }

 
    public function updateSubphaseStatus(Request $request, $projectId, $subphaseId)
    {
        $request->validate([
                'status' => 'required|string',
                'reason' => 'nullable|string',
                'award_person_name' => 'nullable|string|max:255',
            ]);
            $status = $request->input('status');
            $reason = $request->input('reason');


            $project = Project::findOrFail($projectId);
            $subphase = Subphase::findOrFail($subphaseId);
            $defaultPercentage = $subphase->default_percentage;

            $allSubphases = $project->subphases()->with('phase')->orderBy('position')->get();

            $currentIndex = $allSubphases->search(function ($item) use ($subphaseId) {
                return $item->id == $subphaseId;
            });

            if ($status === 'Completed') {
                $previousNotCompleted = $allSubphases->take($currentIndex)->first(function ($sp) {
                    return $sp->pivot->status !== 'Completed';
                });

                if ($previousNotCompleted) {
                    $prevPhase = \App\Models\Phase::find($previousNotCompleted->phase_id);
                    $prevPhaseName = $prevPhase->label ?? ucfirst($prevPhase->name);
                    $prevSubName = $previousNotCompleted->label ?? $previousNotCompleted->name;
                    $prevStatus = $previousNotCompleted->pivot->status;

                    return redirect()->back()->with('error', "Cannot complete this subphase because previous subphase \"$prevSubName\" in phase \"$prevPhaseName\" is still \"not completed\".");
                }
            }

            switch ($status) {
                case 'Not started':
                    $percentage = 0;
                    break;
                case 'In progress':
                    $percentage = $defaultPercentage / 2;
                    break;
                case 'Completed':
                    $percentage = $defaultPercentage;
                    break;
                default:
                    $percentage = $subphase->pivot->percentage ?? 0;
                    break;
            }

        $pivotData = [
                'status'     => $status,
                'percentage' => $percentage,
                'reason'     => $reason,
            ];

            // On ajoute award_person_name *exactement comme reason* sans condition
            if ($subphase->name === 'award') {
                $pivotData['award_person_name'] = $request->input('award_person_name');
            }

            $project->subphases()->updateExistingPivot($subphaseId, $pivotData);

            $phaseId = $subphase->phase_id;
            if (!$project->phases->pluck('id')->contains($phaseId)) {
                $project->phases()->attach($phaseId, ['percentage' => 0, 'status' => 'Not started']);
            }
            $subphases = $project->subphases()->where('phase_id', $phaseId)->get();
            $totalDefault = $subphases->sum('default_percentage');
            $achieved = $subphases->sum(function ($s) {
                return $s->pivot->percentage;
            });

            $phasePercentage = $totalDefault > 0 ? round(($achieved / $totalDefault) * 100, 2) : 0;

            $allCompleted = $subphases->every(function ($s) {
                return $s->pivot->status === 'Completed';
            });

            $phaseUpdate = ['percentage' => $phasePercentage];
            if ($allCompleted) {
                $phaseUpdate['status'] = 'Completed';
            }
            $project->phases()->updateExistingPivot($phaseId, $phaseUpdate);

             // ✅ Envoi de mail si la phase est complétée 
             
            // Bloc if a enlever si le code bug
                if ($allCompleted) {
                    $phase = \App\Models\Phase::find($phaseId);
                    $phaseName = $phase->label ?? ucfirst($phase->name);

                    // Récupérer tous les admins
                    $admins = \App\Models\User::whereHas('role', function ($q) {
                        $q->where('name', 'Admin');
                    })->pluck('email');

                    foreach ($admins as $adminEmail) {
                        Mail::to($adminEmail)->send(new \App\Mail\PhaseCompletedMail($project, $phaseName));
                    }
                }

            // Fin code bloc if a enlever si le code bug

            $firstSubphase = $allSubphases->first();
            $lastSubphase = $allSubphases->last();
            if ($firstSubphase && $firstSubphase->id == $subphaseId) {
                if ($status === 'In progress' || $status === 'Completed') {
                    $project->status = 'In progress';
                    $project->save();
                }elseif ($status === 'Not started') {
                    $project->status = 'Not started';
                }
                $project->save();
            }
            // Met à jour le pivot AVANT toute vérification
            $project->subphases()->updateExistingPivot($subphaseId, [
                'status' => $status,
            ]);
            $allSubphases = $project->subphases;
            
            if ($lastSubphase && $lastSubphase->id == $subphaseId && $status === 'Completed') {
                $incomplete = $allSubphases->first(function ($sp) {
                    return $sp->pivot->status !== 'Completed';
                });
                if (!$incomplete) {
                    $project->status = 'Completed';
                    $project->save();
                }
            }


            $allPhases = $project->phases()->with('subphases')->get();
            $totalProjectDefault = 0;
            $totalAchieved = 0;

            foreach ($allPhases as $phase) {
                $subs = $project->subphases()->where('phase_id', $phase->id)->get();
                $phaseDefault = $subs->sum('default_percentage');
                $phaseAchieved = $subs->sum(function ($s) {
                    return $s->pivot->percentage;
                });

                $totalProjectDefault += $phaseDefault;
                $totalAchieved += $phaseAchieved;

                $phasePercentage = $phaseDefault > 0 ? round(($phaseAchieved / $phaseDefault) * 100, 2) : 0;
                $project->phases()->updateExistingPivot($phase->id, ['percentage' => $phasePercentage]);
            }

            $projectPercentage = $totalProjectDefault > 0 ? round(($totalAchieved / $totalProjectDefault) * 100, 2) : 0;
            $project->percentage = $projectPercentage;
            $project->save();

            return redirect()->back()->with('success', "Subphase status and progress updated successfully.");
    }

  

    public function requestDelete(Request $request, $id)
{
    $request->validate(['reason' => 'required|string']);

    $project = Project::findOrFail($id);

    // 1. Sauvegarde la demande en DB
    $deletionRequest = \App\Models\ProjectDeletionRequest::create([
        'project_id'   => $project->id,
        'requested_by' => Auth::id(),
        'reason'       => $request->reason,
        'status'       => 'pending', 
    ]);

    // 2. Récupère les admins
    $admins = \App\Models\User::whereHas('role', function ($query) {
        $query->where('name', 'Admin');
    })->get();

    // 3. Envoie les mails aux admins
    foreach ($admins as $admin) {
        Mail::to($admin->email)->send(
            new \App\Mail\ProjectDeletionRequestMail(
                $project,
                $deletionRequest->reason,
                Auth::user()
            )
        );
    }

    return back()->with('success', 'Deletion request saved and sent to administrators.');
}



    public function hrmProjects(Request $request)
    {
        $projects = Project::with([
            'phases' => function ($q) {
                $q->withPivot('percentage');
            },
            'subphases' => function ($q) {
                $q->withPivot('status', 'percentage', 'reason');
            },
            'projectmanager', 'partners'
        ])
        ->where('type', 'HRM')
        ->get();
        $status = $request->get('status');
        $query = Project::with([
            'phases' => function ($q) {
                $q->withPivot('percentage');
            },
            'subphases' => function ($q) {
                $q->withPivot('status', 'percentage', 'reason');
            },
            'projectmanager', 'partners'
        ])->where('type', 'HRM');
        if ($status) {
            $query->where('status', $status);
        }

         if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($query) use ($search) {
                $query->where('title', 'like', "%$search%")
                    ->orWhereHas('partners', function ($q2) use ($search) {
                        $q2->where('name', 'like', "%$search%");
                    })
                    ->orWhereHas('projectManager', function ($q3) use ($search) {
                        $q3->where('firstname', 'like', "%$search%")
                            ->orWhere('lastname', 'like', "%$search%");
                    });
            });
        }
      
        $highPriorityProjects = Project::with(['phases'])
            ->where('type', 'HRM')
            ->where('priority', 'High')
            ->where('status', '!=', 'Not started')
            ->get();

        // dd($highPriorityProjects);
        $projects = $query->get();
        // Compte les projets par statut
            $counts = [
                'all' => Project::where('type', 'HRM')->count(),
                'Not started' => Project::where('type', 'HRM')->where('status', 'Not started')->count(),
                'In progress' => Project::where('type', 'HRM')->where('status', 'In progress')->count(),
                'Completed' => Project::where('type', 'HRM')->where('status', 'Completed')->count(),
                'Cancelled' => Project::where('type', 'HRM')->where('status', 'Cancelled')->count(),
                'Closed'   => Project::where('status', 'Closed')->count(),
            ];
        return view('hrmprojects', compact('projects', 'counts', 'status','highPriorityProjects'));
    }

    public function adminProjects(Request $request)
    {
        $projects = Project::with([
            'phases' => function ($q) {
                $q->withPivot('percentage');
            },
            'subphases' => function ($q) {
                $q->withPivot('status', 'percentage', 'reason');
            },
            'projectmanager', 'partners'
        ])
        ->where('type', 'Admin')
        ->get();
        $status = $request->get('status');
        $query = Project::with([
            'phases' => function ($q) {
                $q->withPivot('percentage');
            },
            'subphases' => function ($q) {
                $q->withPivot('status', 'percentage', 'reason');
            },
            'projectmanager', 'partners'
        ])->where('type', 'Admin');
        if ($status) {
            $query->where('status', $status);
        }
      
        $highPriorityProjects = Project::with(['phases'])
            ->where('type', 'Admin')
            ->where('priority', 'High')
            ->where('status', '!=', 'Not started')
            ->get();

             
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($query) use ($search) {
                $query->where('title', 'like', "%$search%")
                    ->orWhereHas('partners', function ($q2) use ($search) {
                        $q2->where('name', 'like', "%$search%");
                    })
                    ->orWhereHas('projectManager', function ($q3) use ($search) {
                        $q3->where('firstname', 'like', "%$search%")
                            ->orWhere('lastname', 'like', "%$search%");
                    });
            });
        }

        // dd($highPriorityProjects);
        $projects = $query->get();
        // Compte les projets par statut
            $counts = [
                'all' => Project::where('type', 'Admin')->count(),
                'Not started' => Project::where('type', 'Admin')->where('status', 'Not started')->count(),
                'In progress' => Project::where('type', 'Admin')->where('status', 'In progress')->count(),
                'Completed' => Project::where('type', 'Admin')->where('status', 'Completed')->count(),
                'Cancelled' => Project::where('type', 'Admin')->where('status', 'Cancelled')->count(),
                'Closed'   => Project::where('status', 'Closed')->count(),
            ];
        return view('adminprojects', compact('projects', 'counts', 'status','highPriorityProjects'));
    }

    public function reactivate(Project $project)
    {
        if ($project->status === 'Cancelled' && $project->previous_status) {
             $project->status = $project->previous_status;
            // $project->status = $project->previous_status ?? 'Not started';
            $project->previous_status = null;
            $project->save();

            return back()->with('success', 'Project successfully reactivated.');
        }

        return back()->with('error', 'Project cannot be reactivated.');
    }



    public function close(Request $request, $encryptedId)
    {
        $id = decrypt($encryptedId); // Décrypter
        $project = Project::findOrFail($id);
        if ($project->status !== 'Completed') {
            return redirect()->back()->with('error', 'Only completed projects can be closed.');
        }

        $project->status = 'Closed';
        $project->close_comment = $request->input('close_comment');
        $project->closed_at = now(); // optional
        $project->save();

        return redirect()->route('allprojects')->with('success', 'Project has been closed.');
    }

        public function closeAdmin(Request $request, $encryptedId)
    {
        $id = decrypt($encryptedId); // Décrypter
        $project = Project::findOrFail($id);
        if ($project->status !== 'Closed') {
            return redirect()->back()->with('error', 'Only closed projects by project manager can be closed by administrator.');
        }

        $project->status = 'Closed';
        $project->close_comment_admin = $request->input('close_comment_admin');
        $project->save();

        return redirect()->route('allprojects')->with('success', 'Project has been closed.');
    }

    public function assignTeam(Request $request, Project $project)
    {
        if ($request->has('assistant_ids')) {
            $project->assistants()->sync($request->assistant_ids);
        }

        if ($request->has('member_ids')) {
            $project->members()->sync($request->member_ids);
        }

        return back()->with('success', 'Team assigned successfully.');
    }

    public function updateRelation(Request $request, Project $project)
    {
        // Update PMA if present
        if ($request->filled('pma_id')) {
            $project->assistants()->sync([$request->pma_id]); // ici tu synchronises la relation
        }

        // Update members if present
        if ($request->has('member_ids')) {
            $project->members()->sync($request->member_ids);
        }

        return back()->with('success', 'Project team updated successfully.');
    }


    public function projectManagersChart()
    {
        $projectManagers = User::withCount('managedProjects')
                ->whereHas('role', fn($q) => $q->whereIn('name', ['Project Manager', 'Admin']))
                ->get(['id', 'firstname', 'lastname']);

        return response()->json([
            'managers' => $projectManagers->pluck('firstname'),
            'counts'   => $projectManagers->pluck('managed_projects_count'),
        ]);
    }


    public function uploadDocuments(Request $request, Project $project)
    {
        $request->validate([
            'documents.*' => 'required|file|mimes:pdf,doc,docx,xlsx,xls,png,jpg,jpeg|max:2048'
        ]);

        foreach ($request->file('documents') as $file) {
            $path = $file->store('projects/documents', 'public');

            ProjectDocument::create([
                'project_id' => $project->id,
                'filename'   => $file->getClientOriginalName(),
                'path'       => $path,
            ]);
        }

        return redirect()->back()->with('success', 'Documents uploaded successfully.');
    }

    // public function downloadDocument(ProjectDocument $document)
    // {
    //         return response()->download(
    //             storage_path('app/public/' . $document->path),
    //             $document->filename
    //         );
    // }

};
