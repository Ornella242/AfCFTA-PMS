@include('partials.navbar')
<main role="main" class="main-content">
        <div class="container-fluid">
          <div class="row justify-content-center">
            <div class="col-12">
              <div class="row align-items-center mb-4">
                <div class="col">
                    <h2 class="h3 mb-0 page-title">Admin Projects</h2>
                </div>
                <div class="col-auto">
                  <button type="button" class="btn mb-2 bg-green  text-white" data-toggle="modal" data-target="#varyModal" data-whatever="@mdo"><i class="fe fe-plus mx-1"></i>Add new </button>
                  <button type="button" class="btn mb-2 bg-maroon  text-white" data-toggle="modal" data-target="#varyModalG" data-whatever="@mdo"><i class="fe fe-upload mx-1"></i>Generate report </button>
                  <div class="modal fade" id="varyModal" tabindex="-1" role="dialog" aria-labelledby="varyModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="varyModalLabel">New project</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <form action="" method="POST">
                            @csrf
                            <!-- Title -->
                            <div class="form-group">
                              <label for="title">Title</label>
                              <input type="text" class="form-control" id="title" name="title" placeholder="Enter project title" required>
                            </div>
                            <!-- Description -->
                            <div class="form-group">
                              <label for="description">Description</label>
                              <textarea class="form-control" id="description" name="description" rows="3" placeholder="Enter project description"></textarea>
                            </div>
                            <!-- Start Date & End Date -->
                            <div class="form-row">
                              <div class="form-group col-md-6">
                                <label for="start_date">Start Date</label>
                                <input type="date" class="form-control" id="start_date" name="start_date" required>
                              </div>
                              <div class="form-group col-md-6">
                                <label for="end_date">End Date</label>
                                <input type="date" class="form-control" id="end_date" name="end_date" required>
                              </div>
                            </div>
                            <!-- Priority & Status -->
                            <div class="form-row">
                              <div class="form-group col-md-6">
                                <label for="priority">Priority</label>
                                <select class="form-control" id="priority" name="priority">
                                  <option value="high">High</option>
                                  <option value="medium">Medium</option>
                                  <option value="low">Low</option>
                                </select>
                              </div>
                              <div class="form-group col-md-6">
                                <label for="status">Status</label>
                                <select class="form-control" id="status" name="status">
                                  <option value="pending" class="text-maroon">Pending</option>
                                  <option value="processing" class="text-yellow">Processing</option>
                                  <option value="completed" class="text-green">Completed</option>
                                </select>
                              </div>
                            </div>
                            <!-- Partner & Unit -->
                            <div class="form-row">
                              <div class="form-group col-md-6">
                                <label for="unit">Unit</label>
                                <select class="form-control" id="unit" name="unit">
                                  <option value="HR">HR</option>
                                  <option value="Facilities">Facilities</option>
                                  <option value="IT">IT</option>
                                  <option value="Procurement">Procurement</option>
                                  <option value="Travel">Travel</option>
                                  <option value="Transport">Transport</option>
                                </select>
                              </div>
                                <div class="form-group col-md-6">
                                <label for="partner">Project Manager</label>
                                <select class="form-control" id="partner" name="partner">
                                    <option value="Director">Director</option>
                                    <option value="Head">Head of Division</option>
                                </select>
                              </div>
                            </div>
                            <!-- Type of project & Partner -->
                            <div class="form-row">
                              <div class="form-group col-md-6">
                                <label for="unit">Type of project</label>
                                <select class="form-control" id="unit" name="unit">
                                  <option value="HRM">HRM</option>
                                  <option value="Admin">Admin</option>
                                </select>
                              </div>
                              <div class="form-group col-md-6">
                                <label for="partner">Partner</label>
                                <select class="form-control" id="partner" name="partner">
                                  <option value="AfDB">AfDB</option>
                                  <option value="AUC">AUC</option>
                                  <option value="MS-1">MS-1</option>
                                </select>
                              </div>
                            </div>
                            
                            <!-- Budget -->
                            <div class="form-group">
                              <label for="budget">Budget (USD)</label>
                              <input type="number" step="0.01" class="form-control" id="budget" name="budget" placeholder="Enter budget amount">
                            </div>

                          </div>

                          <!-- Footer -->
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save Project</button>
                          </div>
                          </form>
                        </div>
                    </div>
                  </div>
                  {{-- <div class="modal fade" id="varyModalG" tabindex="-1" role="dialog" aria-labelledby="varyModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="varyModalLabel">New report</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="" method="POST">
                                @csrf
                                <div class="form-row">
                                    <label for="priority">Project name</label>
                                    <select class="form-control" id="project_name" name="project_name">
                                        <option value="Project 1">Project 1</option>
                                        <option value="Project 2">Project 2</option>
                                    </select>
                                </div>
                                <div class="form-row mt-2">
                                    <div class="form-group col-md-6">
                                    <label for="priority">Season</label>
                                    <select class="form-control" id="priority" name="priority">
                                        <option value="Weekly">Weekly</option>
                                        <option value="Monthly">Monthly</option>
                                    </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                    <label for="priority">Week</label>
                                    <select class="form-control" id="priority" name="priority">
                                        <option value="This week">Current week</option>
                                        <option value="Last week">Last week</option>
                                    </select>
                                    </div>
                                </div>
                                                            
                                </div>

                                <!-- Footer -->
                                <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Generate</button>
                                </div>
                                </form>
                            </div>
                        </div>
                        </div>
                  </div> --}}
                </div>
              </div>
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
                        <th>Estimated Budget</th>
                        <th>Actual Cost</th>
                        <th>Partner</th>
                        <th>Status</th>  
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td class="text-muted small">0001</td>
                        <td class="text-center"><span class="dot dot-lg bg-secondary mr-2"></span></td>
                        <th scope="col">Administration Data</th>
                        <td class="medium">Jun 02, 2025</td>
                        <td class="medium">O$</td>
                        <td class="medium">O$</td>
                        <td class="medium">No Partner</td>
                        <td>
                          <span class="medium">Completed</span>
                          <div class="progress mt-2" style="height: 3px;">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </td>
                        
                        <td><button class="btn btn-sm dropdown-toggle more-horizontal" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="text-muted sr-only">Action</span>
                          </button>
                          <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="{{ url('/projectdetail') }}">Edit</a>
                            <a class="dropdown-item" href="{{ url('/projectdetail') }}">View</a>
                            <a class="dropdown-item" href="#">Remove</a>
                            <a class="dropdown-item" href="#">Assign</a>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td class="text-muted small">0002</td>
                        <td class="text-center"><span class="dot dot-lg bg-success mr-2"></span></td>
                        <th scope="col">AfCFTA Disaster readeness</th>
                        <td class="medium">May 4, 2025</td>
                        <td class="medium">15,000$</td>
                        <td class="medium">15,000$</td>
                        <td class="medium">MS-3</td>
                        <td>
                          <span class="medium">Completed</span>
                          <div class="progress mt-2" style="height: 3px;">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </td>
                        <td><button class="btn btn-sm dropdown-toggle more-horizontal" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="text-muted sr-only">Action</span>
                          </button>
                          <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="#">Edit</a>
                            <a class="dropdown-item" href="#">View</a>
                            <a class="dropdown-item" href="#">Remove</a>
                            <a class="dropdown-item" href="#">Assign</a>
                          </div>
                        </td>
                      </tr>
                        <tr>
                        <td class="text-muted small">0003</td>
                        <td class="text-center"><span class="dot dot-lg bg-secondary mr-2"></span></td>
                        <th scope="col">AHRM Communication</th>
                        <td class="medium">Jun 02, 2025</td>
                        <td class="medium">20,000$</td>
                        <td class="medium">20,000$</td>
                        <td class="medium">BIASHARA</td>
                        <td>
                          <span class="medium">Completed</span>
                          <div class="progress mt-2" style="height: 3px;">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </td>
                        
                        <td><button class="btn btn-sm dropdown-toggle more-horizontal" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="text-muted sr-only">Action</span>
                          </button>
                          <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="#">Edit</a>
                            <a class="dropdown-item" href="#">View</a>
                            <a class="dropdown-item" href="#">Remove</a>
                            <a class="dropdown-item" href="#">Assign</a>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td class="text-muted small">0004</td>
                        <td class="text-center"><span class="dot dot-lg bg-success mr-2"></span></td>
                        <th scope="col">AfCFTA Library</th>
                        <td class="medium">May 4, 2025</td>
                        <td class="medium">60,000$</td>
                        <td class="medium">60,000$</td>
                        <td class="medium">EU-TAF</td>
                        <td>
                          <span class="medium">Completed</span>
                          <div class="progress mt-2" style="height: 3px;">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </td>
                        <td><button class="btn btn-sm dropdown-toggle more-horizontal" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="text-muted sr-only">Action</span>
                          </button>
                          <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="#">Edit</a>
                            <a class="dropdown-item" href="#">View</a>
                            <a class="dropdown-item" href="#">Remove</a>
                            <a class="dropdown-item" href="#">Assign</a>
                          </div>
                        </td>
                      </tr>
                        <tr>
                        <td class="text-muted small">0005</td>
                        <td class="text-center"><span class="dot dot-lg bg-secondary mr-2"></span></td>
                        <th scope="col">AfCFTA IT training</th>
                        <td class="medium">Jun 02, 2025</td>
                        <td class="medium">40,000$</td>
                        <td class="medium">40,000$</td>
                        <td class="medium">AfDB</td>
                        <td>
                          <span class="medium">Completed</span>
                          <div class="progress mt-2" style="height: 3px;">
                            <div class="progress-bar bg-danger" role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </td>
                        
                        <td><button class="btn btn-sm dropdown-toggle more-horizontal" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="text-muted sr-only">Action</span>
                          </button>
                          <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="#">Edit</a>
                            <a class="dropdown-item" href="#">View</a>
                            <a class="dropdown-item" href="#">Remove</a>
                            <a class="dropdown-item" href="#">Assign</a>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td class="text-muted small">0006</td>
                        <td class="text-center"><span class="dot dot-lg bg-success mr-2"></span></td>
                        <th scope="col">AfCFTA IT Smart Campus</th>
                        <td class="medium">May 4, 2025</td>
                        <td class="medium">70,000$</td>
                        <td class="medium">70,000$</td>
                        <td class="medium">AUC</td>
                        <td>
                          <span class="small text-muted">Completed</span>
                          <div class="progress mt-2" style="height: 3px;">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </td>
                        <td><button class="btn btn-sm dropdown-toggle more-horizontal" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="text-muted sr-only">Action</span>
                          </button>
                          <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="#">Edit</a>
                            <a class="dropdown-item" href="#">View</a>
                            <a class="dropdown-item" href="#">Remove</a>
                            <a class="dropdown-item" href="#">Assign</a>
                          </div>
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
</main>
