{{-- <!DOCTYPE html>
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
        <h2 style="color: #333;">Dear {{ $user->firstname }} {{ $user->lastname }}</h2>
        <p>The following report has been shared with you: </p>

        <p><strong>{{ $report->title }}</strong></p>
        <p><strong>Project: {{ $report->project->title }}</strong></p>
        <p><strong>Date: {{ $report->created_at->format('d M Y') }}</strong></p>

        <p>
            You can view the report here:<br>
            <a href="{{ url('projects/' . $report->project->id . '/report') }}">
                View Report
            </a>
        </p>

        <br>
        <p>Best regards,<br>
    </div>
</body>
</html> --}}

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Report Shared</title>
</head>
<body style="font-family: 'Segoe UI', Tahoma, sans-serif; background-color: #f5f8fa; margin: 0; padding: 40px 0;">
    <div style="max-width: 600px; background-color: #ffffff; margin: auto; padding: 30px; border-radius: 10px; box-shadow: 0 4px 12px rgba(0,0,0,0.08);">
        
        <!-- Header/logo -->
        <div style="text-align: right;">
            <img src="{{ asset('images/logo.png') }}" alt="AfCFTA Logo" style="height: 50px;">
        </div>

        <!-- Greeting -->
        <h2 style="color: #222; margin-top: 30px;">Dear {{ $user->firstname }} {{ $user->lastname }},</h2>
        <p style="color: #444; font-size: 15px; line-height: 1.6;">
            A new report has been shared with you:
        </p>

        <!-- Report details -->
        <div style="background-color: #f0f4f8; border-radius: 6px; padding: 15px 20px; margin: 20px 0;">
            <p style="margin: 5px 0;"><strong>📄 Report:</strong> {{ $report->title }}</p>
            <p style="margin: 5px 0;"><strong>📁 Project:</strong> {{ $report->project->title }}</p>
            <p style="margin: 5px 0;"><strong>📅 Date:</strong> {{ $report->created_at->format('d M Y') }}</p>
        </div>

        <!-- Button -->
        <div style="text-align: center; margin: 30px 0;">
            <a href="{{ url('projects/' . $report->project->id . '/report') }}" 
               style="background-color: #00425f; color: white; padding: 12px 24px; text-decoration: none; border-radius: 5px; font-weight: bold;">
                View Report
            </a>
        </div>

        <!-- Footer -->
        <p style="font-size: 14px; color: #666; margin-top: 30px;">
            Kind regards,<br>
            <strong>The AHRMD Team</strong>
        </p>
    </div>
</body>
</html>
