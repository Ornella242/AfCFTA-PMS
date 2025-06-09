@include('partials.navbar')
<main role="main" class="main-content">
        <div class="container-fluid">
          <div class="row justify-content-center">
            <div class="col-12">
                <div class="row align-items-center mb-4">
                    <div class="col">
                        <h2 class="mb-2 page-title text-maroon">Users</h2>
                    </div>
                    <div class="col-auto">
                      <button type="button" class="btn mb-2 bg-green  text-white" data-toggle="modal" data-target="#varyModalUser" data-whatever="@mdo"><i class="fe fe-user-plus mx-1"></i>Add new user</button>
                        <div class="modal fade" id="varyModalUser" tabindex="-1" role="dialog" aria-labelledby="varyModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="varyModalLabel">New user</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                <div class="modal-body">
                                <form action="" method="POST">
                                    @csrf
                                    <!-- Firstname -->
                                    <div class="form-group">
                                    <label for="first">Firstname</label>
                                    <input type="text" class="form-control" id="firstname" name="firstname" placeholder="Enter firstname" required>
                                    </div>
                                    <div class="form-group">
                                    <label for="last">Lastname</label>
                                    <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Enter lastname" required>
                                    </div>
                                    <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter email " required>
                                    </div>  
                                    <!-- Role & Unit -->
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
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn bg-green text-white">Add user</button>
                                </div>
                                </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
              <div class="row my-4">
                <!-- Small table -->
                <div class="col-md-12">
                  <div class="card shadow">
                    <div class="card-body">
                      <!-- table -->
                      <table class="table datatables" id="dataTable-1">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Unit</th>
                            <th>Role</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>0001</td>
                                <td>Imani Lara</td>
                                <td>imanilara@au-afcfta.org</td>
                                <td>Facilities</td>
                                <td><i class="fe fe-user text-maroon"></i> Project Manager</td>
                                <td><button class="btn btn-sm dropdown-toggle more-horizontal" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
                                <td>0002</td>
                                <td>Imani Lara</td>
                                <td>imanilara@au-afcfta.org</td>
                                <td>IT</td>
                                <td><i class="fe fe-user text-maroon"></i> Project Manager</td>
                                <td><button class="btn btn-sm dropdown-toggle more-horizontal" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
                                <td>0003</td>
                                <td>Imani Lara</td>
                                <td>imanilara@au-afcfta.org</td>
                                <td>Procurement</td>
                                <td><i class="fe fe-shield text-green"></i> Admin</td>
                                <td><button class="btn btn-sm dropdown-toggle more-horizontal" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
                                <td>0004</td>
                                <td>Imani Lara</td>
                                <td>imanilara@au-afcfta.org</td>
                                <td>HR</td>
                                <td><i class="fe fe-user text-maroon"></i> Project Manager</td>
                                <td><button class="btn btn-sm dropdown-toggle more-horizontal" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
                                <td>0005</td>
                                <td>Imani Lara</td>
                                <td>imanilara@au-afcfta.org</td>
                                <td>HR</td>
                                <td><i class="fe fe-shield text-green"></i> Admin</td>
                                <td><button class="btn btn-sm dropdown-toggle more-horizontal" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
                                <td>0006</td>
                                <td>Imani Lara</td>
                                <td>imanilara@au-afcfta.org</td>
                                <td>Facilities</td>
                                <td><i class="fe fe-users text-yellow"></i> PM Assistant</td>
                                <td><button class="btn btn-sm dropdown-toggle more-horizontal" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
                                <td>0007</td>
                                <td>Imani Lara</td>
                                <td>imanilara@au-afcfta.org</td>
                                <td>Facilities</td>
                                <td><i class="fe fe-user text-maroon"></i> Project Manager</td>
                                <td><button class="btn btn-sm dropdown-toggle more-horizontal" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
                                <td>0008</td>
                                <td>Imani Lara</td>
                                <td>imanilara@au-afcfta.org</td>
                                <td>Facilities</td>
                                <td><i class="fe fe-users text-yellow"></i> PM Assistant</td>
                                <td><button class="btn btn-sm dropdown-toggle more-horizontal" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
                                <td>0009</td>
                                <td>Imani Lara</td>
                                <td>imanilara@au-afcfta.org</td>
                                <td>Facilities</td>
                                <td><i class="fe fe-user text-maroon"></i> Project Manager</td>
                                <td><button class="btn btn-sm dropdown-toggle more-horizontal" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
                                <td>0010</td>
                                <td>Imani Lara</td>
                                <td>imanilara@au-afcfta.org</td>
                                <td>Facilities</td>
                                <td><i class="fe fe-users text-yellow"></i> PM Assistant</td>
                                <td><button class="btn btn-sm dropdown-toggle more-horizontal" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
                    </div>
                  </div>
                </div> <!-- simple table -->
              </div> <!-- end section -->
            </div> <!-- .col-12 -->
          </div> <!-- .row -->
        </div> <!-- .container-fluid -->   
</main>
<script src="{{ asset('js/apps.js') }}"></script>
<script src="https://unpkg.com/feather-icons"></script>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-56159088-1"></script>
<script>
    window.dataLayer = window.dataLayer || [];

    function gtag()
    {
    dataLayer.push(arguments);
    }
    gtag('js', new Date());
    gtag('config', 'UA-56159088-1');
</script>
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/popper.min.js') }}"></script>
<script src="{{ asset('js/moment.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/simplebar.min.js') }}"></script>
<script src='{{ asset('js/daterangepicker.js') }}'></script>
<script src='{{ asset('js/jquery.stickOnScroll.js') }}'></script>
<script src="{{ asset('js/tinycolor-min.js') }}"></script>
<script src="{{ asset('js/config.js') }}"></script>
<script src='{{ asset('js/jquery.dataTables.min.js') }}'></script>
<script src='{{ asset('js/dataTables.bootstrap4.min.js') }}'></script>
<script>
    $('#dataTable-1').DataTable(
    {
    autoWidth: true,
    "lengthMenu": [
        [16, 32, 64, -1],
        [16, 32, 64, "All"]
    ]
    });
</script>
<script src="{{ asset('js/apps.js') }}"></script>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-56159088-1"></script>
<script>
    window.dataLayer = window.dataLayer || [];

    function gtag()
    {
    dataLayer.push(arguments);
    }
    gtag('js', new Date());
    gtag('config', 'UA-56159088-1');
</script>
