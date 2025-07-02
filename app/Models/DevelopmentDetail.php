<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DevelopmentDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'project_id',
        'subphase_id',
        'title',
        'notes',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function subphase()
    {
        return $this->belongsTo(Subphase::class);
    }
}
