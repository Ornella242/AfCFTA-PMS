@include('partials.navbar')
<div id="loading-spinner" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(255,255,255,0.7); z-index: 9999; justify-content: center; align-items: center;">
  <div class="spinner-grow mr-3 text-success" role="status" style="width: 5rem; height: 5rem;">
    <span class="sr-only">Loading...</span>
  </div>
</div>
<main role="main" class="main-content fade-in" id="page-transition">
        <div class="container-fluid">
          <div class="row justify-content-center">
            <div class="col-12">
              <div class="row align-items-center mb-4">
                <div class="col">
                    <h2 class="h3 mb-0 page-title text-maroon">Pending Project Deletion Requests</h2>
                </div>
                @if(session('success'))
                  <div class="alert alert-success shadow-sm">
                    {{ session('success') }}
                  </div>
                @endif
                @if(session('error'))
                  <div class="alert alert-danger shadow-sm">
                    {{ session('error') }}
                  </div>
                @endif
              </div>
             @foreach($requests as $req)
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">{{ $req->project->title }}</h5>
                <p><strong>Requested by:</strong> {{ $req->requester->firstname }} {{ $req->requester->lastname }}</p>
                <p><strong>Reason:</strong> {{ $req->reason }}</p>

                @if(!$req->approved)
                    <form action="{{ route('deletionRequests.approve', $req->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button class="btn btn-success">Approve Deletion</button>
                    </form>
                @else
                    <span class="badge badge-success">Approved</span>
                @endif
            </div>
        </div>
    @endforeach
            </div> <!-- .col-12 -->
          </div> <!-- .row -->
        </div> <!-- .container-fluid -->
     @include('partials.footer')  
</main>