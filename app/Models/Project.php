<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Unit;    

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'start_date',
        'end_date',
        'priority',
        'status',
        'unit_id',
        'project_manager_id',
        'type',
        'budget',
        'procurement_type'
    ];


    // 🔗 Relations
    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function projectManager()
    {
        return $this->belongsTo(User::class, 'project_manager_id');
    }



    public function partners()
    {
        return $this->belongsToMany(Partner::class, 'partner_project', 'project_id', 'partner_id');
    }


    public function phases()
    {
        return $this->belongsToMany(Phase::class, 'project_phase')
                    ->withPivot('percentage');
    }


    public function subphases()
    {
        return $this->belongsToMany(Subphase::class, 'project_subphase')
                    ->withPivot('percentage','procurement_type', 'status', 'reason')
                    ->withTimestamps();
    }

    public function developmentDetails()
    {
        return $this->hasMany(DevelopmentDetail::class);
    }

   public function getCompletionPercentageAttribute()
    {
        return $this->subphases->sum(function ($subphase) {
            return $subphase->pivot->percentage ?? 0;
        });
    }



}
