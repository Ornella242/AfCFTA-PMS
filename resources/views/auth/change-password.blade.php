@include('partials.navbar')
<div class="container mt-5">
    <h3>Change Password</h3>

    @if (session('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger mt-3">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('password.update') }}" method="POST" class="mt-4">
        @csrf

        <div class="form-group">
            <label for="current_password">Current Password</label>
            <input type="password" class="form-control" name="current_password" required>
        </div>

        <div class="form-group mt-3">
            <label for="new_password">New Password</label>
            <input type="password" class="form-control" name="new_password" required>
        </div>

        <div class="form-group mt-3">
            <label for="new_password_confirmation">Confirm New Password</label>
            <input type="password" class="form-control" name="new_password_confirmation" required>
        </div>

        <button type="submit" class="btn btn-primary mt-4">Update Password</button>
    </form>
</div>
@include('partials.footer')
