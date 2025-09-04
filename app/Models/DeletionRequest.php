<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Hashidable;

class DeletionRequest extends Model
{
    use Hashidable;
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
