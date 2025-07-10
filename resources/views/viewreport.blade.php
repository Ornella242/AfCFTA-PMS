@include('partials.navbar')
<main role="main" class="main-content">
        <div class="container-fluid">
          <div class="row justify-content-center">
            <div class="col-12">
              <div class="row align-items-center mb-4">
                <div class="col">
                  <h2 class="h3 page-title text-black">
                    <small class="h3 text-maroon text-uppercase">Report</small><br />
                    {{ $report->code ?? '#0000' }}
                  </h2>
                </div>
                <div class="col-auto">
                  <button type="button" class="btn bg-yellow text-white"><i class="fe fe-printer fe-16"></i> Print</button>
                </div>
              </div>
              <div class="card shadow">
                <div class="card-body p-5">
                    <div class="row align-items-center">
                        <div class="col-md-10">
                            <h4 class="mb-1 text-uppercase">African Continental Free Trade Area Secretariat</h4>
                            <p class="mb-0">Creating One African Market</p>
                        </div>
                        <div class="col-md-2 text-right">
                            <img src="{{ asset('images/logo.png') }}" alt="AfCFTA Logo" class="navbar-brand-img brand-md mx-auto mb-4">
                        </div>
                        </div>
                        <hr style="border-top: 3px solid #C2A756; margin-top: 0;">

                    <div class="row mb-2">
                    <div class="col-12 mb-2">
                        <h3 class="mb-0  mt-2 text-uppercase">Report {{ $report->code ?? '#0000' }} | {{ $report->project->title}}</h3>
                        <p class="text-black font-bold"> Generated {{ \Carbon\Carbon::parse($report->generated_at)->format('d/m/Y') }} <br />By {{ $report->user->firstname .' '. $report->user->lastname}} </p>
                    </div>
                    </div> <!-- /.row -->
                    <div class="row align-items-center my-4">
                            <div class="col-md-6">
                            <div id="chart-box">
                                <div id="donutChartWidget"></div>
                            </div>
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

                    <div class="row my-4">
                        <div class="col-md-12">
                        <div class="mb-2">
                            <div class="card-header">
                            <strong class="card-title h5">Description: {{ $report->project->description}}</strong>
                            </div>
                            <div class="card-body">
                                <dl class="row align-items-center mb-0">
                                    <dt class="col-sm-2 mb-3 text-muted">Created by</dt>
                                    <dd class="col-sm-4 mb-3">
                                    <strong>{{ $project->creator->firstname . ' ' . $project->creator->lastname }}</strong>
                                    </dd>
                                    <dt class="col-sm-2 mb-3 text-muted">Assigned to</dt>
                                    <dd class="col-sm-4 mb-3">
                                    <strong>{{$report->project->projectManager->firstname .' '. $report->project->projectManager->lastname }}</strong>
                                    </dd>
                                </dl>
                                <dl class="row mb-0">
                                    <dt class="col-sm-2 mb-3 text-muted">Type</dt>
                                    <dd class="col-sm-4 mb-3">{{ $project->type}}</dd>
                                    <dt class="col-sm-2 mb-3 text-muted">Unit</dt>
                                    <dd class="col-sm-4 mb-3">{{ $project->unit->name}}</dd>
                                    <dt class="col-sm-2 mb-3 text-muted">Priority</dt>
                                    <dd class="col-sm-4 mb-3">
                                    <span class="badge badge-pill badge-danger pt-1">{{ $project->priority}}</span>
                                    
                                    </dd>
                                    <dt class="col-sm-2 mb-3 text-muted">Status</dt>
                                    <dd class="col-sm-4 mb-3">
                                        <strong>
                                            {{ $project->status}} 
                                        </strong>
                                    </dd>
                                    <dt class="col-sm-2 mb-3 text-muted">Start Date</dt>
                                    <dd class="col-sm-4 mb-3">{{ \Carbon\Carbon::parse($project->start_date)->format('d/m/Y') }} </dd>
                                    <dt class="col-sm-2 mb-3 text-muted">End Date</dt>
                                    <dd class="col-sm-4 mb-3">{{ \Carbon\Carbon::parse($project->end_date)->format('d/m/Y') }}</dd>
                                </dl>
                            </div> <!-- .card-body -->
                        </div> <!-- .card -->
                         
                        <div class="mb-4">
                           <div class="card-header d-flex justify-content-between align-items-center">
                                <strong class="card-title h5 mb-0">Activity report</strong>
                                <div class="d-flex align-items-center">
                                    <span class="mr-3 d-flex align-items-center">
                                    <i class="fe fe-layers mr-1"></i>3
                                    </span>
                                </div>   
                            </div>
                            <div class="card-body p-0">
                                <table class="table mb-0 table-hover">
                                <thead class="thead-light">
                                    <tr>
                                    <th>Title</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Status</th>
                                    <th class="text-right">Progress</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr data-toggle="modal" data-target=".modal-right">
                                    <td>Design and Implement Database Schema for Administrative Data</td>
                                    <td>05/06/2025</td>
                                    <td>05/06/2025</td>
                                    <td><span class="badge badge-success pt-1">Completed</span></td>
                                    <td class="text-right text-green-600">
                                        100%  
                                    </td>
                                    </tr>
                                    <tr data-toggle="modal" data-target=".modal-right">
                                    <td>Develop Admin Dashboard Interface</td>
                                    <td>05/06/2025</td>
                                    <td>05/06/2025</td>
                                    <td><span class="badge badge-warning pt-1">In Progress</span></td>
                                    <td class="text-right">
                                        60%
                                    </td>
                                    </tr>
                                    <tr data-toggle="modal" data-target=".modal-right">
                                            <td>Implement Role-Based Access Control </td>
                                            <td>05/06/2025</td>
                                            <td>05/06/2025</td>
                                            <td><span class="badge badge-secondary pt-1">Pending</span></td>
                                            <td class="text-right">
                                                0%
                                            </td>
                                        
                                            <div class="modal fade modal-right modal-slide" tabindex="-1" role="dialog" aria-labelledby="defaultModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-sm" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                        <h5 class="modal-title" id="defaultModalLabel">Subtasks</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                        </div>
                                                        <div class="modal-body"> 
                                                            <div class="list-group">
                                                                <!-- Subtask 1 -->
                                                                <div class="list-group-item d-flex justify-content-between align-items-center">
                                                                    <div>
                                                                    <h6 class="mb-1">Design login page</h6>
                                                                    <span class="badge badge-success pt-2 pb-2 text-md">Completed</span>
                                                                    </div>                                                                  
                                                                </div>

                                                                <!-- Subtask 2 -->
                                                                <div class="list-group-item d-flex justify-content-between align-items-center">
                                                                    <div>
                                                                    <h6 class="mb-1">Set up database</h6>
                                                                    <span class="badge badge-warning pt-2 pb-2">In Progress</span>
                                                                    </div>
                                                                </div>

                                                                <!-- Subtask 3 -->
                                                                <div class="list-group-item d-flex justify-content-between align-items-center">
                                                                    <div>
                                                                    <h6 class="mb-1">Write documentation</h6>
                                                                    <span class="badge badge-secondary pb-2 pt-2">Pending</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                        <button type="button" class="btn mb-2 btn-secondary" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    </tr>
                                </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div> <!-- /.card-body -->
              </div> <!-- /.card -->
            </div> <!-- /.col-12 -->
          </div> <!-- .row -->
        </div> <!-- .container-fluid -->
       @include('partials.footer')
</main> <!-- main -->
  