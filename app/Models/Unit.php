<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Unit extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    // Une unité peut avoir plusieurs utilisateurs
    public function users()
    {
        return $this->hasMany(User::class);
    }
    // Une unité peut avoir plusieurs projets
    // Un projet appartient à une unité
     public function projects()
    {
        return $this->hasMany(Project::class);
    }
}
