@include('partials.navbar')
<main role="main" class="main-content">
        <div class="container-fluid">
          <div class="row justify-content-center">
                <div class="col-12">
                    <div class="row align-items-center mb-4">
                        <div class="col">
                        <h2 class="h4 page-title"><small class="text-maroon h4">Design and Implement Database Schema for Administrative Data</small><br />#T0001</h2>
                        </div>
                        </div>
                    </div> <!-- .row -->
                    <div class="row my-4">
                        <div class="col-md-12">
                        <div class="card shadow mb-4">
                            <div class="card-header">
                            <strong class="card-title h5">Task Description</strong>
                            <span class="float-right"><i class="fe fe-flag mr-2"></i><span class="badge badge-pill pt-2 pb-2 bg-yellow text-white">Processing</span></span>
                            </div>
                            <div class="card-body">
                            
                            <dl class="row mb-0">
                                <dt class="col-sm-2 mb-3 text-muted">Type</dt>
                                <dd class="col-sm-4 mb-3">Admin</dd>
                                <dt class="col-sm-2 mb-3 text-muted">Unit</dt>
                                <dd class="col-sm-4 mb-3">Admin</dd>
                                <dt class="col-sm-2 mb-3 text-muted">Priority</dt>
                                <dd class="col-sm-4 mb-3">
                                <span class="badge badge-pill badge-danger pt-1">High</span>
                                
                                </dd>
                                <dt class="col-sm-2 mb-3 text-muted">Status</dt>
                                <dd class="col-sm-4 mb-3">
                                <span class="dot dot-md bg-warning text-yellow mr-2 "></span> Processing <div class="dropdown d-inline">
                                    <button class="btn btn-sm p-0 dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="sr-only">Change status</span>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item text-maroon" href="#">Pending</a>
                                    <a class="dropdown-item text-green" href="#">Completed</a>
                                    </div>
                                </div>
                                </dd>
                                <dt class="col-sm-2 mb-3 text-muted">Created On</dt>
                                <dd class="col-sm-4 mb-3">2025-06-05 1:08pm</dd>
                                <dt class="col-sm-2 mb-3 text-muted">Last Update</dt>
                                <dd class="col-sm-4 mb-3">2025-06-05 1:08pm</dd>
                            </dl>
                            </div> <!-- .card-body -->
                        </div> <!-- .card -->
                         
                        <div class="card shadow mb-4">
                           <div class="card-header d-flex justify-content-between align-items-center">
                                <strong class="card-title h5 mb-0">Associated Subtasks</strong>
                                <div class="d-flex align-items-center">
                                    <span class="mr-3 d-flex align-items-center">
                                    <i class="fe fe-layers mr-1"></i>3
                                    </span>
                                    <button type="button" class="btn bg-maroon text-white" data-toggle="modal" data-target="#createtask">
                                    Create subtask
                                    </button>
                                       <!-- Modal -->
                                    <div class="modal fade" id="createtask" tabindex="-1" role="dialog" aria-labelledby="createtask" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h5 class="modal-title" id="defaultModalLabel">Create subtask</h5>
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
                                                    <input type="text" class="form-control" id="title" name="title" placeholder="Enter subtask title" required>
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
                                                    <button type="submit" class="btn bg-maroon text-white">Add subtask</button>
                                                </div>
                                                </form>
                                        </div>                                              
                                        </div>
                                        </div>
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
                                    <td>Subtask 1</td>
                                    <td>05/06/2025</td>
                                    <td>05/06/2025</td>
                                    <td><span class="badge badge-success pt-1">Completed</span></td>
                                    <td class="text-right text-green-600">
                                        100%  
                                    </td>
                                    </tr>
                                    <tr data-toggle="modal" data-target=".modal-right">
                                    <td>Subtask 2</td>
                                    <td>05/06/2025</td>
                                    <td>05/06/2025</td>
                                    <td><span class="badge badge-warning pt-1">In Progress</span></td>
                                    <td class="text-right">
                                        60%
                                    </td>
                                    </tr>
                                    <tr data-toggle="modal" data-target=".modal-right">
                                            <td>Subtask 3 </td>
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
                                                        <h5 class="modal-title" id="defaultModalLabel">Edit subtask</h5>
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
                                                                <input type="text" class="form-control" id="title" name="title" placeholder="Enter subtask title" required>
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
                                                                    <button type="submit" class="btn bg-maroon text-white">Edit subtask</button>
                                                                </div>
                                                           </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    </tr>
                                </tbody>
                                </table>
                            </div>
                        </div>

                    </div> <!-- .col-md -->
                
                </div> <!-- .col-md -->
            </div>
          </div> <!-- .col-12 -->
        </div> <!-- .row -->
        </div> <!-- .container-fluid -->
     
        @include('partials.footer')
</main>