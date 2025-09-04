@include('partials.navbar')

<main role="main" class="main-content bg-main main-img">
    <div class="container-fluid bg-light min-vh-100 py-4">
        <div class="card shadow-lg border-0 rounded-3 ">
        <div class="card-header text-center bg-gradient bg-green">
            <h4 class="mb-0 text-white">  
                 <img src="{{ asset('images/icons/changepassword.png') }}" alt="password" class="icon-img" style="width:40px; height:40px;">
                 Change Password
            </h4>
        </div>
        <div class="card-body p-4">
            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                <!-- Current password -->
                <div class="form-group mb-3">
                    <img src="{{ asset('images/icons/password.png') }}" alt="password" class="icon-img" style="width:20px; height:20px;">
                    <label for="current_password" style="font-weight:bold">Current Password</label>
                    <input type="password" 
                        name="current_password" 
                        id="current_password" 
                        class="form-control bg-light shadow-sm border-0 rounded-pill" 
                        placeholder="Enter current password">
                    @error('current_password') 
                        <small class="text-danger d-block mt-1">{{ $message }}</small> 
                    @enderror
                </div>

                <!-- New password -->
                <div class="form-group mb-3">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <img src="{{ asset('images/icons/newpassword.png') }}" alt="password" class="icon-img" style="width:20px; height:20px;">
                        <span style="font-weight:bold">New Password</span>
                        <small class="text-muted">At least 8 characters 
                            <small class="text-muted">
                                <em>(Must contain at least one uppercase letter, one lowercase letter, one number, and one special character)</em>
                            </small>
                        </small>
                    </div>
                    <input type="password" 
                        name="password" 
                        id="password" 
                        class="form-control bg-light shadow-sm border-0 rounded-pill" 
                        placeholder="Enter new password">
                    @error('password') 
                        <small class="text-danger d-block mt-1">{{ $message }}</small> 
                    @enderror
                </div>

                <!-- Confirm password -->
                <div class="form-group mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <span style="font-weight:bold">Confirm Password</span>
                        <small class="text-muted">Re-type new password</small>
                    </div>
                    <input type="password" 
                        name="password_confirmation" 
                        id="password_confirmation" 
                        class="form-control bg-light shadow-sm border-0 rounded-pill" 
                        placeholder="Confirm new password">
                </div>

                <!-- Submit -->
                <div class="d-grid">
                    <button type="submit" class="btn bg-green text-white rounded-pill shadow">
                       <img src="{{ asset('images/icons/changepassword.png') }}" alt="password" class="icon-img" style="width:20px; height:20px;">
                        Update Password
                    </button>
                </div>
            </form>
        </div>
        </div>
    </div>
</main>

@include('partials.footer') 