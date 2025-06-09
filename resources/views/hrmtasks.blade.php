@include('partials.navbar')
<main role="main" class="main-content">
        <div class="container-fluid">
          <div class="row justify-content-center">
            <div class="col-12">
              <h2 class="page-title text-center text-maroon">HRM Tasks</h2>
              <div class="row">
                <div class="col-md-12 mb-4">
                  <div class="card shadow">
                    <div class="card-body">
                      
                       <div class="row my-4 d-none d-lg-flex align-items-center justify-content-between">
                            <!-- Bouton Create Task à gauche -->
                            <div>
                                <button type="button" class="btn mb-2 bg-yellow text-white ml-3" data-toggle="modal" data-target="#createtask" data-whatever="@mdo">
                                Create Task
                                </button>
                                <div class="modal fade" id="createtask" tabindex="-1" role="dialog" aria-labelledby="createtask" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h5 class="modal-title" id="defaultModalLabel">Create task</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                                <form action="" method="POST">
                                                    @csrf
                                                    {{-- Project name --}}
                                                    <div class="form-group">
                                                        <label for="project_name">Project name</label>
                                                        <select class="form-control" id="unit" name="unit">
                                                            <option value="">Administration Data</option>
                                                            <option value="">Administration Data</option>
                                                            <option value="">Administration Data</option>
                                                            <!-- Tu peux ajouter d'autres unités -->
                                                        </select>
                                                    </div>
                                                
                                                    <!-- Title -->
                                                    <div class="form-group">
                                                    <label for="title">Title</label>
                                                    <input type="text" class="form-control" id="title" name="title" placeholder="Enter task title" required>
                                                    </div>
                                                    <!-- Description -->
                                                    <div class="form-group">
                                                    <label for="description">Description</label>
                                                    <textarea class="form-control" id="description" name="description" rows="3" placeholder="Enter task description"></textarea>
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
                                                
                                                </div>

                                                <!-- Footer -->
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn bg-maroon text-white">Add task</button>
                                                </div>
                                                </form>
                                        </div>                                              
                                    </div>
                            </div>
                            </div>

                            <!-- Filtres à droite -->
                            <div class="d-flex align-items-center">
                                <span class="small bg-white border py-1 px-2 rounded mr-2">
                                <a href="#" class="text-muted"><i class="fe fe-x mx-1"></i></a>
                                <span class="text-muted">Unit : <strong>IT</strong></span>
                                </span>
                                <button type="button" class="btn" data-toggle="modal" data-target=".modal-slide">
                                <span class="fe fe-filter fe-16 text-muted"></span>
                                </button>
                                <button type="button" class="btn">
                                <span class="fe fe-refresh-ccw fe-16 text-muted"></span>
                                </button>
                            </div>
                        </div>

                      
                      <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="admin" role="tabpanel" aria-labelledby="admintask-tab"> 
                            <div class="card-body p-0">
                                <table class="table mb-0 table-hover">
                                <thead class="thead-light">
                                    <tr>
                                    <th>Task Title</th>
                                    <th>Unit</th>
                                    <th>Start</th>
                                    <th>End Date</th>
                                    <th>Status</th>
                                    <th class="text-right">Progress</th>
                                    <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Design and Implement Database Schema for Administrative Data</td>
                                        <td>HR</td>
                                        <td>05/06/2025</td>
                                        <td>05/06/2025</td>
                                        <td><span class="badge badge-success pt-1">Completed</span></td>
                                        <td class="text-right text-green-600">
                                            100%  
                                        </td>
                                        <td>
                                            <button class="btn btn-sm dropdown-toggle more-horizontal" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span class="sr-only">Action</span>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="{{ url('/edittask') }}">Edit</a>   
                                                <a class="dropdown-item" data-toggle="modal" data-target=".modal-right">View subtasks</a>
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
                                                <a class="dropdown-item" href="#">Delete</a>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Develop Admin Dashboard Interface</td>
                                        <td>Facilities</td>
                                        <td>05/06/2025</td>
                                        <td>05/06/2025</td>
                                        <td><span class="badge badge-warning pt-1">In Progress</span></td>
                                        <td class="text-right">
                                            60%
                                        </td>
                                         <td>
                                            <button class="btn btn-sm dropdown-toggle more-horizontal" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span class="sr-only">Action</span>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="">Edit</a>
                                               <a class="dropdown-item modal-right">View subtasks</a>
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
                                                <a class="dropdown-item" href="#">Delete</a>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Design and Implement Database Schema for Administrative Data</td>
                                        <td>IT</td>
                                        <td>05/06/2025</td>
                                        <td>05/06/2025</td>
                                        <td><span class="badge badge-success pt-1">Completed</span></td>
                                        <td class="text-right text-green-600">
                                            100%  
                                        </td>
                                         <td>
                                            <button class="btn btn-sm dropdown-toggle more-horizontal" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span class="sr-only">Action</span>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="">Edit</a>
                                                <a class="dropdown-item modal-right">View subtasks</a>
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
                                                                        <i class="fe fe-edit-2"></i>
                                                                    </div>

                                                                    <!-- Subtask 2 -->
                                                                    <div class="list-group-item d-flex justify-content-between align-items-center">
                                                                        <div>
                                                                        <h6 class="mb-1">Set up database</h6>
                                                                        <span class="badge badge-warning pt-2 pb-2">In Progress</span>
                                                                        </div>
                                                                        <i class="fe fe-edit-2"></i>
                                                                    </div>

                                                                    <!-- Subtask 3 -->
                                                                    <div class="list-group-item d-flex justify-content-between align-items-center">
                                                                        <div>
                                                                        <h6 class="mb-1">Write documentation</h6>
                                                                        <span class="badge badge-secondary pb-2 pt-2">Pending</span>
                                                                        </div>
                                                                        <i class="fe fe-edit-2"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                            <button type="button" class="btn mb-2 btn-secondary" data-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <a class="dropdown-item" href="#">Delete</a>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Develop Admin Dashboard Interface</td>
                                        <td>Procurement</td>
                                        <td>05/06/2025</td>
                                        <td>05/06/2025</td>
                                        <td><span class="badge badge-warning pt-1">In Progress</span></td>
                                        <td class="text-right">
                                            60%
                                        </td>
                                         <td>
                                            <button class="btn btn-sm dropdown-toggle more-horizontal" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span class="sr-only">Action</span>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="">Edit</a>
                                                <a class="dropdown-item modal-right">View subtasks</a>
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
                                                                        <i class="fe fe-edit-2"></i>
                                                                    </div>

                                                                    <!-- Subtask 2 -->
                                                                    <div class="list-group-item d-flex justify-content-between align-items-center">
                                                                        <div>
                                                                        <h6 class="mb-1">Set up database</h6>
                                                                        <span class="badge badge-warning pt-2 pb-2">In Progress</span>
                                                                        </div>
                                                                        <i class="fe fe-edit-2"></i>
                                                                    </div>

                                                                    <!-- Subtask 3 -->
                                                                    <div class="list-group-item d-flex justify-content-between align-items-center">
                                                                        <div>
                                                                        <h6 class="mb-1">Write documentation</h6>
                                                                        <span class="badge badge-secondary pb-2 pt-2">Pending</span>
                                                                        </div>
                                                                        <i class="fe fe-edit-2"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                            <button type="button" class="btn mb-2 btn-secondary" data-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <a class="dropdown-item" href="#">Delete</a>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Design and Implement Database Schema for Administrative Data</td>
                                        <td>Travel</td>
                                        <td>05/06/2025</td>
                                        <td>05/06/2025</td>
                                        <td><span class="badge badge-success pt-1">Completed</span></td>
                                        <td class="text-right text-green-600">
                                            100%  
                                        </td>
                                         <td>
                                            <button class="btn btn-sm dropdown-toggle more-horizontal" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span class="sr-only">Action</span>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="">Edit</a>
                                                <a class="dropdown-item modal-right">View subtasks</a>
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
                                                                        <i class="fe fe-edit-2"></i>
                                                                    </div>

                                                                    <!-- Subtask 2 -->
                                                                    <div class="list-group-item d-flex justify-content-between align-items-center">
                                                                        <div>
                                                                        <h6 class="mb-1">Set up database</h6>
                                                                        <span class="badge badge-warning pt-2 pb-2">In Progress</span>
                                                                        </div>
                                                                        <i class="fe fe-edit-2"></i>
                                                                    </div>

                                                                    <!-- Subtask 3 -->
                                                                    <div class="list-group-item d-flex justify-content-between align-items-center">
                                                                        <div>
                                                                        <h6 class="mb-1">Write documentation</h6>
                                                                        <span class="badge badge-secondary pb-2 pt-2">Pending</span>
                                                                        </div>
                                                                        <i class="fe fe-edit-2"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                            <button type="button" class="btn mb-2 btn-secondary" data-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <a class="dropdown-item" href="#">Delete</a>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Develop Admin Dashboard Interface</td>
                                        <td>HR</td>
                                        <td>05/06/2025</td>
                                        <td>05/06/2025</td>
                                        <td><span class="badge badge-warning pt-1">In Progress</span></td>
                                        <td class="text-right">
                                            60%
                                        </td>
                                         <td>
                                            <button class="btn btn-sm dropdown-toggle more-horizontal" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span class="sr-only">Action</span>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="">Edit</a>
                                                <a class="dropdown-item modal-right">View subtasks</a>
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
                                                                        <i class="fe fe-edit-2"></i>
                                                                    </div>

                                                                    <!-- Subtask 2 -->
                                                                    <div class="list-group-item d-flex justify-content-between align-items-center">
                                                                        <div>
                                                                        <h6 class="mb-1">Set up database</h6>
                                                                        <span class="badge badge-warning pt-2 pb-2">In Progress</span>
                                                                        </div>
                                                                        <i class="fe fe-edit-2"></i>
                                                                    </div>

                                                                    <!-- Subtask 3 -->
                                                                    <div class="list-group-item d-flex justify-content-between align-items-center">
                                                                        <div>
                                                                        <h6 class="mb-1">Write documentation</h6>
                                                                        <span class="badge badge-secondary pb-2 pt-2">Pending</span>
                                                                        </div>
                                                                        <i class="fe fe-edit-2"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                            <button type="button" class="btn mb-2 btn-secondary" data-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <a class="dropdown-item" href="#">Delete</a>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                            <td>Implement Role-Based Access Control </td>
                                            <td>IT</td>
                                            <td>05/06/2025</td>
                                            <td>05/06/2025</td>
                                            <td><span class="badge badge-secondary pt-1">Pending</span></td>
                                            <td class="text-right">
                                                0%
                                            </td>
                                         <td>
                                            <button class="btn btn-sm dropdown-toggle more-horizontal" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span class="sr-only">Action</span>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="">Edit</a>
                                                <a class="dropdown-item modal-right">View subtasks</a>
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
                                                                        <i class="fe fe-edit-2"></i>
                                                                    </div>

                                                                    <!-- Subtask 2 -->
                                                                    <div class="list-group-item d-flex justify-content-between align-items-center">
                                                                        <div>
                                                                        <h6 class="mb-1">Set up database</h6>
                                                                        <span class="badge badge-warning pt-2 pb-2">In Progress</span>
                                                                        </div>
                                                                        <i class="fe fe-edit-2"></i>
                                                                    </div>

                                                                    <!-- Subtask 3 -->
                                                                    <div class="list-group-item d-flex justify-content-between align-items-center">
                                                                        <div>
                                                                        <h6 class="mb-1">Write documentation</h6>
                                                                        <span class="badge badge-secondary pb-2 pt-2">Pending</span>
                                                                        </div>
                                                                        <i class="fe fe-edit-2"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                            <button type="button" class="btn mb-2 btn-secondary" data-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <a class="dropdown-item" href="#">Delete</a>
                                            </div>
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
                                                                <i class="fe fe-edit-2"></i>
                                                            </div>

                                                            <!-- Subtask 2 -->
                                                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                                                <div>
                                                                <h6 class="mb-1">Set up database</h6>
                                                                <span class="badge badge-warning pt-2 pb-2">In Progress</span>
                                                                </div>
                                                                <i class="fe fe-edit-2"></i>
                                                            </div>

                                                            <!-- Subtask 3 -->
                                                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                                                <div>
                                                                <h6 class="mb-1">Write documentation</h6>
                                                                <span class="badge badge-secondary pb-2 pt-2">Pending</span>
                                                                </div>
                                                                <i class="fe fe-edit-2"></i>
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
                    </div>
                  </div>
                 
                </div>
                </div>
               {{-- view task --}}
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
              </div> <!-- end section -->
            </div> <!-- .col-12 -->
          </div> <!-- .row -->
        </div> <!-- .container-fluid -->
       
      @include('partials.footer')
      </main>