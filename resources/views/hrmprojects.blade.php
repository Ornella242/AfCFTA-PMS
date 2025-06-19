@include('partials.navbar')
<main role="main" class="main-content">
        <div class="container-fluid">
          <div class="row justify-content-center">
            <div class="col-12">
              <div class="row align-items-center mb-4">
                <div class="col">
                    <h2 class="h3 mb-0 page-title">HRM Projects</h2>
                </div>
              </div>
              <div class="row align-items-center my-4">
                <div class="col-md-6">
                    <div id="phaseProgressChartVertical"></div>
                </div>
               <div class="col-md-6">
                  <div class="row align-items-center my-2">
                    <div class="col">
                      <strong class="text-green">Completed</strong><br / />
                      <span class="my-0 medium">85%</span>
                    </div>
                    <div class="col-auto">
                      <strong class="my-0">1200</strong>
                    </div>
                    <div class="col-3">
                      <div class="progress" style="height: 4px;">
                        <div class="progress-bar bg-success" role="progressbar" style="width: 85%" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                    </div>
                  </div>
                  <div class="row align-items-center my-2">
                    <div class="col">
                      <strong class="text-yellow">Processing</strong><br / />
                      <span class="my-0 medium">60%</span>
                    </div>
                    <div class="col-auto">
                      <strong>80</strong>
                    </div>
                    <div class="col-3">
                      <div class="progress" style="height: 4px;">
                        <div class="progress-bar bg-yellow" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                    </div>
                  </div>
                  <div class="row align-items-center my-2">
                    <div class="col">
                      <strong class="text-gold">Assigned</strong>
                      <div class="my-0 medium">2%</div>
                    </div>
                    <div class="col-auto">
                      <strong>262</strong>
                    </div>
                    <div class="col-3">
                      <div class="progress" style="height: 4px;">
                        <div class="progress-bar bg-gold" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                    </div>
                  </div>
                  <div class="row align-items-center my-2">
                    <div class="col">
                      <strong class="text-maroon">Pending</strong>
                      <div class="my-0 medium">6%</div>
                    </div>
                    <div class="col-auto">
                      <strong>26</strong>
                    </div>
                    <div class="col-3">
                      <div class="progress" style="height: 4px;">
                        <div class="progress-bar bg-maroon" role="progressbar" style="width: 2%" aria-valuenow="2" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                    </div>
                  </div>
                </div> <!-- .col-md-12 -->
              </div> <!-- .row -->
              <div class="row items-align-center my-4  d-none d-lg-flex">
                <div class="col-md">
                  <ul class="nav nav-pills justify-content-start">
                    <li class="nav-item">
                      <a class="nav-link active bg-transparent pr-2 pl-0 text-primary" href="#">All <span class="badge badge-pill bg-gold text-white pb-2 pt-2 ml-2">06</span></a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link text-muted px-2" href="#">Pending <span class="badge badge-pill bg-maroon border text-white pb-2 pt-2 ml-2">02</span></a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link text-muted px-2" href="#">Processing <span class="badge badge-pill bg-yellow border text-white pb-2 pt-2 ml-2">01</span></a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link text-muted px-2" href="#">Completed <span class="badge badge-pill bg-green border text-white pb-2 pt-2 ml-2">03</span></a>
                    </li>
                  </ul>
                </div>
                <div class="col-md-auto ml-auto text-right">
                  <span class="small bg-white border py-1 px-2 rounded mr-2">
                    <a href="#" class="text-muted"><i class="fe fe-x mx-1"></i></a>
                    <span class="text-muted">Status : <strong>Pending</strong></span>
                  </span>
                  <button type="button" class="btn" data-toggle="modal" data-target=".modal-slide"><span class="fe fe-filter fe-16 text-muted"></span></button>
                  <button type="button" class="btn"><span class="fe fe-refresh-ccw fe-16 text-muted"></span></button>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <!-- table -->
                <table class="table table-borderless table-striped">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th></th>
                      <th>Title</th>
                      <th>Create At</th>
                      <th>Budget</th>
                      <th>Budget</th>
                      <th>Partner</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <!-- Ligne 1 -->
                    <tr data-toggle="collapse" data-target="#detailsRow1" class="clickable">
                      <td class="text-white small bg-yellow">0001</td>
                      <td class="text-center"><span class="dot dot-lg bg-secondary mr-2"></span></td>
                      <th scope="col">AfCFTA Career Development Plan</th>
                      <td class="medium">Jun 02, 2025</td>
                      <td class="medium">0$</td>
                      <td class="medium">No Partner</td>
                      <td>
                        <span class="medium">Completed</span>
                        <div class="progress mt-2" style="height: 3px;">
                          <div class="progress-bar bg-success" style="width: 100%"></div>
                        </div>
                      </td>
                      <td class="text-center">
                            <!-- Edit -->
                            <a href="#" class="text-primary mr-2 text-decoration-none" title="Edit">
                              <i class="fe fe-edit-2"></i>
                            </a>
                            <!-- View -->
                            <a href="#" class="text-info mr-2 text-decoration-none" title="View">
                              <i class="fe fe-eye"></i>
                            </a>
                            <!-- Remove -->
                            <a href="#" class="text-danger mr-2 text-decoration-none" title="Remove">
                              <i class="fe fe-trash-2"></i>
                            </a>
                            <!-- Assign -->
                            <a href="#" class="text-warning text-decoration-none" title="Assign">
                              <i class="fe fe-user-plus"></i>
                            </a>
                          </td>
                    </tr>
                    <tr class="collapse" id="detailsRow1">
                      <td colspan="8" class="bg-light">
                        <table class="table table-sm mt-2">
                          <thead><tr><th class="text-maroon">Sub Phase</th><th class="text-maroon">Reason</th></tr></thead>
                          <tbody>
                            <tr><td class="text-md">None</td><td>All tasks completed</td></tr>
                          </tbody>
                        </table>
                      </td>
                    </tr>

                    <!-- Ligne 2 -->
                    <tr data-toggle="collapse" data-target="#detailsRow2" class="clickable">
                      <td class="text-muted small">0002</td>
                      <td class="text-center"><span class="dot dot-lg bg-danger mr-2"></span></td>
                      <th scope="col">AfCFTA DEAI Strategy</th>
                      <td class="medium">May 4, 2025</td>
                      <td class="medium">15,000$</td>
                      <td class="medium">MS-3</td>
                      <td>
                        <span class="medium">Completed</span>
                        <div class="progress mt-2" style="height: 3px;">
                          <div class="progress-bar bg-success" style="width: 50%"></div>
                        </div>
                      </td>
                      <td class="text-center">
                            <!-- Edit -->
                            <a href="#" class="text-primary mr-2 text-decoration-none" title="Edit">
                              <i class="fe fe-edit-2"></i>
                            </a>
                            <!-- View -->
                            <a href="#" class="text-info mr-2 text-decoration-none" title="View">
                              <i class="fe fe-eye"></i>
                            </a>
                            <!-- Remove -->
                            <a href="#" class="text-danger mr-2 text-decoration-none" title="Remove">
                              <i class="fe fe-trash-2"></i>
                            </a>
                            <!-- Assign -->
                            <a href="#" class="text-warning text-decoration-none" title="Assign">
                              <i class="fe fe-user-plus"></i>
                            </a>
                          </td>
                    </tr>
                    <tr class="collapse" id="detailsRow2">
                      <td colspan="8" class="bg-light">
                        <table class="table table-sm mt-2">
                          <thead><tr><th class="text-maroon">Sub Phase</th><th class="text-maroon">Reason</th></tr></thead>
                          <tbody>
                            <tr><td class="text-md">None</td><td>All tasks completed</td></tr>
                          </tbody>
                        </table>
                      </td>
                    </tr>

                    <!-- Ligne 3 -->
                    <tr data-toggle="collapse" data-target="#detailsRow3" class="clickable">
                      <td class="text-white small bg-green">0003</td>
                      <td class="text-center"><span class="dot dot-lg bg-success mr-2"></span></td>
                      <th scope="col">AfCFTA Organizational Culture</th>
                      <td class="medium">May 4, 2025</td>
                      <td class="medium">15,000$</td>
                      <td class="medium">MS-3</td>
                      <td>
                        <span class="medium">Completed</span>
                        <div class="progress mt-2" style="height: 3px;">
                          <div class="progress-bar bg-success" style="width: 50%"></div>
                        </div>
                      </td>
                      <td class="text-center">
                            <!-- Edit -->
                            <a href="#" class="text-primary mr-2 text-decoration-none" title="Edit">
                              <i class="fe fe-edit-2"></i>
                            </a>
                            <!-- View -->
                            <a href="#" class="text-info mr-2 text-decoration-none" title="View">
                              <i class="fe fe-eye"></i>
                            </a>
                            <!-- Remove -->
                            <a href="#" class="text-danger mr-2 text-decoration-none" title="Remove">
                              <i class="fe fe-trash-2"></i>
                            </a>
                            <!-- Assign -->
                            <a href="#" class="text-warning text-decoration-none" title="Assign">
                              <i class="fe fe-user-plus"></i>
                            </a>
                          </td>
                    </tr>
                    <tr class="collapse" id="detailsRow3">
                      <td colspan="8" class="bg-light">
                        <table class="table table-sm mt-2">
                          <thead><tr><th class="text-maroon">Sub Phase</th><th class="text-maroon">Reason</th></tr></thead>
                          <tbody>
                            <tr><td class="text-md">None</td><td>All tasks completed</td></tr>
                          </tbody>
                        </table>
                      </td>
                    </tr>

                    <!-- Ligne 4 -->
                    <tr data-toggle="collapse" data-target="#detailsRow4" class="clickable">
                      <td class="text-muted small">0004</td>
                      <td class="text-center"><span class="dot dot-lg bg-success mr-2"></span></td>
                      <th scope="col">AfCFTA Recruitment</th>
                      <td class="medium">May 4, 2025</td>
                      <td class="medium">15,000$</td>
                      <td class="medium">MS-3</td>
                      <td>
                        <span class="medium">Completed</span>
                        <div class="progress mt-2" style="height: 3px;">
                          <div class="progress-bar bg-success" style="width: 50%"></div>
                        </div>
                      </td>
                    <td class="text-center">
                            <!-- Edit -->
                            <a href="#" class="text-primary mr-2 text-decoration-none" title="Edit">
                              <i class="fe fe-edit-2"></i>
                            </a>
                            <!-- View -->
                            <a href="#" class="text-info mr-2 text-decoration-none" title="View">
                              <i class="fe fe-eye"></i>
                            </a>
                            <!-- Remove -->
                            <a href="#" class="text-danger mr-2 text-decoration-none" title="Remove">
                              <i class="fe fe-trash-2"></i>
                            </a>
                            <!-- Assign -->
                            <a href="#" class="text-warning text-decoration-none" title="Assign">
                              <i class="fe fe-user-plus"></i>
                            </a>
                          </td>
                    </tr>
                    <tr class="collapse" id="detailsRow4">
                      <td colspan="8" class="bg-light">
                        <table class="table table-sm mt-2">
                          <thead><tr><th class="text-maroon">Sub Phase</th><th class="text-maroon">Reason</th></tr></thead>
                          <tbody>
                            <tr><td class="text-md">None</td><td>All tasks completed</td></tr>
                          </tbody>
                        </table>
                      </td>
                    </tr>

                    <!-- Ligne 5 -->
                    <tr data-toggle="collapse" data-target="#detailsRow5" class="clickable bg-maroon">
                      <td class="text-white bg-maroon small">0005</td>
                      <td class="text-center"><span class="dot dot-lg bg-warning mr-2"></span></td>
                      <th scope="col">AfCFTA Staff Survey</th>
                      <td class="medium">May 4, 2025</td>
                      <td class="medium">15,000$</td>
                      <td class="medium">MS-3</td>
                      <td>
                        <span class="medium">Pending</span>
                        <div class="progress mt-2" style="height: 3px;">
                          <div class="progress-bar bg-warning" style="width: 50%"></div>
                        </div>
                      </td>
                      <td class="text-center">
                            <!-- Edit -->
                            <a href="#" class="text-primary mr-2 text-decoration-none" title="Edit">
                              <i class="fe fe-edit-2"></i>
                            </a>
                            <!-- View -->
                            <a href="#" class="text-info mr-2 text-decoration-none" title="View">
                              <i class="fe fe-eye"></i>
                            </a>
                            <!-- Remove -->
                            <a href="#" class="text-danger mr-2 text-decoration-none" title="Remove">
                              <i class="fe fe-trash-2"></i>
                            </a>
                            <!-- Assign -->
                            <a href="#" class="text-warning text-decoration-none" title="Assign">
                              <i class="fe fe-user-plus"></i>
                            </a>
                          </td>
                    </tr>
                    <tr class="collapse" id="detailsRow5">
                      <td colspan="8" class="bg-light">
                        <table class="table table-sm mt-2">
                          <thead><tr><th class="text-maroon">Sub Phase</th><th class="text-maroon">Reason</th></tr></thead>
                          <tbody>
                            <tr><td class="text-md">None</td><td>All tasks completed</td></tr>
                          </tbody>
                        </table>
                      </td>
                    </tr>

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