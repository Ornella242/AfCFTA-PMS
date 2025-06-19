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
                                <form action="{{ route('users.store') }}" method="POST">
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
                                         <select name="unit_id" id="unit" class="form-control">
                                            @foreach($units as $unit)
                                                <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                        <div class="form-group col-md-6">
                                        <label for="role">Role</label>
                                        <select id="role" class="form-control" name='role_id'>
                                                @foreach($roles as $role)
                                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                                @endforeach
                                        </select>
                                    </div>
                                    </div>
                                    <!-- Footer -->
                                    <div class="modal-footer">
                                        <button type="submit" class="btn bg-green text-white">
                                            <i class="fe fe-user-plus mx-1"></i>Add
                                        </button>
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
                            @foreach($users as $index => $user)
                                <tr>
                                    <td>{{ str_pad($user->id, 4, '0', STR_PAD_LEFT) }}</td>
                                    <td>{{ $user->firstname }} {{ $user->lastname }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->unit->name ?? '—' }}</td>
                                    @php
                                        $icon = 'fe fe-user';
                                        $color = 'text-muted'; // couleur par défaut

                                        if ($user->role->name === 'Admin') {
                                            $icon = 'fe fe-shield';
                                            $color = 'text-danger';
                                        } elseif ($user->role->name === 'Project Manager') {
                                            $icon = 'fe fe-user-check';
                                            $color = 'text-maroon';
                                        } elseif ($user->role->name === 'Project Manager Assistant') {
                                            $icon = 'fe fe-user';
                                            $color = 'text-green';
                                        } elseif ($user->role->name === 'Member') {
                                            $icon = 'fe fe-users';
                                            $color = 'text-gold';
                                        }
                                    @endphp

                                    <td><i class="{{ $icon }} {{ $color }}"></i> {{ $user->role->name ?? '—' }}</td>
                                    {{-- <td>{{ $user->role->name ?? '—' }}</td> --}}

                                     <!-- Action column -->
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-2">
                                            <!-- Edit -->
                                            <a href="#" class="text-primary text-decoration-none"
                                            data-toggle="modal"
                                            data-target="#editUserModal"
                                            data-id="{{ $user->id }}"
                                            data-firstname="{{ $user->firstname }}"
                                            data-lastname="{{ $user->lastname }}"
                                            data-email="{{ $user->email }}"
                                            data-unit_id="{{ $user->unit_id }}"
                                            data-role_id="{{ $user->role_id }}"
                                            title="Edit">
                                                <i class="fe fe-edit-2"></i>
                                            </a>
                                          
                                            <!-- Remove -->
                                            <form method="POST" action="{{ route('users.destroy', $user->id) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-link text-danger p-0 m-0 text-decoration-none" title="Remove" onclick="return confirm('Are you sure?')">
                                                    <i class="fe fe-trash-2"></i>
                                                </button>
                                            </form>
                                            <!-- Assign -->
                                            {{-- <a href="{{ route('users.assign', $user->id) }}" class="text-warning text-decoration-none" title="Assign">
                                                <i class="fe fe-user-plus"></i>
                                            </a> --}}
                                        </div>
                                    </td>


                                </tr>
                            @endforeach
                        </tbody>

                      </table>
                      <!-- Edit User Modal -->
                        <div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <form method="POST" action="" id="editUserForm">
                                @csrf
                                @method('PUT')
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title">Edit User</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span>&times;</span>
                                    </button>
                                    </div>
                                    <div class="modal-body">
                                        <input type="hidden" name="user_id" id="edit_user_id">

                                        <div class="form-group">
                                            <label for="firstname">Firstname</label>
                                            <input type="text" name="firstname" id="edit_firstname" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="lastname">Lastname</label>
                                            <input type="text" name="lastname" id="edit_lastname" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" name="email" id="edit_email" class="form-control" required>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="unit">Unit</label>
                                                <select name="unit_id" id="edit_unit_id" class="form-control">
                                                    @foreach($units as $unit)
                                                        <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="role">Role</label>
                                                <select name="role_id" id="edit_role_id" class="form-control">
                                                    @foreach($roles as $role)
                                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                    <button type="submit" class="btn bg-green text-white">
                                        <i class="fe fe-save"></i> Save
                                    </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        </div>

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

<script>
    $('#editUserModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)

        var id = button.data('id');
        var firstname = button.data('firstname');
        var lastname = button.data('lastname');
        var email = button.data('email');
        var unit_id = button.data('unit_id');
        var role_id = button.data('role_id');

        var modal = $(this);
        modal.find('#edit_firstname').val(firstname);
        modal.find('#edit_lastname').val(lastname);
        modal.find('#edit_email').val(email);
        modal.find('#edit_unit_id').val(unit_id);
        modal.find('#edit_role_id').val(role_id);
        modal.find('#editUserForm').attr('action', '/users/' + id); // Route vers UserController@update
    });
</script>

