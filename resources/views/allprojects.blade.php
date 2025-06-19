@include('partials.navbar')
<main role="main" class="main-content">
        <div class="container-fluid">
          <div class="row justify-content-center">
            <div class="col-12">
               <div class="row align-items-center mb-4">
                        <div class="col">
                         <h2 class="h3 mb-0 page-title">All Projects</h2>
                        </div>
                        <div class="col-auto">
                          <button type="button" class="btn mb-2 bg-maroon text-white" data-toggle="modal" data-target="#projectModal">
                        <i class="fe fe-plus mx-1"></i>Add new
                      </button>

                      <!-- Large Modal -->
                      <div class="modal fade bd-example-modal-lg" id="projectModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title">New project</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <form action="" method="POST">
                              @csrf
                              <div class="modal-body">
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
                                <!-- Dates -->
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
                                      <option value="pending">Pending</option>
                                      <option value="processing">Processing</option>
                                      <option value="completed">Completed</option>
                                    </select>
                                  </div>
                                </div>
                                <!-- Unit & Project Manager -->
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
                                    <label for="manager">Project Manager</label>
                                    <select class="form-control" id="manager" name="manager">
                                      <option value="Director">Director</option>
                                      <option value="Head">Head of Division</option>
                                    </select>
                                  </div>
                                </div>
                                <!-- Project Type & Partner -->
                                <div class="form-row">
                                  <div class="form-group col-md-6">
                                    <label for="project_type">Type of project</label>
                                    <select class="form-control" id="project_type" name="project_type">
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
                                <!-- Phases -->
                                <div class="form-group mt-4">
                                  <label class="d-block">Project Phases</label>
                                  <div class="form-row">
                                    <div class="col-md-6">
                                      <div class="form-check mb-2">
                                          <input class="form-check-input" type="checkbox" value="tor" id="phaseTor" name="phases[]">
                                          <label class="form-check-label font-weight-bold text-maroon" for="phaseTor">Terms of Reference</label>
                                        </div>

                                        <div class="ml-4 pl-3 border-left">
                                          <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="subphases[tor][]" value="needs_analysis" id="tor1">
                                            <label class="form-check-label" for="tor1">Preparation</label>
                                          </div>
                                          <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="subphases[tor][]" value="objectives_definition" id="tor2">
                                            <label class="form-check-label" for="tor2">Availability of funds</label>
                                          </div>
                                          <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="subphases[tor][]" value="stakeholder_consultation" id="tor3">
                                            <label class="form-check-label" for="tor3">Validation</label>
                                          </div>
                                          <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="subphases[tor][]" value="drafting_tor" id="tor4">
                                            <label class="form-check-label" for="tor4">SG Approval</label>
                                          </div>
                                          <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="subphases[tor][]" value="approval" id="tor5">
                                            <label class="form-check-label" for="tor5">Procurement Request</label>
                                          </div>
                                        </div>

                                      </div>
                                      <div class="col-md-6">
                                         <!-- Phase: Procurement -->
                                <div class="form-check mb-2">
                                  <input class="form-check-input" type="checkbox" value="procurement" id="phaseProcurement" name="phases[]">
                                  <label class="form-check-label text-maroon font-weight-bold" for="phaseProcurement">Procurement</label>
                                </div>

                                <!-- Type of Procurement (hidden by default) -->
                                <div id="procurementTypeContainer" class="ml-4 mb-2 d-none">
                                  <label class="font-weight-bold">Type of Procurement:</label>
                                  <div class="form-check">
                                    <input class="form-check-input" type="radio" name="procurement_type" id="afcfta" value="afcfta">
                                    <label class="form-check-label" for="afcfta">AfCFTA Procurement</label>
                                  </div>
                                  <div class="form-check">
                                    <input class="form-check-input" type="radio" name="procurement_type" id="partner" value="partner">
                                    <label class="form-check-label" for="partner">Partner Procurement</label>
                                  </div>
                                </div>

                                <!-- AfCFTA Sub-phases (hidden by default) -->
                                <div id="afcftaSubphases" class="ml-5 d-none">
                                  <label class="font-weight-bold">AfCFTA Procurement Sub-phases:</label>
                                  <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="subphases[procurement_afcfta][]" value="needs_assessment" id="afcfta1">
                                    <label class="form-check-label" for="afcfta1">Tender document</label>
                                  </div>
                                  <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="subphases[procurement_afcfta][]" value="rfp_preparation" id="afcfta2">
                                    <label class="form-check-label" for="afcfta2">Advertisement</label>
                                  </div>
                                  <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="subphases[procurement_afcfta][]" value="advertising" id="afcfta3">
                                    <label class="form-check-label" for="afcfta3">Evaluation & Negociation</label>
                                  </div>
                                  <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="subphases[procurement_afcfta][]" value="evaluation" id="afcfta4">
                                    <label class="form-check-label" for="afcfta4">Award</label>
                                  </div>
                                </div>
                                      </div>
                                  </div>
                                 

                                 
                                <!-- Phase: Implementation -->
                                <div class="form-check mb-2">
                                  <input class="form-check-input" type="checkbox" value="implementation" id="phaseImplementation" name="phases[]">
                                  <label class="form-check-label text-maroon font-weight-bold" for="phaseImplementation">Implementation</label>
                                </div>

                                <!-- Sous-phases statiques -->
                                <div id="implementationSubphases" class="ml-4">
                                  <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="subphases[implementation][]" value="launch_meeting" id="imp1">
                                    <label class="form-check-label" for="imp1">Team Set</label>
                                  </div>
                                  <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="subphases[implementation][]" value="work_plan" id="imp2">
                                    <label class="form-check-label" for="imp2">Work Plan</label>
                                  </div>
                                  <div class="form-check">
                                    <input class="form-check-input dynamic-trigger" type="checkbox" name="subphases[implementation][]" value="activities" id="imp3">
                                    <label class="form-check-label" for="imp3">Development</label>
                                  </div>

                                  <!-- Zone dynamique pour "Project Activities" -->
                                  <div id="dynamicActivities" class="ml-4 mt-2 d-none">
                                    <label>Development phases:</label>
                                    <div id="activityInputs">
                                      <div class="form-row align-items-center mb-2">
                                        <div class="col">
                                          <input type="text" name="implementation_activities[]" class="form-control" placeholder="Enter activity title">
                                        </div>
                                        <div class="col-auto">
                                          <button type="button" class="btn btn-sm btn-outline-primary add-activity">Add</button>
                                        </div>
                                      </div>
                                    </div>
                                  </div>

                                  <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="subphases[implementation][]" value="monitoring" id="imp4">
                                    <label class="form-check-label" for="imp4">Control & Validation</label>
                                  </div>
                                  <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="subphases[implementation][]" value="reporting" id="imp5">
                                    <label class="form-check-label" for="imp5">Training</label>
                                  </div>
                                  <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="subphases[implementation][]" value="closing" id="imp6">
                                    <label class="form-check-label" for="imp6">Service</label>
                                  </div>
                                </div>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-primary">Save Project</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>

                        </div>
                </div> <!-- .row -->
              <div class="row items-align-center my-4  d-none d-lg-flex">
                <div class="col-md">
                  <ul class="nav nav-pills justify-content-start">
                    <li class="nav-item">
                      <a class="nav-link active bg-transparent pr-2 pl-0 text-primary" href="#">All <span class="badge badge-pill bg-gold text-white pb-2 pt-2 ml-2">28</span></a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link text-maroon px-2" href="#">Pending <span class="badge badge-pill bg-maroon border text-white pb-2 pt-2 ml-2">05</span></a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link text-yellow px-2" href="#">Processing <span class="badge badge-pill bg-yellow border text-white pb-2 pt-2 ml-2">13</span></a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link text-green px-2" href="#">Completed <span class="badge badge-pill bg-green border text-white pb-2 pt-2 ml-2">10</span></a>
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
                        <th>Partner</th>
                        <th>Status</th>  
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td class="text-muted medium">0001</td>
                        <td class="text-center"><span class="dot dot-lg bg-secondary mr-2"></span></td>
                        <th scope="col">Administration Data</th>
                        <td class="text-black medium">Jun 02, 2025</td>
                        <td class="medium">O$</td>
                        <td class="medium">No Partner</td>
                        <td>
                          <span class="medium">Completed</span>
                          <div class="progress mt-2" style="height: 3px;">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
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
                      <tr>
                        <td class="text-muted small">0002</td>
                        <td class="text-center"><span class="dot dot-lg bg-success mr-2"></span></td>
                        <th scope="col">AfCFTA Disaster readeness</th>
                        <td class="medium">May 4, 2025</td>
                        <td class="medium">15,000$</td>
                        <td class="medium">MS-3</td>
                        <td>
                          <span class="small text-muted">Completed</span>
                          <div class="progress mt-2" style="height: 3px;">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
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
                        <tr>
                        <td class="text-muted small">0003</td>
                        <td class="text-center"><span class="dot dot-lg bg-secondary mr-2"></span></td>
                        <th scope="col">AHRM Communication</th>
                        <td class="medium">Jun 02, 2025</td>
                        <td class="medium">20,000$</td>
                        <td class="medium">BIASHARA</td>
                        <td>
                          <span class="medium">Completed</span>
                          <div class="progress mt-2" style="height: 3px;">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
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
                      <tr>
                        <td class="text-muted medium">0004</td>
                        <td class="text-center"><span class="dot dot-lg bg-success mr-2"></span></td>
                        <th scope="col">AfCFTA Library</th>
                        <td class="medium">May 4, 2025</td>
                        <td class="medium">60,000$</td>
                        <td class="medium">EU-TAF</td>
                        <td>
                          <span class="medium">Completed</span>
                          <div class="progress mt-2" style="height: 3px;">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
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
                        <tr>
                        <td class="text-muted small">0005</td>
                        <td class="text-center"><span class="dot dot-lg bg-secondary mr-2"></span></td>
                        <th scope="col">AfCFTA IT training</th>
                        <td class="medium">Jun 02, 2025</td>
                        <td class="medium">40,000$</td>
                        <td class="medium">AfDB</td>
                        <td>
                          <span class="small text-muted">Completed</span>
                          <div class="progress mt-2" style="height: 3px;">
                            <div class="progress-bar bg-danger" role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
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
                      <tr>
                        <td class="text-muted small">0006</td>
                        <td class="text-center"><span class="dot dot-lg bg-success mr-2"></span></td>
                        <th scope="col">AfCFTA IT Smart Campus</th>
                        <td class="medium">May 4, 2025</td>
                        <td class="medium">70,000$</td>
                        <td class="medium">AUC</td>
                        <td>
                          <span class="small text-muted">Completed</span>
                          <div class="progress mt-2" style="height: 3px;">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
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
                    
                      <tr>
                        <td class="text-muted small">0001</td>
                        <td class="text-center"><span class="dot dot-lg bg-secondary mr-2"></span></td>
                        <th scope="col">AfCFTA Career Development Plan</th>
                        <td class="medium">Jun 02, 2025</td>
                        <td class="medium">O$</td>
                        <td class="medium">No Partner</td>
                        <td>
                          <span class="medium">Completed</span>
                          <div class="progress mt-2" style="height: 3px;">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
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
                      <tr>
                        <td class="text-muted small">0002</td>
                        <td class="text-center"><span class="dot dot-lg bg-danger mr-2"></span></td>
                        <th scope="col">AfCFTA DEAI Strategy</th>
                        <td class="medium">May 4, 2025</td>
                        <td class="medium">15,000$</td>
                        <td class="medium">MS-3</td>
                        <td>
                          <span class="small text-muted">Completed</span>
                          <div class="progress mt-2" style="height: 3px;">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
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
                     
                      <tr>
                          <td class="text-muted small">0003</td>
                          <td class="text-center"><span class="dot dot-lg bg-success mr-2"></span></td>
                          <th scope="col">AfCFTA Organizational Culture</th>
                          <td class="medium">May 4, 2025</td>
                          <td class="medium">15,000$</td>
                          <td class="medium">MS-3</td>
                          <td>
                            <span class="small text-muted">Completed</span>
                            <div class="progress mt-2" style="height: 3px;">
                              <div class="progress-bar bg-success" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
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

                      <tr>
                          <td class="text-muted small">0004</td>
                          <td class="text-center"><span class="dot dot-lg bg-success mr-2"></span></td>
                          <th scope="col">AfCFTA Recruitment </th>
                          <td class="medium">May 4, 2025</td>
                          <td class="medium">15,000$</td>
                          <td class="medium">MS-3</td>
                          <td>
                            <span class="small text-muted">Completed</span>
                            <div class="progress mt-2" style="height: 3px;">
                              <div class="progress-bar bg-success" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
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

                      <tr>
                          <td class="text-muted small">0005</td>
                          <td class="text-center"><span class="dot dot-lg bg-primary mr-2"></span></td>
                          <th scope="col">AfCFTA Staff Survey </th>
                          <td class="medium">May 4, 2025</td>
                          <td class="medium">15,000$</td>
                          <td class="medium">MS-3</td>
                          <td>
                            <span class="small text-muted">Pending</span>
                            <div class="progress mt-2" style="height: 3px;">
                              <div class="progress-bar bg-warning" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
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

                      <tr>
                          <td class="text-muted small">0005</td>
                          <td class="text-center"><span class="dot dot-lg bg-warning mr-2"></span></td>
                          <th scope="col">AHRMD SOP and manual</th>
                          <td class="medium">May 4, 2025</td>
                          <td class="medium">15,000$</td>
                          <td class="medium">MS-3</td>
                          <td>
                            <span class="small text-muted">Pending</span>
                            <div class="progress mt-2" style="height: 3px;">
                              <div class="progress-bar bg-success" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
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
                    </tbody>
                  </table>
                 
                </div> <!-- .col -->
              </div> <!-- .row -->
            </div> <!-- .col-12 -->
          </div> <!-- .row -->
        </div> <!-- .container-fluid -->
     @include('partials.footer')   
</main>

<script>
  document.addEventListener("DOMContentLoaded", function () {
    const procurementCheckbox = document.getElementById("phaseProcurement");
    const procurementTypeContainer = document.getElementById("procurementTypeContainer");
    const afcftaRadio = document.getElementById("afcfta");
    const partnerRadio = document.getElementById("partner");
    const afcftaSubphases = document.getElementById("afcftaSubphases");

    procurementCheckbox.addEventListener("change", function () {
      if (this.checked) {
        procurementTypeContainer.classList.remove("d-none");
      } else {
        procurementTypeContainer.classList.add("d-none");
        afcftaSubphases.classList.add("d-none");
        afcftaRadio.checked = false;
        partnerRadio.checked = false;
      }
    });

    afcftaRadio.addEventListener("change", function () {
      afcftaSubphases.classList.remove("d-none");
    });

    partnerRadio.addEventListener("change", function () {
      afcftaSubphases.classList.add("d-none");
    });
  });
</script>

<script>
  document.addEventListener("DOMContentLoaded", function () {
    const triggerCheckbox = document.getElementById("imp3");
    const dynamicSection = document.getElementById("dynamicActivities");
    const addButtonClass = "add-activity";

    // Show/hide dynamic input area
    triggerCheckbox.addEventListener("change", function () {
      if (this.checked) {
        dynamicSection.classList.remove("d-none");
      } else {
        dynamicSection.classList.add("d-none");
        // Optionally clear inputs
        document.getElementById("activityInputs").innerHTML = `
          <div class="form-row align-items-center mb-2">
            <div class="col">
              <input type="text" name="implementation_activities[]" class="form-control" placeholder="Enter activity title">
            </div>
            <div class="col-auto">
              <button type="button" class="btn btn-sm btn-outline-primary add-activity">Add</button>
            </div>
          </div>`;
      }
    });

    // Delegate "Add" button clicks to append new input lines
    document.getElementById("activityInputs").addEventListener("click", function (e) {
      if (e.target.classList.contains(addButtonClass)) {
        const newInput = document.createElement("div");
        newInput.className = "form-row align-items-center mb-2";
        newInput.innerHTML = `
          <div class="col">
            <input type="text" name="implementation_activities[]" class="form-control" placeholder="Enter activity title">
          </div>
          <div class="col-auto">
            <button type="button" class="btn btn-sm btn-outline-danger remove-activity">Remove</button>
          </div>`;
        this.appendChild(newInput);
      }
    });

    // Handle "Remove" button
    document.getElementById("activityInputs").addEventListener("click", function (e) {
      if (e.target.classList.contains("remove-activity")) {
        e.target.closest(".form-row").remove();
      }
    });
  });
</script>
