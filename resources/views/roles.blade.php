@include('partials.navbar')
<main role="main" class="main-content">
        <div class="container-fluid">
          <div class="row justify-content-center">
            <div class="col-12">
                <div class="row align-items-center mb-4">
                    <div class="col">
                        <h2 class="mb-2 page-title text-black">Roles</h2>
                    </div>
                    <div class="col-auto">
                      <button type="button" class="btn mb-2 bg-green  text-white" data-toggle="modal" data-target="#varyModalRole" data-whatever="@mdo"><i class="fe fe-user-plus mx-1"></i>Assign role</button>
                        <div class="modal fade" id="varyModalRole" tabindex="-1" role="dialog" aria-labelledby="varyModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="varyModalLabel">Assign role</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                <div class="modal-body">
                                <form action="" method="POST">
                                    @csrf
                                    <!-- Role & User -->
                                    <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="unit">User</label>
                                        <select class="form-control" id="unit" name="unit">
                                        <option value="Imani">Imani Lamani</option>
                                        <option value="Imani">Imani Lamani</option>
                                        <option value="Imani">Imani Lamani</option>
                                        <option value="Imani">Imani Lamani</option>
                                        <option value="Imani">Imani Lamani</option>
                                        <option value="Imani">Imani Lamani</option>
                                        </select>
                                    </div>
                                        <div class="form-group col-md-6">
                                        <label for="role">Role</label>
                                        <select class="form-control" id="partner" name="partner">
                                            <option value="admin">Admin</option>
                                            <option value="pm">Project Manager</option>
                                            <option value="pma">PM Assistant</option>
                                        </select>
                                    </div>
                                    </div>
                                <!-- Footer -->
                                <div class="modal-footer">
                                    <button type="submit" class="btn bg-green text-white">Assign</button>
                                </div>
                                </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
             </div>
              <!-- info small box -->
              <div class="row">
                <div class="col-md-4 mb-4">
                  <div class="card shadow bg-gold">
                    <div class="card-body">
                      <div class="row align-items-center">
                        <div class="col">
                          <span class="h3 text-white mb-0">Administrator</span>
                          <p class="small text-white mb-0">Full access on the system</p>
                          <span class="badge badge-pill bg-green mt-1 mb-1 text-white">5 users</span>
                        </div>
                        <div class="col-auto">
                          <span class="fe fe-32 fe-shield text-white mb-0"></span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-4 mb-4">
                  <div class="card shadow bg-maroon">
                    <div class="card-body">
                      <div class="row align-items-center">
                        <div class="col">
                          <span class="h3 mb-0 text-white">Project Manager</span>
                          <p class="small text-white mb-0">Half access on the system</p>
                          <span class="badge badge-pill bg-green text-white mt-1 mb-1">4 users</span>
                        </div>
                        <div class="col-auto">
                          <span class="fe fe-32 fe-user text-white mb-0"></span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-4 mb-4">
                  <div class="card shadow bg-yellow">
                    <div class="card-body">
                      <div class="row align-items-center">
                        <div class="col">
                          <span class="h3 mb-0 text-white">Project Manager Assistant</span>
                          <p class="small text-white mb-0">Low access on the system</p>
                          <span class="badge badge-pill bg-green text-white mt-1 mb-1">3 users</span>
                        </div>
                        <div class="col-auto">
                          <span class="fe fe-32 fe-users text-white mb-0"></span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div> <!-- end section -->
               <div class="col-md-12">
                  <h6 class="h5 mb-3">Role details</h6>
                  <table class="table table-borderless table-striped">
                    <thead>
                      <tr role="row">
                        <th>ID</th>
                        <th>Name</th>
                        <th>Unit</th>
                        <th>Project assigned</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="col">0008</th>
                            <td>Imani Lamani</td>
                            <td>HRM</td>
                            <td>AfCFTA Recruitment </td>
                            <td>
                            {{-- <td>
                                <i class="fe fe-eye fe-16"></i> 
                            </td> --}}
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
                            <th scope="col">0008</th>
                            <td>Imani Lamani</td>
                            <td>HRM</td>
                            <td>AfCFTA Recruitment </td>
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
                            <th scope="col">0008</th>
                            <td>Imani Lamani</td>
                            <td>HRM</td>
                            <td>AfCFTA Recruitment </td>
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
                            <th scope="col">0008</th>
                            <td>Imani Lamani</td>
                            <td>HRM</td>
                            <td>AfCFTA Recruitment </td>
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
                            <th scope="col">0008</th>
                            <td>Imani Lamani</td>
                            <td>HRM</td>
                            <td>AfCFTA Recruitment </td>
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
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div> <!-- .row -->
        </div> <!-- .container-fluid -->
        @include('partials.footer')
      </main>