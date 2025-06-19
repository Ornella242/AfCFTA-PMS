@include('partials.navbar')
<main role="main" class="main-content">
  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-12 col-xl-10">
        <div class="row align-items-center my-4">
          <div class="col">
            <h2 class="h3 mb-0 page-title">New user</h2>
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
          <hr class="my-4">
          <h5 class="mb-2 mt-4 text-maroon">User details</h5>
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
          <button type="submit" class="btn mb-2 bg-maroon text-white">
            <i class="fe fe-user-plus mx-1"></i>Add
          </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</main>


@include('partials.footer')