<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use App\Traits\Hashidable;

class DevelopmentDetail extends Model
{
    // use Hashidable;
    use HasFactory;
    protected $fillable = [
        'project_id',
        'subphase_id',
        'title',
        'status',
        'reason',
        'budget_activity', // New field for budget activity
        'payment_status',
        'payment_date',
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
