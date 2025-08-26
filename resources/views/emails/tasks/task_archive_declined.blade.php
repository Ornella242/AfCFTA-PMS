<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <style>
    .card {
      max-width: 600px;
      margin: auto;
      background: #ffffff;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
      font-family: Arial, sans-serif;
      padding: 24px;
      color: #333;
    }
    .card-header {
      background-color: #b71c1c;
      color: white;
      padding: 16px;
      border-radius: 8px 8px 0 0;
      font-size: 20px;
      font-weight: bold;
    }
    .card-body {
      padding: 16px;
    }
    .info {
      margin-bottom: 12px;
    }
    .label {
      font-weight: bold;
      color: #444;
    }
    .value {
      margin-left: 8px;
    }
    .footer {
      margin-top: 24px;
      font-size: 14px;
      color: #777;
    }
    .button {
      display: inline-block;
      margin-top: 20px;
      padding: 10px 16px;
      background-color: #388e3c;
      color: white;
      text-decoration: none;
      border-radius: 5px;
      font-weight: bold;
    }
    .button:hover {
      background-color: #2e7d32;
    }
  </style>
</head>
<body>
<div class="card">
  <div class="card-header">
    Task Archiving Request Declined
  </div>
  <div class="card-body">
    <div class="info">
        <span class="label">Decline Reason:</span>
        <span class="value">{{ $declineReason }}</span>
    </div>
    <table width="100%" cellpadding="0" cellspacing="0" style="margin-top: 30px;">
      <tr>
        <td style="font-family: Arial, sans-serif; font-size: 14px; color: #444;">
          This is an automated message from the AfCFTA Project Management System.
        </td>
        <td align="right">
          <img src="{{ asset('images/logo.png') }}" alt="AfCFTA Logo" style="height: 40px;">
        </td>
      </tr>
    </table>


</div>

</body>
</html>
