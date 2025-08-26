
{{-- <div class="container py-5">
    <h4 class="mb-4">Forgot your password?</h4>
    <p class="text-muted">Enter your email address and we will send you a link to reset your password.</p>

    @if (session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    <form action="{{ route('password.email') }}" method="POST">
        @csrf
        <div class="form-group mb-3">
            <label>Email address</label>
            <input type="email" name="email" value="{{ old('email') }}" 
                   class="form-control @error('email') is-invalid @enderror" required autofocus>
            @error('email')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Send Password Reset Link</button>
    </form>
</div> --}}




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }
        body {
            background-color: #f0f0f0;
        }
        .wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: linear-gradient(to right, #F4A51F 50%, #299347 50%);
        }
        .card {
            background: #299347;
            color: white;
            display: flex;
            flex-wrap: wrap;
            width: 900px;
            max-width: 95%;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }
        .left {
            flex: 1 1 50%;
            padding: 50px;
            background-color: #FAD58B;
            color: #333;
        }
        .left h2 {
            font-size: 28px;
            margin-bottom: 10px;
        }
        .left p {
            margin-bottom: 25px;
            color: #444;
        }
        .left input {
            width: 100%;
            padding: 12px;
            border: none;
            border-bottom: 2px solid #ccc;
            background: transparent;
            margin-bottom: 20px;
            font-size: 16px;
        }
        .left input:focus {
            outline: none;
            border-bottom-color: #9E2140;
        }
        .left button {
            background: #9E2140;
            color: white;
            padding: 12px 25px;
            border: none;
            cursor: pointer;
            font-size: 16px;
            border-radius: 25px;
        }
        .left button:hover {
            background: #1f2140;
        }
        .right {
            flex: 1 1 50%;
            background: #70CA89;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 30px;
        }
        .right img {
            max-width: 50%;
            height: auto;
        }
        @media (max-width: 768px) {
            .wrapper {
                background: #F4A51F;
            }
            .card {
                flex-direction: column;
            }
            .right {
                order: -1;
                background: transparent;
            }
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="card">
            <!-- Left side: Form -->
            <div class="left">
                <h2 class=" text-white">Forgot Password?</h2>
                <p>Enter your email address and we will send you a link to reset your password.</p>

                @if (session('status'))
                    <div style="background:#d4edda;color:#155724;padding:10px;border-radius:5px;margin-bottom:15px;">
                        {{ session('status') }}
                    </div>
                @endif

                <form action="{{ route('password.email') }}" method="POST">
                    @csrf
                    <input type="email" name="email" value="{{ old('email') }}" 
                        class="@error('email') is-invalid @enderror" 
                        placeholder="Enter email address" required autofocus>
                    @error('email')
                        <span style="color:red;font-size:14px;">{{ $message }}</span>
                    @enderror
                    <button type="submit">Send</button>
                </form>
            </div>

            <!-- Right side: Illustration -->
            <div class="right">
                <img src="{{ asset('images/logo.png') }}" alt="Forgot Password Illustration">
            </div>
        </div>
    </div>
</body>
</html>


