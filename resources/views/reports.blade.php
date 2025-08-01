@include('partials.navbar')
  <main role="main" class="main-content">
        <div class="container-fluid">
          <div class="row justify-content-center">
            <div class="col-md-12">
              <div class="row align-items-center my-3">
                <div class="col">
                  <h2 class="page-title">Reports</h2>
                </div>
                <div class="col-auto">
                    <button type="button" class="btn mb-2 bg-maroon  text-white" data-toggle="modal" data-target="#varyModal" data-whatever="@mdo"><i class="fe fe-upload mx-1"></i>Generate new </button>
                    <div class="modal fade" id="varyModal" tabindex="-1" role="dialog" aria-labelledby="varyModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="varyModalLabel">New report</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                  <div class="form-row">
                                      <label for="priority">Project name</label>
                                       <select class="form-control" id="project_id" name="project_id">
                                          @foreach ($projects as $project)
                                            <option value="{{ $project->id }}">{{ $project->title }}</option>
                                          @endforeach
                                      </select>
                                  </div>
                                  <!-- Footer -->
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary" onclick="goToReport()">Generate</button>                                  </div>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
                 <div class="col-12">
                      @if(session('success'))
                          <div class="alert alert-success alert-dismissible fade show" role="alert">
                              {{ session('success') }}
                              <button type="button" class="close" data-dismiss="alert" aria-label="Fermer">
                                  <span aria-hidden="true">&times;</span>
                              </button>
                          </div>
                      @endif
                      @if(session('error'))
                          <div class="alert alert-danger alert-dismissible fade show" role="alert">
                              {{ session('error') }}
                              <button type="button" class="close" data-dismiss="alert" aria-label="Fermer">
                                  <span aria-hidden="true">&times;</span>
                              </button>
                          </div>
                      @endif
                </div>
              <div class="file-container border-top">
                <div class="file-panel mt-4">
                  <h5 class="mb-3">Generated this month</h5>
                  <div class="row my-4">
                    @foreach ($monthlyReports as $report)
                      <div class="col-md-4">
                        @php
                            $status = $report->project->status;
                            $borderColor = match ($status) {
                                'In progress' => '#F4A51F', // jaune
                                'Completed' => '#70CA89',   // vert
                                'Closed' => '#299347', 
                                'Cancelled' => '#dc3545',   // rouge
                                default => '#C3A466'        // gris par défaut
                            };
                        @endphp
                        <div class="card shadow-sm mb-3" style="border-left: 5px solid {{ $borderColor }};">
                            <div class="card-body d-flex align-items-start">
                                <div class="flex-grow-1">
                                    <div>
                                        <a href="{{ url('projects/' . $report->project->id . '/report') }}" class="text-black h6 fw-bold text-decoration-none">
                                            {{ $report->title }}
                                        </a>
                                    </div>
                                    <div class="text-muted small mt-1">
                                        Web Report<br>
                                        <span>{{ $report->created_at->format('d M Y') }}</span>
                                    </div>
                                </div>
                                <div class="ms-auto">
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-light" data-toggle="dropdown">
                                            <i class="fe fe-more-vertical"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="{{ url('projects/' . $report->project->id . '/report') }}"><i class="fe fe-eye mr-2"></i>View</a>
                                            <a class="dropdown-item text-danger" href="#"><i class="fe fe-trash mr-2"></i>Delete</a>
                                            <a class="dropdown-item" data-toggle="modal" data-target="#shareReportModal{{ $report->id }}">
                                                <i class="fe fe-share mr-2"></i>Share
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                      </div>
                    @endforeach
                  </div> <!-- .row -->
                 
                  <hr style="border: none; height: 3px; background: linear-gradient(to right, #feb47b, #1b1311);">

                  <h6 class="mb-3">Admin Reports</h6>
                  <div class="row my-4 pb-4">
                    @foreach ($adminReports as $adminreport)
                      <div class="col-md-4">
                        @php
                            $status = $report->project->status;
                            $borderColor = match ($status) {
                                'In progress' => '#F4A51F', // jaune
                                'Completed' => '#70CA89',   // vert
                                'Closed' => '#299347', 
                                'Cancelled' => '#dc3545',   // rouge
                                default => '#C3A466'        // gris par défaut
                            };
                        @endphp
                        <div class="card shadow-sm mb-3" style="border-left: 5px solid {{ $borderColor }};">
                            <div class="card-body d-flex align-items-start">
                                <div class="flex-grow-1">
                                    <div>
                                        <a href="{{ url('projects/' . $report->project->id . '/report') }}" class="text-black h6 fw-bold text-decoration-none">
                                            {{ $report->title }}
                                        </a>
                                    </div>
                                    <div class="text-muted small mt-1">
                                        Web Report<br>
                                        <span>{{ $report->created_at->format('d M Y') }}</span>
                                    </div>
                                </div>
                                <div class="ms-auto">
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-light" data-toggle="dropdown">
                                            <i class="fe fe-more-vertical"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="{{ url('projects/' . $report->project->id . '/report') }}"><i class="fe fe-eye mr-2"></i>View</a>
                                            <a class="dropdown-item text-danger" href="#"><i class="fe fe-trash mr-2"></i>Delete</a>
                                            <a class="dropdown-item" href="#"><i class="fe fe-share mr-2"></i>Share</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                      </div>
                    @endforeach
                  </div> <!-- .row -->
                  <!-- .row -->

                  <hr style="border: none; height: 3px; background: linear-gradient(to right, #1b1311, #feb47b);">

                  <h6 class="mb-3">HRM Reports</h6>
                   <div class="row my-4 pb-4">
                    @foreach ($hrmReports as $hrmreport)
                       <div class="col-md-4">
                        @php
                            $status = $report->project->status;
                            $borderColor = match ($status) {
                                'In progress' => '#F4A51F', // jaune
                                'Completed' => '#70CA89',   // vert
                                'Closed' => '#299347', 
                                'Cancelled' => '#dc3545',   // rouge
                                default => '#C3A466'        // gris par défaut
                            };
                        @endphp
                        <div class="card shadow-sm mb-3" style="border-left: 5px solid {{ $borderColor }};">
                            <div class="card-body d-flex align-items-start">
                                <div class="flex-grow-1">
                                    <div>
                                        <a href="{{ url('projects/' . $report->project->id . '/report') }}" class="text-black h6 fw-bold text-decoration-none">
                                            {{ $report->title }}
                                        </a>
                                    </div>
                                    <div class="text-muted small mt-1">
                                        Web Report<br>
                                        <span>{{ $report->created_at->format('d M Y') }}</span>
                                    </div>
                                </div>
                                <div class="ms-auto">
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-light" data-toggle="dropdown">
                                            <i class="fe fe-more-vertical"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="{{ url('projects/' . $report->project->id . '/report') }}"><i class="fe fe-eye mr-2"></i>View</a>
                                            <a class="dropdown-item text-danger" href="#"><i class="fe fe-trash mr-2"></i>Delete</a>
                                            <a class="dropdown-item" href="#"><i class="fe fe-share mr-2"></i>Share</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                      </div>
                    @endforeach
                  </div> <!-- .row -->

                </div> <!-- .file-panel -->
              </div> <!-- .file-container -->
            </div> <!-- .col -->
          </div> <!-- .row -->
          <div class="modal fade" id="shareReportModal{{ $report->id }}" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
              <form method="POST" action="{{ route('reports.share', $report->id) }}">
              @csrf
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Share Report</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                  </div>
                  <div class="modal-body">
                    <p>Select users to share <strong>{{ $report->title }}</strong> with:</p>
                    <div class="form-group">
                      @foreach($users as $user)
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" name="users[]" value="{{ $user->id }}" id="user{{ $user->id }}">
                          <label class="form-check-label" for="user{{ $user->id }}">
                            {{ $user->firstname }} {{ $user->lastname }}
                          </label>
                        </div>
                       
                      @endforeach
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Send</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div> <!-- .container-fluid -->
        @include('partials.footer')
        <script>
          function goToReport() {
            const projectId = document.getElementById('project_id').value;
            if (projectId) {
              window.location.href = `/projects/${projectId}/report`;
            }
          }
        </script>
        
      </main> 