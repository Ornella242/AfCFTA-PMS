@include('partials.navbar')
<main role="main" class="main-content">
        <div class="container-fluid">
          <div class="row justify-content-center">
                <div class="col-12">
                    <div class="row align-items-center mb-4">
                        <div class="col">
                        <h2 class="h4 page-title"><small class="text-maroon h4">Administration Data</small><br />#0001</h2>
                        </div>
                        <div class="col-auto">
                        <button type="button" class="btn bg-green text-white" data-toggle="modal" data-target="#defaultModal">
                        PM Assistant
                        </button>
                        <!-- Modal -->
                        <div class="modal fade" id="defaultModal" tabindex="-1" role="dialog" aria-labelledby="defaultModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="defaultModalLabel">Assign Assistant</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                            <div class="modal-body">
                                    <form action="" method="POST">
                                        @csrf
                                        {{-- Project Assistant --}}
                                        <div class="form-group">
                                            <label for="project_name">Project Manager Assistant</label>
                                            <select class="form-control" id="unit" name="unit">
                                                <option value="">Sandra KPEGBA</option>
                                                <option value="">Ornella AHOUANDOGBO</option>
                                                <option value="">Grace DIBAKALA</option>
                                                <option value="">Ayaw Abdul Ganiu</option>
                                                <option value="">Ohemaa BOATENG</option>
                                                <!-- Tu peux ajouter d'autres unités -->
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Footer -->
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn bg-green text-white">Add assistant</button>
                                    </div>
                                    </form>
                            </div>                                              
                            </div>
                            </div>
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
                                <strong class="text-yellow">In progress</strong><br / />
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
                        </div>
                    </div> <!-- .row -->
                    <div class="row my-4">
                        <div class="col-md-12">
                        <div class="card shadow mb-4">
                            <div class="card-header">
                            <strong class="card-title h5">Administrative services dashboard</strong>
                            <span class="float-right"><i class="fe fe-flag mr-2"></i><span class="badge badge-pill pt-2 pb-2 bg-yellow text-white">Processing</span></span>
                            </div>
                            <div class="card-body">
                            <dl class="row align-items-center mb-0">
                                <dt class="col-sm-2 mb-3 text-muted">Created by</dt>
                                <dd class="col-sm-4 mb-3">
                                <strong>Brown Asher</strong>
                                </dd>
                                <dt class="col-sm-2 mb-3 text-muted">Assigned to</dt>
                                <dd class="col-sm-4 mb-3">
                                <strong>Kelley Sonya</strong>
                                </dd>
                            </dl>
                            <dl class="row mb-0">
                                <dt class="col-sm-2 mb-3 text-muted">Type</dt>
                                <dd class="col-sm-4 mb-3">Admin</dd>
                                <dt class="col-sm-2 mb-3 text-muted">Unit</dt>
                                <dd class="col-sm-4 mb-3">Admin</dd>
                                <dt class="col-sm-2 mb-3 text-muted">Priority</dt>
                                <dd class="col-sm-4 mb-3">
                                <span class="badge badge-pill badge-danger pt-1">High</span>
                                
                                </dd>
                                <dt class="col-sm-2 mb-3 text-muted">Status</dt>
                                <dd class="col-sm-4 mb-3">
                                <span class="dot dot-md bg-warning text-yellow mr-2 "></span> Processing <div class="dropdown d-inline">
                                    <button class="btn btn-sm p-0 dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="sr-only">Change status</span>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item text-maroon" href="#">Pending</a>
                                    <a class="dropdown-item text-green" href="#">Completed</a>
                                    </div>
                                </div>
                                </dd>
                                <dt class="col-sm-2 mb-3 text-muted">Created On</dt>
                                <dd class="col-sm-4 mb-3">2025-06-05 1:08pm</dd>
                                <dt class="col-sm-2 mb-3 text-muted">Last Update</dt>
                                <dd class="col-sm-4 mb-3">2025-06-05 1:08pm</dd>
                            </dl>
                            </div> <!-- .card-body -->
                        </div> <!-- .card -->
                         
                        <div class="card shadow mb-4">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <strong class="card-title h5 mb-0">Associated Phases</strong>
                            </div>
                          

                            <!-- TERMS OF REFERENCES -->
                            <div class="section-title bg-maroon">TERMS OF REFERENCES</div>
                                <div class="step-row">
                                    <span>Preparation</span>
                                    <select class="form-control form-control-sm status-select">
                                        <option selected>Not started</option>
                                        <option>In Progress</option>
                                        <option>Completed</option>
                                        <option>Cancelled</option>
                                        <option>Waiting for approval</option>
                                        <option>Delayed</option>
                                        <option>Under review</option>
                                    </select>
                                      <input type="text" class="form-control form-control-sm reason-input d-none" placeholder="Enter reason" style="width: 200px;" />
                                </div>
                                <div class="step-row">
                                    <span>Availability of Funds</span>
                                    <select class="form-control form-control-sm status-select">
                                        <option selected>Not started</option>
                                        <option>In Progress</option>
                                        <option>Completed</option>
                                        <option>Cancelled</option>
                                        <option>Waiting for approval</option>
                                        <option>Delayed</option>
                                        <option>Under review</option>
                                    </select>
                                </div>
                                  <div class="step-row">
                                    <span>Validation</span>
                                    <select class="form-control form-control-sm status-select">
                                        <option selected>Not started</option>
                                        <option>In Progress</option>
                                        <option>Completed</option>
                                        <option>Cancelled</option>
                                        <option>Waiting for approval</option>
                                        <option>Delayed</option>
                                        <option>Under review</option>
                                    </select>
                                </div>
                                <div class="step-row">
                                <span>SG Approval</span>
                                <select class="form-control form-control-sm status-select">
                                        <option selected>Not started</option>
                                        <option>In Progress</option>
                                        <option>Completed</option>
                                        <option>Cancelled</option>
                                        <option>Waiting for approval</option>
                                        <option>Delayed</option>
                                        <option>Under review</option>
                                    </select>
                                </div>
                                <div class="step-row">
                                <span>Proc. Request</span>
                                <select class="form-control form-control-sm status-select">
                                    <option selected>Not started</option>
                                    <option>In Progress</option>
                                    <option>Completed</option>
                                    <option>Cancelled</option>
                                    <option>Waiting for approval</option>
                                    <option>Delayed</option>
                                    <option>Under review</option>
                                </select>
                                </div>

                            <!-- PROCUREMENT -->
                            <div class="section-title bg-yellow">PROCUREMENT</div>
                                <div class="step-row">
                                <span>Tender Doc</span>
                                <select class="form-control form-control-sm status-select">
                                    <option selected>Not started</option>
                                    <option>In Progress</option>
                                    <option>Completed</option>
                                    <option>Cancelled</option>
                                    <option>Waiting for approval</option>
                                    <option>Delayed</option>
                                    <option>Under review</option>
                                </select>
                                </div>
                                <div class="step-row">
                                <span>Advert.</span>
                                <select class="form-control form-control-sm status-select">
                                    <option selected>Not started</option>
                                    <option>In Progress</option>
                                    <option>Completed</option>
                                    <option>Cancelled</option>
                                    <option>Waiting for approval</option>
                                    <option>Delayed</option>
                                    <option>Under review</option>
                                </select>
                                </div>
                                <div class="step-row">
                                <span>Evaluation and negotiation</span>
                                <select class="form-control form-control-sm status-select">
                                    <option selected>Not started</option>
                                    <option>In Progress</option>
                                    <option>Completed</option>
                                    <option>Cancelled</option>
                                    <option>Waiting for approval</option>
                                    <option>Delayed</option>
                                    <option>Under review</option>
                                </select>
                                </div>
                                <div class="step-row">
                                <span>Award</span>
                                <select class="form-control form-control-sm status-select">
                                    <option selected>Not started</option>
                                    <option>In Progress</option>
                                    <option>Completed</option>
                                    <option>Cancelled</option>
                                    <option>Waiting for approval</option>
                                    <option>Delayed</option>
                                    <option>Under review</option>
                                </select>
                                </div>
                                  <div class="step-row">
                                    <span>Contracting</span>
                                    <select class="form-control form-control-sm status-select">
                                        <option selected>Not started</option>
                                        <option>In Progress</option>
                                        <option>Completed</option>
                                        <option>Cancelled</option>
                                        <option>Waiting for approval</option>
                                        <option>Delayed</option>
                                        <option>Under review</option>
                                    </select>
                                </div>

                            <!-- IMPLEMENTATION -->
                            <div class="section-title bg-green">IMPLEMENTATION</div>
                                <div class="step-row">
                                <span>Team Set</span>
                                <select class="form-control form-control-sm status-select">
                                    <option selected>Not started</option>
                                    <option>In Progress</option>
                                    <option>Completed</option>
                                    <option>Cancelled</option>
                                    <option>Waiting for approval</option>
                                    <option>Delayed</option>
                                    <option>Under review</option>
                                </select>
                                </div>
                                <div class="step-row">
                                <span>WorkPlan</span>
                                <select class="form-control form-control-sm status-select">
                                    <option selected>Not started</option>
                                    <option>In Progress</option>
                                    <option>Completed</option>
                                    <option>Cancelled</option>
                                    <option>Waiting for approval</option>
                                    <option>Delayed</option>
                                    <option>Under review</option>
                                </select>
                                </div>
                                <div class="step-row">
                                <span>Development</span>
                                <select class="form-control form-control-sm status-select">
                                    <option selected>Not started</option>
                                    <option>In Progress</option>
                                    <option>Completed</option>
                                    <option>Cancelled</option>
                                    <option>Waiting for approval</option>
                                    <option>Delayed</option>
                                    <option>Under review</option>
                                </select>
                                </div>
                                <div class="step-row">
                                <span>Control and validation</span>
                                <select class="form-control form-control-sm status-select">
                                    <option selected>Not started</option>
                                    <option>In Progress</option>
                                    <option>Completed</option>
                                    <option>Cancelled</option>
                                    <option>Waiting for approval</option>
                                    <option>Delayed</option>
                                    <option>Under review</option>
                                </select>
                                </div>
                                <div class="step-row">
                                <span>Training</span>
                                <select class="form-control form-control-sm status-select">
                                    <option selected>Not started</option>
                                    <option>In Progress</option>
                                    <option>Completed</option>
                                    <option>Cancelled</option>
                                    <option>Waiting for approval</option>
                                    <option>Delayed</option>
                                    <option>Under review</option>
                                </select>
                                </div>
                                <div class="step-row">
                                <span>In service</span>
                                <select class="form-control form-control-sm status-select">
                                    <option selected>Not started</option>
                                    <option>In Progress</option>
                                    <option>Completed</option>
                                    <option>Cancelled</option>
                                    <option>Waiting for approval</option>
                                    <option>Delayed</option>
                                    <option>Under review</option>
                                </select>
                                </div>
                        </div>

                    </div> <!-- .col-md -->
                
                </div> <!-- .col-md -->
            </div>
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

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const selects = document.querySelectorAll('.status-select');

    selects.forEach(select => {
      select.addEventListener('change', function () {
        const parent = this.closest('.step-row');
        const reasonInput = parent.querySelector('.reason-input');

        if (['Cancelled', 'Delayed', 'Pending'].includes(this.value)) {
          reasonInput.classList.remove('d-none');
        } else {
          reasonInput.classList.add('d-none');
        }
      });
    });
  });
</script>

</main> <!-- main -->
