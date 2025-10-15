
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #299347 50%, #F4A51F 50%);
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }
        .reset-container {
            background-color: #C3A466;
            color: white;
            display: flex;
            border-radius: 10px;
            overflow: hidden;
            width: 90%;
            max-width: 800px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.2);
        }
        .reset-left {
            flex: 1;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .reset-left h2 {
            color: #000000;
            margin-bottom: 15px;
        }
        .reset-left p {
            color: #ddd;
            margin-bottom: 25px;
            font-size: 14px;
        }
        .reset-left input {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: none;
            border-radius: 5px;
            outline: none;
        }
        .reset-left button {
            background-color: #FFC107;
            border: none;
            padding: 12px;
            border-radius: 5px;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.3s;
        }
        .reset-left button:hover {
            background-color: #e0a800;
        }
        .reset-right {
            flex: 1;
            background-color: #E0D1A6;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 30px;
        }
        .reset-right img {
            max-width: 100%;
            height: auto;
        }
        @media(max-width: 768px) {
            body {
                background: #2C2C54;
            }
            .reset-container {
                flex-direction: column;
            }
            .reset-right {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="reset-container">
        <!-- Partie gauche (Formulaire) -->
        <div class="reset-left">
            <h2>Reset Password</h2>
            <p>Enter your email and your new password below.</p>
                @if (session('status'))
                    <div style="background:#d4edda;color:#155724;padding:10px;border-radius:5px;margin-bottom:15px;">
                        {{ session('status') }}
                    </div>
                @endif
           <form action="{{ url('/reset-password') }}" method="POST">

    @csrf
    <input type="hidden" name="token" value="{{ $token }}">

    <input type="email" name="email" value="{{ $email ?? old('email') }}" required placeholder="Email address">
    <input type="password" name="password" placeholder="New password" required>
    <input type="password" name="password_confirmation" placeholder="Confirm new password" required>

    <button type="submit">Reset Password</button>
</form>

        </div>

        <!-- Partie droite (Image) -->
        <div class="reset-right">
            <img src="{{ asset('images/logo.png') }}" alt="Reset Illustration">
        </div>
    </div>
</body>
</html>
