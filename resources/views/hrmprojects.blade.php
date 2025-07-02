@include('partials.navbar')
<main role="main" class="main-content">
        <div class="container-fluid">
          <div class="row justify-content-center">
            <div class="col-12">
              <div class="row align-items-center mb-4">
                <div class="col">
                    <h2 class="h3 mb-0 page-title text-maroon">Human Resources Managment Projects</h2>
                </div>
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

                  {{-- <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100 border-0 shadow-sm">
                      <div class="card-body">
                        <h6 class="text-black font-weight-bold mb-3">{{ $project->title }}</h6>
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
                  </div> --}}

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
                            <h6 class="text-black font-weight-bold mb-3">{{ $project->title }}</h6>
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