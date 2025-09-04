<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\Hashidable;

class Role extends Model
{
    use Hashidable;
    use HasFactory;
    protected $fillable = ['name'];

    // Un rôle peut avoir plusieurs utilisateurs
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
