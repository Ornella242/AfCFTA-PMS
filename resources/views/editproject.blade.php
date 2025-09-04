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
                      <option value="{{ $unit->id }}" {{ $project->unit_id == $unit->id ? 'selected' : '' }}>{{ $unit->name }}</option>
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

            {{-- PMA --}}
            <dt class="col-sm-2 mb-3 text-black">PMA</dt>
            <dd class="col-sm-4 mb-3">
              <form method="POST" action="{{ route('projects.updateRelation', ['project' => $project->id]) }}">
                @csrf
                @method('PATCH') 
                <div class="d-flex align-items-center">
                  <select name="pma_id" class="form-control form-control-sm">
                    <option value="" disabled {{ $project->assistants->isEmpty() ? 'selected' : '' }}>-- Select PMA --</option>
                    @foreach($users as $user)
                      <option value="{{ $user->id }}"
                        {{ $project->assistants->contains('id', $user->id) ? 'selected' : '' }}>
                        {{ $user->firstname }} {{ $user->lastname }}
                      </option>
                    @endforeach
                  </select>
                  <button class="btn btn-sm btn-outline-success ml-2">Save</button>
                </div>
              </form>
            </dd>
            </dd>

            {{-- Members --}}
            <dt class="col-sm-2 mb-3 text-black">Members</dt>
            <dd class="col-sm-4 mb-3 text-white">
              <div id="members-display" onclick="toggleMembersEdit()" style="cursor: pointer; display: flex; flex-wrap: wrap; gap: 0.5rem;">
            @forelse($project->members as $member)
              <span class="badge badge-info p-2">{{ $member->firstname }} {{ $member->lastname }}</span> 
            @empty
              <span class="text-muted">None</span>
            @endforelse
            <span class="text-muted"><small>(Edit)</small></span>
          </div>


          <form id="members-form" method="POST" action="{{ route('projects.updateRelation', ['project' => $project->id]) }}" style="display: none;">
            @csrf
            @method('PATCH')
            <div class="d-flex align-items-center mt-2">
              <select name="member_ids[]" class="form-control form-control-sm select2-multi" multiple style="min-width: 300px;">
                @foreach($users as $user)
                  <option value="{{ $user->id }}" {{ $project->members->contains('id', $user->id) ? 'selected' : '' }}>
                    {{ $user->firstname }} {{ $user->lastname }}
                  </option>
                @endforeach
              </select>
              <button class="btn btn-sm btn-outline-success ml-2">Save</button>
            </div>
          </form>
        </dd>


        {{-- PARTNERS --}}
        <dt class="col-sm-2 mb-3 text-black">Partners</dt>
        <dd class="col-sm-4 mb-3">
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
                  <option value="{{ $partner->id }}" {{ $project->partners->contains($partner->id) ? 'selected' : '' }}>{{ $partner->name }}</option>
                @endforeach
              </select>
              <button class="btn btn-sm btn-outline-success ml-2">Save</button>
            </div>
          </form>
        </dd>

        {{-- PROCUREMENT --}}
        <dt class="col-sm-2 mb-3 text-black">Procurement</dt>
        <dd class="col-sm-4 mb-3">
          <form method="POST" action="{{ route('projects.updateField', ['id' => $project->id, 'field' => 'procurement_type']) }}">
            @csrf @method('PATCH')
            <div class="d-flex align-items-center">
              <select name="value" class="form-control form-control-sm">
                <option value="afcfta_procurement" {{ $project->subphases->contains('name', 'afcfta') ? 'selected' : '' }}>AfCFTA Procurement</option>
                <option value="partner_procurement" {{ $project->subphases->contains('name', 'partner_procurement') ? 'selected' : '' }}>Partner Procurement</option>
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
                  <option value="{{ $priority }}" {{ $project->priority == $priority ? 'selected' : '' }}>{{ $priority }}</option>
                @endforeach
              </select>
              <button class="btn btn-sm btn-outline-success ml-2">Save</button>
            </div>
          </form>
        </dd>

        {{-- STATUS --}}
        <dt class="col-sm-2 mb-3 text-black">Status</dt>
        <dd class="col-sm-4 mb-3">
          <div class="input-group input-group-sm">
            <div class="input-group-prepend">
              <span class="input-group-text bg-light"><i class="fe fe-lock text-muted"></i></span>
            </div>
            <input type="text" class="form-control" value="{{ $project->status }}" readonly>
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
            <form method="POST" action="{{ route('projects.updateField', ['id' => $project->id]) }}" id="budgetForm">
              @csrf @method('PATCH')
              <input type="hidden" name="field" value="budget">
              <input type="hidden" name="reason" id="budgetReason">
              <div class="d-flex align-items-center">
                <input type="number" step="0.01" name="value" id="budgetValue" class="form-control form-control-sm" value="{{ $project->budget }}">
                <button type="button" class="btn btn-sm btn-outline-success ml-2" onclick="$('#budgetModal').modal('show')">Save</button>
              </div>
            </form>
          </dd>

            {{-- BUDGET MODAL --}}

            {{-- BUDGET CODE --}}
            <dt class="col-sm-2 mb-3 text-black">Budget Code</dt>
            <dd class="col-sm-4 mb-3">
              <form method="POST" action="{{ route('projects.updateField', ['id' => $project->id, 'field' => 'budget_code']) }}">
                @csrf @method('PATCH')
                <div class="d-flex align-items-center">
                  <input type="text" class="form-control form-control-sm" name="value" value="{{ $project->budget_code }}">
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
            
           @if (is_null($project->assistant_id) && $project->members->isEmpty())
              <dt class="col-sm-2 text-black">Assign Team</dt>
              <dd class="col-sm-10">
                  {{-- Select trigger --}}
                  <button class="btn btn-sm btn-outline-primary mb-2" type="button" onclick="toggleTeamOptions()">Assign PMA / Members</button>

                  {{-- Hidden section --}}
                  <div id="teamOptions" style="display: none;">
                      <form method="POST" action="{{ route('projects.assignTeam', $project->id) }}">
                          @csrf

                          <div class="form-group mb-2">
                              <label>Who do you want to assign?</label>
                              <select class="form-control" id="teamTypeSelector" onchange="handleTeamSelection(this.value)">
                                  <option value="">-- Select --</option>
                                  <option value="pma">PMA only</option>
                                  <option value="members">Members only</option>
                                  <option value="both">PMA & Members</option>
                              </select>
                          </div>

                          <div id="pmaField" class="form-group mb-2" style="display: none;">
                              <label for="pmaSelect">Select PMA</label>
                              <select class="form-control" id="pmaSelect" name="assistant_ids[]">
                                  @foreach($users as $user)
                                      <option value="{{ $user->id }}">{{ $user->firstname.' '.$user->lastname }}</option>
                                  @endforeach
                              </select>
                              <button type="button" class="btn btn-sm btn-outline-success mt-2"
                                  onclick="document.getElementById('pmaField').style.display = 'none';
                                          document.getElementById('membersField').style.display = 'block';">
                                  Next
                              </button>
                          </div>

                          <div id="membersField" class="form-group mb-2" style="display: none;">
                              <label for="membersSelect">Select Members</label>
                              <select class="form-control js-select2" id="membersSelect" name="member_ids[]" multiple>
                                  @foreach($users as $user)
                                      <option value="{{ $user->id }}">{{ $user->firstname.' '.$user->lastname }}</option>
                                  @endforeach
                              </select>
                          </div>

                          <button type="submit" class="btn btn-success btn-sm mt-2">Save Team</button>
                      </form>
                  </div>
              </dd>
            @endif

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
                                  <select name="status" class="form-control form-control-sm status-select" data-subphase="{{ $sub->id }}" data-subphase-name="{{ $sub->name }}">
                                      @foreach(['Not started','In progress','Completed','Cancelled','Delayed','Waiting Approval','Under review'] as $option)
                                          <option value="{{ $option }}" {{ $status == $option ? 'selected' : '' }}>{{ $option }}</option>
                                      @endforeach
                                  </select>

                                  <input type="text" name="reason" class="form-control form-control-sm ml-2 reason-input"
                                      placeholder="Reason" style="display: none;" value="{{ $sub->pivot->reason ?? '' }}">
                                    @if($sub->name === 'award')
                                      <input type="text"
                                            name="award_person_name"
                                            class="form-control form-control-sm ml-2 award-input"
                                            placeholder="Award responsible name"
                                            style="{{ $sub->pivot->status === 'Completed' ? '' : 'display:none;' }}"
                                            value="{{ $sub->pivot->award_person_name ?? '' }}">
                                    @endif

                                  <button type="submit" class="btn btn-sm btn-outline-success ml-2">Save</button>
                                @endif
                              </div>
                            </div>
                          </form>

                          @if($sub->name === 'development')
                            <div class="mt-3 ml-4">
                              <strong>Development Activities:</strong>

                              {{-- Liste des activités déjà enregistrées --}}
                              @if($project->developmentDetails->count())
                                <ul class="list-group mt-2 mb-3">
                                  @foreach($project->developmentDetails as $activity)
                                    {{-- <li class="list-group-item d-flex justify-content-between align-items-center">
                                    

                                      <div>
                                        <strong>{{ $activity->title }}</strong>
                                          @if($activity->budget_activity)
                                            <div><small class="text-muted">Budget: ${{ number_format($activity->budget_activity, 2) }}</small></div>
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
                                    </li> --}}
                                    <li class="list-group-item">
                                      <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                          <strong>{{ $activity->title }}</strong>
                                        
                                          <div class="ms-3"> {{-- Ou ml-3 si Bootstrap 4 --}}
                                            @if(!is_null($activity->budget_activity))
                                              <small class="text-black mr-2">Budget: ${{ number_format($activity->budget_activity, 2) }}</small>

                                              @if($activity->payment_status)
                                                <small class="text-black mr-2">| Status: {{ $activity->payment_status }}</small>
                                              @endif

                                              @if($activity->payment_status === 'Paid' && $activity->payment_date)
                                                <small class="text-muted mr-2">
                                                  on {{ \Carbon\Carbon::parse($activity->payment_date)->format('d M Y') }}
                                                </small>
                                              @endif
                                              <button type="button" class="btn btn-sm btn-link p-0 edit-budget-btn text-decoration-none" data-activity-id="{{ $activity->id }}">
                                                <i class="fe fe-edit-2 text-maroon fe-16 "></i>
                                              </button>

                                            @else
                                              <small class="text-muted mr-2">No budget dedicated</small>
                                            @endif
                                          </div>
                                        
                                          {{-- Formulaire de paiement caché --}}
                                          <form method="POST" action="{{ route('developmentDetails.updatePayment', $activity->id) }}"
                                                class="payment-form mt-2" id="payment-form-{{ $activity->id }}" style="display: none;">
                                            @csrf @method('PATCH')
                                            
                                            <div class="form-row align-items-center">
                                              
                                              <div class="col-auto">
                                                <select name="payment_status" class="form-control form-control-sm payment-status">
                                                  <option value="">Select Payment Status</option>
                                                  <option value="Paid" {{ $activity->payment_status == 'Paid' ? 'selected' : '' }}>Paid</option>
                                                  <option value="Unpaid" {{ $activity->payment_status == 'Unpaid' ? 'selected' : '' }}>Unpaid</option>
                                                </select>
                                              </div>

                                              <div class="col-auto payment-date-field" style="{{ $activity->payment_status == 'Paid' ? '' : 'display: none;' }}">
                                                <input type="date" name="payment_date" value="{{ $activity->payment_date }}" class="form-control form-control-sm">
                                              </div>

                                              <div class="col-auto">
                                                <button class="btn btn-sm btn-outline-success">Save</button>
                                              </div>
                                            </div>
                                          </form>
                                        </div>

                                        {{-- Formulaire de statut activité --}}
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
                                      </div>
                                    </li>

                                  @endforeach
                                </ul>
                              @endif


                              <form method="POST" action="{{ route('developmentDetails.store') }}">
                                @csrf
                                <input type="hidden" name="project_id" value="{{ $project->id }}">

                                <div id="activityInputs">
                                  <div class="form-row align-items-center mb-2 activity-row">
                                    <div class="col">
                                      <input type="text" name="development_activities[0][title]" class="form-control" placeholder="Activity title">
                                    </div>
                                    <div class="col">
                                      <input type="number" step="0.01" name="development_activities[0][budget]" class="form-control" placeholder="Budget">
                                    </div>
                                    <div class="col-auto">
                                      <button type="button" class="btn btn-sm btn-outline-danger remove-activity">X</button>
                                    </div>
                                  </div>
                                </div>

                                <button type="button" class="btn btn-sm btn-outline-primary mt-2" id="addActivityRow">Add Activity</button>
                                <button type="submit" class="btn btn-success btn-sm mt-2">Save Activities</button>
                              </form>

                            </div>
                          @endif

                        </li>
                      @endforeach
                    

                    </ul>
                  </div>
                </div>
            @endforeach

            <hr style="border: none; height: 6px; background: linear-gradient(to right, #1b1311, #feb47b);">
            <h5 class="text-uppercase mt-4">Supporting documents</h5>


            <div class="card mb-4 shadow-sm">
              <div class="card-body bg-white d-flex flex-wrap">
                  @if($project->documents && $project->documents->count())
                      @foreach($project->documents as $doc)
                          @php
                              $extension = strtolower(pathinfo($doc->filename, PATHINFO_EXTENSION));
                              $isImage = in_array($extension, ['jpg','jpeg','png','gif','webp']);
                              $iconPath = match($extension) {
                                  'pdf' => asset('images/icons/pdf.png'),
                                  'doc','docx' => asset('images/icons/word.png'),
                                  'xls','xlsx' => asset('images/icons/excel.png'),
                                  'ppt','pptx' => asset('images/icons/ppt.png'),
                                  default => asset('images/icons/filei.png'),
                              };
                          @endphp

                          <div class="text-center m-2 p-2 border rounded" style="width: 140px;">
                              {{-- Preview image ou icône --}}
                              <a href="{{ asset('storage/' . $doc->path) }}" target="_blank">
                                  @if($isImage)
                                      <img src="{{ asset('storage/' . $doc->path) }}" 
                                          alt="preview" 
                                          style="width:70px; height:70px; object-fit:cover; border-radius:6px;">
                                  @else
                                      <img src="{{ $iconPath }}" 
                                          alt="icon" 
                                          style="width:70px; height:70px; object-fit:contain;">
                                  @endif
                              </a>

                              {{-- Nom du fichier --}}
                              <div class="mt-2 small text-truncate" title="{{ $doc->filename }}">
                                  {{ $doc->filename }}
                              </div>

                              {{-- Boutons --}}
                              {{-- <div class="d-flex flex-row mt-2 gap-2">
                                  <a href="{{ asset('storage/' . $doc->path) }}" 
                                    target="_blank" 
                                    class="btn btn-sm btn-outline-secondary mb-1">
                                      <i class="fe fe-download mr-1"></i>
                                  </a>

                                  <form action="{{ route('documents.destroy', $doc->id) }}" method="POST" onsubmit="return confirm('Delete this document?');">
                                      @csrf
                                      @method('DELETE')
                                      <button type="submit" class="btn btn-sm btn-outline-danger ml-2">
                                          <i class="fe fe-trash mr-1"></i>
                                      </button>
                                  </form>
                              </div> --}}

                              <div class="d-flex justify-content-center mt-2">
                                  <div class="btn-group" role="group" aria-label="Document actions">
                                      <!-- Bouton Télécharger -->
                                      <a href="{{ asset('storage/' . $doc->path) }}" 
                                        target="_blank" 
                                        class="btn btn-sm btn-outline-secondary" 
                                        data-toggle="tooltip" 
                                        title="Download document">
                                          <i class="fe fe-download"></i>
                                      </a>

                                      <!-- Bouton Supprimer -->
                                      <form action="{{ route('documents.destroy', $doc->id) }}" 
                                            method="POST" 
                                            onsubmit="return confirm('Delete this document?');" 
                                            class="m-0 p-0">
                                          @csrf
                                          @method('DELETE')
                                          <button type="submit" 
                                                  class="btn btn-sm btn-outline-danger ml-2" 
                                                  data-toggle="tooltip" 
                                                  title="Delete document">
                                              <i class="fe fe-trash"></i>
                                          </button>
                                      </form>
                                  </div>
                              </div>

                          </div>
                      @endforeach
                  @else
                      <p class="text-muted mb-0">No supporting documents uploaded.</p>
                  @endif
              </div>
            </div>

            <form action="{{ route('projects.documents.store', $project->id) }}" 
                method="POST" 
                enctype="multipart/form-data">
              @csrf

                <div class="card mb-4 shadow-sm">
                    <div class="card-header bg-maroon text-white">
                        <strong>Add supporting Documents</strong>
                    </div>
                    <div class="card-body">
                        {{-- Champ d'ajout --}}
                        <div class="mt-1">
                            <label for="documents" class="form-label">Add new documents</label>
                            <input type="file" name="documents[]" id="documents" class="form-control" multiple>
                            <small class="text-muted">You can select multiple files (maintain Ctrl to select multiple)</small>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn bg-green text-white">Add documents</button>
            </form>

        </div>      
      </div>    
    </div>
     
  @include('partials.footer')   
 <div class="modal fade" id="budgetModal" tabindex="-1" role="dialog" aria-labelledby="budgetModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header bg-warning text-dark">
                  <h5 class="modal-title" id="budgetModalLabel">Justify Budget Change</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div class="form-group">
                    <label for="reasonInput">Reason for budget change</label>
                    <textarea class="form-control" id="reasonInput" rows="3" placeholder="Provide a justification..." required></textarea>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                  <button type="button" class="btn btn-primary" id="confirmBudgetChange">Confirm</button>
                </div>
              </div>
            </div>
      </div>

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

<script>
  document.addEventListener("DOMContentLoaded", function () {
    const addButtonClass = "add-activity";
    const container = document.getElementById("activityInputs");

    container.addEventListener("click", function (e) {
      if (e.target.classList.contains(addButtonClass)) {
        const newInput = document.createElement("div");
        newInput.className = "form-row align-items-center mb-2";
        newInput.innerHTML = `
          <div class="col">
            <input type="text" name="development_activities[]" class="form-control" placeholder="Enter activity title">
          </div>
          
          <div class="col-auto">
            <button type="button" class="btn btn-sm btn-outline-danger remove-activity">Remove</button>
          </div>`;
        container.appendChild(newInput);
      }

      if (e.target.classList.contains("remove-activity")) {
        e.target.closest(".form-row").remove();
      }
    });
  });
</script>

<script>
  document.addEventListener("DOMContentLoaded", function () {
    const confirmBtn = document.getElementById('confirmBudgetChange');
    if (confirmBtn) {
      confirmBtn.addEventListener('click', function () {
        const reason = document.getElementById('reasonInput').value.trim();

        if (reason === '') {
          alert('Please provide a reason for the budget change.');
          return;
        }

        document.getElementById('budgetReason').value = reason;
        document.getElementById('budgetForm').submit();
      });
    } else {
      console.warn('❗ Bouton #confirmBudgetChange non trouvé dans le DOM.');
    }
  });
</script>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    // Clic sur icône crayon
    document.querySelectorAll('.edit-budget-btn').forEach(function (btn) {
      btn.addEventListener('click', function () {
        const activityId = this.dataset.activityId;
        document.getElementById('payment-form-' + activityId).style.display = 'block';
      });
    });

    // Afficher champ date si "Paid"
    document.querySelectorAll('.payment-status').forEach(function (select) {
      select.addEventListener('change', function () {
        const parent = this.closest('.payment-form');
        const dateField = parent.querySelector('.payment-date-field');
        if (this.value === 'Paid') {
          dateField.style.display = 'block';
        } else {
          dateField.style.display = 'none';
        }
      });
    });
  });
</script>

<script>
document.addEventListener('DOMContentLoaded', () => {

  // Délégation : toutes les sélections de statut
  document.body.addEventListener('change', function (e) {
    if (!e.target.matches('.status-select')) return;

    const select = e.target;
    const isAward = select.dataset.subphaseName === 'award';
    if (!isAward) return;

    const container = select.closest('form');
    const awardInput = container.querySelector('.award-input');

    if (select.value === 'Completed') {
      awardInput.style.display = 'block';
    } else {
      awardInput.style.display = 'none';
      awardInput.value = '';
    }
  });

});
</script>
<script>
    function toggleTeamOptions() {
        const section = document.getElementById('teamOptions');
        section.style.display = section.style.display === 'none' ? 'block' : 'none';
    }

    function handleTeamSelection(value) {
        document.getElementById('pmaField').style.display = (value === 'pma' || value === 'both') ? 'block' : 'none';
        document.getElementById('membersField').style.display = (value === 'members' || value === 'both') ? 'block' : 'none';
    }
</script>
<script>
    $(document).ready(function() {
        $('.js-select2').select2({
            placeholder: "Select members",
            width: '100%'
        });
    });
</script>
<script>
  function toggleMembersEdit() {
    document.getElementById('members-display').style.display = 'none';
    document.getElementById('members-form').style.display = 'block';
  }
</script>
<script>
  $(document).ready(function() {
    $('.select2-multi').select2({
      width: 'resolve',
      placeholder: "Select members"
    });
  });
</script>
