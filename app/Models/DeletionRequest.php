<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeletionRequest extends Model
{
     protected $fillable = [
        'project_id',
        'requester_id',
        'reason',
        'status',
        'decline_reason',
    ];

    public function requester()
    {
        return $this->belongsTo(User::class, 'requester_id');
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
