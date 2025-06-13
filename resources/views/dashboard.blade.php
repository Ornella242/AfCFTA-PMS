@include('partials.navbar')
<main role="main" class="main-content">
        <div class="container-fluid">
          <div class="row justify-content-center">
            <div class="col-12">
              <div class="row">
                <div class="col-md-6 col-xl-3 mb-4">
                  <div class="card shadow bg-maroon text-white border-0">
                    <div class="card-body">
                      <div class="row align-items-center">
                        <div class="col-3 text-center">
                          <span class="circle circle-sm bg-maroon-light">
                            <i class="fe fe-16 fe-check-circle text-white mb-0"></i>
                          </span>
                        </div>
                        <div class="col pr-0">
                          <p class="h5 text-bold text-white mb-0">12 Completed</p>
                          {{-- <span class="h3 mb-0 text-white">12</span> --}}
                          <span class="small text-white">in the last 7days</span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 col-xl-3 mb-4">
                  <div class="card shadow border-0 bg-green">
                    <div class="card-body">
                      <div class="row align-items-center">
                        <div class="col-3 text-center">
                          <span class="circle circle-sm bg-green-light">
                            <i class="fe fe-16 fe-edit text-white mb-0"></i>
                          </span>
                        </div>
                        <div class="col pr-0">
                          <p class="h5 text-white mb-0">34 Updated</p>
                          {{-- <span class="h3 mb-0">2</span> --}}
                          <span class="small text-white">in the last 7 days</span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 col-xl-3 mb-4">
                  <div class="card shadow border-0">
                    <div class="card shadow border-0 card-body bg-yellow">
                      <div class="row align-items-center">
                        <div class="col-3 text-center">
                          <span class="circle circle-sm bg-yellow-light">
                            <i class="fe fe-16 fe-file-plus text-white mb-0"></i>
                          </span>
                        </div>
                        <div class="col">
                          <p class="h5 text-white mb-0">34 Created</p>
                          <div class="row align-items-center no-gutters">
                            <div class="col-auto">
                              <span class="small text-white">in the last 7 days</span>
                            </div>
                          
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 col-xl-3 mb-4">
                  <div class="card shadow border-0">
                    <div class="card shadow border-0 card-body bg-gold">
                      <div class="row align-items-center">
                        <div class="col-3 text-center">
                          <span class="circle circle-sm bg-gold-light">
                            <i class="fe fe-16 fe-calendar text-white mb-0"></i>
                          </span>
                        </div>
                        <div class="col">
                          <p class="h5 text-white mb-0">1 non started</p>
                              <span class="small text-white">in the next 7 days</span>                          
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div> <!-- end section -->
            
              <!-- info small box -->
              <div class="row">               
                <div class="col-md-12">
                  <div class="card shadow mb-4">
                    <div class="card-body">
                      <div class="card-title">
                        <strong>Projects</strong>
                        <a class="float-right small text-muted" href="{{ url('/allprojects') }}">View all</a>
                      </div>
                      <div class="row">
                        {{-- <div class="col-md-12">
                          <div id="chart-box">
                            <div id="donutChartWidget"></div>
                          </div>
                        </div> --}}
                        <div class="col-md-12">
                          <div id="phaseProgressChartVertical"></div>
                        </div>

                        <div class="col-md-12">
                          <div class="row align-items-center my-3">
                            <div class="col">
                              <strong>AfCFTA Career Development Plan</strong>
                            </div>
                            <div class="col-auto">
                              <strong>+85%</strong>
                            </div>
                            <div class="col-3">
                              <div class="progress" style="height: 4px;">
                                <div class="progress-bar" role="progressbar" style="width: 85%" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                            </div>
                          </div>
                          <div class="row align-items-center my-3">
                            <div class="col">
                              <strong>AfCFTA DEAI Strategy</strong>
                            </div>
                            <div class="col-auto">
                              <strong>+75%</strong>
                            </div>
                            <div class="col-3">
                              <div class="progress" style="height: 4px;">
                                <div class="progress-bar" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                            </div>
                          </div>
                          <div class="row align-items-center my-3">
                            <div class="col">
                              <strong>AHRM Communication</strong>
                            </div>
                            <div class="col-auto">
                              <strong>+62%</strong>
                            </div>
                            <div class="col-3">
                              <div class="progress" style="height: 4px;">
                                <div class="progress-bar" role="progressbar" style="width: 62%" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                            </div>
                          </div>
                           <div class="row align-items-center my-3">
                            <div class="col">
                              <strong>AfCFTA Library</strong>
                            </div>
                            <div class="col-auto">
                              <strong>+50%</strong>
                            </div>
                            <div class="col-3">
                              <div class="progress" style="height: 4px;">
                                <div class="progress-bar" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                            </div>
                          </div>
                        </div> <!-- .col-md-12 -->
                      </div> <!-- .row -->
                    </div> <!-- .card-body -->
                  </div> <!-- .card -->
                </div> <!-- .col-md -->
                {{-- <div class="col-md-6">
                  
                  <div class="card timeline shadow">
                    <div class="card-header">
                      <strong class="card-title">Recent Activity</strong>
                      <a class="float-right small text-muted" href="{{ url('/logs') }}">View all</a>
                    </div>
                    <div class="card-body" data-simplebar style="height:355px; overflow-y: auto; overflow-x: hidden;">
                      <h6 class="text-uppercase text-muted mb-4">Today</h6>
                      <div class="pb-3 timeline-item item-primary">
                        <div class="pl-5">
                          <div class="mb-1"><strong>@Brown Asher</strong><span class="text-muted small mx-2">Just create new project in</span><strong>Admin Category</strong></div>
                          <p class="small text-muted">FM Development <span class="badge badge-light">1h ago</span>
                          </p>
                        </div>
                      </div>
                      <div class="pb-3 timeline-item item-warning">
                        <div class="pl-5">
                          <div class="mb-1"><strong>@Brown Asher</strong><span class="text-muted small mx-2">Just create new project in</span><strong>HRM Projects Category</strong></div>
                          <p class="small text-muted">AHRMD SOP and manual<span class="badge badge-light">1h ago</span>
                          </p>
                        </div>
                      </div>
                       <div class="pb-3 timeline-item item-success">
                        <div class="pl-5">
                          <div class="mb-1"><strong>@Brown Asher</strong><span class="text-muted small mx-2">Just create a new project in </span><strong>Admin Projects Category</strong></div>
                          <p class="small text-muted">AfCFTA Disaster readeness<span class="badge badge-light">1h ago</span>
                          </p>
                        </div>
                      </div>
                      <h6 class="text-uppercase text-muted mb-4">Yesterday</h6>
                      <div class="pb-3 timeline-item item-warning">
                        <div class="pl-5">
                          <div class="mb-3"><strong>@Fletcher Everett</strong><span class="text-muted small mx-2">created a new project in </span><strong>HRM</strong></div>
                          <p class="small text-muted">AfCFTA Organizational Culture <span class="badge badge-light">1h ago</span>
                          </p>
                        </div>
                      </div>
                      
                  </div> <!-- / .card-body -->
                  </div> <!-- / .card -->
                
                </div> <!-- .col --> --}}
              </div> <!-- / .row -->
              <div class="row">
                <!-- Recent projects -->
                <div class="col-md-12">
                  <h6 class="h5 mb-3">Latest Projects</h6>
                  <table class="table table-borderless table-striped">
                    <thead>
                      <tr role="row">
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
                    <tbody>
                      <tr>
                        <th scope="col">0008</th>
                        <td>AfCFTA Recruitment </td>
                        <td>HRM</td>
                        <td>60,000$</td>
                        <td>AfDB</td>
                        <td>10-06-2024</td>
                        <td>10-06-2027</td>
                        <td>High</td>
                        <td>
                          <div class="dropdown">
                            <button class="btn btn-sm dropdown-toggle more-vertical" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <span class="text-muted sr-only">Action</span>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                              <a class="dropdown-item" href="#">Edit</a>
                              <a class="dropdown-item" href="#">Remove</a>
                              <a class="dropdown-item" href="#">Assign</a>
                            </div>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <th scope="col">0007</th>
                        <td>AfCFTA DEAI Strategy</td>
                        <td>HRM</td>
                        <td>50,000$</td>
                        <td>AfDB</td>
                        <td>10-06-2024</td>
                        <td>10-06-2027</td>
                        <td>High</td>
                        <td>
                          <div class="dropdown">
                            <button class="btn btn-sm dropdown-toggle more-vertical" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <span class="text-muted sr-only">Action</span>
                            </button> 
                            <div class="dropdown-menu dropdown-menu-right">
                              <a class="dropdown-item" href="#">Edit</a>
                              <a class="dropdown-item" href="#">Remove</a>
                              <a class="dropdown-item" href="#">Assign</a>  
                          </div>
                        </td> 
                      </tr>  
                      <tr>
                        <th scope="col">0008</th>
                        <td>AfCFTA Recruitment </td>
                        <td>HRM</td>
                        <td>60,000$</td>
                        <td>AfDB</td>
                        <td>10-06-2024</td>
                        <td>10-06-2027</td>
                        <td>High</td>
                        <td>
                          <div class="dropdown">
                            <button class="btn btn-sm dropdown-toggle more-vertical" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <span class="text-muted sr-only">Action</span>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                              <a class="dropdown-item" href="#">Edit</a>
                              <a class="dropdown-item" href="#">Remove</a>
                              <a class="dropdown-item" href="#">Assign</a>
                            </div>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <th scope="col">0007</th>
                        <td>AfCFTA DEAI Strategy</td>
                        <td>HRM</td>
                        <td>50,000$</td>
                        <td>AfDB</td>
                        <td>10-06-2024</td>
                        <td>10-06-2027</td>
                        <td>High</td>
                        <td>
                          <div class="dropdown">
                            <button class="btn btn-sm dropdown-toggle more-vertical" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <span class="text-muted sr-only">Action</span>
                            </button> 
                            <div class="dropdown-menu dropdown-menu-right">
                              <a class="dropdown-item" href="#">Edit</a>
                              <a class="dropdown-item" href="#">Remove</a>
                              <a class="dropdown-item" href="#">Assign</a>  
                          </div>
                        </td> 
                      </tr>  
                      <tr>
                        <th scope="col">0008</th>
                        <td>AfCFTA Recruitment </td>
                        <td>HRM</td>
                        <td>60,000$</td>
                        <td>AfDB</td>
                        <td>10-06-2024</td>
                        <td>10-06-2027</td>
                        <td>High</td>
                        <td>
                          <div class="dropdown">
                            <button class="btn btn-sm dropdown-toggle more-vertical" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <span class="text-muted sr-only">Action</span>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                              <a class="dropdown-item" href="#">Edit</a>
                              <a class="dropdown-item" href="#">Remove</a>
                              <a class="dropdown-item" href="#">Assign</a>
                            </div>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <th scope="col">0007</th>
                        <td>AfCFTA DEAI Strategy</td>
                        <td>HRM</td>
                        <td>50,000$</td>
                        <td>AfDB</td>
                        <td>10-06-2024</td>
                        <td>10-06-2027</td>
                        <td>High</td>
                        <td>
                          <div class="dropdown">
                            <button class="btn btn-sm dropdown-toggle more-vertical" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <span class="text-muted sr-only">Action</span>
                            </button> 
                            <div class="dropdown-menu dropdown-menu-right">
                              <a class="dropdown-item" href="#">Edit</a>
                              <a class="dropdown-item" href="#">Remove</a>
                              <a class="dropdown-item" href="#">Assign</a>  
                          </div>
                        </td> 
                      </tr>   
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



 