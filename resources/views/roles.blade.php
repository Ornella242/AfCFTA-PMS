@include('partials.navbar')
 <div id="loading-spinner" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(255,255,255,0.7); z-index: 9999; justify-content: center; align-items: center;">
  <div class="spinner-grow mr-3 text-success" role="status" style="width: 3rem; height: 3rem;">
    <span class="sr-only">Loading...</span>
  </div>
</div>
<main role="main" class="main-content fade-in" id="page-transition">
        <div class="container-fluid">
          <div class="row justify-content-center">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center mt-3 flex-wrap">
                    <!-- Back Button -->
                    <div>
                        <a href="{{ url()->previous() }}" class="btn btn-outline-success btn-back shadow-sm transition-all">
                            <i class="fe fe-arrow-left mr-2"></i> Back
                        </a>
                    </div>

                    <!-- Page Title -->
                    <div>
                        <h2 class="mb-0 page-title text-black">List of roles</h2>
                    </div>

                    <!-- Assign Role Button -->
                    <div>
                        <button type="button" class="btn bg-green text-white" data-toggle="modal" data-target="#assignRoleModal">
                            <i class="fe fe-user-plus mx-1"></i> Assign role
                        </button>
                         <!-- Modal -->
                       
                    </div>
                </div>

                <div class="row align-items-center mb-4">
                    <div class="col">
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
                </div>
             </div>
              <div class="row">
                @foreach($roles as $role)
                <div class="col-md-4 mb-4">
                    <div class="card shadow {{ 
                         $role->name === 'Admin' ? 'bg-gold' : 
                        ($role->name === 'Project Manager' ? 'bg-maroon' : 
                        ($role->name === 'Project Manager Assistant' ? 'bg-yellow' : 'bg-green')) }}"
                        data-role-id="{{ $role->id }}"
                        style="cursor: pointer;"
                        onclick="loadRoleUsers({{ $role->id }})">
                        
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col">
                                    <span class="h3 text-white mb-0">{{ $role->name }}</span>
                                    <p class="small text-white mb-0">
                                        @if($role->name === 'Admin') Full access on the system
                                        @elseif($role->name === 'Project Manager') Full access on the system
                                        @else Low access on the system @endif
                                    </p>
                                    <span class="badge badge-pill bg-green mt-1 mb-1 text-white">
                                        {{ $role->users_count }} user{{ $role->users_count > 1 ? 's' : '' }}
                                    </span>
                                </div>
                                <div class="col-auto">
                                    <span class="fe fe-32 {{ 
                                        $role->name === 'Admin' ? 'fe-shield' : 
                                        ($role->name === 'Project Manager' ? 'fe-user' : 'fe-users') }} text-white mb-0">
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
              </div>

              <div class="col-md-12">
                   <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="h5 mb-0">Role details</h6>
                        <div class="form-group mb-0">
                            <input type="text" class="form-control" id="searchUserInput" placeholder="Search by name..." style="width: 250px;">
                        </div>
                    </div>


                  <table class="table table-borderless table-striped">
                    <thead>
                      <tr role="row">
                        <th>ID</th>
                        <th>Name</th>
                        <th>Unit</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody id="roleUsersTableBody">
                        <tr><td colspan="4" class="text-muted">Click on a role card to see details.</td></tr>
                    </tbody>

                  </table>
                </div>
              </div>
            </div>
          </div> <!-- .row -->
        </div> <!-- .container-fluid -->
        @include('partials.footer')
        <!-- Modal de modification du rôle -->
        <div class="modal fade" id="editUserRoleModal" tabindex="-1" role="dialog" aria-labelledby="editRoleLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form method="POST" id="editUserRoleForm">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="editRoleLabel">Change User Role</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span>&times;</span>
                </button>
                </div>
                <div class="modal-body">
                <p id="editUserName" class="mb-2 font-weight-bold"></p>
                <div class="form-group">
                    <label for="roleSelect">Select New Role</label>
                    <select class="form-control" id="roleSelect" name="role_id" required>
                    @foreach ($roles as $role)
                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                    @endforeach
                    </select>
                </div>
                </div>
                <div class="modal-footer">
                <input type="hidden" id="editUserId" name="user_id">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </div>
            </form>
        </div>
        </div>
 <div class="modal fade" id="assignRoleModal" tabindex="-1" role="dialog" aria-labelledby="assignRoleLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <form method="POST" action="{{ route('assign.role') }}">
                                    @csrf
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="assignRoleLabel">Assign role</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <div class="modal-body">
                                            <!-- User & Role Selection -->
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="user_id">User</label>
                                                    <select class="form-control" id="user_id" name="user_id" required>
                                                        <option value="">-- Select a user --</option>
                                                        @foreach($users as $user)
                                                            <option value="{{ $user->id }}">{{ $user->firstname }} {{ $user->lastname }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="role_id">Role</label>
                                                    <select class="form-control" id="role_id" name="role_id" required>
                                                        @foreach($roles as $role)
                                                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="submit" class="btn bg-green text-white">Assign</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
      </main>
      <script>

          function loadRoleUsers(roleId) {
              fetch(`/roles/${roleId}/users`)
                  .then(response => response.json())
                  .then(data => {
                      const tbody = document.getElementById('roleUsersTableBody');
                      tbody.innerHTML = '';
          
                      if (data.users.length === 0) {
                          tbody.innerHTML = '<tr><td colspan="4" class="text-muted">No users for this role.</td></tr>';
                          return;
                      }
          
                      data.users.forEach(user => {
                          let unitIcon = '';
                          switch (user.unit) {
                              case 'IT':
                                  unitIcon = '<i class="fe fe-monitor text-primary mr-1" title="IT"></i>';
                                  break;
                              case 'Medical':
                                  unitIcon = '<i class="fe fe-activity text-danger mr-1" title="Medical"></i>';
                                  break;
                              case 'HR':
                                  unitIcon = '<i class="fe fe-users text-success mr-1" title="HR"></i>';
                                  break;
                              case 'Procurement & Travel':
                                  unitIcon = '<i class="fe fe-shopping-cart text-warning mr-1" title="Procurement"></i>';
                                  break;
                              case 'Facilities & Transport':
                                  unitIcon = '<i class="fe fe-home text-info mr-1" title="Facilities"></i>';
                                  break;
                              case 'Stores':
                                  unitIcon = '<i class="fe fe-box text-purple mr-1" title="Stores"></i>';
                                  break;
                              default:
                                  unitIcon = '<i class="fe fe-layers text-muted mr-1" title="Other"></i>';
                          }
          
                          const row = document.createElement('tr');
                          row.innerHTML = `
                              <th scope="row">${user.id}</th>
                              <td>${user.name}</td>
                              <td>${unitIcon}${user.unit}</td>
                              <td>
                                  <button class="btn btn-sm btn-link text-dark p-0" 
                                          title="Edit user role"
                                          onclick="openRoleEditModal(${user.id}, '${user.name}')">
                                      <i class="fe fe-edit-2 text-green"></i>
                                  </button>
                              </td>
                          `;
                          tbody.appendChild(row);
                      });
                  })
                  .catch(error => {
                      console.error('Error loading role users:', error);
                  });
          }
      </script>


<script>
    function openRoleEditModal(userId, userName) {
        document.getElementById('editUserId').value = userId;
        document.getElementById('editUserName').innerText = `Change role for: ${userName}`;
        document.getElementById('editUserRoleForm').action = `/users/${userId}/update-role`;
        // Optionnel: tu peux pré-sélectionner le rôle actuel ici si tu le passes dans loadRoleUsers()

        $('#editUserRoleModal').modal('show');
    }
</script>

<script>
document.getElementById('searchUserInput').addEventListener('keyup', function () {
    let filter = this.value.toLowerCase();
    let rows = document.querySelectorAll('#roleUsersTableBody tr');

    rows.forEach(function(row) {
        let nameCell = row.cells[1]; // Deuxième colonne (Name)
        if (nameCell) {
            let nameText = nameCell.textContent.toLowerCase();
            row.style.display = nameText.includes(filter) ? '' : 'none';
        }
    });
});
</script>

<script>
  // Affiche le spinner quand on clique sur "Retour arrière" ou on recharge
  window.addEventListener("pageshow", function (event) {
    const spinner = document.getElementById("loading-spinner");

    if (event.persisted || performance.getEntriesByType("navigation")[0].type === "back_forward") {
      spinner.style.display = "flex";
    }
  });

  // Affiche le spinner manuellement quand on clique sur les liens de retour
  document.querySelectorAll('.btn-back, .btn-refresh').forEach(btn => {
    btn.addEventListener('click', function () {
      document.getElementById("loading-spinner").style.display = "flex";
    });
  });
</script>
