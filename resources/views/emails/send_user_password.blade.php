<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Account Created</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f5f8fa; padding: 30px;">
    <div style="background-color: white; max-width: 600px; margin: auto; padding: 30px; border-radius: 8px; box-shadow: 0 2px 6px rgba(0,0,0,0.1);">
        <div style="text-align: right;">
            <img src="{{ asset('images/logo.png') }}" alt="AfCFTA Logo" style="width: 60px;">
        </div>
        <h2 style="color: #333;">Hello {{ $user->firstname }},</h2>
        <p>An account has been created for you on the project management platform </p>

        <p><strong>Here are your log in information :</strong></p>
        <p><strong>Email :</strong> {{ $user->email }}</p>
        <p><strong>Password :</strong> {{ $password }}</p>

        <p>Please change your password after your first login for security reasons.</p>

        <br>
        <p>Best regards,<br>
    </div>
</body>
</html>
