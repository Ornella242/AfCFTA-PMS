@php
function statusColorClass($status) {
    return match($status) {
        'Not started' => 'bg-secondary text-white',
        'In progress' => 'bg-yellow text-dark',
        'Completed' => 'bg-success text-white',
        'Cancelled' => 'bg-danger text-white',
        'Waiting Approval' => 'bg-info text-white',
        'Delayed' => 'bg-orange text-white',
        'Under review' => 'bg-primary text-white',
        'Closed'   => 'bg-gold text-white',
        default => 'bg-light text-dark',
    };
}
@endphp
<style>
      /* Container du tableau */
    .table-container {
        background: #fff;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
    }

    /* En-tête */
    .table thead {
        background: linear-gradient(90deg, #800000, #a83232);
        color: white;
        text-transform: uppercase;
        font-size: 14px;
        letter-spacing: 0.5px;
    }

    /* Lignes du tableau */
    .table tbody tr {
        transition: all 0.2s ease-in-out;
    }

    .table tbody tr:hover {
        background-color: rgba(255, 215, 0, 0.1);
        transform: scale(1.01);
    }

    /* Cellules */
    .table td {
        vertical-align: middle;
        font-size: 14px;
    }

    /* Points de statut */
    .dot {
        height: 12px;
        width: 12px;
        display: inline-block;
        border-radius: 50%;
        position: relative;
        animation: pulse 1.5s infinite;
    }

    @keyframes pulse {
        0% { transform: scale(0.9); opacity: 0.7; }
        50% { transform: scale(1.2); opacity: 1; }
        100% { transform: scale(0.9); opacity: 0.7; }
    }

    /* Icônes d’action */
    .table .fe {
        transition: transform 0.2s ease, color 0.2s ease;
    }

    .table .fe:hover {
        transform: scale(1.2);
        color: #ff9800;
    }

    /* Boutons icônes */
    .btn-sm {
        border-radius: 6px;
        padding: 4px 6px;
    }
    

</style>
@include('partials.navbar')
<main role="main" class="main-content fade-in" id="page-transition">
        <div class="container-fluid">
          <div class="row justify-content-center">
           <div class="col-12">
              @if(auth()->user()->role && auth()->user()->role->name === 'Admin' && $deletionRequests->count())
                <div class="alert alert-warning border-0 shadow-sm rounded-lg p-4">
                  
                  <!-- Header -->
                  <h4 class="mb-3 text-dark d-flex align-items-center">
                    <i class="fe fe-alert-triangle text-danger mr-2"></i>
                    Project Cancellation Requests
                  </h4>

                  <!-- List of requests -->
                  @foreach($deletionRequests as $request)
                    <div class="card mb-3 border-0 shadow-sm rounded-lg">
                      <div class="card-body d-flex justify-content-between align-items-center">

                        <!-- Infos -->
                        <div>
                          <h6 class="mb-1">
                            <strong class="text-primary">
                              {{ $request->requester->firstname }} {{ $request->requester->lastname }}
                            </strong>
                            <span class="text-muted">requests to delete</span>
                            <strong class="text-dark">{{ $request->project->title }}</strong>
                          </h6>
                          <p class="mb-0 text-muted">
                            <i class="fe fe-info mr-1 text-secondary"></i>
                            <strong>Reason:</strong> {{ $request->reason }}
                          </p>
                        </div>

                        <!-- Actions -->
                        <div class="d-flex">
                          <!-- Approve -->
                          <form action="{{ route('deletionRequests.approve', $request->id) }}" 
                                method="POST" class="mr-2">
                            @csrf
                            <button type="submit" class="btn btn-success btn-sm shadow-sm d-flex align-items-center">
                              <i class="fe fe-check mr-1"></i> Approve
                            </button>
                          </form>

                          <!-- Decline button -->
                          <button type="button" class="btn btn-outline-danger btn-sm shadow-sm d-flex align-items-center" 
                                  data-toggle="modal" data-target="#declineModal-{{ $request->id }}">
                            <i class="fe fe-x mr-1"></i> Decline
                          </button>
                        </div>
                      </div>
                    </div>
                  @endforeach

                </div>
              @endif
            </div>

            <div class="col-12">
              <div class="d-flex justify-content-between align-items-center mt-3 flex-wrap">
                  <!-- Back Button -->
                  <div>
                      <a href="{{ url()->previous() }}" class="btn btn-outline-success btn-back shadow-sm transition-all">
                          <i class="fe fe-arrow-left mr-2"></i> Back
                      </a>
                  </div>

                  <!-- Page Title -->
                  <div>
                      <h2 class="mb-0 page-title text-black">List of all projects</h2>
                  </div>

                  <!-- Add Project Button -->
                  <div>
                      <button type="button" class="btn mb-2 bg-maroon text-white" data-toggle="modal" data-target="#projectModal">
                          <i class="fe fe-plus mx-1"></i> <a href="{{ route('projects.create') }}" class="text-white text-decoration-none">Add new</a>
                      </button>
                  </div>
              </div>
              <div class="row align-items-center mb-4">
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
                </div>

                </div>
              </div> <!-- .row -->
              <div class="row items-align-center my-4  d-none d-lg-flex">
                <div class="col-md">
                  <ul class="nav nav-pills justify-content-start">
                    <li class="nav-item">
                      <a class="nav-link active bg-transparent pr-2 pl-0 {{ request('status') === null ? 'active text-primary' : 'text-dark' }}" href="{{ route('allprojects') }}">All <span class="badge badge-pill bg-gold text-white pb-2 pt-2 ml-2">{{ $counts['all'] }}</span></a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link {{ request('status') === 'Not started' ? 'active text-maroon' : 'text-dark' }}"
                        href="{{ route('allprojects', ['status' => 'Not started']) }}">
                        Not Started
                        <span class="badge badge-pill bg-maroon border text-white pb-2 pt-2 ml-2">{{ $counts['Not started'] }}</span>
                      </a>

                      
                    </li>
                    <li class="nav-item">
                      <a class="nav-link {{ request('status') === 'In progress' ? 'active text-yellow' : 'text-dark' }}"
                        href="{{ route('allprojects', ['status' => 'In progress']) }}">
                        In Progress
                        <span class="badge badge-pill bg-yellow border text-white pb-2 pt-2 ml-2">{{ $counts['In progress'] }}</span>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link {{ request('status') === 'Completed' ? 'active text-green' : 'text-dark' }}"
                        href="{{ route('allprojects', ['status' => 'Completed']) }}">
                        Completed
                        <span class="badge badge-pill bg-green border text-white pb-2 pt-2 ml-2">{{ $counts['Completed'] }}</span>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link {{ request('status') === 'Cancelled' ? 'active text-green' : 'text-dark' }}"
                        href="{{ route('allprojects', ['status' => 'Cancelled']) }}">
                        Cancelled
                        <span class="badge badge-pill bg-maroon border text-white pb-2 pt-2 ml-2">{{ $counts['Cancelled'] }}</span>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link {{ request('status') === 'Closed' ? 'active text-green' : 'text-dark' }}"
                        href="{{ route('allprojects', ['status' => 'Closed']) }}">
                        Closed
                        <span class="badge badge-pill bg-green border text-white pb-2 pt-2 ml-2">{{ $counts['Closed'] }}</span>
                      </a>
                    </li>
                  </ul>
                </div>
                {{-- <div class="col-md-auto ml-auto text-right">
                  <span class="small bg-white border py-1 px-2 rounded mr-2">
                    <span class="text-muted">Status : <strong>{{ $status ?? 'All' }}</strong></span>
                  </span>
                </div> --}}
              </div>
              <div class="row mb-4">
                <div class="col-md-12">
                  <form method="GET" action="{{ route('allprojects') }}">
                    <div class="input-group">
                      <input 
                        type="text" 
                        name="search" 
                        class="form-control" 
                        placeholder="Search by title, partner or project manager..."
                        value="{{ request('search') }}"
                      >
                      @if(request('status'))
                        <input type="hidden" name="status" value="{{ request('status') }}">
                      @endif
                      <div class="input-group-append">
                        <button class="btn btn-outline-primary" type="submit">Search</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>

              <div class="row">
                <div class="col-md-12">
                  
                  <!-- table -->
                  <table class="table table-borderless table-striped table-hover">
                    <thead class="text-white bg-maroon">
                      <tr>
                        <th>ID</th>
                        <th></th>
                        <th>Title</th>
                        <th>Start Date</th>
                        <th>Budget</th>
                        <th>Partner</th>
                        <th>Project Manager</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @forelse($projects as $project)
                        <tr>
                          <td class="{{ statusColorClass($project->status) }}">
                              #{{ str_pad($project->id, 4, '0', STR_PAD_LEFT) }}
                          </td>
                          <td class="text-center">
                            @php
                              $colors = [
                                'Not started' => 'bg-secondary',
                                'In progress' => 'bg-yellow',
                                'Completed'   => 'bg-green',
                                'Cancelled'   => 'bg-red',
                                'Waiting Approval' => 'bg-blue',
                                'Delayed'    => 'bg-orange',
                                'Under review' => 'bg-purple',  
                                'Closed'   => 'bg-green',
                              ];
                            @endphp
                            <span class="dot dot-lg {{ $colors[$project->status] ?? 'bg-secondary' }}"></span>
                          </td>
                          <td>{{ $project->title }}</td>
                          <td>{{ \Carbon\Carbon::parse($project->start_date)->format('M d, Y') }}</td>
                          <td>${{ number_format($project->budget ?? 0, 2) }}</td>
                          <td>
                            {{ $project->partners->isEmpty()
                                ? 'No Partner'
                                : $project->partners->pluck('name')->join(', ') }}
                          </td>
                          <td>
                              {{ $project->projectManager->firstname ?? '' }} {{ $project->projectManager->lastname ?? '' }}
                          </td>
                        
                         
                          <td class="text-center">
                          <div class="d-flex justify-content-center gap-2 align-items-center">
                          

                          @php
                              $user = auth()->user();
                              $isManager = $user->id === $project->project_manager_id;
                              $isAdmin = $user->role?->name === 'Admin';
                              $isMember = $project->members->contains('id', $user->id);
                              $isPMAssistant = $project->assistants->contains('id', $user->id);
                          @endphp
                          @if (
                              $project->status !== 'Closed' && 
                              $project->status !== 'Completed' && 
                              ($isManager || $isAdmin || $isMember || $isPMAssistant)
                          )
                              <a href="{{ route('projects.edit', $project) }}" class="text-primary mx-1 text-decoration-none">
                                  <i class="fe fe-edit-2"></i>
                              </a>
                          @endif


                            <a href="{{ route('projects.show', $project->id) }}" class="text-info mx-1 text-decoration-none"><i class="fe fe-eye"></i></a>
                              @if($project->status === 'Cancelled' && $isAdmin)
                                {{-- Bouton de réactivation --}}
                                <!-- Reactivate Trigger Button -->
                               <button 
                                  class="btn btn-sm text-success" 
                                  title="Reactivate Project" 
                                  data-toggle="modal" 
                                  data-target="#reactivateProjectModal" 
                                  data-id="{{ $project->id }}" 
                                  data-title="{{ $project->title }}">
                                  <i class="fe fe-refresh-ccw"></i>
                                </button>
                                @endif
                              @php
                                  $user = auth()->user();
                                  $isManager = $user->id === $project->project_manager_id;
                                  $isAdmin = $user->role?->name === 'Admin';
                              @endphp

                              @if (
                                  $project->status !== 'Closed' &&
                                  $project->status !== 'Cancelled' &&
                                  $project->status !== 'Completed' &&
                                  ($isManager || $isAdmin)
                              )
                                  <button 
                                      class="btn btn-sm text-danger" 
                                      data-toggle="modal" 
                                      data-target="#deleteProjectModal" 
                                      data-id="{{ $project->id }}" 
                                      data-title="{{ $project->title }}">
                                      <i class="fe fe-trash-2"></i>
                                  </button>
                              @endif

                              
                           @if($project->status === 'Completed' && auth()->user()->role->name === 'Project Manager')
                              <button 
                                type="button"
                                class="btn btn-sm text-danger" 
                                data-toggle="modal" 
                                data-target="#closeProjectModal" 
                                data-id="{{ $project->id }}" 
                                data-title="{{ $project->title }}">
                                <i class="fe fe-lock"></i>
                              </button>
                            @endif

                            
                            @if(
                                $project->status === 'Closed' && 
                                auth()->user()->role->name === 'Admin' && 
                                empty($project->close_comment_admin)
                            )
                                <button 
                                    type="button"
                                    class="btn btn-sm text-danger" 
                                    data-toggle="modal" 
                                    data-target="#adminLockModal" 
                                    data-id="{{ $project->id }}" 
                                    data-title="{{ $project->title }}">
                                    <i class="fe fe-lock"></i>
                                </button>
                            @endif

                          </div>
                        </td>
                        </tr>
                      @empty
                        <tr><td colspan="8" class="text-center text-muted">No projects found.</td></tr>
                      @endforelse
                    </tbody>
                  </table>
                </div> <!-- .col -->
              </div> <!-- .row -->
            </div> <!-- .col-12 -->        
          </div> <!-- .row -->
        </div> <!-- .container-fluid -->
        
     @include('partials.footer')   
     <!-- Delete Project Modal (Générique) -->
    <div class="modal fade" id="deleteProjectModal" tabindex="-1" role="dialog" aria-labelledby="deleteProjectModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <form method="POST" id="deleteProjectForm">
          @csrf
          <div class="modal-content">
            <div class="modal-header bg-danger text-white">
              <h5 class="modal-title text-white" id="deleteProjectModalLabel">Delete Project Request</h5>
              <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p class="text-black h5">
                Why do you want to delete the project <strong id="projectTitlePlaceholder"></strong>?
              </p>
              <textarea name="reason" class="form-control" required placeholder="Enter your reason here..."></textarea>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-danger">Request Deletion</button>
            </div>
          </div>
        </form>
      </div>
    </div>

    <!-- Close Project Modal (Générique) -->
    <div class="modal fade" id="closeProjectModal" tabindex="-1" aria-labelledby="closeProjectModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <form method="POST" id="closeProjectForm">
          @csrf
          @method('PATCH')
          <div class="modal-content">
            <div class="modal-header bg-danger text-white">
              <h5 class="modal-title text-white" id="closeProjectModalLabel">Close Project</h5>
              <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                <span>&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p class="text-black h5">Add a final comment before closing <strong id="closeProjectTitle"></strong>.</p>
              <textarea name="close_comment" class="form-control" rows="3" placeholder="Enter a final comment..." required></textarea>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-danger">Close Project</button>
            </div>
          </div>
        </form>
      </div>
    </div>

     <!-- Close Project Admin Modal (Générique) -->
    <div class="modal fade" id="adminLockModal" tabindex="-1" aria-labelledby="adminLockModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <form method="POST" id="adminLockForm">
          @csrf
          @method('PATCH')
          <div class="modal-content">
            <div class="modal-header bg-danger text-white">
              <h5 class="modal-title text-white" id="closeProjectModalLabel">Close Project</h5>
              <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                <span>&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p class="text-black h5">Add a final comment before closing <strong id="closeAdminProjectTitle"></strong>.</p>
              <textarea name="close_comment_admin" class="form-control" rows="3" placeholder="Enter a final comment..." required></textarea>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-danger">Close Project</button>
            </div>
          </div>
        </form>
      </div>
    </div>

    <!-- Reactivate Project Modal (Générique) -->
    <div class="modal fade" id="reactivateProjectModal" tabindex="-1" role="dialog" aria-labelledby="reactivateProjectModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <form method="POST" id="reactivateProjectForm">
          @csrf
          @method('PATCH')
          <div class="modal-content">
            <div class="modal-header bg-success text-white">
              <h5 class="modal-title" id="reactivateProjectModalLabel">Reactivate Project</h5>
              <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <div class="modal-body">
              <p>Are you sure you want to <strong>reactivate</strong> the project <strong id="reactivateProjectTitle"></strong>?</p>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-success">Reactivate</button>
            </div>
          </div>
        </form>
      </div>
    </div>

  @if(auth()->user()->role && auth()->user()->role->name === 'Admin' && $deletionRequests->count())
    @foreach($deletionRequests as $request)
      <!-- Decline Modal -->
      <div class="modal fade" id="declineModal-{{ $request->id }}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
          <div class="modal-content shadow-lg border-0 rounded-3">
            <form action="{{ route('deletionRequests.decline', $request->id) }}" method="POST">
              @csrf
              @method('PUT')

              <!-- Header -->
              <div class="modal-header bg-maroon border-0">
                <h5 class="modal-title text-white font-weight-bold">
                  <i class="fa fa-times-circle mr-2"></i> Decline Deletion Request
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>

              <!-- Body -->
              <div class="modal-body">
                <p class="text-muted mb-3">
                  You are about to decline this project deletion request. Please provide a reason below:
                </p>

                <div class="form-group">
                  <label for="declineReason-{{ $request->id }}" class="font-weight-semibold">
                    Reason for Decline <span class="text-danger">*</span>
                  </label>
                  <textarea name="decline_reason" id="declineReason-{{ $request->id }}" 
                    class="form-control border-danger" rows="4" required></textarea>
                </div>
              </div>

              <!-- Footer -->
              <div class="modal-footer border-0">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">
                  <i class="fa fa-arrow-left mr-1"></i> Cancel
                </button>
                <button type="submit" class="btn btn-danger shadow-sm">
                  <i class="fa fa-check-circle mr-1"></i> Confirm Decline
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    @endforeach
  @endif

</main>

<script>
  document.addEventListener("DOMContentLoaded", function () {
    const procurementCheckbox = document.getElementById("phaseProcurement");
    const procurementTypeContainer = document.getElementById("procurementTypeContainer");
    const afcftaRadio = document.getElementById("afcfta");
    const partnerRadio = document.getElementById("partner");
    const afcftaSubphases = document.getElementById("afcftaSubphases");

    procurementCheckbox.addEventListener("change", function () {
      if (this.checked) {
        procurementTypeContainer.classList.remove("d-none");
      } else {
        procurementTypeContainer.classList.add("d-none");
        afcftaSubphases.classList.add("d-none");
        afcftaRadio.checked = false;
        partnerRadio.checked = false;
      }
    });

    afcftaRadio.addEventListener("change", function () {
      afcftaSubphases.classList.remove("d-none");
    });

    partnerRadio.addEventListener("change", function () {
      afcftaSubphases.classList.add("d-none");
    });
  });
</script>

<script>
  document.addEventListener("DOMContentLoaded", function () {
    const triggerCheckbox = document.getElementById("imp3");
    const dynamicSection = document.getElementById("dynamicActivities");
    const addButtonClass = "add-activity";

    // Show/hide dynamic input area
    triggerCheckbox.addEventListener("change", function () {
      if (this.checked) {
        dynamicSection.classList.remove("d-none");
      } else {
        dynamicSection.classList.add("d-none");
        // Optionally clear inputs
        document.getElementById("activityInputs").innerHTML = `
          <div class="form-row align-items-center mb-2">
            <div class="col">
              <input type="text" name="implementation_activities[]" class="form-control" placeholder="Enter activity title">
            </div>
            <div class="col-auto">
              <button type="button" class="btn btn-sm btn-outline-primary add-activity">Add</button>
            </div>
          </div>`;
      }
    });

    // Delegate "Add" button clicks to append new input lines
    document.getElementById("activityInputs").addEventListener("click", function (e) {
      if (e.target.classList.contains(addButtonClass)) {
        const newInput = document.createElement("div");
        newInput.className = "form-row align-items-center mb-2";
        newInput.innerHTML = `
          <div class="col">
            <input type="text" name="implementation_activities[]" class="form-control" placeholder="Enter activity title">
          </div>
          <div class="col-auto">
            <button type="button" class="btn btn-sm btn-outline-danger remove-activity">Remove</button>
          </div>`;
        this.appendChild(newInput);
      }
    });

    // Handle "Remove" button
    document.getElementById("activityInputs").addEventListener("click", function (e) {
      if (e.target.classList.contains("remove-activity")) {
        e.target.closest(".form-row").remove();
      }
    });
  });
</script>

<script>
  // Affiche le spinner quand on clique sur "Retour arrière" ou on recharge
  window.addEventListener("pageshow", function (event) {
    const spinner = document.getElementById("loading-spinner");

    if (event.persisted || performance.getEntriesByType("navigation")[0].type === "back_forward") {
      spinner.style.display = "flex";
    }
  });

  // Affiche le spinner manuellement quand on clique sur les liens de retour
  document.querySelectorAll('.btn-back, .btn-refresh').forEach(btn => {
    btn.addEventListener('click', function () {
      document.getElementById("loading-spinner").style.display = "flex";
    });
  });
</script>

<script>
  $('#deleteProjectModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var projectId = button.data('id');
    var projectTitle = button.data('title');
    var actionUrl = '{{ url('/projects') }}/' + projectId + '/request-delete'; // ajuste la route si besoin

    $('#deleteProjectForm').attr('action', actionUrl);
    $('#projectTitlePlaceholder').text(projectTitle);
  });
</script>

<script>
  $('#closeProjectModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var projectId = button.data('id');
    var projectTitle = button.data('title');
    var actionUrl = '{{ url('/projects') }}/' + projectId + '/close';

    $('#closeProjectForm').attr('action', actionUrl);
    $('#closeProjectTitle').text(projectTitle);
  });
</script>

<script>
  $('#adminLockModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var projectId = button.data('id');
    var projectAdminTitle = button.data('title');
    var actionUrl = '{{ url('/projects') }}/' + projectId + '/closeAdmin';

    $('#adminLockForm').attr('action', actionUrl);
    $('#closeAdminProjectTitle').text(projectAdminTitle);
  });
</script>

<script>
  $('#reactivateProjectModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var projectId = button.data('id');
    var projectTitle = button.data('title');
    var actionUrl = '{{ url('/projects') }}/' + projectId + '/reactivate';

    $('#reactivateProjectForm').attr('action', actionUrl);
    $('#reactivateProjectTitle').text(projectTitle);
  });
</script>

