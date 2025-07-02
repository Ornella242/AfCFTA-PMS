<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Partner extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    // public function users()
    // {
    //     return $this->belongsToMany(User::class, 'partner_user')->withTimestamps();
    // }
    public function projects()
    {
        return $this->belongsToMany(Project::class, 'partner_project', 'partner_id', 'project_id');
    }

}
