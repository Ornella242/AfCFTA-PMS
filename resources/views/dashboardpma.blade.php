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

        @if($relatedProjects->isNotEmpty())
            {{-- Statistiques --}}
          
            <div class="row mb-4">
                <div class="col-md-3">
                    <div class="card stat-card text-white" style="background: linear-gradient(to right,#E0D1A6, #C3A466);">
                        <div class="card-body d-flex align-items-center justify-content-between">
                            <div>
                                <h6 class="text-uppercase">Not started</h6>
                                <h3 class="mb-0">{{ $counts['Not started'] }}</h3>
                            </div>
                            <i class="fas fa-hourglass-start fa-2x opacity-75"></i>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card stat-card text-white" style="background: linear-gradient(to right, #FAD58B, #F4A51F);">
                        <div class="card-body d-flex align-items-center justify-content-between">
                            <div>
                                <h6 class="text-uppercase">In progress</h6>
                                <h3 class="mb-0">{{ $counts['In progress'] }}</h3>
                            </div>
                            <i class="fas fa-tasks fa-2x opacity-75"></i>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card stat-card text-white" style="background: linear-gradient(to right, #70CA89, #299347);">
                        <div class="card-body d-flex align-items-center justify-content-between">
                            <div>
                                <h6 class="text-uppercase">Completed</h6>
                                <h3 class="mb-0">{{ $counts['Completed'] }}</h3>
                            </div>
                            <i class="fas fa-check-circle fa-2x opacity-75"></i>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card stat-card text-white" style="background: linear-gradient(to right, #D0627C, #9E2140);">
                        <div class="card-body d-flex align-items-center justify-content-between">
                            <div>
                                <h6 class="text-uppercase">Cancelled</h6>
                                <h3 class="mb-0">{{ $counts['Cancelled'] }}</h3>
                            </div>
                            <i class="fas fa-times-circle fa-2x opacity-75"></i>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Graphique des phases --}}
            <div class="card mb-4 shadow-sm">
                <div class="card-header bg-gold text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Projects You Are Involved In</h5>
                </div>
                <div class="card-body">
                    @if($relatedProjects->isEmpty())
                        <p class="text-muted">You are not assigned to any project yet.</p>
                    @else
                        <div class="table-responsive">
                              <table class="table table-hover table-borderless align-middle shadow-sm rounded">
                                <thead class="bg-green text-white">
                                    <tr>
                                        <th>Project Title</th>
                                        <th>Current Phase</th>
                                        <th>Status</th>
                                        <th>Project manager</th>
                                        <th style="width: 150px;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($relatedProjects as $project)
                                        @php
                                            $phaseColors = [
                                                'Not started' => 'badge bg-secondary text-white',
                                                'In progress' => 'badge bg-warning text-dark',
                                                'Completed' => 'badge bg-success text-white',
                                                'Cancelled' => 'badge bg-danger text-white',
                                                'Waiting Approval' => 'badge bg-info text-white',
                                                'Delayed' => 'badge bg-orange text-white',
                                                'Under review' => 'badge bg-primary text-white',
                                                'Closed'   => 'badge bg-dark text-white',
                                            ];
                                            $currentPhase = $project->phases
                                              ->where('status', 'In progress')
                                              ->sortByDesc('id') // ou 'created_at'
                                              ->first();
                                            $color = $phaseColors[$currentPhase] ?? 'badge bg-light text-dark';
                                        @endphp
                                        <tr>
                                            <td class="text-start">
                                                <i class="fas fa-folder-open text-muted me-2"></i> {{ $project->title }}
                                            </td>
                                            <td><span class="{{ $color }}">{{ $currentPhase }}</span></td>
                                            <td>
                                                <span class="p-2 badge rounded-pill 
                                                    @if($project->status === 'Completed') bg-green 
                                                    @elseif($project->status === 'Not started') bg-grey 
                                                    @elseif($project->status === 'In progress') bg-yellow text-dark
                                                    @elseif($project->status === 'Cancelled') bg-maroon
                                                    @else bg-secondary
                                                    @endif">
                                                    {{ $project->status }}
                                                </span>
                                            </td>
                                            <td>
                                               {{ $project->projectManager->firstname .' '. $project->projectManager->lastname?? 'N/A' }} 
                                            </td>
                                            <td>
                                                
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>



            {{-- Derniers projets --}}
            {{-- @include('partials.latest-projects', ['latestProjects' => $latestProjects]) --}}

            {{-- Liste Project Managers (optionnelle) --}}
            {{-- @include('partials.project-managers', ['projectManagers' => $projectManagers]) --}}

        @else
            {{-- Image par défaut si aucun projet --}}
            <div class="d-flex justify-content-center align-items-center" style="height: 400px;">
                <div class="text-center">
                    <img src="{{ asset('images/default.png') }}" alt="Dashboard Illustration" class="img-fluid" style="max-height: 250px;">
                    <p class="mt-3">No projects assigned yet. Please check back later.</p>
                </div>
            </div>
        @endif

    </div>
      @include('partials.footer')

</main>
 <!-- main -->
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
    window.addEventListener("load", function () {
        const loader = document.getElementById("loader-wrapper");
        if (loader) {
            loader.style.display = "none";
        }
    });
</script> --}}

<script>
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
</script>

