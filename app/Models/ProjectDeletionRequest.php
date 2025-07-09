<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ProjectDeletionRequest extends Model
{
      protected $fillable = [
        'project_id',
        'reason',
        'requested_by',
        'approved',
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
