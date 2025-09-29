<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
// use App\Traits\Hashidable;

class ProjectDeletionRequest extends Model
{
    // use Hashidable;
      protected $fillable = [
        'project_id',
        'reason',
        'requested_by',
        'approved',
        'decline_reason',
    ];

    // Relations (optionnelles mais utiles)
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function requester()
    {
        return $this->belongsTo(User::class, 'requested_by');
    }
}
