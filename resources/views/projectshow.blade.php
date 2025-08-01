
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
          <div class="table-responsive">
              <table class="table table-bordered table-striped">
                  <tbody>
                      <tr>
                          <th class="text-nowrap text-black">Unit</th>
                          <td>{{ $project->unit->name ?? '-' }}</td>

                          <th class="text-nowrap text-black">Project Manager</th>
                          <td>{{ $project->projectManager->firstname . ' ' . $project->projectManager->lastname ?? '-' }}</td>
                      </tr>

                      <tr>
                          <th class="text-black">PMA</th>
                          <td>
                              @forelse($project->assistants as $pma)
                                  <span class="badge bg-success me-1 text-white p-2">{{ $pma->firstname . ' ' . $pma->lastname }}</span>
                              @empty
                                  <span>None</span>
                              @endforelse
                          </td>

                          <th class="text-black">Members</th>
                          <td>
                              @forelse($project->members as $member)
                                  <span class="badge bg-info me-1 p-2 text-white">{{ $member->firstname . ' ' . $member->lastname }}</span>
                              @empty
                                  <span>None</span>
                              @endforelse
                          </td>
                      </tr>

                      <tr>
                          <th class="text-black">Partners</th>
                          <td>
                              @forelse($project->partners as $partner)
                                  <span class="badge bg-primary me-1 p-2 text-white">{{ $partner->name }}</span>
                              @empty
                                  <span>None</span>
                              @endforelse
                          </td>

                          <th class="text-black">Procurement Type</th>
                          <td>
                              {{ $project->subphases->contains('name', 'partner_procurement') ? 'Partner Procurement' : 'AfCFTA Procurement' }}
                          </td>
                      </tr>

                      <tr>
                          <th class="text-black">Priority</th>
                          <td>
                              <span class="badge text-white p-2
                                  {{ $project->priority === 'High' ? 'bg-danger' : ($project->priority === 'Medium' ? 'bg-warning text-white' : 'bg-secondary') }}">
                                  {{ $project->priority }}
                              </span>
                          </td>

                          <th class="text-black">Status</th>
                          <td>
                            @php
                                $status = $project->status;
                                $statusClass = match ($status) {
                                    'Not started' => 'bg-gray',
                                    'Waiting approval' => 'bg-primary',
                                    'In progress' => 'bg-yellow',
                                    'Completed' => 'bg-green',
                                    'Delayed' => 'bg-maroon',
                                    'Cancelled' => 'bg-red',
                                    default => 'bg-info',
                                };
                            @endphp

                            <span class="badge {{ $statusClass }} p-2 text-white">
                                {{ $status }}
                            </span>
                          </td>
                      </tr>

                      <tr>
                          <th class="text-black">Start Date</th>
                          <td>{{ \Carbon\Carbon::parse($project->start_date)->format('M d, Y') }}</td>

                          <th class="text-black">End Date</th>
                          <td>{{ \Carbon\Carbon::parse($project->end_date)->format('M d, Y') }}</td>
                      </tr>

                      <tr>
                          <th class="text-black">Budget</th>
                          <td>${{ number_format($project->budget, 2) }}</td>

                          <th class="text-black">Budget Code</th>
                          <td>{{ $project->budget_code ?? '-' }}</td>
                      </tr>

                      <tr>
                          <th class="text-black">Description</th>
                          <td colspan="3">{{ $project->description }}</td>
                      </tr>
                  </tbody>
              </table>
          </div>

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
