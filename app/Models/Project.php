<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Unit;   
use App\Traits\Hashidable;

class Project extends Model
{
    use Hashidable;
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
        'procurement_type',
        'created_by',
        'budget_code',
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
                    ->withPivot('percentage','procurement_type', 'status', 'reason','award_person_name')
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

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function assistants()
    {
        return $this->belongsToMany(User::class, 'project_user_assistants', 'project_id', 'user_id');
    }

    public function members()
    {
        return $this->belongsToMany(User::class, 'project_user_members', 'project_id', 'user_id');
    }

    public function currentPhase()
    {
        return $this->phases()
            ->where('status', 'In progress')
            ->orderByDesc('id') // ou created_at si plus logique
            ->first();
    }

    public function documents()
    {
        return $this->hasMany(ProjectDocument::class);
    }



}
