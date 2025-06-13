@include('partials.navbar')
<main role="main" class="main-content bg-main">
  <div class="container-fluid">
      <h4 class="mb-4">HRM Task Management Board</h4>
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="row" id="kanban-board">
          <!-- TO DO -->
          <div class="col-md-4">
            <div class="card">
              <div class="card-header bg-light d-flex justify-content-between align-items-center">
                <strong>To Do</strong>
                <!-- Bouton Create uniquement ici -->
                <button type="button" class="btn btn-sm bg-yellow text-white" data-toggle="modal" data-target="#createtask">Create</button>
              </div>
              <div class="card-body min-vh-50" id="todo" data-status="pending">
                <!-- Exemple de tâche -->
                <div class="card mb-2 task-item" data-id="1" data-toggle="modal" data-target="#taskDetailsModal" style="cursor: pointer; border-left: 4px solid #007bff;">
                    <div class="card-body p-2">
                        <!-- Title -->
                        <strong class="d-block mb-1">Deployment plan</strong>

                        <!-- Start Date -->
                        <div class="d-flex align-items-center mb-1">
                        <i class="fe fe-calendar mr-2 text-muted"></i>
                        <small class="text-muted mt-1">Aug 11, 2025</small>
                        </div>

                        <!-- Code -->
                        <div class="d-flex align-items-center mb-1">
                        <input type="checkbox" checked class="mr-2">
                        <small class="text-muted font-weight-bold mt-1">APM-29</small>
                        </div>

                        <!-- End Date -->
                        <div class="d-flex align-items-center mb-1">
                        <i class="fe fe-calendar mr-2 text-muted"></i>
                        <small class="text-muted mt-1">End: Aug 15, 2025</small>
                        </div>

                        <!-- Priority -->
                        <div class="d-flex align-items-center mb-1">
                        <i class="fe fe-alert-circle mr-2 text-danger"></i>
                        <small class="text-danger font-weight-bold mt-1">High</small>
                        </div>

                        <!-- Assigned to -->
                        <div class="d-flex justify-content-end mt-2">
                        <span class="badge badge-pill bg-success text-white" style="width: 32px; height: 32px; border-radius: 50%; display: flex; align-items: center; justify-content: center;">OA</span>
                        </div>
                    </div>  
                </div>

              </div>
            </div>
          </div>

          <!-- IN PROGRESS -->
          <div class="col-md-4">
            <div class="card">
              <div class="card-header bg-light"><strong>In Progress</strong></div>
              <div class="card-body min-vh-50" id="inprogress" data-status="processing">
                 <div class="card mb-2 task-item" data-id="1" data-toggle="modal" data-target="#taskDetailsModal" style="cursor: pointer; border-left: 4px solid #F4A51F;">
                    <div class="card-body p-2">
                        <!-- Title -->
                        <strong class="d-block mb-1">Deployment plan</strong>

                        <!-- Start Date -->
                        <div class="d-flex align-items-center mb-1">
                        <i class="fe fe-calendar mr-2 text-muted"></i>
                        <small class="text-muted mt-1">Aug 11, 2025</small>
                        </div>

                        <!-- Code -->
                        <div class="d-flex align-items-center mb-1">
                        <input type="checkbox" checked class="mr-2">
                        <small class="text-muted font-weight-bold mt-1">APM-29</small>
                        </div>

                        <!-- End Date -->
                        <div class="d-flex align-items-center mb-1">
                        <i class="fe fe-calendar mr-2 text-muted"></i>
                        <small class="text-muted mt-1">End: Aug 15, 2025</small>
                        </div>

                        <!-- Priority -->
                        <div class="d-flex align-items-center mb-1">
                        <i class="fe fe-alert-circle mr-2 text-danger"></i>
                        <small class="text-danger font-weight-bold mt-1">High</small>
                        </div>

                        <!-- Assigned to -->
                        <div class="d-flex justify-content-end mt-2">
                        <span class="badge badge-pill bg-success text-white" style="width: 32px; height: 32px; border-radius: 50%; display: flex; align-items: center; justify-content: center;">OA</span>
                        </div>
                    </div>  
                </div>
              </div>
            </div>
          </div>

          <!-- DONE -->
          <div class="col-md-4">
            <div class="card">
              <div class="card-header bg-light"><strong>Done</strong></div>
                <div class="card-body min-vh-50" id="inprogress" data-status="processing">
                 <div class="card mb-2 task-item" data-id="1" data-toggle="modal" data-target="#taskDetailsModal" style="cursor: pointer; border-left: 4px solid #299347;">
                    <div class="card-body p-2">
                        <!-- Title -->
                        <strong class="d-block mb-1">Deployment plan</strong>

                        <!-- Start Date -->
                        <div class="d-flex align-items-center mb-1">
                        <i class="fe fe-calendar mr-2 text-muted"></i>
                        <small class="text-muted mt-1">Aug 11, 2025</small>
                        </div>

                        <!-- Code -->
                        <div class="d-flex align-items-center mb-1">
                        <input type="checkbox" checked class="mr-2">
                        <small class="text-muted font-weight-bold mt-1">APM-29</small>
                        </div>

                        <!-- End Date -->
                        <div class="d-flex align-items-center mb-1">
                        <i class="fe fe-calendar mr-2 text-muted"></i>
                        <small class="text-muted mt-1">End: Aug 15, 2025</small>
                        </div>

                        <!-- Priority -->
                        <div class="d-flex align-items-center mb-1">
                        <i class="fe fe-alert-circle mr-2 text-danger"></i>
                        <small class="text-danger font-weight-bold mt-1">High</small>
                        </div>

                        <!-- Assigned to -->
                        <div class="d-flex justify-content-end mt-2">
                        <span class="badge badge-pill bg-success text-white" style="width: 32px; height: 32px; border-radius: 50%; display: flex; align-items: center; justify-content: center;">OA</span>
                        </div>
                    </div>  
                </div>
              </div>
            </div>
          </div>

        </div> <!-- .row -->
      </div>
    </div>
  </div>

  <!-- Modal Create Task -->
  <div class="modal fade" id="createtask" tabindex="-1" role="dialog" aria-labelledby="createtask" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Create task</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form>
            <div class="form-group">
              <label for="title">Title</label>
              <input type="text" class="form-control" id="title" placeholder="Enter task title">
            </div>
            <div class="form-group">
              <label for="description">Description</label>
              <textarea class="form-control" id="description" rows="3" placeholder="Enter task description"></textarea>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="start_date">Start Date</label>
                <input type="date" class="form-control" id="start_date">
              </div>
              <div class="form-group col-md-6">
                <label for="end_date">End Date</label>
                <input type="date" class="form-control" id="end_date">
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="priority">Priority</label>
                <select class="form-control" id="priority">
                  <option value="high">High</option>
                  <option value="medium">Medium</option>
                  <option value="low">Low</option>
                </select>
              </div>
              <div class="form-group col-md-6">
                <label for="status">Status</label>
                <select class="form-control" id="status">
                  <option value="pending" class="text-maroon">Pending</option>
                  <option value="processing" class="text-yellow">Processing</option>
                  <option value="completed" class="text-green">Completed</option>
                </select>
              </div>
            </div>
             <div class="form-group">
              <label for="project_name">Assigned To</label>
              <select class="form-control" id="name" name="name">
                <option value="">Ornella AHOUANDOGBO</option>
                <option value="">Grace DIBAKALA</option>
              </select>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn bg-maroon text-white">Add task</button>
        </div>
        
      </div>
      
    </div>
    
  </div>
<!-- Modal Task Details -->
<div class="modal fade" id="taskDetailsModal" tabindex="-1" role="dialog" aria-labelledby="taskDetailsModalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content rounded-lg shadow">

    <!-- Header -->
    <div class="modal-header bg-light">
        <h5 class="modal-title" id="taskDetailsModalLabel">Task Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span>&times;</span>
        </button>
    </div>

    <!-- Body -->
    <div class="modal-body">
        <div class="row">
        <!-- Col gauche -->
        <div class="col-md-6">
            <div class="mb-3">
            <label class="font-weight-bold">Title</label>
            <p>Deployment plan</p>
            </div>
            <div class="mb-3">
            <label class="font-weight-bold">Start Date</label>
            <p><i class="fe fe-calendar mr-2 text-muted"></i>Aug 11, 2025</p>
            </div>
            <div class="mb-3">
            <label class="font-weight-bold">Code</label>
            <p>APM-29</p>
            </div>
        </div>

        <!-- Col droite -->
        <div class="col-md-6">
            <div class="mb-3">
            <label class="font-weight-bold">End Date</label>
            <p><i class="fe fe-calendar mr-2 text-muted"></i>Aug 15, 2025</p>
            </div>
            <div class="mb-3">
            <label class="font-weight-bold">Priority</label>
            <p><i class="fe fe-alert-circle mr-2 text-danger"></i><span class="text-danger">High</span></p>
            </div>
            <div class="mb-3">
            <label class="font-weight-bold">Assigned To</label>
            <span class=" text-black p-2">Ornella AHOUANDOGBO</span>
            </div>
        </div>
        </div>

        <!-- Comment Section -->
        <hr>
        <h6 class="font-weight-bold">Comments</h6>
        <div class="form-group">
        <textarea class="form-control" rows="3" placeholder="Write your comment..."></textarea>
        </div>
        <button type="button" class="btn btn-primary">Post Comment</button>

        <!-- Previous Comments -->
        <div class="row align-items-start mb-3 mt-4">
            <!-- Badge -->
            <div class="col-md-1 d-flex justify-content-center">
                <span class="badge badge-pill bg-success text-white" style="width: 32px; height: 32px; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                OA
                </span>
            </div>

            <!-- Commentaire -->
            <div class="col-md-11">
                <div class="bg-light p-2 rounded">
                Started working on the deployment plan.
                </div>
            </div>
            </div>  
        </div>

    <!-- Footer -->
    <div class="modal-footer bg-light">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    </div>

    </div>
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
<script>
  ['todo', 'inprogress', 'done'].forEach(function(id) {
    new Sortable(document.getElementById(id), {
      group: 'kanban',
      animation: 150,
    });
  });
</script>

  @include('partials.footer')
</main>
