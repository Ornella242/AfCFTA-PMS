<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\TaskComment;

class Task extends Model
{
    protected $casts = [
    'start_date' => 'date',
    'end_date' => 'date',
    ];

    protected $fillable = [
        'title', 'description', 'start_date', 'end_date',
        'status', 'assigned_to', 'created_by',
        'delete_requested', 'archived', 'type',
        'unit_id',
    ];

    public function assignedUser()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

  public function comments()
    {
        return $this->hasMany(TaskComment::class);
    }

    public function activities()
{
    return $this->hasMany(TaskActivity::class);
}

 // Scope pratique pour ne pas afficher les archivées
    public function scopeActive($query)
    {
        return $query->where('archived', false);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }


}
