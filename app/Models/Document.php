<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use App\Traits\Hashidable;
use Illuminate\Support\Facades\Crypt;

class Document extends Model
{
    // use Hashidable;
     protected $table = 'project_documents';
    protected $fillable = ['project_id', 'filename', 'path'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }


    // Quand on lit la colonne "path", on la déchiffre
    public function getPathAttribute($value)
    {
        return Crypt::decryptString($value);
    }

    // Quand on écrit dans la colonne "path", on la chiffre
    public function setPathAttribute($value)
    {
        $this->attributes['path'] = Crypt::encryptString($value);
    }
}
