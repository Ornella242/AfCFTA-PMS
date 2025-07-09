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
        default => 'bg-light text-dark',
    };
}
@endphp
@include('partials.navbar')
{{-- <div id="loading-spinner" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(255,255,255,0.7); z-index: 9999; justify-content: center; align-items: center;">
  <div class="spinner-grow mr-3 text-success" role="status" style="width: 5rem; height: 5rem;">
    <span class="sr-only">Loading...</span>
  </div>
</div> --}}
<main role="main" class="main-content fade-in" id="page-transition">
        <div class="container-fluid">
          <div class="row justify-content-center">
            <div class="col-12">
              @if($deletionRequests->count())
                <div class="alert alert-warning">
                  <h5>Project Deletion Requests</h5>

                  @foreach($deletionRequests as $request)
                    <div class="card mb-2">
                      <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                          <p><strong>{{ $request->requester->firstname }} {{ $request->requester->lastname }}</strong> wants to delete <strong>{{ $request->project->title }}</strong></p>
                          <p><strong>Reason:</strong> {{ $request->reason }}</p>
                        </div>
                        <div class="d-flex">
                          <form action="{{ route('deletionRequests.approve', $request->id) }}" method="POST" class="mr-2">
                            @csrf
                            <button type="submit" class="btn btn-success btn-sm">Approve</button>
                          </form>

                          <form action="{{ route('deletionRequests.decline', $request->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Decline</button>
                          </form>
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
                      <h2 class="mb-0 page-title text-black">List of Projects</h2>
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
                  </ul>
                </div>
                <div class="col-md-auto ml-auto text-right">
                  <span class="small bg-white border py-1 px-2 rounded mr-2">
                    <span class="text-muted">Status : <strong>{{ $status ?? 'All' }}</strong></span>
                  </span>
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
                              <a href="{{ route('projects.edit', $project) }}" class="text-primary mx-1 text-decoration-none"><i class="fe fe-edit-2"></i></a>
                              <a href="{{ route('projects.show', $project->id) }}" class="text-info mx-1 text-decoration-none"><i class="fe fe-eye"></i></a>
                              <form action="{{ route('projects.destroy', $project->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this project?');">
                                  @csrf
                                  @method('DELETE')
                                  <button class="btn btn-sm text-danger" title="Delete">
                                      <i class="fe fe-trash-2"></i>
                                  </button>
                              </form>
                             
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
  $('#deleteModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); // Bouton qui déclenche le modal
    var projectId = button.data('id');   // ID du projet depuis data-id
    var action = '{{ url('/projects') }}/' + projectId;

    // Mettre à jour l'action du formulaire dans le modal
    $('#deleteProjectForm').attr('action', action);
  });
</script>
