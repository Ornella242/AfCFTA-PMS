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
                                    <label for="priority">Type of report</label>
                                    <select class="form-control" id="project_name" name="project_name">
                                        <option value="Project 1">Project report</option>
                                        <option value="Project 2">Financial project report</option>
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
                    </div>
                </div>
              <div class="file-container border-top">
                <div class="file-panel mt-4">
                  <h6 class="mb-3">Generated this month</h6>
                  <div class="row my-4">
                    <div class="col-md-3">
                      <div class="card shadow text-center mb-4 bg-maroon">
                        <div class="card-body file">
                          <div class="file-action">
                            <button type="button" class="btn btn-link dropdown-toggle more-vertical p-0 text-white mx-auto" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <span class="text-muted sr-only">Action</span>
                            </button>
                            <div class="dropdown-menu m-2">
                              <a class="dropdown-item" href="{{ url('viewreport') }}"><i class="fe fe-eye fe-12 mr-4"></i>View</a>
                              <a class="dropdown-item" href="#"><i class="fe fe-delete fe-12 mr-4"></i>Delete</a>
                              <a class="dropdown-item" href="#"><i class="fe fe-share fe-12 mr-4"></i>Share</a>
                              <a class="dropdown-item" href="#"><i class="fe fe-download fe-12 mr-4"></i>Download</a>
                            </div>
                          </div>
                          <div class="circle circle-lg bg-maroon-light my-4">
                            <span class="fe fe-file fe-24 text-white"></span>
                          </div>
                          <div class="file-info">
                            <span class="badge badge-light text-muted mr-2">07 June</span>
                          </div>
                        </div> <!-- .card-body -->
                        <div class="card-footer bg-transparent border-0 fname text-white">
                          <strong><span class="dot dot-lg bg-success mr-2 text-white"></span>Project Name 1</strong>
                        </div> <!-- .card-footer -->
                      </div> <!-- .card -->
                    </div> <!-- .col -->
                    <div class="col-md-3">
                      <div class="card shadow text-center mb-4 bg-green">
                        <div class="card-body file">
                          <div class="file-action">
                            <button type="button" class="btn btn-link dropdown-toggle more-vertical p-0 text-white mx-auto" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <span class="text-muted sr-only">Action</span>
                            </button>
                            <div class="dropdown-menu m-2">
                              <a class="dropdown-item" href="#"><i class="fe fe-delete fe-12 mr-4"></i>Delete</a>
                              <a class="dropdown-item" href="#"><i class="fe fe-share fe-12 mr-4"></i>Share</a>
                              <a class="dropdown-item" href="#"><i class="fe fe-download fe-12 mr-4"></i>Download</a>
                            </div>
                          </div>
                          <div class="circle circle-lg bg-green-light my-4">
                            <span class="fe fe-file fe-24 text-white"></span>
                          </div>
                         <div class="file-info">
                            <span class="badge badge-light text-muted mr-2">07 June</span>
                          </div>
                        </div> <!-- .card-body -->
                        <div class="card-footer bg-transparent border-0 fname text-white">
                          <span class="dot dot-lg bg-warning mr-2"></span>
                          <strong>Project name 2</strong>
                        </div> <!-- .card-footer -->
                      </div> <!-- .card -->
                    </div> <!-- .col -->
                    <div class="col-md-3">
                      <div class="card shadow text-center mb-4 bg-yellow">
                        <div class="card-body file">
                          <div class="file-action">
                            <button type="button" class="btn btn-link dropdown-toggle more-vertical p-0 text-white mx-auto" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <span class="text-muted sr-only">Action</span>
                            </button>
                            <div class="dropdown-menu m-2">
                              <a class="dropdown-item" href="#"><i class="fe fe-delete fe-12 mr-4"></i>Delete</a>
                              <a class="dropdown-item" href="#"><i class="fe fe-share fe-12 mr-4"></i>Share</a>
                              <a class="dropdown-item" href="#"><i class="fe fe-download fe-12 mr-4"></i>Download</a>
                            </div>
                          </div>
                          <div class="circle circle-lg bg-yellow-light my-4">
                            <span class="fe fe-file-text fe-24 text-success"></span>
                          </div>
                         <div class="file-info">
                            <span class="badge badge-light text-muted mr-2">07 June</span>
                          </div>
                        </div> <!-- .card-body -->
                        <div class="card-footer bg-transparent border-0 fname text-white">
                          <strong>Project name 3</strong>
                        </div> <!-- .card-footer -->
                      </div> <!-- .card -->
                    </div> <!-- .col -->
                    <div class="col-md-3">
                      <div class="card shadow text-center mb-4 bg-gold">
                        <div class="card-body file">
                          <div class="file-action">
                            <button type="button" class="btn btn-link dropdown-toggle more-vertical p-0 text-white mx-auto" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <span class="text-muted sr-only">Action</span>
                            </button>
                            <div class="dropdown-menu m-2">
                              <a class="dropdown-item" href="#"><i class="fe fe-delete fe-12 mr-4"></i>Delete</a>
                              <a class="dropdown-item" href="#"><i class="fe fe-share fe-12 mr-4"></i>Share</a>
                              <a class="dropdown-item" href="#"><i class="fe fe-download fe-12 mr-4"></i>Download</a>
                            </div>
                          </div>
                          <div class="circle circle-lg bg-gold-light my-4">
                            <span class="fe fe-file-text fe-24 text-white"></span>
                          </div>
                          <div class="file-info">
                            <span class="badge badge-light text-muted mr-2">07 June</span>
                          </div>
                        </div> <!-- .card-body -->
                        <div class="card-footer bg-transparent border-0 fname text-white">
                          <strong>Project name 4</strong>
                        </div> <!-- .card-footer -->
                      </div> <!-- .card -->
                    </div> <!-- .col -->
                  </div> <!-- .row -->
                  <hr class="my-4">
                   <h6 class="mb-3">Admin Reports</h6>
                  <div class="row my-4 pb-4">
                    <div class="col-md-3">
                      <div class="card shadow text-center mb-4">
                        <div class="card-body file">
                          <div class="file-action">
                            <button type="button" class="btn btn-link dropdown-toggle more-vertical p-0 text-muted mx-auto" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <span class="text-muted sr-only">Action</span>
                            </button>
                            <div class="dropdown-menu m-2">
                              <a class="dropdown-item" href="#"><i class="fe fe-chevrons-right fe-12 mr-4"></i>Move</a>
                              <a class="dropdown-item" href="#"><i class="fe fe-copy fe-12 mr-4"></i>Copy</a>
                              <a class="dropdown-item" href="#"><i class="fe fe-edit-3 fe-12 mr-4"></i>Rename</a>
                              <a class="dropdown-item" href="#"><i class="fe fe-delete fe-12 mr-4"></i>Delete</a>
                              <a class="dropdown-item" href="#"><i class="fe fe-share fe-12 mr-4"></i>Share</a>
                              <a class="dropdown-item" href="#"><i class="fe fe-download fe-12 mr-4"></i>Download</a>
                            </div>
                          </div>
                          <div class="circle circle-lg bg-light my-4">
                            <span class="fe fe-file fe-24 text-secondary"></span>
                          </div>
                        </div> <!-- .card-body -->
                        <div class="card-footer bg-transparent border-0 fname">
                          <strong>Project1</strong>
                        </div> <!-- .card-footer -->
                      </div> <!-- .card -->
                    </div> <!-- .col -->
                    <div class="col-md-3">
                      <div class="card shadow text-center mb-4">
                        <div class="card-body file">
                          <div class="file-action">
                            <button type="button" class="btn btn-link dropdown-toggle more-vertical p-0 text-muted mx-auto" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <span class="text-muted sr-only">Action</span>
                            </button>
                            <div class="dropdown-menu m-2">
                              <a class="dropdown-item" href="#"><i class="fe fe-delete fe-12 mr-4"></i>Delete</a>
                              <a class="dropdown-item" href="#"><i class="fe fe-share fe-12 mr-4"></i>Share</a>
                              <a class="dropdown-item" href="#"><i class="fe fe-download fe-12 mr-4"></i>Download</a>
                            </div>
                          </div>
                          <div class="circle circle-lg bg-light my-4">
                            <span class="fe fe-file fe-24 text-info"></span>
                          </div>
                          
                        </div> <!-- .card-body -->
                        <div class="card-footer bg-transparent border-0 fname">
                          <strong>Project 2</strong>
                        </div> <!-- .card-footer -->
                      </div> <!-- .card -->
                    </div> <!-- .col -->
                    <div class="col-md-3">
                      <div class="card shadow text-center mb-4">
                        <div class="card-body file">
                          <div class="file-action">
                            <button type="button" class="btn btn-link dropdown-toggle more-vertical p-0 text-muted mx-auto" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <span class="text-muted sr-only">Action</span>
                            </button>
                            <div class="dropdown-menu m-2">
                              <a class="dropdown-item" href="#"><i class="fe fe-delete fe-12 mr-4"></i>Delete</a>
                              <a class="dropdown-item" href="#"><i class="fe fe-share fe-12 mr-4"></i>Share</a>
                              <a class="dropdown-item" href="#"><i class="fe fe-download fe-12 mr-4"></i>Download</a>
                            </div>
                          </div>
                          <div class="circle circle-lg bg-light my-4">
                            <span class="fe fe-file fe-24 text-success"></span>
                          </div>
                        </div> <!-- .card-body -->
                        <div class="card-footer bg-transparent border-0 fname">
                          <strong>Project 3</strong>
                        </div> <!-- .card-footer -->
                      </div> <!-- .card -->
                    </div> <!-- .col -->
                    <div class="col-md-3">
                      <div class="card shadow text-center mb-4">
                        <div class="card-body file">
                          <div class="file-action">
                            <button type="button" class="btn btn-link dropdown-toggle more-vertical p-0 text-muted mx-auto" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <span class="text-muted sr-only">Action</span>
                            </button>
                            <div class="dropdown-menu m-2">
                              <a class="dropdown-item" href="#"><i class="fe fe-delete fe-12 mr-4"></i>Delete</a>
                              <a class="dropdown-item" href="#"><i class="fe fe-share fe-12 mr-4"></i>Share</a>
                              <a class="dropdown-item" href="#"><i class="fe fe-download fe-12 mr-4"></i>Download</a>
                            </div>
                          </div>
                          <div class="circle circle-lg bg-light my-4">
                            <span class="fe fe-file fe-24 text-success"></span>
                          </div>
                         
                        </div> <!-- .card-body -->
                        <div class="card-footer bg-transparent border-0 fname">
                          <strong>Project 4</strong>
                        </div> <!-- .card-footer -->
                      </div> <!-- .card -->
                    </div> <!-- .col -->
                    <div class="col-md-3">
                      <div class="card shadow text-center mb-4">
                        <div class="card-body file">
                          <div class="file-action">
                            <button type="button" class="btn btn-link dropdown-toggle more-vertical p-0 text-muted mx-auto" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <span class="text-muted sr-only">Action</span>
                            </button>
                            <div class="dropdown-menu m-2">
                              <a class="dropdown-item" href="#"><i class="fe fe-delete fe-12 mr-4"></i>Delete</a>
                              <a class="dropdown-item" href="#"><i class="fe fe-share fe-12 mr-4"></i>Share</a>
                              <a class="dropdown-item" href="#"><i class="fe fe-download fe-12 mr-4"></i>Download</a>
                            </div>
                          </div>
                          <div class="circle circle-lg bg-light my-4">
                            <span class="fe fe-file fe-24 text-success"></span>
                          </div>
                         
                        </div> <!-- .card-body -->
                        <div class="card-footer bg-transparent border-0 fname">
                          <strong>Project 5</strong>
                        </div> <!-- .card-footer -->
                      </div> <!-- .card -->
                    </div> <!-- .col -->
                    <div class="col-md-3">
                      <div class="card shadow text-center mb-4">
                        <div class="card-body file">
                          <div class="file-action">
                            <button type="button" class="btn btn-link dropdown-toggle more-vertical p-0 text-muted mx-auto" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <span class="text-muted sr-only">Action</span>
                            </button>
                            <div class="dropdown-menu m-2">
                              <a class="dropdown-item" href="#"><i class="fe fe-delete fe-12 mr-4"></i>Delete</a>
                              <a class="dropdown-item" href="#"><i class="fe fe-share fe-12 mr-4"></i>Share</a>
                              <a class="dropdown-item" href="#"><i class="fe fe-download fe-12 mr-4"></i>Download</a>
                            </div>
                          </div>
                          <div class="circle circle-lg bg-light my-4">
                            <span class="fe fe-file-text fe-24 text-success"></span>
                          </div>
                         
                        </div> <!-- .card-body -->
                        <div class="card-footer bg-transparent border-0 fname">
                          <strong>Project 6</strong>
                        </div> <!-- .card-footer -->
                      </div> <!-- .card -->
                    </div> <!-- .col -->
                    <div class="col-md-3">
                      <div class="card shadow text-center mb-4">
                        <div class="card-body file">
                          <div class="file-action">
                            <button type="button" class="btn btn-link dropdown-toggle more-vertical p-0 text-muted mx-auto" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <span class="text-muted sr-only">Action</span>
                            </button>
                            <div class="dropdown-menu m-2">
                              <a class="dropdown-item" href="#"><i class="fe fe-delete fe-12 mr-4"></i>Delete</a>
                              <a class="dropdown-item" href="#"><i class="fe fe-share fe-12 mr-4"></i>Share</a>
                              <a class="dropdown-item" href="#"><i class="fe fe-download fe-12 mr-4"></i>Download</a>
                            </div>
                          </div>
                          <div class="circle circle-lg bg-light my-4">
                            <span class="fe fe-file fe-24 text-success"></span>
                          </div>
                          <div class="file-info">
                            <span class="badge badge-light text-muted mr-2">2M</span>
                            <span class="badge badge-pill badge-light text-muted">Mp3</span>
                          </div>
                        </div> <!-- .card-body -->
                        <div class="card-footer bg-transparent border-0 fname">
                          <strong>Project 8</strong>
                        </div> <!-- .card-footer -->
                      </div> <!-- .card -->
                    </div> <!-- .col -->
                  </div> <!-- .row -->
                  <hr class="my-4">
                  <h6 class="mb-3">HRM Reports</h6>
                  <div class="row my-4 pb-4">
                    <div class="col-md-3">
                      <div class="card shadow text-center mb-4">
                        <div class="card-body file">
                          <div class="file-action">
                            <button type="button" class="btn btn-link dropdown-toggle more-vertical p-0 text-muted mx-auto" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <span class="text-muted sr-only">Action</span>
                            </button>
                            <div class="dropdown-menu m-2">
                              <a class="dropdown-item" href="#"><i class="fe fe-chevrons-right fe-12 mr-4"></i>Move</a>
                              <a class="dropdown-item" href="#"><i class="fe fe-copy fe-12 mr-4"></i>Copy</a>
                              <a class="dropdown-item" href="#"><i class="fe fe-edit-3 fe-12 mr-4"></i>Rename</a>
                              <a class="dropdown-item" href="#"><i class="fe fe-delete fe-12 mr-4"></i>Delete</a>
                              <a class="dropdown-item" href="#"><i class="fe fe-share fe-12 mr-4"></i>Share</a>
                              <a class="dropdown-item" href="#"><i class="fe fe-download fe-12 mr-4"></i>Download</a>
                            </div>
                          </div>
                          <div class="circle circle-lg bg-light my-4">
                            <span class="fe fe-file fe-24 text-secondary"></span>
                          </div>
                         
                        </div> <!-- .card-body -->
                        <div class="card-footer bg-transparent border-0 fname">
                          <strong>Project1</strong>
                        </div> <!-- .card-footer -->
                      </div> <!-- .card -->
                    </div> <!-- .col -->
                    <div class="col-md-3">
                      <div class="card shadow text-center mb-4">
                        <div class="card-body file">
                          <div class="file-action">
                            <button type="button" class="btn btn-link dropdown-toggle more-vertical p-0 text-muted mx-auto" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <span class="text-muted sr-only">Action</span>
                            </button>
                            <div class="dropdown-menu m-2">
                              <a class="dropdown-item" href="#"><i class="fe fe-delete fe-12 mr-4"></i>Delete</a>
                              <a class="dropdown-item" href="#"><i class="fe fe-share fe-12 mr-4"></i>Share</a>
                              <a class="dropdown-item" href="#"><i class="fe fe-download fe-12 mr-4"></i>Download</a>
                            </div>
                          </div>
                          <div class="circle circle-lg bg-light my-4">
                            <span class="fe fe-file fe-24 text-info"></span>
                          </div>
                          
                        </div> <!-- .card-body -->
                        <div class="card-footer bg-transparent border-0 fname">
                          <strong>Project 2</strong>
                        </div> <!-- .card-footer -->
                      </div> <!-- .card -->
                    </div> <!-- .col -->
                    <div class="col-md-3">
                      <div class="card shadow text-center mb-4">
                        <div class="card-body file">
                          <div class="file-action">
                            <button type="button" class="btn btn-link dropdown-toggle more-vertical p-0 text-muted mx-auto" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <span class="text-muted sr-only">Action</span>
                            </button>
                            <div class="dropdown-menu m-2">
                              <a class="dropdown-item" href="#"><i class="fe fe-delete fe-12 mr-4"></i>Delete</a>
                              <a class="dropdown-item" href="#"><i class="fe fe-share fe-12 mr-4"></i>Share</a>
                              <a class="dropdown-item" href="#"><i class="fe fe-download fe-12 mr-4"></i>Download</a>
                            </div>
                          </div>
                          <div class="circle circle-lg bg-light my-4">
                            <span class="fe fe-file fe-24 text-success"></span>
                          </div>
                        </div> <!-- .card-body -->
                        <div class="card-footer bg-transparent border-0 fname">
                          <strong>Project 3</strong>
                        </div> <!-- .card-footer -->
                      </div> <!-- .card -->
                    </div> <!-- .col -->
                    <div class="col-md-3">
                      <div class="card shadow text-center mb-4">
                        <div class="card-body file">
                          <div class="file-action">
                            <button type="button" class="btn btn-link dropdown-toggle more-vertical p-0 text-muted mx-auto" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <span class="text-muted sr-only">Action</span>
                            </button>
                            <div class="dropdown-menu m-2">
                              <a class="dropdown-item" href="#"><i class="fe fe-delete fe-12 mr-4"></i>Delete</a>
                              <a class="dropdown-item" href="#"><i class="fe fe-share fe-12 mr-4"></i>Share</a>
                              <a class="dropdown-item" href="#"><i class="fe fe-download fe-12 mr-4"></i>Download</a>
                            </div>
                          </div>
                          <div class="circle circle-lg bg-light my-4">
                            <span class="fe fe-file fe-24 text-success"></span>
                          </div>
                         
                        </div> <!-- .card-body -->
                        <div class="card-footer bg-transparent border-0 fname">
                          <strong>Project 4</strong>
                        </div> <!-- .card-footer -->
                      </div> <!-- .card -->
                    </div> <!-- .col -->
                    <div class="col-md-3">
                      <div class="card shadow text-center mb-4">
                        <div class="card-body file">
                          <div class="file-action">
                            <button type="button" class="btn btn-link dropdown-toggle more-vertical p-0 text-muted mx-auto" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <span class="text-muted sr-only">Action</span>
                            </button>
                            <div class="dropdown-menu m-2">
                              <a class="dropdown-item" href="#"><i class="fe fe-delete fe-12 mr-4"></i>Delete</a>
                              <a class="dropdown-item" href="#"><i class="fe fe-share fe-12 mr-4"></i>Share</a>
                              <a class="dropdown-item" href="#"><i class="fe fe-download fe-12 mr-4"></i>Download</a>
                            </div>
                          </div>
                          <div class="circle circle-lg bg-light my-4">
                            <span class="fe fe-file fe-24 text-success"></span>
                          </div>
                         
                        </div> <!-- .card-body -->
                        <div class="card-footer bg-transparent border-0 fname">
                          <strong>Project 5</strong>
                        </div> <!-- .card-footer -->
                      </div> <!-- .card -->
                    </div> <!-- .col -->
                    <div class="col-md-3">
                      <div class="card shadow text-center mb-4">
                        <div class="card-body file">
                          <div class="file-action">
                            <button type="button" class="btn btn-link dropdown-toggle more-vertical p-0 text-muted mx-auto" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <span class="text-muted sr-only">Action</span>
                            </button>
                            <div class="dropdown-menu m-2">
                              <a class="dropdown-item" href="#"><i class="fe fe-delete fe-12 mr-4"></i>Delete</a>
                              <a class="dropdown-item" href="#"><i class="fe fe-share fe-12 mr-4"></i>Share</a>
                              <a class="dropdown-item" href="#"><i class="fe fe-download fe-12 mr-4"></i>Download</a>
                            </div>
                          </div>
                          <div class="circle circle-lg bg-light my-4">
                            <span class="fe fe-file-text fe-24 text-success"></span>
                          </div>
                         
                        </div> <!-- .card-body -->
                        <div class="card-footer bg-transparent border-0 fname">
                          <strong>Project 6</strong>
                        </div> <!-- .card-footer -->
                      </div> <!-- .card -->
                    </div> <!-- .col -->
                    <div class="col-md-3">
                      <div class="card shadow text-center mb-4">
                        <div class="card-body file">
                          <div class="file-action">
                            <button type="button" class="btn btn-link dropdown-toggle more-vertical p-0 text-muted mx-auto" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <span class="text-muted sr-only">Action</span>
                            </button>
                            <div class="dropdown-menu m-2">
                              <a class="dropdown-item" href="#"><i class="fe fe-delete fe-12 mr-4"></i>Delete</a>
                              <a class="dropdown-item" href="#"><i class="fe fe-share fe-12 mr-4"></i>Share</a>
                              <a class="dropdown-item" href="#"><i class="fe fe-download fe-12 mr-4"></i>Download</a>
                            </div>
                          </div>
                          <div class="circle circle-lg bg-light my-4">
                            <span class="fe fe-file fe-24 text-success"></span>
                          </div>
                          <div class="file-info">
                            <span class="badge badge-light text-muted mr-2">2M</span>
                            <span class="badge badge-pill badge-light text-muted">Mp3</span>
                          </div>
                        </div> <!-- .card-body -->
                        <div class="card-footer bg-transparent border-0 fname">
                          <strong>Project 8</strong>
                        </div> <!-- .card-footer -->
                      </div> <!-- .card -->
                    </div> <!-- .col -->
                  </div> <!-- .row -->
                </div> <!-- .file-panel -->
               
              </div> <!-- .file-container -->
            </div> <!-- .col -->
          </div> <!-- .row -->
        </div> <!-- .container-fluid -->
        @include('partials.footer')
      </main> 