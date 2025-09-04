@php
    $colors = ['#4a4a8d', '#4a8d5c', '#8d4a4a', '#4a8d89', '#8d854a', '#6b4a8d'];
       $gradients = [
        'linear-gradient(to right, #6a11cb, #2575fc)', // Violet → Bleu
        'linear-gradient(to right, #ff6a00, #ee0979)', // Orange → Rose
        'linear-gradient(to right, #43e97b, #38f9d7)', // Vert → Turquoise
        'linear-gradient(to right, #f7971e, #ffd200)', // Orange vif → Jaune
        'linear-gradient(to right, #8E2DE2, #4A00E0)', // Violet profond
        'linear-gradient(to right, #56CCF2, #2F80ED)', // Bleu clair → foncé
    ];
@endphp


@include('partials.navbar')
<main role="main" class="main-content">
        <div class="container-fluid">
          <div class="row justify-content-center">
            <div class="col-12">
              {{-- <div class="row">
                <div class="col-md-6 col-xl-3 mb-4">
                  <div class="card shadow bg-gold text-white border-0">
                    <div class="card-body">
                      <div class="row align-items-center">
                        <div class="col-3 text-center">
                          <span class="circle circle-sm bg-gold-light">
                            <i class="fe fe-16 fe-clock text-white mb-0"></i>
                          </span>
                        </div>
                        <div class="col pr-0">
                          <p class="h5 text-white mb-0">{{ $counts['Not started'] ?? 0 }} Not Started</p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-md-6 col-xl-3 mb-4">
                  <div class="card shadow bg-yellow text-white border-0">
                    <div class="card-body">
                      <div class="row align-items-center">
                        <div class="col-3 text-center">
                          <span class="circle circle-sm bg-yellow-light">
                            <i class="fe fe-16 fe-refresh-cw text-white mb-0"></i>
                          </span>
                        </div>
                        <div class="col pr-0">
                          <p class="h5 text-white mb-0">{{ $counts['In progress'] ?? 0 }} In Progress</p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-md-6 col-xl-3 mb-4">
                  <div class="card shadow bg-green text-white border-0">
                    <div class="card-body">
                      <div class="row align-items-center">
                        <div class="col-3 text-center">
                          <span class="circle circle-sm bg-green-light">
                            <i class="fe fe-16 fe-check-circle text-white mb-0"></i>
                          </span>
                        </div>
                        <div class="col pr-0">
                          <p class="h5 text-white mb-0">{{ $counts['Completed'] ?? 0 }} Completed</p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-md-6 col-xl-3 mb-4">
                  <div class="card shadow bg-maroon text-white border-0">
                    <div class="card-body">
                      <div class="row align-items-center">
                        <div class="col-3 text-center">
                          <span class="circle circle-sm bg-maroon-light">
                            <i class="fe fe-16 fe-x-circle text-white mb-0"></i>
                          </span>
                        </div>
                        <div class="col pr-0">
                          <p class="h5 text-white mb-0">{{ $counts['Cancelled'] ?? 0 }} Cancelled</p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div> --}}
              <div class="row">
                @if(session('success'))
                   <div class="alert alert-success alert-dismissible fade show" role="alert">
                       {{ session('success') }}
                       <button type="button" class="close" data-dismiss="alert" aria-label="Fermer">
                           <span aria-hidden="true">&times;</span>
                       </button>
                   </div>
               @endif
              </div>
              <div class="row">
                @php
                  $statuses = [
                    ['label' => 'Not started', 'color' => '#C3A466', 'icon' => 'clock'],
                    ['label' => 'In progress', 'color' => '#F4A51F', 'icon' => 'refresh-cw'],
                    ['label' => 'Completed', 'color' => '#299347', 'icon' => 'check-circle'],
                    ['label' => 'Cancelled', 'color' => '#9E2140', 'icon' => 'x-circle'],
                  ];
                @endphp

                @foreach ($statuses as $status)
                  <div class="col-md-6 col-xl-3 mb-4">
                    <div class="card status-box border-0" style="background: {{ $status['color'] }};">
                      <div class="card-body d-flex align-items-center justify-content-between">
                        <div class="icon-circle d-flex align-items-center justify-content-center" style="background: rgba(255,255,255,0.15);">
                          <i class="fe fe-24 fe-{{ $status['icon'] }} text-white"></i>
                        </div>
                        <div class="text-end text-white ms-3">
                          <div class="h4 mb-0 fw-bold text-white">
                            {{ $counts[$status['label']] ?? 0 }} P
                          </div>
                          <div class="small text-uppercase fw-semibold">{{ $status['label'] }}</div>
                        </div>
                      </div>
                    </div>
                  </div>
                @endforeach
              </div>
              @php
                  $user = auth()->user();
                  $isAdmin = $user->role?->name === 'Admin';
              @endphp
              @if ($isAdmin)
                  <div class="row">
                    <div class="my-5 col-12">
                      <h3 class="mb-4 text-maroon font-weight-bold">
                        <i class="fe fe-bar-chart-2 mr-2"></i>Project Distribution by Manager
                      </h3>
                      <div class="card shadow-sm border-0 p-4">
                        <div id="managerProjectsChart"></div>
                      </div>
                      <div class="mt-5">
                        <h4 class="mb-3 text-black font-weight-bold">
                          <i class="fe fe-users mr-2"></i> Project Manager Overview
                        </h4>

                        <div class="table-responsive">
                            <table class="table table-hover align-middle shadow-sm rounded overflow-hidden">
                              <thead class="bg-maroon text-white">
                                <tr>
                                  <th class="p-3">Manager</th>
                                  <th class="text-center p-3">Projects</th>
                                  <th class="p-3">Average Progress</th>
                                </tr>
                              </thead>
                              <tbody>
                                @foreach ($projectManagers as $manager)
                                  <tr data-toggle="modal" data-target="#managerModal{{ $manager->id }}" style="cursor: pointer; transition: all .3s;"
                                      onmouseover="this.style.backgroundColor='#fdf2f2'" onmouseout="this.style.backgroundColor=''">
                                    <td class="font-weight-bold">
                                      <img src="{{ asset('images/icons/user.png') }}" alt="Dashboard" class="icon-img" style="width:20px; height:20px;">
                                      {{ $manager->firstname }} {{ $manager->lastname }}
                                    </td>
                                    <td class="text-center">
                                      <span class="badge badge-pill badge-dark px-3 py-2 shadow-sm text-white">
                                        {{ $manager->managed_projects_count }}
                                      </span>
                                    </td>
                                    <td style="min-width: 280px;">
                                      <div class="progress shadow-sm" style="height: 22px; border-radius: 12px; overflow: hidden;">
                                        <div class="progress-bar progress-bar-striped progress-bar-animated {{ $manager->bar_class }}"
                                            style="width: {{ $manager->average_progress }}%; border-radius: 12px;">
                                          {{ $manager->average_progress }}%
                                        </div>
                                      </div>
                                    </td>
                                  </tr>
                                @endforeach
                              </tbody>
                            </table>
                          </div>
                          @foreach ($projectManagers as $manager)
                            <div class="modal fade" id="managerModal{{ $manager->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="managerModalLabel{{ $manager->id }}" aria-hidden="true">
                              <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                <div class="modal-content border-0 shadow-lg rounded-lg">
                                  <div class="modal-header bg-maroon text-white">
                                    <h5 class="modal-title text-white" id="managerModalLabel{{ $manager->id }}">
                                      <i class="fe fe-folder mr-2"></i> Projects of {{ $manager->firstname }} {{ $manager->lastname }}
                                    </h5>
                                    <button type="button" class="close text-white" data-dismiss="modal"><span>&times;</span></button>
                                  </div>
                                  <div class="modal-body p-4">
                                    @forelse ($manager->managedProjects as $project)
                                      @php
                                        $barClass = 'bg-success';
                                        if ($project->percentage < 40) $barClass = 'bg-danger';
                                        elseif ($project->percentage < 70) $barClass = 'bg-warning';
                                      @endphp

                                      <div class="mb-4 p-3 border rounded shadow-sm bg-light">
                                        <div class="d-flex justify-content-between align-items-center mb-1">
                                          <strong class="text-maroon">{{ $project->title }}</strong>
                                          <small class="font-weight-bold {{ $barClass == 'bg-danger' ? 'text-danger' : ($barClass == 'bg-warning' ? 'text-warning' : 'text-success') }}">
                                            {{ $project->percentage }}%
                                          </small>
                                        </div>
                                        <div class="progress" style="height: 14px; border-radius: 7px;">
                                          <div class="progress-bar {{ $barClass }} progress-bar-striped progress-bar-animated"
                                              role="progressbar"
                                              style="width: {{ $project->percentage }}%;"
                                              aria-valuenow="{{ $project->percentage }}" aria-valuemin="0" aria-valuemax="100">
                                          </div>
                                        </div>
                                      </div>
                                    @empty
                                      <div class="alert alert-secondary text-center">No projects assigned</div>
                                    @endforelse
                                  </div>
                                </div>
                              </div>
                            </div>
                          @endforeach
                        </div>
                      </div>
                    </div>
                  </div>
              @endif

              <div class="row">
                <!-- Recent projects -->
                <div class="col-md-12">
                  <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="h4 mb-0">Latest Projects</h6>

                    <div class="dropdown">
                      <button class="btn btn-outline-green btn-sm dropdown-toggle" type="button" id="viewProjectsDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fe fe-filter mr-1"></i> View
                      </button>
                      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="viewProjectsDropdown">
                        <a class="dropdown-item" href="{{ route('allprojects') }}">All Projects</a>
                        <a class="dropdown-item" href="{{ route('projects.hrm') }}">HRM Projects</a>
                        <a class="dropdown-item" href="{{ route('projects.admin') }}">Admin Projects</a>
                      </div>
                    </div>
                  </div>
                  <table class="table table-hover table-borderless align-middle shadow-sm rounded">
                    <thead class="bg-green text-white">
                      <tr class="text-uppercase">
                        <th>ID</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Budget</th>
                        <th>Partner</th>
                        <th>Start</th>
                        <th>End</th>
                        <th>Priority</th>
                      </tr>
                    </thead>
                    <tbody class="text-black font-weight-bold size-7">
                      @foreach ($latestProjects as $project)
                        <tr>
                          <td>{{ str_pad($project->id, 4, '0', STR_PAD_LEFT) }}</td>
                          <td>{{ $project->title }}</td>
                          <td>{{ $project->type }}</td>
                          <td>${{ number_format($project->budget, 0, '.', ',') }}</td>
                          <td>
                            {{ $project->partners->pluck('name')->join(', ') ?: '-' }}
                          </td>
                          <td>{{ \Carbon\Carbon::parse($project->start_date)->format('d-m-Y') }}</td>
                          <td>{{ \Carbon\Carbon::parse($project->end_date)->format('d-m-Y') }}</td>
                          @php
                            $priority = strtolower($project->priority);
                            $priorityClass = match($priority) {
                                'high' => 'badge-danger',
                                'medium' => 'badge-warning text-dark',
                                'low' => 'badge-info',
                                default => 'badge-secondary',
                            };

                            $priorityIcon = match($priority) {
                                'high' => 'fe-arrow-up-circle',
                                'medium' => 'fe-minus-circle',
                                'low' => 'fe-arrow-down-circle',
                                default => 'fe-circle',
                            };
                          @endphp

                          <td>
                            <span class="badge  p-2 badge-pill {{ $priorityClass }}">
                              <i class="fe {{ $priorityIcon }} mr-1"></i> {{ ucfirst($priority) }}
                            </span>
                          </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div> <!-- / .col-md-3 -->
              </div> <!-- end section -->
            </div>
          </div> <!-- .row -->
        </div> <!-- .container-fluid -->
       
        @include('partials.footer')
</main> <!-- main -->
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


{{-- <script>
  document.addEventListener("DOMContentLoaded", function () {
    const managerNames = @json($projectManagers->map(fn($m) => $m->firstname));
    const projectCounts = @json($projectManagers->pluck('managed_projects_count'));

    const gradientColors = [
      "#9E2140", "#299347", "#F4A51F", "#C3A466", "#299347", "#9E2140"    ];

    const options = {
      chart: {
        type: 'bar',
        height: 400,
        toolbar: { show: true }
      },
      series: [{
        name: 'Projects',
        data: projectCounts
      }],
      xaxis: {
        categories: managerNames,
        labels: {
          rotate: -45,
          style: {
            colors: '#555',
            fontSize: '14px'
          }
        },
       
      },
      yaxis: {
        title: {
          text: 'Number of Projects',
          style: { fontWeight: 600, fontSize: '18px' }
        }
      },
      plotOptions: {
        bar: {
          distributed: true,
          borderRadius: 8,
          columnWidth: '45%',
          endingShape: 'rounded'
        }
      },
      colors: gradientColors.slice(0, managerNames.length),
      dataLabels: {
        enabled: true,
        style: {
          fontSize: '13px',
          colors: ['#fff']
        }
      },
      tooltip: {
        theme: 'light',
        y: {
          formatter: val => `${val} project${val > 1 ? 's' : ''}`
        }
      },
      grid: {
        borderColor: '#e0e0e0',
        strokeDashArray: 4
      },
      legend: { show: false }
    };

    new ApexCharts(document.querySelector("#managerProjectsChart"), options).render();
  });
</script> --}}

<script>
  document.addEventListener("DOMContentLoaded", function () {
    const chartEl = document.querySelector("#managerProjectsChart");

    const options = {
      chart: {
        type: 'bar',
        height: 400,
        toolbar: { show: true }
      },
      series: [{ name: 'Projects', data: [] }],
      xaxis: { categories: [] },
      plotOptions: {
        bar: {
          distributed: true,
          borderRadius: 8,
          columnWidth: '45%',
          endingShape: 'rounded'
        }
      },
      dataLabels: {
        enabled: true,
        style: { fontSize: '13px', colors: ['#fff'] }
      },
      colors: ["#9E2140", "#299347", "#F4A51F", "#C3A466"],
      tooltip: {
        theme: 'light',
        y: { formatter: val => `${val} project${val > 1 ? 's' : ''}` }
      },
      grid: {
        borderColor: '#e0e0e0',
        strokeDashArray: 4
      },
      legend: { show: false }
    };

    const chart = new ApexCharts(chartEl, options);
    chart.render();

    // Fonction pour charger les données
    function fetchData() {
      fetch("/charts/project-managers")
        .then(res => res.json())
        .then(data => {
          chart.updateOptions({
            xaxis: { categories: data.managers },
            colors: ["#9E2140", "#299347", "#F4A51F", "#C3A466"].slice(0, data.managers.length)
          });
          chart.updateSeries([{ data: data.counts }]);
        });
    }

    fetchData(); // première fois
    setInterval(fetchData, 10000); // refresh toutes les 10 secondes
  });
</script>


