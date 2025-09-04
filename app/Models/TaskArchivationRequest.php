<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Hashidable;
class TaskArchivationRequest extends Model
{
    use Hashidable;
    protected $table = 'task_archive_requests';
     protected $fillable = [
        'task_id',
        'reason',
        'requested_by',
        'approved',
        'decline_reason',
    ];

    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    public function requester()
    {
        return $this->belongsTo(User::class, 'requested_by');
    }
}
