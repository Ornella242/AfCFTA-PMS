<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Hashidable;

class TaskActivity extends Model
{
    use Hashidable;
    protected $fillable = ['task_id', 'user_id', 'from_status', 'to_status'];

    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
