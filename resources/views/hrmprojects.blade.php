@include('partials.navbar')
<main role="main" class="main-content fade-in" id="page-transition">
        <div class="container-fluid">
         
          <div class="row justify-content-center">
            <div class="col-12">
              <div class="row align-items-start mb-2">
                  <div class="col">
                    <h2 class="h3 mb-0 page-title text-maroon">Human Resources Managment Projects</h2>
                  
                      {{-- Légende stylée --}}
                      <div class="d-flex flex-wrap align-items-center mt-3" style="gap: 20px;">
                          @php
                              $phases = collect([
                                  ['name' => 'ToR', 'color' => '#17a2b8'],         // bg-info
                                  ['name' => 'Procurement', 'color' => '#ffc107'], // bg-warning
                                  ['name' => 'Implementation', 'color' => '#28a745'], // bg-success
                              ]);
                          @endphp

                          @foreach($phases as $phase)
                              <div class="d-flex align-items-center" style="gap: 8px;">
                                  <span style="display:inline-block; width:14px; height:14px; border-radius:50%; background-color: {{ $phase['color'] }};"></span>
                                  <span style="font-size: 14px; color: #555;">{{ $phase['name'] }}</span>
                              </div>
                          @endforeach
                      </div>
                  </div>
                   
                @if(session('success'))
                  <div class="alert alert-success shadow-sm">
                    {{ session('success') }}
                  </div>
                @endif
                @if(session('error'))
                  <div class="alert alert-danger shadow-sm">
                    {{ session('error') }}
                  </div>
                @endif
              </div>
              <div class="row">
                @foreach($highPriorityProjects as $project)
                  @php
                      $phases = collect([
                          ['name' => 'tor', 'color' => 'bg-info'],
                          ['name' => 'procurement', 'color' => 'bg-warning'],
                          ['name' => 'implementation', 'color' => 'bg-success'],
                      ]);

                      $phaseBars = $phases->map(function ($phase) use ($project) {
                          $p = $project->phases->firstWhere('name', $phase['name']);
                          return $p ? [
                              'percentage' => $p->pivot->percentage,
                              'color' => $phase['color']
                          ] : null;
                      })->filter();
                  @endphp

                  <div class="col-md-6 col-lg-4 mb-4">
                    <a href="{{ route('projects.show', $project->id) }}" class="text-decoration-none text-dark">
                      <div class="d-flex h-100">
                        <!-- Bande verticale avec dégradé -->
                        <div style="width: 2px; border-top-left-radius: .25rem; border-bottom-left-radius: .25rem;
                                    background: linear-gradient(to bottom, #28a745, #ffc107, #dc3545);">
                        </div>

                        <!-- Carte cliquable -->
                        <div class="card h-100 flex-grow-1 border-0 shadow-sm">
                          <div class="card-body">
                            <h5 class="text-maroon font-weight-bold mb-3">{{ $project->title }}</h5>
                            <div class="progress" style="height: 20px;">
                              @foreach($phaseBars as $bar)
                                <div class="progress-bar progress-bar-striped {{ $bar['color'] }}" 
                                    role="progressbar"
                                    style="width: {{ $bar['percentage'] }}%"
                                    aria-valuenow="{{ $bar['percentage'] }}" 
                                    aria-valuemin="0" 
                                    aria-valuemax="100">
                                  {{ $bar['percentage'] }}%
                                </div>
                              @endforeach
                            </div>
                          </div>
                        </div>
                      </div>
                    </a>
                  </div>

                @endforeach
              </div>
              <div class="row items-align-center my-4  d-none d-lg-flex">
               <div class="col-md">
                  <ul class="nav nav-pills justify-content-start">
                    <li class="nav-item">
                      <a class="nav-link {{ request('status') === null ? 'active text-white' : 'text-dark' }}"
                        href="{{ route('projects.hrm') }}">
                        All
                        <span class="badge badge-pill bg-gold text-white pb-2 pt-2 ml-2">{{ $counts['all'] }}</span>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link {{ request('status') === 'Not started' ? 'active text-maroon' : 'text-dark' }}"
                        href="{{ route('projects.hrm', ['status' => 'Not started']) }}">
                        Not Started
                        <span class="badge badge-pill bg-maroon border text-white pb-2 pt-2 ml-2">{{ $counts['Not started'] }}</span>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link {{ request('status') === 'In progress' ? 'active text-yellow' : 'text-dark' }}"
                        href="{{ route('projects.hrm', ['status' => 'In progress']) }}">
                        In Progress
                        <span class="badge badge-pill bg-yellow border text-white pb-2 pt-2 ml-2">{{ $counts['In progress'] }}</span>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link {{ request('status') === 'Completed' ? 'active text-green' : 'text-dark' }}"
                        href="{{ route('projects.hrm', ['status' => 'Completed']) }}">
                        Completed
                        <span class="badge badge-pill bg-green border text-white pb-2 pt-2 ml-2">{{ $counts['Completed'] }}</span>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link {{ request('status') === 'Cancelled' ? 'active text-white' : 'text-dark' }}"
                        href="{{ route('projects.hrm', ['status' => 'Cancelled']) }}">
                        Cancelled
                        <span class="badge badge-pill bg-danger border text-white pb-2 pt-2 ml-2">{{ $counts['Cancelled'] }}</span>
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
                <div class="col-md-12 d-flex justify-content-end">
                  <form method="GET" action="{{ route('projects.hrm') }}" class="w-100" style="max-width: 400px;">
                    <div class="input-group shadow-sm">
                      <input 
                        type="text" 
                        name="search" 
                        class="form-control" 
                        placeholder="Search by title or project manager..."
                        value="{{ request('search') }}"
                      >
                      @if(request('status'))
                        <input type="hidden" name="status" value="{{ request('status') }}">
                      @endif
                      <div class="input-group-append">
                        <button class="btn bg-maroon text-white" type="submit">
                          <i class="fe fe-search fe-16"></i>
                        </button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>

              <div class="row">
                <div class="col-md-12">
                  <!-- table -->
                <table class="table table-borderless table-striped">
                  <thead class="bg-maroon text-white">
                    <tr>
                      <th>ID</th>
                      <th></th>
                      <th>Title</th>
                      <th>Project Manager</th>
                      <th>TOR</th>
                      <th>Procurement</th>
                      <th>Implementation</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                   

                    @forelse($projects as $project)
                      @php

                        $status = $project->status ?? 'Pending';

                        $bgClass = match($status) {
                            'Not started'        => 'bg-secondary text-white',
                            'In progress'        => 'bg-warning text-dark',
                            'Completed'          => 'bg-success text-white',
                            'Cancelled'          => 'bg-danger text-white',
                            'Delayed'            => 'bg-danger text-white',
                            'Waiting Approval'   => 'bg-info text-white',
                            'Under review'       => 'bg-primary text-white',
                            'Closed'             => 'bg-green text-white',
                            default              => 'bg-light text-dark',
                        };

                       $hasImportantIssue = false;
                        if ($status === 'In progress') {
                            $hasImportantIssue = $project->subphases->contains(function ($sub) {
                                return in_array($sub->pivot->status, ['Cancelled', 'Delayed']);
                            });

                            // Vérifie aussi les developmentDetails
                            if (!$hasImportantIssue && $project->developmentDetails->isNotEmpty()) {
                                $hasImportantIssue = $project->developmentDetails->contains(function ($detail) {
                                    return in_array($detail->status, ['Cancelled', 'Delayed']);
                                });
                            }
                        }

                        $getPhasePercentage = function($project, $phaseName) {
                            $phase = $project->phases->firstWhere('name', $phaseName);
                            return $phase ? $phase->pivot->percentage : null;
                        };

                        $tor = $getPhasePercentage($project, 'tor');
                        $proc = $getPhasePercentage($project, 'procurement');
                        $impl = $getPhasePercentage($project, 'implementation');
                      @endphp


                        <tr @if($hasImportantIssue) data-toggle="collapse" data-target="#detailsRow{{ $project->id }}" class="clickable" @endif>
                        <td class="small {{ $bgClass }}">{{ str_pad($project->id, 4, '0', STR_PAD_LEFT) }}</td>
                        <td class="text-center"><span class="dot dot-lg {{ $bgClass }} mr-2"></span></td>
                        <th>{{ $project->title }}</th>
                        <td class="medium">
                          {{ $project->projectManager ? $project->projectManager->firstname . ' ' . $project->projectManager->lastname : 'N/A' }}
                        </td>

                    {{-- TOR --}}
                    <td class="medium">
                      @if($tor !== null)
                        {{ $tor }}%
                        <div class="progress mt-1" style="height: 4px;">
                          <div class="progress-bar bg-info" style="width: {{ $tor }}%"></div>
                        </div>
                      @else
                        —
                      @endif
                    </td>

                    {{-- Procurement --}}
                   <td class="medium">
                      @if($proc !== null)
                        {{ $proc }}%
                        <div class="progress mt-1" style="height: 4px;">
                          <div class="progress-bar bg-warning" style="width: {{ $proc }}%"></div>
                        </div>
                      @else
                        —
                      @endif
                    </td>

                    {{-- Implementation --}}
                   <td class="medium">
                      @if($impl !== null)
                        {{ $impl }}%
                        <div class="progress mt-1" style="height: 4px;">
                          <div class="progress-bar bg-success" style="width: {{ $impl }}%"></div>
                        </div>
                      @else
                        —
                      @endif
                    </td>

                        <td class="text-center">
                          <div class="d-flex justify-content-center gap-2 align-items-center">
                            @if ($project->status !=='Closed')
                              <a href="{{ route('projects.edit', $project) }}" class="text-primary mx-1 text-decoration-none"><i class="fe fe-edit-2"></i></a>
                            @endif

                            <a href="{{ route('projects.show', $project->id) }}" class="text-info mx-1 text-decoration-none"><i class="fe fe-eye"></i></a>
                              @if($project->status === 'Cancelled')
                                {{-- Bouton de réactivation --}}
                                <!-- Reactivate Trigger Button -->
                                <button class="btn btn-sm text-success" title="Reactivate Project" data-toggle="modal" data-target="#reactivateProjectModal{{ $project->id }}">
                                  <i class="fe fe-refresh-ccw"></i>
                                </button>

                                <!-- Reactivate Modal -->
                                <div class="modal fade" id="reactivateProjectModal{{ $project->id }}" tabindex="-1" role="dialog" aria-labelledby="reactivateProjectModalLabel{{ $project->id }}" aria-hidden="true">
                                  <div class="modal-dialog" role="document">
                                    <form action="{{ route('projects.reactivate', $project->id) }}" method="POST">
                                      @csrf
                                      @method('PATCH')
                                      <div class="modal-content">
                                        <div class="modal-header bg-success text-white">
                                          <h5 class="modal-title" id="reactivateProjectModalLabel{{ $project->id }}">
                                            Reactivate Project
                                          </h5>
                                          <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                        </div>

                                        <div class="modal-body">
                                          <p>Are you sure you want to <strong>reactivate</strong> the project <strong>{{ $project->title }}</strong>?</p>
                                        </div>

                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                          <button type="submit" class="btn btn-success">Reactivate</button>
                                        </div>
                                      </div>
                                    </form>
                                  </div>
                                </div>

                             
                                @elseif($project->status !== 'Closed')
                                {{-- Bouton de suppression --}}
                                <button class="btn btn-sm text-danger" data-toggle="modal" data-target="#deleteProjectModal{{ $project->id }}">
                                  <i class="fe fe-trash-2"></i>
                                </button>
                              @endif

                            <!-- Delete Modal -->
                            <div class="modal fade" id="deleteProjectModal{{ $project->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteProjectModalLabel" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                <form action="{{ route('projects.requestDelete', $project->id) }}" method="POST">
                                  @csrf
                                  <div class="modal-content">
                                    <div class="modal-header bg-danger text-white">
                                      <h5 class="modal-title text-white" id="deleteProjectModalLabel">Delete Project Request</h5>
                                      <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body">
                                      <p class="text-black h5">Why do you want to delete this project?</p>
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

                            @if($project->status === 'Completed')
                              <!-- Close button triggers modal -->
                              <button class="btn btn-sm text-danger" data-toggle="modal" data-target="#closeProjectModal{{ $project->id }}" title="Close Project">
                                  <i class="fe fe-lock"></i>
                              </button>
                              <!-- Modal -->
                              <div class="modal fade" id="closeProjectModal{{ $project->id }}" tabindex="-1" aria-labelledby="closeProjectModalLabel{{ $project->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                  <form method="POST" action="{{ route('projects.close', $project->id) }}">
                                    @csrf
                                    @method('PATCH')
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="closeProjectModalLabel{{ $project->id }}">Close Project</h5>
                                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                                      </div>
                                      <div class="modal-body">
                                        <div class="mb-3">
                                          <label for="close_comment_{{ $project->id }}" class="form-label">Add a comment</label>
                                          <textarea name="close_comment" class="form-control" id="close_comment_{{ $project->id }}" rows="3" placeholder="Enter a final comment before closing the project..."></textarea>
                                        </div>
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-danger">Close Project</button>
                                      </div>
                                    </div>
                                  </form>
                                </div>
                              </div>
                            @endif
                          </div>
                        </td>
                      </tr>

                    @if($hasImportantIssue)
                      <tr class="collapse" id="detailsRow{{ $project->id }}">
                          <td colspan="8" class="bg-light">
                             <table class="table table-sm mt-2">
                                <thead>
                                    <tr class="bg-light">
                                        <th class="text-maroon">Sub Phase / Development Detail</th>
                                        <th class="text-maroon">Status</th>
                                        <th class="text-maroon">Reason</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- Sous-phases problématiques --}}
                                    @foreach($project->subphases as $sub)
                                        @if(in_array($sub->pivot->status, ['Cancelled', 'Delayed']))
                                            @php
                                                $rowClass = $sub->pivot->status === 'Cancelled' ? 'bg-danger text-white' : 'bg-warning text-dark';
                                            @endphp
                                            <tr class="{{ $rowClass }}">
                                                <td><strong>{{ $sub->label ?? $sub->name }}</strong></td>
                                                <td>{{ $sub->pivot->status }}</td>
                                                <td>{{ !empty(trim($sub->pivot->reason)) ? $sub->pivot->reason : '—' }}</td>
                                            </tr>
                                        @endif
                                    @endforeach

                                    {{-- Development Details problématiques --}}
                                    @foreach($project->developmentDetails as $detail)
                                        @if(in_array($detail->status, ['Cancelled', 'Delayed']))
                                            @php
                                                $rowClass = $detail->status === 'Cancelled' ? 'bg-danger text-white' : 'bg-warning text-dark';
                                            @endphp
                                            <tr class="{{ $rowClass }}">
                                                <td>{{ $detail->title }}</td>
                                                <td>{{ $detail->status }}</td>
                                                <td>{{ !empty(trim($detail->reason)) ? $detail->reason : '—' }}</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>

                          </td>
                      </tr>
                    @endif


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
  <script>
    document.addEventListener("DOMContentLoaded", function () {
      var options = {
        chart: {
          type: 'bar',
          height: 400
        },
        plotOptions: {
          bar: {
            horizontal: false,
            columnWidth: '50%',
            endingShape: 'rounded'
          }
        },
        dataLabels: {
          enabled: false  // Désactivation de l'affichage sur les barres
        },
        stroke: {
          show: true,
          width: 2,
          colors: ['transparent']
        },
        series: [
          {
            name: 'ToR',
            data: [80, 100, 60]
          },
          {
            name: 'Procurement',
            data: [0, 90, 0]
          },
          {
            name: 'Implementation',
            data: [0, 70, 0]
          }
        ],
        xaxis: {
          categories: ['AHRM Communication', 'AfCFTA Library', 'AfCFTA DEAI Strategy'],
          title: {
            text: 'Projets'
          }
        },
        yaxis: {
          max: 100,
          title: {
            text: 'Pourcentage'
          }
        },
        fill: {
          opacity: 1
        },
        tooltip: {
          y: {
            formatter: function (val) {
              return val + "%";
            }
          }
        },
        legend: {
          position: 'top'
        }
      };

      var chart = new ApexCharts(document.querySelector("#phaseProgressChartVertical"), options);
      chart.render();
    });

  </script> 

</main>