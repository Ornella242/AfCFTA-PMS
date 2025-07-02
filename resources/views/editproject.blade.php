@php
  // ID de la phase "Procurement" (à adapter selon ta DB)
  $procurementPhase = \App\Models\Phase::where('name', 'procurement')->first();

  // Sous-phases de cette phase
  $procurementSubphases = $procurementPhase
      ? \App\Models\Subphase::where('phase_id', $procurementPhase->id)->get()
      : collect();

  // Vérifier si une des sous-phases procurement est déjà assignée
  $hasProcurement = $project->subphases->contains(function($sub) use ($procurementSubphases) {
      return $procurementSubphases->pluck('id')->contains($sub->id);
  });
@endphp

@include('partials.navbar')
 <div id="loading-spinner" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(255,255,255,0.7); z-index: 9999; justify-content: center; align-items: center;">
  <div class="spinner-grow mr-3 text-success" role="status" style="width: 5rem; height: 5rem;">
    <span class="sr-only">Loading...</span>
  </div>
</div>
<main role="main" class="main-content fade-in" id="page-transition">
    <div class="col-md-12">
       <div class="mb-2">
          <a href="{{ url()->previous() }}" class="btn btn-outline-success btn-back shadow-sm transition-all">
              <i class="fe fe-arrow-left mr-2"></i> Back
          </a>
      </div>
      <div class="card shadow mb-4">
        <div class="card-header bg-maroon text-white d-flex justify-content-between align-items-center">
          <strong class="card-title h3 text-white mt-3">{{ $project->title }}</strong>
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
          <span class="float-right">
            <span class="badge badge-pill bg-green text-white pb-2 pt-2">{{ $project->type }}</span>
          </span>
        </div>
        <div class="card-body">
          
        <dl class="row align-items-center mb-0">
          {{-- UNIT --}}
          <dt class="col-sm-2 mb-3 text-black">Unit</dt>
          <dd class="col-sm-4 mb-3">
            <form method="POST" action="{{ route('projects.updateField', ['id' => $project->id, 'field' => 'unit_id']) }}">
              @csrf @method('PATCH')
              <div class="d-flex align-items-center">
                <select name="value" class="form-control form-control-sm">
                  @foreach($units as $unit)
                    <option value="{{ $unit->id }}" {{ $project->unit_id == $unit->id ? 'selected' : '' }}>
                      {{ $unit->name }}
                    </option>
                  @endforeach
                </select>
                
                <button class="btn btn-sm btn-outline-success ml-2">Save</button>
              </div>
            </form>
          </dd>

          {{-- PROJECT MANAGER --}}
          <dt class="col-sm-2 mb-3 text-black">Project Manager</dt>
          <dd class="col-sm-4 mb-3">
            <form method="POST" action="{{ route('projects.updateField', ['id' => $project->id, 'field' => 'project_manager_id']) }}">
              @csrf @method('PATCH')
              <div class="d-flex align-items-center">
                <select name="value" class="form-control form-control-sm">
                  @foreach($projectManagers as $manager)
                    <option value="{{ $manager->id }}" {{ $project->project_manager_id == $manager->id ? 'selected' : '' }}>
                      {{ $manager->firstname }} {{ $manager->lastname }}
                    </option>
                  @endforeach
                </select>
                <button class="btn btn-sm btn-outline-success ml-2">Save</button>
              </div>
            </form>
          </dd>
        </dl>

        <dl class="row mb-0">
          {{-- PARTNERS --}}
        <dt class="col-sm-2 mb-3 text-black">Partners</dt>
        <dd class="col-sm-10 mb-3">
          <div id="partners-display" onclick="togglePartnerEdit()" style="cursor: pointer;">
            @forelse($project->partners as $partner)
              <span class="badge badge-primary mr-1 pt-2 pb-2">{{ $partner->name }}</span>
            @empty
              <span class="text-black">None</span>
            @endforelse
            <span class="text-muted ml-2"><small>(Click to edit)</small></span>
          </div>

          <form id="partners-form" method="POST" action="{{ route('projects.updateField', ['id' => $project->id, 'field' => 'partners']) }}" style="display: none;">
            @csrf @method('PATCH')
            <div class="d-flex align-items-center mt-2">
              <select name="value[]" class="form-control form-control-sm select2-multi" multiple style="min-width: 300px;">
                @foreach($partners as $partner)
                  <option value="{{ $partner->id }}" {{ $project->partners->contains($partner->id) ? 'selected' : '' }}>
                    {{ $partner->name }}
                  </option>
                @endforeach
              </select>
              <button class="btn btn-sm btn-outline-success ml-2">Save</button>
            </div>
          </form>
        </dd>


          {{-- PRIORITY --}}
          <dt class="col-sm-2 mb-3 text-black">Priority</dt>
          <dd class="col-sm-4 mb-3">
            <form method="POST" action="{{ route('projects.updateField', ['id' => $project->id, 'field' => 'priority']) }}">
              @csrf @method('PATCH')
              <div class="d-flex align-items-center">
                <select name="value" class="form-control form-control-sm">
                  @foreach(['Low', 'Medium', 'High'] as $priority)
                    <option value="{{ $priority }}" {{ $project->priority == $priority ? 'selected' : '' }}>
                      {{ $priority }}
                    </option>
                  @endforeach
                </select>
                <button class="btn btn-sm btn-outline-success ml-2">Save</button>
              </div>
            </form>
          </dd>

          <dt class="col-sm-2 mb-3 text-black">Status</dt>
            <dd class="col-sm-4 mb-3">
              <div class="d-flex align-items-center">
                <div class="input-group input-group-sm">
                  <div class="input-group-prepend">
                    <span class="input-group-text bg-light">
                      <i class="fe fe-lock text-muted"></i> {{-- Icône de cadenas --}}
                    </span>
                  </div>
                  <input type="text" class="form-control" value="{{ $project->status }}" readonly>
                </div>
              </div>
            </dd>


          {{-- START DATE --}}
          <dt class="col-sm-2 mb-3 text-black">Start Date</dt>
          <dd class="col-sm-4 mb-3">
            <form method="POST" action="{{ route('projects.updateField', ['id' => $project->id, 'field' => 'start_date']) }}">
              @csrf @method('PATCH')
              <div class="d-flex align-items-center">
                <input type="date" name="value" class="form-control form-control-sm" value="{{ $project->start_date }}">
                <button class="btn btn-sm btn-outline-success ml-2">Save</button>
              </div>
            </form>
          </dd>

          {{-- END DATE --}}
          <dt class="col-sm-2 mb-3 text-black">End Date</dt>
          <dd class="col-sm-4 mb-3">
            <form method="POST" action="{{ route('projects.updateField', ['id' => $project->id, 'field' => 'end_date']) }}">
              @csrf @method('PATCH')
              <div class="d-flex align-items-center">
                <input type="date" name="value" class="form-control form-control-sm" value="{{ $project->end_date }}">
                <button class="btn btn-sm btn-outline-success ml-2">Save</button>
              </div>
            </form>
          </dd>

          {{-- BUDGET --}}
          <dt class="col-sm-2 mb-3 text-black">Budget</dt>
          <dd class="col-sm-4 mb-3">
            <form method="POST" action="{{ route('projects.updateField', ['id' => $project->id, 'field' => 'budget']) }}">
              @csrf @method('PATCH')
              <div class="d-flex align-items-center">
                <input type="number" step="0.01" name="value" class="form-control form-control-sm" value="{{ $project->budget }}">
                <button class="btn btn-sm btn-outline-success ml-2">Save</button>
              </div>
            </form>
          </dd>

          {{-- PROCUREMENT TYPE --}}
        <dt class="col-sm-2 mb-3 text-black">Procurement</dt>
          <dd class="col-sm-4 mb-3 text-black">
            <form method="POST" action="{{ route('projects.updateField', ['id' => $project->id, 'field' => 'procurement_type']) }}">
              @csrf
              @method('PATCH')
              <div class="d-flex align-items-center">
                <select name="value" class="form-control form-control-sm">
                  <option value="afcfta_procurement" {{ $project->subphases->contains('name', 'afcfta') ? 'selected' : '' }}>
                    AfCFTA Procurement
                  </option>
                  <option value="partner_procurement" {{ $project->subphases->contains('name', 'partner_procurement') ? 'selected' : '' }}>
                    Partner Procurement
                  </option>

                </select>
                <button class="btn btn-sm btn-outline-success ml-2">Save</button>
              </div>
            </form>
          </dd>

          {{-- DESCRIPTION --}}
          <dt class="col-sm-2 text-black">Description</dt>
            <dd class="col-sm-10">
              <form method="POST" action="{{ route('projects.updateField', ['id' => $project->id, 'field' => 'description']) }}">
                @csrf @method('PATCH')
                <div class="d-flex align-items-center">
                  <textarea name="value" class="form-control form-control-sm">{{ $project->description }}</textarea>
                  <button class="btn btn-sm btn-outline-success ml-2">Save</button>
                </div>
              </form>
            </dd>
          </dl>


            {{-- Subphases --}}
            <hr style="border: none; height: 6px; background: linear-gradient(to right, #1b1311, #feb47b);">

            <h5 class="text-uppercase mt-4">Phases & Subphases</h5>

            @php
            $groupedSubphases = $project->subphases->groupBy('phase_id');
            @endphp

            @foreach($groupedSubphases as $phaseId => $subphases)
            @php
                $phase = \App\Models\Phase::find($phaseId);
                $phasePercentage = optional($project->phases->firstWhere('id', $phaseId))->pivot->percentage ?? 0;
            @endphp

          <div>
            
        </div>
          @php
            // Déterminer la couleur du header selon le nom de la phase
            $phaseColor = match(strtolower($phase->name)) {
                'tor' => 'bg-gold',
                'procurement' => 'bg-yellow',
                'implementation' => 'bg-green',
                'evaluation' => 'bg-info',
                default => 'bg-secondary',
            };
          @endphp

            <div class="card mb-4 shadow-sm">
              <div class="card-header text-white d-flex justify-content-between align-items-center {{ $phaseColor }}">
                <span class="font-weight-bold h5 text-white">
                  {{ $phase->label ?? ucfirst($phase->name) }}
                </span>

                <div class="progress" style="width: 180px; height: 20px; background-color: rgba(255,255,255,0.3);">
                  <div class="progress-bar progress-bar-striped bg-light text-dark"
                      role="progressbar"
                      style="width: {{ $phasePercentage }}%"
                      aria-valuenow="{{ $phasePercentage }}"
                      aria-valuemin="0"
                      aria-valuemax="100">
                    {{ $phasePercentage }}%
                  </div>
                </div>
              </div>

              <div class="card-body bg-white">
                <ul class="list-group list-group-flush">
                  @foreach($subphases as $sub)
                    <li class="list-group-item">
                      <form method="POST" action="{{ route('projects.updateSubphaseStatus', ['project' => $project->id, 'subphase' => $sub->id]) }}">
                        @csrf @method('PATCH')

                        @php
                            $status = $sub->pivot->status;

                            if ($status === 'Completed') {
                                $displayedPercentage = 100;
                            } elseif ($sub->name === 'development' && $sub->default_percentage > 0) {
                                $displayedPercentage = round(($sub->pivot->percentage / $sub->default_percentage) * 100);
                            } else {
                                $displayedPercentage = round($sub->pivot->percentage, 1);
                            }

                            $statusColor = match($status) {
                                'Completed' => 'success',
                                'In progress' => 'info',
                                'Not started' => 'secondary',
                                'Cancelled' => 'danger',
                                'Delayed' => 'warning',
                                'Waiting Approval' => 'primary',
                                'Under review' => 'dark',
                                default => 'light',
                            };
                        @endphp

                        <div class="d-flex align-items-center justify-content-between w-100">
                          <div class="w-25">
                            <strong>{{ $sub->label ?? $sub->name }}</strong>
                          </div>

                          <div class="text-center w-25">
                            <span class="badge badge-{{ $statusColor }} px-3 py-2">
                                {{ $displayedPercentage }}%
                            </span>
                          </div>

                          <div class="d-flex align-items-center justify-content-end w-50">
                            @if($sub->name === 'development')
                              <div class="input-group input-group-sm">
                                  <div class="input-group-prepend">
                                      <span class="input-group-text bg-light">
                                          <i class="fe fe-lock text-maroon"></i>
                                      </span>
                                  </div>
                                  <input type="text" class="form-control" value="{{ $status }}" readonly>
                              </div>
                            @else
                              <select name="status" class="form-control form-control-sm status-select" data-subphase="{{ $sub->id }}">
                                  @foreach(['Not started','In progress','Completed','Cancelled','Delayed','Waiting Approval','Under review'] as $option)
                                      <option value="{{ $option }}" {{ $status == $option ? 'selected' : '' }}>{{ $option }}</option>
                                  @endforeach
                              </select>

                              <input type="text" name="reason" class="form-control form-control-sm ml-2 reason-input"
                                  placeholder="Reason" style="display: none;" value="{{ $sub->pivot->reason ?? '' }}">

                              <button type="submit" class="btn btn-sm btn-outline-success ml-2">Save</button>
                            @endif
                          </div>
                        </div>
                      </form>

                      {{-- Afficher les activités de développement --}}
                      @if($sub->name === 'development' && $project->developmentDetails->count())
                        <div class="mt-3 ml-4">
                          <strong>Development Activities:</strong>
                          <ul class="list-group mt-2">
                            @foreach($project->developmentDetails as $activity)
                              <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                  <strong>{{ $activity->title }}</strong>
                                  @if($activity->notes)
                                    <div><small class="text-muted">{{ $activity->notes }}</small></div>
                                  @endif
                                </div>

                                <form method="POST" action="{{ route('developmentDetails.updateStatus', $activity->id) }}" class="d-flex align-items-center">
                                  @csrf @method('PATCH')

                                  <select name="status" class="form-control form-control-sm mr-2 status-select">
                                    @foreach(['Not started', 'In progress', 'Completed','Cancelled','Delayed','Waiting Approval','Under review'] as $status)
                                      <option value="{{ $status }}" {{ $activity->status == $status ? 'selected' : '' }}>
                                        {{ $status }}
                                      </option>
                                    @endforeach
                                  </select>

                                  <input type="text" name="reason" class="form-control form-control-sm mr-2 reason-input"
                                    placeholder="Reason" style="display: none;" value="{{ $activity->reason ?? '' }}">

                                  <button class="btn btn-sm btn-outline-success">Save</button>
                                </form>
                              </li>
                            @endforeach
                          </ul>
                        </div>
                      @endif

                    </li>
                  @endforeach
                </ul>
              </div>
            </div>


            @endforeach


        </div>
      </div>
    </div>

  @include('partials.footer')   
</main>

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
<!-- Select2 -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
  function togglePartnerEdit() {
    document.getElementById('partners-display').style.display = 'none';
    document.getElementById('partners-form').style.display = 'block';
    $('.select2-multi').select2();
  }
</script>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.status-select').forEach(select => {
      const form = select.closest('form');
      const reasonInput = form.querySelector('.reason-input');

      function toggleReasonField() {
        const value = select.value;
        if (['Cancelled', 'Delayed', 'Waiting Approval', 'Under review'].includes(value)) {
          if (reasonInput) {
            reasonInput.style.display = 'block';
          }
        } else {
          if (reasonInput) {
            reasonInput.style.display = 'none';
            reasonInput.value = '';
          }
        }
      }

      toggleReasonField(); // on page load
      select.addEventListener('change', toggleReasonField);
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
