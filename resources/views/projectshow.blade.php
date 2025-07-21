
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
      
        <div class="card-header bg-gold text-white d-flex justify-content-between align-items-center">
          <strong class="card-title h3 text-white mt-3">{{ $project->title }}</strong>
          
          <div class="d-flex align-items-center">
            <a href="{{ route('projects.viewReport', $project->id) }}" class="btn btn-sm btn-light text-black font-bold mr-3 shadow-sm">
              <i class="fe fe-file-text text-green mr-1"></i> View Report
            </a>

            <span class="badge badge-pill bg-green text-white pb-2 pt-2">{{ $project->type }}</span>
          </div>
        </div>
        <div class="card-body">
          <dl class="row align-items-center mb-0">
            <dt class="col-sm-2 mb-3 text-black">Unit</dt>
            <dd class="col-sm-4 mb-3">
              <strong>{{ $project->unit->name ?? '-' }}</strong>
            </dd>
            <dt class="col-sm-2 mb-3 text-black">Project Manager</dt>
            <dd class="col-sm-4 mb-3">
              <strong>{{ $project->projectManager->firstname . ' ' . $project->projectManager->lastname ?? '-' }}</strong>
            </dd>
          </dl>

          <dl class="row mb-0">
            <dt class="col-sm-2 mb-3 text-black">Partners</dt>
            <dd class="col-sm-10 mb-3">
              @forelse($project->partners as $partner)
                <span class="badge badge-primary pt-2 pb-2">{{ $partner->name }}</span>
              @empty
                <span class="text-black">None</span>
              @endforelse
            </dd>

            <dt class="col-sm-2 mb-3 text-black">Priority</dt>
            <dd class="col-sm-4 mb-3">
              <span class="badge badge-pill pt-2 pb-2 text-white text-2xl 
                {{ $project->priority === 'High' ? 'badge-danger' : ($project->priority === 'Medium' ? 'badge-warning' : 'badge-secondary') }}">
                {{ $project->priority }}
              </span>
            </dd>

            <dt class="col-sm-2 mb-3 text-black">Status</dt>
            <dd class="col-sm-4 mb-3">
              <span class="dot dot-md bg-info mr-2 text-black"></span> {{ $project->status }}
            </dd>

            <dt class="col-sm-2 mb-3 text-black">Start Date</dt>
            <dd class="col-sm-4 mb-3 text-black">{{ \Carbon\Carbon::parse($project->start_date)->format('M d, Y') }}</dd>

            <dt class="col-sm-2 mb-3 text-black">End Date</dt>
            <dd class="col-sm-4 mb-3 text-black">{{ \Carbon\Carbon::parse($project->end_date)->format('M d, Y') }}</dd>

            <dt class="col-sm-2 mb-3 text-black">Budget</dt>
            <dd class="col-sm-4 mb-3 text-black">${{ number_format($project->budget, 2) }}</dd>

            <dt class="col-sm-2 mb-3 text-black">Procurement Type</dt>
            <dd class="col-sm-4 mb-3 text-black">
              {{-- Vérifie si le projet a une sous-phase de type "partner_procurement" --}}
              {{ $project->subphases->contains('name', 'partner_procurement') ? 'Partner Procurement' : 'AfCFTA Procurement' }}
            </dd>

            <dt class="col-sm-2 text-black">Description</dt>
            <dd class="col-sm-10">{{ $project->description }}</dd>
          </dl>

          {{-- Subphases --}}
        <hr style="border: none; height: 6px; background: linear-gradient(to right, #1b1311, #feb47b);">

        <h5 class="text-uppercase mt-4">Phases & Subphases</h5>

        @foreach($project->phases as $phase)
            @php
                $subphases = $project->subphases->where('phase_id', $phase->id);
                $phaseColor = match(strtolower($phase->name)) {
                    'tor' => 'bg-primary',
                    'procurement' => 'bg-warning',
                    'implementation' => 'bg-success',
                    'evaluation' => 'bg-info',
                    default => 'bg-secondary',
                };

                $borderColor = match(strtolower($phase->name)) {
                    'tor' => 'border-primary',
                    'procurement' => 'border-warning',
                    'implementation' => 'border-success',
                    'evaluation' => 'border-info',
                    default => 'border-secondary',
                };
            @endphp

            <div class="card mb-4 shadow-sm border-2 {{ $borderColor }}">
                <div class="card-header text-white d-flex justify-content-between align-items-center {{ $phaseColor }}">
                    <h6 class="mb-0">
                        {{ $phase->label ?? ucfirst($phase->name) }}
                    </h6>
                    <span class="badge bg-light text-dark p-2 ">
                        {{ $phase->pivot->percentage ?? 0 }}%
                    </span>
                </div>

                <div class="card-body bg-white">
                    @if($subphases->isEmpty())
                        <p class="text-muted">No subphases for this phase.</p>
                    @else
                        <ul class="list-group list-group-flush">
                            @foreach($subphases as $sub)
                                <li class="list-group-item">
                                    <div class="d-flex justify-content-between align-items-center">
                                        {{ $sub->label ?? $sub->name }}

                                        @php
                                            $subStatus = $sub->pivot->status;
                                            $procurementType = strtolower($sub->pivot->procurement_type ?? '');
                                            $subColor = match($subStatus) {
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

                                        <span class="badge badge-{{ $subColor }} pt-2 pb-2 badge-pill">
                                            {{ $sub->pivot->percentage }}%
                                        </span>
                                    </div>

                                    {{-- Affichage conditionnel selon procurement_type --}}
                                    @if(strtolower($phase->name) === 'procurement')
                                        @if($procurementType === 'partner')
                                            <div class="mt-2">
                                                <label><strong>Partner Procurement Status:</strong></label>
                                                <select class="form-control w-50" name="partner_procurement_status_{{ $sub->id }}">
                                                    <option value="">-- Select Status --</option>
                                                    <option value="Not started" {{ $subStatus === 'Not started' ? 'selected' : '' }}>Not started</option>
                                                    <option value="In progress" {{ $subStatus === 'In progress' ? 'selected' : '' }}>In progress</option>
                                                    <option value="Completed" {{ $subStatus === 'Completed' ? 'selected' : '' }}>Completed</option>
                                                    <option value="Delayed" {{ $subStatus === 'Delayed' ? 'selected' : '' }}>Delayed</option>
                                                    <option value="Cancelled" {{ $subStatus === 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                                                    <option value="Waiting Approval" {{ $subStatus === 'Waiting Approval' ? 'selected' : '' }}>Waiting Approval</option>
                                                    <option value="Under review" {{ $subStatus === 'Under review' ? 'selected' : '' }}>Under review</option>
                                                </select>
                                            </div>
                                        @elseif($procurementType === 'afcfta')
                                            <p class="text-muted mt-2">AfCFTA procurement in progress.</p>
                                        @endif
                                    @endif

                                    {{-- Activités de développement --}}
                                  
                                    @if($sub->name === 'development' && $project->developmentDetails->count())
                                      <div class="mt-2 ml-3">
                                          <strong>Development Activities:</strong>
                                          <ul class="list-group mt-1">
                                              @foreach($project->developmentDetails as $activity)
                                                  <li class="list-group-item d-flex justify-content-between align-items-center">
                                                      {{-- Titre et notes --}}
                                                      <div>
                                                          <strong>{{ $activity->title }}</strong>
                                                          @if($activity->notes)
                                                              <div><small class="text-muted">{{ $activity->notes }}</small></div>
                                                          @endif
                                                      </div>

                                                      {{-- Infos à droite : budget + statut + date --}}
                                                      <div class="text-right">
                                                          <small class="text-muted">
                                                              @if($activity->budget_activity > 0)
                                                                  ${{ number_format($activity->budget_activity, 2) }}
                                                              @else
                                                                  No budget dedicated
                                                              @endif

                                                              {{-- Statut de paiement --}}
                                                              @if($activity->payment_status)
                                                                  | {{ $activity->payment_status }}

                                                                  {{-- Date si payé --}}
                                                                  @if($activity->payment_status === 'Paid' && $activity->payment_date)
                                                                      on {{ \Carbon\Carbon::parse($activity->payment_date)->format('d M Y') }}
                                                                  @endif
                                                              @endif
                                                          </small>
                                                      </div>
                                                  </li>
                                              @endforeach
                                          </ul>
                                      </div>
                                    @endif

                                </li>
                            @endforeach
                        </ul>
                    @endif
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
