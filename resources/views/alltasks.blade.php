@include('partials.navbar')
<style>
/* Style global du menu */
.custom-nav .nav-link {
    color: #555;
    font-weight: 500;
    padding: 10px 18px;
    border: none;
    display: flex;
    align-items: center;
    gap: 6px;
    transition: all 0.3s ease;
}

/* Icônes un peu plus grandes */
.custom-nav .nav-link i {
    font-size: 16px;
}

/* Onglet actif */
.custom-nav .nav-link.active {
    color: #fff !important;
    background: linear-gradient(135deg, #D0627C, #9E2140);
    border-radius: 8px;
    box-shadow: 0 3px 6px rgba(0,0,0,0.1);
}

/* Effet hover */
.custom-nav .nav-link:hover {
    color: #9E2140;
    background-color: #f5f6fa;
    border-radius: 8px;
}

/* Supprimer la ligne par défaut de bootstrap */
.custom-nav {
    border-bottom: none !important;
    gap: 8px;
}

.main-img {
  background: linear-gradient(rgba(0,0,0,.25), rgba(0,0,0,.25)),
    url('/images/bg1.jpg') center / cover no-repeat;
  min-height: 40vh;      /* assure une hauteur visible */
  position: relative; 
}

</style>

<main role="main" class="main-content bg-main bg-gold main-img">
    <div class="container-fluid">
        <div class="col-12 mb-3">     
            <div class="d-flex align-items-center border-bottom mb-3">
                <h3 class="mb-0 mr-4 text-white">Task Management Board</h3>
                <button type="button" class="btn bg-green text-white btn-sm ml-auto mb-2 p-2"  data-toggle="modal" data-target="#createTaskModal">
                    <i class="fe fe-plus"></i> Create new task
                </button>
            </div>
        </div>
        <div class="col-12">
            @if(auth()->user()->role && auth()->user()->role->name === 'Admin' && $archiveRequests->count())
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-warning text-dark d-flex align-items-center">
                        <i class="fe fe-archive text-white mr-2"></i>
                        <h5 class="mb-0 text-white">Pending Task Archivation Requests</h5>
                    </div>
                    <div class="card-body">
                        @foreach($archiveRequests as $request)
                            <div class="card border-light shadow-sm mb-3">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div>
                                            <h6 class="mb-1">
                                                <i class="fe fe-user text-primary"></i>
                                                <strong>{{ $request->requester->firstname }} {{ $request->requester->lastname }}</strong>
                                                <span class="badge badge-secondary p-1">requested</span>
                                            </h6>
                                            <p class="mb-1">
                                                To archive: 
                                                <span class="font-weight-bold text-dark">
                                                    <i class="fe fe-file-text text-info"></i> {{ $request->task->title }}
                                                </span>
                                            </p>
                                            <p class="text-black small mb-0">
                                                <i class="fe fe-message-circle"></i>
                                                <strong>Reason:</strong> {{ $request->reason }}
                                            </p>
                                        </div>
                                        <div class="d-flex flex-column">
                                            <form action="{{ route('taskArchiveRequests.approve', $request->id) }}" method="POST" class="mb-2">
                                                @csrf
                                                <button type="submit" class="btn btn-success btn-sm">
                                                    <i class="fe fe-check"></i> Approve
                                                </button>
                                            </form>
                                           
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#declineModal{{ $request->id }}">
                                                <i class="fe fe-x"></i> Decline
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                             <div class="modal fade" id="declineModal{{ $request->id }}" tabindex="-1" role="dialog">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header bg-danger text-white">
                                            <h5 class="modal-title text-white">Decline Request</h5>
                                            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                                <span>&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('taskArchiveRequests.decline', $request->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <div class="modal-body">
                                                <p>Please provide a reason for declining this request:</p>
                                                <textarea name="decline_reason" class="form-control" rows="3" required></textarea>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-danger">Confirm Decline</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>


        <div class="col-12">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Fermer">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Fermer">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
        </div>

        <div class="col-12 mb-3">     
            <div class="card shadow p-2 rounded-lg">
                <ul class="nav nav-tabs custom-nav" id="taskTabs" role="tablist">
                    @if (auth()->user()->role && auth()->user()->role->name !== 'Member' && auth()->user()->role->name !== 'Project Manager Assistant')  
                        <li class="nav-item">
                            <a class="nav-link active" id="summary-tab" data-toggle="tab" href="#summary-tab-content" role="tab" aria-controls="summary-tab-content" aria-selected="true">
                                <i class="fe fe-aperture"></i> Summary
                            </a>
                        </li>
                    @endif
                   
                    <li class="nav-item">
                        <a class="nav-link" id="board-tab" data-toggle="tab" href="#board-tab-content" role="tab" aria-controls="board-tab-content" aria-selected="false">
                            <i class="fe fe-columns"></i> Board
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="list-tab" data-toggle="tab" href="#list-tab-content" role="tab" aria-controls="list-tab-content" aria-selected="false">
                            <i class="fe fe-list"></i> List
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="calendar-tab" data-toggle="tab" href="#calendar-tab-content" role="tab" aria-controls="calendar-tab-content" aria-selected="false">
                            <i class="fe fe-calendar"></i> Calendar
                        </a>
                    </li>
                   
                </ul>
            </div>
        </div>

        <div class="col-12 tab-content mt-3" id="taskTabsContent">
                <!-- SUMMARY -->
              @if (auth()->user()->role && auth()->user()->role->name !== 'Member' && auth()->user()->role->name !== 'Project Manager Assistant')
                <div class="tab-pane fade-in show active" id="summary-tab-content" role="tabpanel" aria-labelledby="summary-tab">
                    <div class="row"> 
                            <div class="col-md-6">
                                <div class="card shadow mb-3">
                                    <div class="card-header bg-gold text-white">All tasks assigned by status</div>
                                    <div class="card-body">
                                        <canvas id="statusPieChart"></canvas>
                                    </div>
                                </div>
                            </div>


                        <div class="col-md-6">
                            <div class="card shadow mb-3">
                                <div class="card-header bg-maroon text-white">My tasks by status</div>
                                <div class="card-body">
                                    <canvas id="myTasksChart"></canvas>
                                </div>
                            </div>
                        </div>

                        <!-- Activité -->
                            
                            <div class="col-md-6">
                                <div class="card shadow mb-3">
                                    <div class="card-header bg-maroon text-white">Recent Activity</div>
                                        <div class="card-body">
                                                <ul class="list-group list-group-flush">
                                                    @foreach($activities as $log)
                                                        <li class="list-group-item">
                                                            <div class="d-flex justify-content-between">
                                                                <div>
                                                                    <strong>{{ $log->user->firstname }}</strong> 
                                                                    changed <strong>{{ $log->task->title }}</strong><br>
                                                                    <span class="badge bg-grey">{{ $log->from_status }}</span>
                                                                    →
                                                                    <span class="badge bg-green text-white">{{ $log->to_status }}</span>
                                                                </div>
                                                                <small class="text-muted">
                                                                    {{ $log->created_at->diffForHumans() }}
                                                                </small>
                                                            </div>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                        </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="card shadow mb-3">
                                    <div class="card-header bg-green text-white">Tasks assigned per person</div>
                                    <div class="card-body">
                                        <canvas id="tasksByUserChart"></canvas>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
           @endif
            <!-- BOARD -->
            <div class="tab-pane fade-in" id="board-tab-content" role="tabpanel" aria-labelledby="board-tab">
                <div class="row">
                    <!-- TO DO -->
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header bg-gold d-flex justify-content-between align-items-center text-white">
                                <strong>To Do</strong>
                                <button type="button" class="btn btn-sm bg-maroon text-white" data-toggle="modal" data-target="#createTaskModal">Create</button>
                            </div>
                            <div class="card-body min-vh-50" id="todo" data-status="pending">
                                @foreach($tasks->where('status', 'pending') as $task)
                                    <div class="card mb-2 task-item" 
                                        data-id="{{ $task->id }}" 
                                        data-toggle="modal" 
                                        data-target="#taskDetailsModal"
                                        draggable="true"
                                        style="cursor: pointer; border-left: 4px solid 
                                            {{ $task->status == 'pending' ? '#007bff' : ($task->status == 'processing' ? '#ffc107' : '#28a745') }};">
                                        <div class="card-body p-2">
                                            <strong class="d-block mb-1">{{ $task->title }}</strong>
                                            <div class="d-flex align-items-center mb-1">
                                                <i class="fe fe-calendar mr-2 text-muted"></i>
                                                <small class="text-muted mt-1">
                                                    {{ \Carbon\Carbon::parse($task->start_date)->format('M d, Y') }}
                                                </small>
                                            </div>
                                            <div class="d-flex align-items-center mb-1">
                                                <i class="fe fe-calendar mr-2 text-muted"></i>
                                                <small class="text-muted mt-1">
                                                    End: {{ \Carbon\Carbon::parse($task->end_date)->format('M d, Y') }}
                                                </small>
                                            </div>
                                            <div class="d-flex align-items-center mb-1">
                                                <i class="fe fe-alert-circle mr-2 
                                                    {{ $task->priority == 'high' ? 'text-danger' : ($task->priority == 'medium' ? 'text-warning' : 'text-muted') }}">
                                                </i>
                                                <small class="{{ $task->priority == 'high' ? 'text-danger' : ($task->priority == 'medium' ? 'text-warning' : 'text-muted') }} font-weight-bold mt-1">
                                                    {{ ucfirst($task->priority) }}
                                                </small>
                                            </div>
                                            <div class="d-flex justify-content-end mt-2">
                                                <span class="badge badge-pill bg-success text-white" 
                                                    style="width: 32px; height: 32px; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                                    {{ strtoupper(substr($task->assignedUser->firstname, 0, 1) . substr($task->assignedUser->lastname, 0, 1)) }}
                                                </span>
                                            </div>
                                        </div>  
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- IN PROGRESS -->
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header bg-yellow text-white"><strong>In Progress</strong></div>
                                <div class="card-body min-vh-50" id="inprogress" data-status="processing">
                                    @foreach($tasks->where('status', 'processing') as $task)
                                        <div class="card mb-2 task-item" 
                                                data-id="{{ $task->id }}" 
                                                data-toggle="modal" 
                                                data-target="#taskDetailsModal" 
                                                style="cursor: pointer; border-left: 4px solid 
                                                {{ $task->status == 'pending' ? '#007bff' : ($task->status == 'processing' ? '#ffc107' : '#28a745') }};">
                                                
                                                <div class="card-body p-2">
                                                    <strong class="d-block mb-1">{{ $task->title }}</strong>

                                                    <!-- Dates -->
                                                    <div class="d-flex align-items-center mb-1">
                                                        <i class="fe fe-calendar mr-2 text-muted"></i>
                                                        <small class="text-muted mt-1">{{ \Carbon\Carbon::parse($task->start_date)->format('M d, Y') }}</small>
                                                    </div>
                                                    <div class="d-flex align-items-center mb-1">
                                                        <i class="fe fe-calendar mr-2 text-muted"></i>
                                                        <small class="text-muted mt-1">End: {{ \Carbon\Carbon::parse($task->end_date)->format('M d, Y') }}</small>
                                                    </div>

                                                    <!-- Priority -->
                                                    <div class="d-flex align-items-center mb-1">
                                                        <i class="fe fe-alert-circle mr-2 
                                                        {{ $task->priority == 'high' ? 'text-danger' : ($task->priority == 'medium' ? 'text-warning' : 'text-muted') }}">
                                                        </i>
                                                        <small class="{{ $task->priority == 'high' ? 'text-danger' : ($task->priority == 'medium' ? 'text-warning' : 'text-muted') }} font-weight-bold mt-1">
                                                            {{ ucfirst($task->priority) }}
                                                        </small>
                                                    </div>

                                                    <!-- Assigned to -->
                                                    <div class="d-flex justify-content-end mt-2">
                                                        <span class="badge badge-pill bg-success text-white" 
                                                            style="width: 32px; height: 32px; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                                            {{ strtoupper(substr($task->assignedUser->firstname, 0, 1) . substr($task->assignedUser->lastname, 0, 1)) }}
                                                        </span>
                                                    </div>
                                                </div>  
                                        </div>
                                    @endforeach
                                </div>
                        </div>
                    </div>

                    <!-- DONE -->
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header bg-green text-white"><strong>Done</strong></div>
                            <div class="card-body min-vh-50" id="done" data-status="completed">
                                @foreach($tasks->where('status', 'completed') as $task)
                                    <div class="card mb-2 task-item" 
                                            data-id="{{ $task->id }}" 
                                            data-toggle="modal" 
                                            data-target="#taskDetailsModal" 
                                            style="cursor: pointer; border-left: 4px solid 
                                            {{ $task->status == 'pending' ? '#007bff' : ($task->status == 'processing' ? '#ffc107' : '#28a745') }};">
                                            <div class="card-body p-2">
                                                <strong class="d-block mb-1">{{ $task->title }}</strong>

                                                <!-- Dates -->
                                                <div class="d-flex align-items-center mb-1">
                                                    <i class="fe fe-calendar mr-2 text-muted"></i>
                                                    <small class="text-muted mt-1">{{ \Carbon\Carbon::parse($task->start_date)->format('M d, Y') }}</small>
                                                </div>
                                                <div class="d-flex align-items-center mb-1">
                                                    <i class="fe fe-calendar mr-2 text-muted"></i>
                                                    <small class="text-muted mt-1">End: {{ \Carbon\Carbon::parse($task->end_date)->format('M d, Y') }}</small>
                                                </div>

                                                <!-- Priority -->
                                                <div class="d-flex align-items-center mb-1">
                                                    <i class="fe fe-alert-circle mr-2 
                                                    {{ $task->priority == 'high' ? 'text-danger' : ($task->priority == 'medium' ? 'text-warning' : 'text-muted') }}">
                                                    </i>
                                                    <small class="{{ $task->priority == 'high' ? 'text-danger' : ($task->priority == 'medium' ? 'text-warning' : 'text-muted') }} font-weight-bold mt-1">
                                                        {{ ucfirst($task->priority) }}
                                                    </small>
                                                </div>

                                                <!-- Assigned to -->
                                                <div class="d-flex justify-content-end mt-2">
                                                    <span class="badge badge-pill bg-success text-white" 
                                                        style="width: 32px; height: 32px; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                                        {{ strtoupper(substr($task->assignedUser->firstname, 0, 1) . substr($task->assignedUser->lastname, 0, 1)) }}
                                                    </span>
                                                </div>
                                            </div>  
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- LIST -->
            <div class="tab-pane fade-in" id="list-tab-content" role="tabpanel" aria-labelledby="list-tab">
                <div class="card shadow-lg border-0 rounded-4">
                    <div class="card-body p-0">
                        <div class="table-responsive" style="overflow-x:auto;">
                            <table class="table table-striped table-hover align-middle mb-0">
                                <thead class="bg-green text-white">
                                    <tr>
                                        <th>Title</th>
                                        <th>Assignee</th>
                                        <th>Start </th>
                                        <th>End </th>
                                        <th>Priority</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($tasks as $task)
                                        <tr>
                                            <td class="fw-semibold bg-green-light text-white">{{ $task->title }}</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                
                                                    <span class="ms-2">{{ $task->assignedUser->firstname ?? 'Unassigned' }}</span>
                                                </div>
                                            </td>
                                            <td>{{ $task->start_date ? \Carbon\Carbon::parse($task->start_date)->format('d M Y') : '—' }}</td>
                                            <td>{{ $task->end_date ? \Carbon\Carbon::parse($task->end_date)->format('d M Y') : '—' }}</td>
                                            <td>
                                                @if($task->priority == 'high')
                                                    <span class="badge bg-danger text-white p-1">High</span>
                                                @elseif($task->priority == 'medium')
                                                    <span class="badge bg-warning text-white p-1">Medium</span>
                                                @else
                                                    <span class="badge bg-success text-white p-1">Low</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($task->status == 'pending')
                                                    <span class="badge bg-secondary text-white p-1">Pending</span>
                                                @elseif($task->status == 'processing')
                                                    <span class="badge bg-info text-white p-1">In Progress</span>
                                                @else
                                                    <span class="badge bg-success text-white p-1">Completed</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="btn-group">
                                                    <button class="btn btn-sm btn-light"data-id="{{ encrypt($task->id) }}" 
                                                            data-toggle="modal" 
                                                            data-target="#taskDetailsModal"><i class="fe fe-eye"></i></button>
                                                    <button class="btn btn-sm btn-light" data-toggle="modal" data-target="#editTaskModal{{ $task->id }}">
                                                        <i class="fe fe-edit"></i>
                                                    </button>

                                                
                                                    <button 
                                                        class="btn btn-warning" 
                                                        data-toggle="modal" 
                                                        data-target="#archiveTaskModal" 
                                                        data-id="{{ encrypt($task->id) }}" 
                                                        data-title="{{ $task->title }}">
                                                        <i class="fe fe-archive"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>

            <!-- CALENDAR -->
           <div class="tab-pane fade" id="calendar-tab-content" role="tabpanel" aria-labelledby="calendar-tab">
                <div class="card shadow border-0 rounded-4">
                    <div class="card-body">
                        <div id="tasksCalendar" style="height:400px;"></div>
                    </div>
                </div>
            </div>
        </div>    
    </div>

  <!-- Modal Create Task -->

  <div class="modal fade" id="createTaskModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('tasks.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Create Task</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" name="title" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="description" class="form-control"></textarea>
                    </div>

                    <div class="form-row">
                        <!-- Start Date -->
                        <div class="form-group col-md-6">
                            <label for="start_date">Start Date</label>
                            <input type="date" name="start_date" id="start_date" class="form-control" value="{{ old('start_date') }}">
                        </div>

                        <!-- End Date -->
                        <div class="form-group col-md-6">
                            <label for="end_date">End Date</label>
                            <input type="date" name="end_date" id="end_date" class="form-control" value="{{ old('end_date') }}">
                        </div>
                    </div>

                    <div class="form-row">
                        <!-- Type -->
                        <div class="form-group col-md-6">
                            <label for="type">Task Type</label>
                            <select name="type" id="type" class="form-control" required>
                                <option value="">Select Type</option>
                                @foreach($types as $type)
                                    <option value="{{ $type }}" @if(old('type') == $type) selected @endif>{{ $type }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Unit -->
                        <div class="form-group col-md-6">
                            <label for="unit_id">Unit</label>
                            <select name="unit_id" id="unit_id" class="form-control" required>
                                <option value="">Select Unit</option>
                                @foreach($units as $unit)
                                    <option value="{{ $unit->id }}" @if(old('unit_id') == $unit->id) selected @endif>{{ $unit->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-row">

                        <div class="form-group col-md-6">
                            <label>Priority</label>
                            <select name="priority" class="form-control" required>
                                <option value="low">Low</option>
                                <option value="medium">Medium</option>
                                <option value="high">High</option>
                            </select>
                        </div>
    
                        <div class="form-group col-md-6">
                            <label>Status</label>
                            <select name="status" class="form-control" required>
                                <option value="pending">Pending</option>
                                <option value="processing">Processing</option>
                                <option value="completed">Completed</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Assign To</label>
                        <select name="assigned_to" class="form-control" required>
                            <option value="">-- Select User --</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->firstname .' '. $user->lastname }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Save Task</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
  </div>

    <!-- Modal Task Details & Edit -->
    <div class="modal fade" id="taskDetailsModal" tabindex="-1" aria-labelledby="taskDetailsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content shadow-lg rounded-lg">
                
                <!-- Header -->
                <div class="modal-header bg-maroon text-white">
                    <h5 class="modal-title text-white" id="taskDetailsModalLabel">
                        <i class="fe fe-list mr-2"></i> Task Details
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span>&times;</span>
                    </button>
                </div>
                
                <div class="modal-body p-4">
                    
                    <!-- Zone Détails -->
                    <div id="taskDetailsContent">
                        <h5 class="mb-3 text-secondary"><i class="fe fe-info mr-2"></i> Task Information</h5>
                        <table class="table table-bordered align-middle">
                            <tbody>
                            <tr>
                              <th class="bg-green-light text-black" style="font-weight: bold;">Title</th>
                                <td id="modalTaskTitle"></td>
                                <th class="bg-green-light text-black" style="font-weight: bold;">Status</th>
                                <td id="modalTaskStatus"></td>
                            </tr>
                            <tr>
                                <th class="bg-green-light text-black" style="font-weight: bold;">Description</th>
                                <td id="modalTaskDescription"></td>
                                <th class="bg-green-light text-black" style="font-weight: bold;">Start Date</th>
                                <td id="modalTaskStart"></td>
                            </tr>
                            <tr>
                                <th class="bg-green-light text-black" style="font-weight: bold;">Assigned To</th>
                                <td id="modalTaskUser"></td>
                                <th class="bg-green-light text-black" style="font-weight: bold;">End Date</th>
                                <td id="modalTaskEnd"></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- Comment Section --> 
                    <hr> 
                   <h6 class="font-weight-bold">Comments</h6>
                        @isset($task)
                            <form method="POST" action="{{ route('tasks.comments.store', encrypt($task->id)) }}">
                                @csrf
                                <div class="form-group">
                                    <textarea name="comment" class="form-control" rows="3" placeholder="Write your comment..." required></textarea>
                                </div>
                                <button type="submit" class="btn bg-gold text-white mt-2">
                                    <i class="fe fe-send text-white mr-1"></i> Post Comment
                                </button>
                            </form>
                        @endisset

                    <hr>

                    <!-- Commentaires (inchangés) -->
                    @isset($task)
                        @if($task->comments->count() > 0)
                            <ul class="list-group list-group-flush mb-3">
                                @foreach($task->comments as $comment)
                                    <li class="list-group-item border-0 px-0 py-2">
                                        <div class="d-flex align-items-start">
                                            <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center mr-3"
                                                style="width: 40px; height: 40px; font-weight: bold;">
                                                {{ strtoupper(substr($comment->user->firstname,0,1) . substr($comment->user->lastname,0,1)) }}
                                            </div>
                                            <div class="flex-grow-1">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <strong class="text-dark">{{ $comment->user->firstname }} {{ $comment->user->lastname }}</strong>
                                                    <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                                                </div>
                                                <div class="mt-1 p-2 bg-light rounded shadow-sm">
                                                    {{ $comment->comment }}
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-muted">No comments yet.</p>
                        @endif
                    @endisset
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="archiveTaskModal" tabindex="-1" role="dialog" aria-labelledby="archiveTaskModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form method="POST" id="archiveTaskForm">
                @csrf
                <div class="modal-content">
                    <div class="modal-header bg-warning text-white">
                    <h5 class="modal-title text-white" id="archiveTaskModalLabel">Archive Task Request</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                    <p class="text-black h5">
                        Why do you want to archive the task <strong id="taskTitlePlaceholder"></strong>?
                    </p>
                    <textarea name="reason" class="form-control" required placeholder="Enter your reason here..."></textarea>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-warning">Request Archivation</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

   @foreach($tasks as $task)
        <!-- Modal -->
        <div class="modal fade" id="editTaskModal{{ $task->id }}" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <!-- Header -->
                    <div class="modal-header bg-maroon text-white">
                        <h5 class="modal-title text-white">Edit Task </h5>
                        <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Form -->
                    <form action="{{ route('tasks.update', $task->id) }}" method="POST">

                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" name="title" value="{{ $task->title }}" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Description</label>
                                <textarea name="description" class="form-control">{{ $task->description }}</textarea>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label>Start date</label>
                                    <input type="date" name="start_date" value="{{ $task->start_date->format('Y-m-d') }}" class="form-control">
                                </div>
        
                                <div class="form-group col-md-4">
                                    <label>End date</label>
                                    <input type="date" name="end_date" value="{{ $task->end_date->format('Y-m-d') }}" class="form-control">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Priority</label>
                                    <select name="priority" class="form-control">
                                        <option value="low" {{ $task->priority == 'low' ? 'selected' : '' }}>Low</option>
                                        <option value="medium" {{ $task->priority == 'medium' ? 'selected' : '' }}>Medium</option>
                                        <option value="high" {{ $task->priority == 'high' ? 'selected' : '' }}>High</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Status</label>
                                    <select name="status" class="form-control">
                                        <option value="pending" {{ $task->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="processing" {{ $task->status == 'processing' ? 'selected' : '' }}>Processing</option>
                                        <option value="completed" {{ $task->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                    </select>
                                </div>

                                <div class="form-group col-md-6">
                                    <label>Assigned user</label>
                                    <select name="assigned_to" class="form-control">
                                        <option value="">-- None --</option>
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}" {{ $task->assigned_to == $user->id ? 'selected' : '' }}>
                                                {{ $user->firstname }} {{ $user->lastname }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>

                            
                            <div class="form-row">
                                
                                <div class="form-group col-md-6">
                                    <label>Unit</label>
                                    <select name="unit_id" class="form-control">
                                        <option value="">-- Select Unit --</option>
                                        @foreach($units as $unit)
                                            <option value="{{ $unit->id }}" {{ $task->unit_id == $unit->id ? 'selected' : '' }}>
                                                {{ $unit->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-md-6">
                                    <label>Type</label>
                                    <select name="type" class="form-control">
                                        <option value="HRM" {{ $task->type == 'HRM' ? 'selected' : '' }}>HRM</option>
                                        <option value="Admin" {{ $task->type == 'Admin' ? 'selected' : '' }}>Admin</option>
                                    </select>
                                </div>
                            </div>
                        

                        </div>

                        <!-- Footer -->
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Save changes</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach


{{-- Script --}}

<script>
    document.addEventListener("DOMContentLoaded", function () {
        $('#archiveTaskModal').on('show.bs.modal', function (event) {
            let button = $(event.relatedTarget);
            let encryptedId = button.data('id');
            let taskTitle = button.data('title');

            let modal = $(this);
            modal.find('#taskTitlePlaceholder').text(taskTitle);

            // Remplit dynamiquement l'action du formulaire avec l'ID encrypté
            modal.find('#archiveTaskForm').attr('action', '/tasks/archive/' + encryptedId);
        });
    });
</script>



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



<script>
    document.addEventListener('DOMContentLoaded', function() {
    const editBtn = document.getElementById('editTaskBtn');
    const cancelBtn = document.getElementById('cancelEditBtn');
    const detailsContent = document.getElementById('taskDetailsContent');
    const editForm = document.getElementById('taskEditForm');

    // Passage en mode édition
    editBtn.addEventListener('click', function() {
        detailsContent.style.display = 'none';
        editForm.style.display = 'block';
    });

    // Annuler l'édition
        cancelBtn.addEventListener('click', function() {
            editForm.style.display = 'none';
            detailsContent.style.display = 'block';
        });
    });

    document.querySelectorAll('.editTaskBtn').forEach(btn => {

        btn.addEventListener('click', function() {
            // --- Remplissage affichage (partie "détails") ---
            document.getElementById('modalTaskTitle').textContent = this.dataset.title;
            document.getElementById('modalTaskDescription').textContent = this.dataset.description || '—';
            document.getElementById('modalTaskStart').textContent = this.dataset.start;
            document.getElementById('modalTaskEnd').textContent = this.dataset.end;
            document.getElementById('modalTaskStatus').textContent = this.dataset.status;

            // --- Remplissage formulaire (partie édition) ---
            document.getElementById('editTaskId').value = this.dataset.id;
            document.getElementById('taskEditForm').action = "/tasks/" + this.dataset.id; // vers route update
            document.getElementById('editTaskTitle').value = this.dataset.title;
            document.getElementById('editTaskDescription').value = this.dataset.description;

            // Pour input type="date" il faut format YYYY-MM-DD → déjà fait dans data-start / data-end
            document.getElementById('editTaskStart').value = this.dataset.start;
            document.getElementById('editTaskEnd').value = this.dataset.end;

            // Selects
            document.getElementById('editTaskStatus').value = this.dataset.status;
            document.getElementById('editTaskUser').value = this.dataset.user;
        });
    });

</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Drag start
        document.querySelectorAll('.task-item').forEach(item => {
            item.addEventListener('dragstart', function(e) {
                e.dataTransfer.setData('taskId', this.dataset.id);
            });
        });

        // Drop sur colonne "In Progress"
        const inProgressCol = document.querySelector('#in-progress-column');
        if (inProgressCol) {
            inProgressCol.addEventListener('drop', function(e) {
                e.preventDefault();
                let taskId = e.dataTransfer.getData('taskId');

                // Update couleur immédiatement
                let card = document.querySelector(`.task-item[data-id="${taskId}"]`);
                if (card) {
                    card.style.borderLeft = '4px solid #ffc107'; // Jaune
                    card.style.textDecoration = 'none';
                    card.style.opacity = '1';
                }

                // Update en base
                fetch(`/tasks/${taskId}/update-status`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ status: 'processing' })
                });
            });

            inProgressCol.addEventListener('dragover', function(e) {
                e.preventDefault();
            });
        }

        // ✅ Drop sur colonne "Done"
        const doneCol = document.querySelector('#done-column');
        if (doneCol) {
            doneCol.addEventListener('drop', function(e) {
                e.preventDefault();
                let taskId = e.dataTransfer.getData('taskId');

                // Update style barré immédiatement
                let card = document.querySelector(`.task-item[data-id="${taskId}"]`);
                if (card) {
                    card.style.borderLeft = '4px solid #28a745'; // Vert
                    card.style.textDecoration = 'line-through';
                    card.style.opacity = '0.7';
                }

                // Update en base
                fetch(`/tasks/${taskId}/update-status`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ status: 'completed' })
                });
            });

            doneCol.addEventListener('dragover', function(e) {
                e.preventDefault();
            });
        }

        // Modal détails tâche
        $('#taskDetailsModal').on('show.bs.modal', function(event) {
            let button = $(event.relatedTarget);
            let taskId = button.data('id');

        
        fetch(`/tasks/${taskId}`)
            .then(response => response.json())
            .then(task => {
                // Infos de la tâche
                $('#modalTaskTitle').text(task.title);
                $('#modalTaskDescription').text(task.description ?? 'Aucune description');
                $('#modalTaskStatus').text(task.status);
                $('#modalTaskPriority').text(task.priority);
                $('#modalTaskStart').text(task.start_date);
                $('#modalTaskEnd').text(task.end_date);
                $('#modalTaskUser').text(task.assigned_user ? (task.assigned_user.firstname + ' ' + task.assigned_user.lastname) : 'N/A');


            })
            .catch(error => console.error('Erreur chargement tâche:', error));
        });
    });
</script>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        $('#taskDetailsModal').on('show.bs.modal', function (event) {
            let button = $(event.relatedTarget); // L’élément qui a déclenché le modal
            let taskId = button.data('id');      // Récupère l’ID de la tâche

            let options = { day: '2-digit', month: '2-digit' };

            fetch(`/tasks/${taskId}`)
                .then(response => response.json())
                .then(task => {
                    $('#modalTaskTitle').text(task.title);
                    $('#modalTaskDescription').text(task.description ?? 'Aucune description');
                    $('#modalTaskStatus').text(task.status);
                    $('#modalTaskPriority').text(task.priority);
                    $('#modalTaskStart').text(task.start_date);
                    $('#modalTaskEnd').text(task.end_date);
                    $('#modalTaskUser').text(task.assigned_user?.firstname + ' ' + task.assigned_user?.lastname);
                })
                .catch(error => console.error('Erreur chargement tâche:', error));
        });
    });

</script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


<script>
    let tasksByUserChart = null;
    let statusPieChart = null;
    let myTasksChart = null;

    // --- Tasks By User ---
    const tasksByUserCanvas = document.getElementById('tasksByUserChart');
    if (tasksByUserCanvas) {
        tasksByUserChart = new Chart(tasksByUserCanvas, {
            type: 'bar',
            data: {
                labels: [],
                datasets: [{
                    label: 'Number of tasks',
                    data: [],
                    backgroundColor: [],
                    borderRadius: 6,
                }]
            },
            options: {
                responsive: true,
                plugins: { legend: { display: false } }
            }
        });
    }

    // --- Status Pie (Admin only) ---
    const statusPieCanvas = document.getElementById('statusPieChart');
    if (statusPieCanvas) {
        statusPieChart = new Chart(statusPieCanvas, {
            type: 'pie',
            data: {
                labels: [],
                datasets: [{
                    data: [],
                    backgroundColor: ['#9E2140', '#F4A51F', '#299347', '#dc3545']
                }]
            }
        });
    }
    // --- My Tasks ---
    const myTasksCanvas = document.getElementById('myTasksChart');
    if (myTasksCanvas) {
        myTasksChart = new Chart(myTasksCanvas, {
            type: 'pie',
            data: {
                labels: [],
                datasets: [{
                    data: [],
                    backgroundColor: ['#9E2140', '#F4A51F', '#299347', '#dc3545']
                }]
            },
            options: {
                responsive: true,
                plugins: { legend: { position: 'bottom' } }
            }
        });
    }

    // Fonction de mise à jour des graphes
    async function refreshCharts() {
        try {
            const response = await fetch('/charts/data');
            const data = await response.json();

            // --- Tasks By User ---
            if (tasksByUserChart) {
                const tasksByUserLabels = Object.keys(data.tasksByUser);
                const tasksByUserData = Object.values(data.tasksByUser);

                const backgroundColors = tasksByUserData.map(value => {
                    if (value >= 10) {
                        return 'rgba(255, 99, 132, 0.8)';
                    } else if (value < 5) {
                        return 'rgba(255, 206, 86, 0.8)';
                    } else {
                        return 'rgba(75, 192, 192, 0.8)';
                    }
                });

                tasksByUserChart.data.labels = tasksByUserLabels;
                tasksByUserChart.data.datasets[0].data = tasksByUserData;
                tasksByUserChart.data.datasets[0].backgroundColor = backgroundColors;
                tasksByUserChart.update();
            }

            // --- Status Pie ---
            if (statusPieChart) {
                statusPieChart.data.labels = Object.keys(data.statusCounts);
                statusPieChart.data.datasets[0].data = Object.values(data.statusCounts);
                statusPieChart.update();
            }

            // --- My Tasks ---
            if (myTasksChart) {
                myTasksChart.data.labels = Object.keys(data.myTasks);
                myTasksChart.data.datasets[0].data = Object.values(data.myTasks);
                myTasksChart.update();
            }

        } catch (error) {
            console.error("Erreur lors du refresh des graphiques:", error);
        }
    }

    // Refresh immédiat au chargement
    refreshCharts();

    // Refresh toutes les 30 secondes
    setInterval(refreshCharts, 30000);
</script>


<script>
document.addEventListener('DOMContentLoaded', function() {

    // Préparer les events depuis Laravel
    const tasksEvents = [
        @foreach($tasks as $task)
        {
            title: "{{ $task->title }}",
            start: "{{ $task->start_date }}",
            end: "{{ $task->end_date }}",
            backgroundColor: 
                @if($task->priority == 'high') '#dc3545'
                @elseif($task->priority == 'medium') '#ffc107'
                @else '#28a745'
                @endif,
            textColor: '#fff'
        },
        @endforeach
    ];

    const calendarEl = document.getElementById('tasksCalendar');
    const calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
        },
        events: tasksEvents,
        height: 600
    });

    // Rendre le calendrier seulement après que l'onglet est activé
    let calendarTab = document.getElementById('calendar-tab');
    if(calendarTab) {
        calendarTab.addEventListener('shown.bs.tab', function () {
            calendar.render();
        });
    }

});
</script>



<script>
  // Petites fonctions utilitaires
  function paintBorderByStatus(el, status) {
      if (status === 'processing') {
          el.style.borderLeft = '4px solid #F4A51F'; // Jaune
      } else if (status === 'completed') {
          el.style.borderLeft = '4px solid #299347'; // Vert
      } else {
          el.style.borderLeft = '4px solid #007bff'; // Bleu
      }
  }

  document.addEventListener("DOMContentLoaded", function() {
      ['todo', 'inprogress', 'done'].forEach(function(id) {
          const container = document.getElementById(id);
          if (!container) return; // sécurité si l’ID manque

          new Sortable(container, {
              group: 'kanban',
              animation: 150,
              onEnd: function (evt) {
                  const taskId = evt.item.getAttribute("data-id");
                  const targetStatus = evt.to.getAttribute("data-status"); // pending | processing | completed

                  // Update BDD (on n’attend PAS du JSON)
                 fetch(`/tasks/${taskId}/status`, {
                      method: "PATCH",
                      headers: {
                          "Content-Type": "application/json",
                          "X-CSRF-TOKEN": "{{ csrf_token() }}"
                      },
                      body: JSON.stringify({ status: targetStatus })
                  })
                  .then(response => response.json())
                  .then(data => {
                      if (data.success) {
                          // Changer la couleur de bordure selon le statut
                          if (targetStatus === "processing") {
                              draggedCard.style.borderLeft = "4px solid #ffc107"; // jaune
                          } else if (targetStatus === "pending") {
                              draggedCard.style.borderLeft = "4px solid #007bff"; // bleu
                          } else if (targetStatus === "completed") {
                              draggedCard.style.borderLeft = "4px solid #28a745"; // vert
                          }
                      }
                  });

              }
          });
      });
  });
</script>

<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>


<script>
document.addEventListener('DOMContentLoaded', function() {
    const tasksEvents = [
        @foreach($tasks as $task)
        {
            title: "{{ $task->title }}",
            start: "{{ $task->start_date->format('Y-m-d') }}",
            end: "{{ $task->end_date->format('Y-m-d') }}",
            backgroundColor: 
                @if($task->priority == 'high') '#f8d7da'
                @elseif($task->priority == 'medium') '#fff3cd'
                @else '#d4edda'
                @endif,
            textColor: 
                @if($task->priority == 'high') '#842029'
                @elseif($task->priority == 'medium') '#856404'
                @else '#155724'
                @endif
        },
        @endforeach
    ];

   const calendarEl = document.getElementById('tasksCalendar');
   const calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        height: 600,
        themeSystem: 'bootstrap', 
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
        },
        events: tasksEvents
    });

    // rendu initial si l'onglet est actif
    calendar.render();

    // rendu lorsque l'onglet Calendar est activé
    document.getElementById('calendar-tab').addEventListener('shown.bs.tab', function () {
        calendar.render();
    });

    //   window.addEventListener('resize', () => {
    //     calendar.updateSize();
    // });
});
</script>


  @include('partials.footer')
</main>
