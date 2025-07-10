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
        //   dd('Store Project Data');
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
        ]);
        //  dd($project);
        // 3. Attacher les partenaires (many-to-many)
        if ($request->has('partners') && is_array($request->partners)) {
            $project->partners()->sync($request->partners); // Met à jour les partenaires
        } else {
            $project->partners()->detach(); // Aucun partenaire sélectionné, on vide la relation
        }
        // dd($project->partners);
        // 3.1 Si le projet a un partenaire spécifique, on l'ajoute
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

        // 3.3 Pour débogage, tu peux décommenter la ligne suivante pour voir les partenaires attachés
        // dd($project->partners);

        // 3.4 Pour vérifier les partenaires attachés
        // dd($project->partners);
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

       
        $selectedSubphases = $request->input('subphases', []); // contient subphases[phase_id][]
        // dd($selectedSubphases);
        // $selectedPhaseIds = array_keys($selectedSubphases);
        $selectedPhaseIds = array_filter(array_keys($selectedSubphases), fn($id) => is_numeric($id));

        // dd($selectedPhaseIds);
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

        // c) Enregistrer les sous-phases liées au projet
        // if (!empty($subphaseSyncData)) {
        //     $project->subphases()->sync($subphaseSyncData);
        // }

        if (!empty($subphaseSyncData)) {
            foreach ($subphaseSyncData as $subId => $data) {
                $project->subphases()->syncWithoutDetaching([$subId => $data]);
            }
        }

            // 5. Activités dynamiques de développement
        if ($request->has('development_activities')) {
            foreach ($request->input('development_activities') as $activityTitle) {
                if (!empty($activityTitle)) {
                    $project->developmentDetails()->create([
                        'title' => $activityTitle,
                        'subphase_id' => Subphase::where('name', 'development')->value('id'),
                    ]);
                }
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
        ]);

        $validated['start_date'] = Carbon::parse($validated['start_date'])->format('Y-m-d');
        $validated['end_date'] = Carbon::parse($validated['end_date'])->format('Y-m-d');

        $project->update($validated);

        // Partenaires
        $project->partners()->sync($request->input('partners', []));

        // Sous-phases
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

        // Activités de développement (tu peux optimiser avec diff)
        $project->developmentDetails()->delete();
        foreach ($request->input('development_activities', []) as $title) {
            $project->developmentDetails()->create([
                'title' => $title,
                'subphase_id' => Subphase::where('name', 'development')->value('id')
            ]);
        }

        return redirect()->route('allprojects')->with('success', 'Project updated successfully.');
    }

    public function show(Project $project)
    {
        // Récupérer le projet avec ses relations
        $project->load(['unit', 'projectManager', 'partners', 'phases', 'subphases','subphases.phase', 'developmentDetails']);

        // Calculer le pourcentage d'achèvement
        $completionPercentage = $project->getCompletionPercentageAttribute();
        $units = \App\Models\Unit::all();
        $projectManagers = \App\Models\User::whereHas('role', function ($query) {
            $query->whereIn('name', ['Admin', 'Project Manager']);
        })->get();

        // dd($project->project_manager_id);
        return view('projectshow', compact('project', 'completionPercentage', 'units', 'projectManagers'));
    }

    public function edit(Project $project)
    {
        // Charger les relations du projet
        $project->load(['unit', 'projectManager', 'partners', 'subphases', 'phases','developmentDetails']);


        // Données nécessaires pour les listes déroulantes et sélections
        $units = Unit::all();

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
            'phases'
        ));
    }

    public function updateField(Request $request, $id)
    {
        $project = Project::findOrFail($id);
        $field = $request->input('field');
        $value = $request->input('value');

        // Liste des champs autorisés
        $allowedFields = [
            'title', 'description', 'start_date', 'end_date',
            'priority', 'status', 'budget', 'type',
            'unit_id', 'project_manager_id', 'partners', 'procurement_type'
        ];

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

        // Libellés humains pour l'alerte
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

                return redirect()->back()->with('error', "Cannot complete this subphase because previous subphase \"$prevSubName\" in phase \"$prevPhaseName\" is still \"$prevStatus\".");
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

        $project->subphases()->updateExistingPivot($subphaseId, [
            'status' => $status,
            'percentage' => $percentage,
            'reason' => $reason
        ]);

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


    // public function destroy($id)
    // {
    //     $project = Project::findOrFail($id);

    //     // Supprimer les relations si nécessaire
    //     $project->partners()->detach();
    //     $project->subphases()->detach();
    //     $project->phases()->detach();
    //     $project->developmentDetails()->delete();

    //     $project->delete();

    //     return redirect()->route('allprojects')->with('success', 'Project deleted successfully.');
    // }

    public function requestDelete(Request $request, $id)
    {
        $request->validate(['reason' => 'required|string']);
        $project = Project::findOrFail($id);

        // Store reason (create a model if needed)
        \App\Models\ProjectDeletionRequest::create([
            'project_id' => $project->id,
            'requested_by' => Auth::id(),
            'reason' => $request->reason,
        ]);

        // Notify admins via email
        $admins =  \App\Models\User::whereHas('role', function ($query) {
                        $query->where('name', 'Admin');
                    })->get();
    
        $user = Auth::user();
        foreach ($admins as $admin) {
            Mail::to($admin->email)->send(new \App\Mail\ProjectDeletionRequestMail(
                $project,
                $request->reason,
                Auth::user()
            ));   
        }

        return back()->with('success', 'Deletion request sent to administrators.');
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

        // dd($highPriorityProjects);
        $projects = $query->get();
        // Compte les projets par statut
            $counts = [
                'all' => Project::where('type', 'Admin')->count(),
                'Not started' => Project::where('type', 'Admin')->where('status', 'Not started')->count(),
                'In progress' => Project::where('type', 'Admin')->where('status', 'In progress')->count(),
                'Completed' => Project::where('type', 'Admin')->where('status', 'Completed')->count(),
                'Cancelled' => Project::where('type', 'Admin')->where('status', 'Cancelled')->count(),
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

    // public function viewReport(Project $project)
    // {
    //     return view('viewreport', compact('project'));
    // }

    // public function viewReport(Project $project)
    // {
    //     // Crée d'abord le rapport sans code ni titre pour récupérer l'ID
    //     $report = Report::create([
    //         'project_id'   => $project->id,
    //         'user_id'      => Auth::id(),
    //         'format'       => 'web',
    //         'generated_at' => now(),
    //     ]);

    //     // Crée le code de rapport : #TYPE + ID (ex: #ADMIN4)
    //     $code = '#' . strtoupper($project->type) . $report->id;

    //     // Met à jour le rapport avec le code et le titre (ex: "#Project Alpha")
    //     $report->update([
    //         'code'  => $code,
    //         'title' => '#' . $project->title,
    //     ]);

    //     return view('viewreport', compact('project', 'report'));
    // }

};
