<div class="body" style="font-family: Arial, sans-serif; color:#333; font-size:14px; line-height:1.6;">
  
  <p>Hello <strong>{{ $task->assignedUser->firstname ?? $task->assignedUser->lastname }}</strong>,</p>

  <p>You have just been assigned a new task in the 
    <strong>AfCFTA Project Management System</strong>:</p>

  <p style="text-align:center; margin:30px 0;">
    <a href="{{ route('tasks.index') }}" 
       style="background:#7B1FA2;color:#fff;text-decoration:none;
              padding:12px 20px;border-radius:6px;
              font-weight:bold;display:inline-block;">
      🔗 View Tasks
    </a>
  </p>

  <p style="margin-top:30px;">
    We count on your collaboration to complete this task successfully ✅
  </p>

  <hr style="margin:40px 0; border:none; border-top:1px solid #ddd;">

  <p style="font-size:12px; color:#777;">
    This is an automated message from the <strong>AfCFTA Project Management System</strong>.  
    Please do not reply directly to this email.
  </p>
</div>
