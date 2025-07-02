@include('partials.navbar')
<div id="loading-spinner" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(255,255,255,0.7); z-index: 9999; justify-content: center; align-items: center;">
  <div class="spinner-grow mr-3 text-success" role="status" style="width: 3rem; height: 3rem;">
    <span class="sr-only">Loading...</span>
  </div>
</div>
<main role="main" class="main-content fade-in" id="page-transition">
  <div class="container-fluid bg-grey">
    <div class="row justify-content-center">
      <div class="col-12">
        <div class="w-100 text-left mt-3 ml-3">
          <a href="{{ url()->previous() }}" class="btn btn-outline-success btn-back shadow-sm transition-all">
            <i class="fe fe-arrow-left mr-2"></i> Back
          </a>
        </div>
        <div class="row align-items-center my-4">
          <div class="col">
            <h2 class="h2 mb-0 page-title text-center">New user form</h2>
          </div>
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
        <form action="{{ route('users.store') }}" method="POST">
          @csrf
          <h5 class="mb-2 mt-1 text-maroon">User details</h5>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="firstname">Firstname</label>
              <input type="text" id="firstname" name="firstname" class="form-control">
            </div>   
            <div class="form-group col-md-6">
              <label for="lastname">Lastname</label>
              <input type="text" id="lastname" name="lastname" class="form-control">
            </div>   
          </div>
         
          <div class="form-row">
            <div class="form-group col-md-4">
               <label for="email">Email</label>
               <input type="email" name="email" class="form-control">
            </div>
            <div class="form-group col-md-4">
               <label for="unit">Unit</label>
                <select name="unit_id" id="unit" class="form-control">
                    @foreach($units as $unit)
                        <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-4">
              <label for="role">Role</label>
              <select id="role" class="form-control" name='role_id'>
                  @foreach($roles as $role)
                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                  @endforeach
              </select>
            </div>
          </div>
          <div>
          <div class="col-md-12 d-flex justify-content-end">
            <button type="submit" class="btn mb-2 bg-maroon text-white">
              <i class="fe fe-user-plus mx-1"></i>Add
            </button>
          </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</main>


@include('partials.footer')