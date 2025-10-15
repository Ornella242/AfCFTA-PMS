<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\TaskActivity;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Models\TaskArchivationRequest;
use App\Mail\TaskArchiveRequest;
use App\Models\Unit;
use App\Mail\TaskAssignedMail;
use App\Notifications\TaskDeleteRequestNotification;

class TaskController extends Controller
{

    public function index(Request $request)
    {
        $user = Auth::user();
        // Tâches créées par l'utilisateur et non archivées
       if ($user->role->name === 'Admin' || $user->role->name === 'Admin Assistant') {
        // dd('admin here');
            $tasks = Task::with('assignedUser')
                        ->where('is_archived', false)
                        ->where('archived', false)
                        ->get();         
        } else {
            // dd('user here');
            $tasks = Task::with('assignedUser')
                        ->where('is_archived', false)
                        ->where('archived', false)
                        ->where(function ($q) use ($user) {
                            $q->where('created_by', $user->id)
                            ->orWhere('assigned_to', $user->id);
                        })
                        ->get();
        }

        $units = Unit::orderBy('name')->get(); 
        $types = ['HRM', 'Admin'];

        $users = User::orderBy('firstname')->get();

        // Tâches par statut (créées par l'utilisateur)
        $tasksPending = Task::where('status', 'pending')
            ->where('created_by', $user->id)
            ->get();

        $tasksProcessing = Task::where('status', 'processing')
            ->where('created_by', $user->id)
            ->get();

        $tasksCompleted = Task::where('status', 'completed')
            ->where('created_by', $user->id)
            ->get();

        // Demandes d'archivation
        $archiveRequests = TaskArchivationRequest::with('task', 'requester')
            ->where('approved', false)
            ->whereHas('task', function($q) use ($user) {
                $q->where('created_by', $user->id);
            })
            ->get();

        // Tâches par personne (seulement pour ses tâches)
        $tasksByUser = User::whereHas('tasks', function($q) use ($user) {
                $q->where('created_by', $user->id);
            })
            ->withCount(['tasks' => function($q) use ($user) {
                $q->where('created_by', $user->id);
            }])
            ->orderBy('tasks_count', 'desc')
            ->pluck('tasks_count', 'firstname');

        // Répartition par statut pour ses tâches
        $statusCounts = Task::select('status', DB::raw('COUNT(*) as total'))
            ->where('created_by', $user->id)
            ->groupBy('status')
            ->pluck('total', 'status');
        
         $myTasks = Task::where('assigned_to', Auth::id())
            ->select('status', DB::raw('COUNT(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status');

        // Activité récente pour ses tâches
        $activities = TaskActivity::with(['user', 'task'])
            ->whereHas('task', function($q) use ($user) {
                $q->where('created_by', $user->id);
            })
            ->latest()
            ->take(20)
            ->get();

        // Activité pour graph
        $activity = Task::selectRaw('DATE(updated_at) as date, COUNT(*) as total')
            ->where('created_by', $user->id)
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->pluck('total', 'date');

        return view('alltasks', compact(
            'tasks',
            'users',
            'tasksPending',
            'tasksProcessing',
            'tasksCompleted',
            'tasksByUser',
            'statusCounts',
            'activity',
            'activities',
            'archiveRequests',
            'units',
            'types',
            'myTasks'
        ));
    }


    // public function indexhrm(Request $request)
    // {
    //     $user = Auth::user();
    //     $unitId = $request->get('unit_id'); // récupère le filtre
        

    //     // 🔹 Base query
    //     $baseQuery = Task::with('assignedUser')
    //         ->where('created_by', $user->id)
    //         ->where('is_archived', false)
    //         ->where('type', 'HRM');

    //     if ($unitId) {
    //         $baseQuery->where('unit_id', $unitId);
    //     }

    //     $tasks = $baseQuery->get();

    //     // 🔹 Tâches par statut
    //     $tasksPending = (clone $baseQuery)->where('status', 'pending')->get();
    //     $tasksProcessing = (clone $baseQuery)->where('status', 'processing')->get();
    //     $tasksCompleted = (clone $baseQuery)->where('status', 'completed')->get();

    //     // 🔹 Demandes d’archivation
    //     $archiveRequests = TaskArchivationRequest::with('task', 'requester')
    //         ->where('approved', false)
    //         ->whereHas('task', function($q) use ($user, $unitId) {
    //             $q->where('created_by', $user->id)
    //             ->where('type', 'HRM');
    //             if ($unitId) {
    //                 $q->where('unit_id', $unitId);
    //             }
    //         })
    //         ->get();

    //     // 🔹 Tâches par personne
    //     $tasksByUser = User::whereHas('tasks', function($q) use ($user, $unitId) {
    //             $q->where('created_by', $user->id)
    //             ->where('type', 'HRM');
    //             if ($unitId) {
    //                 $q->where('unit_id', $unitId);
    //             }
    //         })
    //         ->withCount(['tasks' => function($q) use ($user, $unitId) {
    //             $q->where('created_by', $user->id)
    //             ->where('type', 'HRM');
    //             if ($unitId) {
    //                 $q->where('unit_id', $unitId);
    //             }
    //         }])
    //         ->orderBy('tasks_count', 'desc')
    //         ->pluck('tasks_count', 'firstname');

    //     // 🔹 Répartition par statut
    //     $statusCounts = Task::select('status', DB::raw('COUNT(*) as total'))
    //         ->where('created_by', $user->id)
    //         ->where('type', 'HRM')
    //         ->when($unitId, function($q) use ($unitId) {
    //             $q->where('unit_id', $unitId);
    //         })
    //         ->groupBy('status')
    //         ->pluck('total', 'status');

    //     // 🔹 Activité
    //     $activities = TaskActivity::with(['user', 'task'])
    //         ->whereHas('task', function($q) use ($user, $unitId) {
    //             $q->where('created_by', $user->id)
    //             ->where('type', 'HRM');
    //             if ($unitId) {
    //                 $q->where('unit_id', $unitId);
    //             }
    //         })
    //         ->latest()
    //         ->take(20)
    //         ->get();

    //     $activity = Task::selectRaw('DATE(updated_at) as date, COUNT(*) as total')
    //         ->where('created_by', $user->id)
    //         ->where('type', 'HRM')
    //         ->when($unitId, function($q) use ($unitId) {
    //             $q->where('unit_id', $unitId);
    //         })
    //         ->groupBy('date')
    //         ->orderBy('date', 'asc')
    //         ->pluck('total', 'date');

    //     // 🔹 Listes pour le formulaire
    //     $units = Unit::orderBy('name')->get();
    //     $types = ['HRM', 'Admin'];
    //     $users = User::orderBy('firstname')->get();

    //     return view('hrmtasks', compact(
    //         'tasks',
    //         'users',
    //         'tasksPending',
    //         'tasksProcessing',
    //         'tasksCompleted',
    //         'tasksByUser',
    //         'statusCounts',
    //         'activity',
    //         'activities',
    //         'archiveRequests',
    //         'units',
    //         'types'
    //     ));
    // }

    public function indexhrm(Request $request)
    {
        $user = Auth::user();
        $unitId = $request->get('unit_id'); // filtre unité
        $isAdmin = in_array($user->role->name, ['Admin', 'Admin Assistant']); // 🔹 Vérifie le rôle

        // 🔹 Base query
        $baseQuery = Task::with('assignedUser')
            ->where('is_archived', false)
            ->where('type', 'HRM');

        // Si ce n’est PAS un Admin/Admin Assistant → filtrer sur created_by
        if (!$isAdmin) {
            $baseQuery->where('created_by', $user->id);
        }

        if ($unitId) {
            $baseQuery->where('unit_id', $unitId);
        }

        $tasks = $baseQuery->get();

        // 🔹 Tâches par statut
        $tasksPending = (clone $baseQuery)->where('status', 'pending')->get();
        $tasksProcessing = (clone $baseQuery)->where('status', 'processing')->get();
        $tasksCompleted = (clone $baseQuery)->where('status', 'completed')->get();

        // 🔹 Demandes d’archivation
        $archiveRequests = TaskArchivationRequest::with('task', 'requester')
            ->where('approved', false)
            ->whereHas('task', function($q) use ($user, $unitId, $isAdmin) {
                $q->where('type', 'HRM');
                if (!$isAdmin) {
                    $q->where('created_by', $user->id);
                }
                if ($unitId) {
                    $q->where('unit_id', $unitId);
                }
            })
            ->get();

        // 🔹 Tâches par personne
        $tasksByUser = User::whereHas('tasks', function($q) use ($user, $unitId, $isAdmin) {
                $q->where('type', 'HRM');
                if (!$isAdmin) {
                    $q->where('created_by', $user->id);
                }
                if ($unitId) {
                    $q->where('unit_id', $unitId);
                }
            })
            ->withCount(['tasks' => function($q) use ($user, $unitId, $isAdmin) {
                $q->where('type', 'HRM');
                if (!$isAdmin) {
                    $q->where('created_by', $user->id);
                }
                if ($unitId) {
                    $q->where('unit_id', $unitId);
                }
            }])
            ->orderBy('tasks_count', 'desc')
            ->pluck('tasks_count', 'firstname');

        // 🔹 Répartition par statut
        $statusCounts = Task::select('status', DB::raw('COUNT(*) as total'))
            ->where('type', 'HRM')
            ->when(!$isAdmin, fn($q) => $q->where('created_by', $user->id))
            ->when($unitId, fn($q) => $q->where('unit_id', $unitId))
            ->groupBy('status')
            ->pluck('total', 'status');

        // 🔹 Activité
        $activities = TaskActivity::with(['user', 'task'])
            ->whereHas('task', function($q) use ($user, $unitId, $isAdmin) {
                $q->where('type', 'HRM');
                if (!$isAdmin) {
                    $q->where('created_by', $user->id);
                }
                if ($unitId) {
                    $q->where('unit_id', $unitId);
                }
            })
            ->latest()
            ->take(20)
            ->get();

        // 🔹 Activité par date
        $activity = Task::selectRaw('DATE(updated_at) as date, COUNT(*) as total')
            ->where('type', 'HRM')
            ->when(!$isAdmin, fn($q) => $q->where('created_by', $user->id))
            ->when($unitId, fn($q) => $q->where('unit_id', $unitId))
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->pluck('total', 'date');

        // 🔹 Données pour le formulaire
        $units = Unit::orderBy('name')->get();
        $types = ['HRM', 'Admin'];
        $users = User::orderBy('firstname')->get();

        return view('hrmtasks', compact(
            'tasks',
            'users',
            'tasksPending',
            'tasksProcessing',
            'tasksCompleted',
            'tasksByUser',
            'statusCounts',
            'activity',
            'activities',
            'archiveRequests',
            'units',
            'types'
        ));
    }



    // public function indexadmin(Request $request)
    // {
    //     $user = Auth::user();

    //     // Base query = uniquement Admin et non archivées
    //     $query = Task::with('assignedUser')
    //         ->where('is_archived', false)
    //         ->where('type', 'Admin');

    //     // --- filtre Unit si sélectionné ---
    //     if ($request->filled('unit_id')) {
    //         $query->where('unit_id', $request->unit_id);
    //     }

    //     $tasks = $query->get();

    //     $units = Unit::orderBy('name')->get(); 
    //     $types = ['HRM', 'Admin'];
    //     $users = User::orderBy('firstname')->get();

    //     // Tâches par statut (type Admin + filtre unit si présent)
    //     $tasksPending = (clone $query)->where('status', 'pending')->get();
    //     $tasksProcessing = (clone $query)->where('status', 'processing')->get();
    //     $tasksCompleted = (clone $query)->where('status', 'completed')->get();

    //     // Demandes d'archivation
    //     $archiveRequests = TaskArchivationRequest::with('task', 'requester')
    //         ->where('approved', false)
    //         ->whereHas('task', function($q) use ($request) {
    //             $q->where('type', 'Admin');
    //             if ($request->filled('unit_id')) {
    //                 $q->where('unit_id', $request->unit_id);
    //             }
    //         })
    //         ->get();

    //     // Tâches par personne (type Admin + filtre unit si présent)
    //     $tasksByUser = User::whereHas('tasks', function($q) use ($request) {
    //             $q->where('type', 'Admin');
    //             if ($request->filled('unit_id')) {
    //                 $q->where('unit_id', $request->unit_id);
    //             }
    //         })
    //         ->withCount(['tasks' => function($q) use ($request) {
    //             $q->where('type', 'Admin');
    //             if ($request->filled('unit_id')) {
    //                 $q->where('unit_id', $request->unit_id);
    //             }
    //         }])
    //         ->orderBy('tasks_count', 'desc')
    //         ->pluck('tasks_count', 'firstname');

    //     // Répartition par statut (Admin + filtre unit)
    //     $statusCounts = (clone $query)
    //         ->select('status', DB::raw('COUNT(*) as total'))
    //         ->groupBy('status')
    //         ->pluck('total', 'status');

    //     // Activité récente (Admin + filtre unit)
    //     $activities = TaskActivity::with(['user', 'task'])
    //         ->whereHas('task', function($q) use ($request) {
    //             $q->where('type', 'Admin');
    //             if ($request->filled('unit_id')) {
    //                 $q->where('unit_id', $request->unit_id);
    //             }
    //         })
    //         ->latest()
    //         ->take(20)
    //         ->get();

    //     // Activité pour graph (Admin + filtre unit)
    //     $activity = (clone $query)
    //         ->selectRaw('DATE(updated_at) as date, COUNT(*) as total')
    //         ->groupBy('date')
    //         ->orderBy('date', 'asc')
    //         ->pluck('total', 'date');

    //     return view('admintasks', compact(
    //         'tasks',
    //         'users',
    //         'tasksPending',
    //         'tasksProcessing',
    //         'tasksCompleted',
    //         'tasksByUser',
    //         'statusCounts',
    //         'activity',
    //         'activities',
    //         'archiveRequests',
    //         'units',
    //         'types'
    //     ));
    // }

public function indexadmin(Request $request)
{
    $user = Auth::user();
    $unitId = $request->get('unit_id');
    $isAdmin = in_array($user->role->name, ['Admin', 'Admin Assistant']); // 🔹 Vérifie le rôle

    // 🔹 Base query
    $baseQuery = Task::with('assignedUser')
        ->where('is_archived', false)
        ->where('type', 'Admin');

    // 🔸 Si pas Admin/Admin Assistant → ne montrer que ses tâches
    if (!$isAdmin) {
        $baseQuery->where('created_by', $user->id);
    }

    // 🔸 Filtre unité si sélectionné
    if ($unitId) {
        $baseQuery->where('unit_id', $unitId);
    }

    $tasks = $baseQuery->get();

    // 🔹 Listes pour le formulaire
    $units = Unit::orderBy('name')->get(); 
    $types = ['HRM', 'Admin'];
    $users = User::orderBy('firstname')->get();

    // 🔹 Tâches par statut
    $tasksPending = (clone $baseQuery)->where('status', 'pending')->get();
    $tasksProcessing = (clone $baseQuery)->where('status', 'processing')->get();
    $tasksCompleted = (clone $baseQuery)->where('status', 'completed')->get();

    // 🔹 Demandes d’archivation
    $archiveRequests = TaskArchivationRequest::with('task', 'requester')
        ->where('approved', false)
        ->whereHas('task', function($q) use ($user, $unitId, $isAdmin) {
            $q->where('type', 'Admin');
            if (!$isAdmin) {
                $q->where('created_by', $user->id);
            }
            if ($unitId) {
                $q->where('unit_id', $unitId);
            }
        })
        ->get();

    // 🔹 Tâches par personne
    $tasksByUser = User::whereHas('tasks', function($q) use ($user, $unitId, $isAdmin) {
            $q->where('type', 'Admin');
            if (!$isAdmin) {
                $q->where('created_by', $user->id);
            }
            if ($unitId) {
                $q->where('unit_id', $unitId);
            }
        })
        ->withCount(['tasks' => function($q) use ($user, $unitId, $isAdmin) {
            $q->where('type', 'Admin');
            if (!$isAdmin) {
                $q->where('created_by', $user->id);
            }
            if ($unitId) {
                $q->where('unit_id', $unitId);
            }
        }])
        ->orderBy('tasks_count', 'desc')
        ->pluck('tasks_count', 'firstname');

    // 🔹 Répartition par statut
    $statusCounts = Task::select('status', DB::raw('COUNT(*) as total'))
        ->where('type', 'Admin')
        ->when(!$isAdmin, fn($q) => $q->where('created_by', $user->id))
        ->when($unitId, fn($q) => $q->where('unit_id', $unitId))
        ->groupBy('status')
        ->pluck('total', 'status');

    // 🔹 Activité récente
    $activities = TaskActivity::with(['user', 'task'])
        ->whereHas('task', function($q) use ($user, $unitId, $isAdmin) {
            $q->where('type', 'Admin');
            if (!$isAdmin) {
                $q->where('created_by', $user->id);
            }
            if ($unitId) {
                $q->where('unit_id', $unitId);
            }
        })
        ->latest()
        ->take(20)
        ->get();

    // 🔹 Activité pour le graph
    $activity = Task::selectRaw('DATE(updated_at) as date, COUNT(*) as total')
        ->where('type', 'Admin')
        ->when(!$isAdmin, fn($q) => $q->where('created_by', $user->id))
        ->when($unitId, fn($q) => $q->where('unit_id', $unitId))
        ->groupBy('date')
        ->orderBy('date', 'asc')
        ->pluck('total', 'date');

    return view('admintasks', compact(
        'tasks',
        'users',
        'tasksPending',
        'tasksProcessing',
        'tasksCompleted',
        'tasksByUser',
        'statusCounts',
        'activity',
        'activities',
        'archiveRequests',
        'units',
        'types'
    ));
}


    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'priority' => 'required|in:high,medium,low',
            'status' => 'required|in:pending,processing,completed',
            'assigned_to' => 'required|exists:users,id',
            'type' => 'required|in:HRM,Admin',
            'unit_id' => 'required|exists:units,id',
        ]);
        $validated['created_by'] = Auth::id();

        $task = Task::create($validated);

        // ✅ Envoi du mail à la personne assignée
        $assignedUser = \App\Models\User::find($task->assigned_to);
        if ($assignedUser && $assignedUser->email) {
            Mail::to($assignedUser->email)->send(new TaskAssignedMail($task));
        }

        return redirect()->back()->with('success', 'Task created successfully and notification sent!');
    }
   

    public function updateStatus(Task $task, Request $request)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,completed'
        ]);

        $oldStatus = $task->status;
        $newStatus = $request->status;

        if ($oldStatus !== $newStatus) {
            // Log dans task_activities
            \App\Models\TaskActivity::create([
                'task_id' => $task->id,
                'user_id' => Auth::user()->id,
                'from_status' => $oldStatus,
                'to_status' => $newStatus,
            ]);
        }

        $task->status = $newStatus;
        $task->save();

        return redirect()->back()->with('success', 'Task status updated!');
    }



    public function show($encryptedId)
    {
        $id = decrypt($encryptedId);
        $task = Task::with(['assignedUser', 'comments.user'])->findOrFail($id);

        return response()->json([
            'id' => $task->id,
            'title' => $task->title,
            'description' => $task->description,
            'start_date' => $task->start_date,
            'end_date' => $task->end_date,
            'priority' => $task->priority,
            'status' => $task->status,
            'assigned_user' => [
                'id' => $task->assignedUser?->id,
                'firstname' => $task->assignedUser?->firstname,
                'lastname' => $task->assignedUser?->lastname,
            ],
            'comments' => $task->comments->map(function($comment) {
                return [
                    'id' => $comment->id,
                    'comment' => $comment->comment,
                    'created_at' => $comment->created_at->format('d M Y H:i'),
                    'user' => [
                        'id' => $comment->user?->id,
                        'firstname' => $comment->user?->firstname,
                        'lastname' => $comment->user?->lastname,
                    ]
                ];
            })
        ]);
    }



    public function storeComment(Request $request, $id)
    {
        try {
            // Déchiffrer l'ID
            $taskId = decrypt($id);
        } catch (\Exception $e) {
            return back()->with('error', 'Invalid task identifier.');
        }

        // Récupérer la tâche
        $task = Task::findOrFail($taskId);

        // Validation
        $request->validate([
            'comment' => 'required|string|max:1000',
        ]);

        // Créer le commentaire
        $comment = $task->comments()->create([
            'comment' => $request->comment,
            'user_id' => Auth::id(),
        ]);

        return back()->with('success', 'Comment added successfully.');
    }


    public function summary()
    {
        // 1. Tâches par personne (nom => nombre)
        $tasksByUser = User::withCount('tasks')
            ->orderBy('tasks_count', 'desc')
            ->pluck('tasks_count', 'name');

        // 2. Répartition par statut
        $statusCounts = Task::select('status', DB::raw('COUNT(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status');

        // 3. Activité récente (graph/stat)
        $activity = \App\Models\Task::selectRaw('DATE(created_at) as date, COUNT(*) as total')
            ->whereIn('event_type', ['status_changed', 'comment_added'])
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->pluck('total', 'date');
         // 4. Tâches assignées à l’utilisateur connecté
        $myTasks = Task::where('assigned_to', Auth::id())
            ->select('status', DB::raw('COUNT(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status');
        
        return view('alltasks', compact('tasksByUser', 'statusCounts', 'activity', 'myTasks'));
    }


    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date'  => 'nullable|date',
            'end_date'    => 'nullable|date|after_or_equal:start_date',
            'status'      => 'required|in:pending,processing,completed',
            'unit_id' => 'nullable|exists:units,id',
            'type' => 'nullable|in:HRM,Admin',
            'assigned_user_id' => 'nullable|exists:users,id',
        ]);

        if ($request->status === 'completed' && $task->status !== 'completed') {
            $task->completed_at = now();
        }
        $task->update($request->all());
        return redirect()->back()->with('success', 'Task updated successfully!');
    }

    

    public function archive(Task $task, $encryptedId)
    {
        $id = decrypt($encryptedId);
        $task = Task::findOrFail($id);
        $user = Auth::user();

        if ($task->created_by == $user->id) {
            // Cas 1 : L'utilisateur est le créateur → archivage direct
            $task->is_archived = true;
            $task->save();

            return redirect()->back()->with('success', 'Task archived successfully!');
        } else {
            // dd('here requester');
            // Cas 2 : L’utilisateur n’est pas le créateur → demande d’archivage enregistrée
        TaskArchivationRequest::create([
                'task_id'  => $task->id,
                'requested_by' => $user->id,
                'user_id'  => $user->id,
                'reason'   => request('reason') ?? 'No reason provided',
                'approved' => 0,
            ]);
            
            // (Optionnel) notifier le créateur par mail
            $creator = $task->creator;
            if ($creator && $creator->email) {
                Mail::to($creator->email)->send(new TaskArchiveRequest($task, $user));
            }

            return redirect()->back()->with('success', 'Archive request submitted for approval.');
        }
    }



    public function chartData()
    {
        // 1. Tâches par personne
        $tasksByUserQuery = Task::join('users', 'tasks.assigned_to', '=', 'users.id')
            ->selectRaw('users.id, users.firstname as username, COUNT(*) as total')
            ->where('tasks.is_archived', false)   // exclure les archivées
            ->groupBy('users.id', 'users.firstname');

        if (Auth::user()->role->name === 'Project Manager') {
            $tasksByUserQuery->where('tasks.created_by', Auth::id());
        }

        $tasksByUser = $tasksByUserQuery->pluck('total', 'username');

        // 2. Répartition par statut (Admin vs Project Manager)
        $statusQuery = Task::where('is_archived', false);

        if (Auth::user()->role->name === 'Project Manager') {
            // Un PM ne voit que les tâches qu’il a assignées
            $statusQuery->where('created_by', Auth::id());
        }

        $statusCounts = $statusQuery
            ->selectRaw('status, count(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status');

        // 3. Mes propres tâches
        $myTasks = Task::where('assigned_to', Auth::id())
            ->where('is_archived', false)
            ->selectRaw('status, count(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status');

        return response()->json([
            'tasksByUser'   => $tasksByUser,
            'statusCounts'  => $statusCounts,
            'myTasks'       => $myTasks,
        ]);
    }

}
