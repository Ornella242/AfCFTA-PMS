<div style="max-width:600px;margin:20px auto;padding:25px;
            border:1px solid #e0e0e0;border-radius:12px;
            background:#fafafa;font-family:Arial,sans-serif;
            color:#333;font-size:14px;line-height:1.6;">

  <!-- En-tête -->
  <table width="100%" border="0" cellspacing="0" cellpadding="0" 
       style="border-bottom:2px solid #9E2140;">
  <tr>
    <td align="center" style="padding-bottom:20px;">
      <h2 style="margin:0;color:#9E2140;
                 font-family:Arial,sans-serif;">
        AHRMD Project Management System
      </h2>
    </td>
    <td align="right" style="padding-bottom:20px;">
      <img src="{{ asset('images/logo.png') }}" alt="Logo" 
           style="height:40px;width:auto;">
    </td>
  </tr>
</table>


  <!-- Corps -->
  <div style="padding:20px;">
    <p>Dear Admin,</p>

    <p>The phase <strong>{{ $phaseName }}</strong> of the project 
       <strong>{{ $project->title }}</strong> has just been finalized (100%).</p>
    <p>Best regards,<br>
  </div>

  <!-- Pied -->
  <div style="margin-top:30px;padding-top:20px;
              border-top:1px solid #ddd;
              text-align:center;font-size:12px;color:#777;">
    <p style="margin:0;">
      Automated message from the 
      <strong>AHRMD Project Management System</strong>.<br>
    </p>
  </div>
</div>
