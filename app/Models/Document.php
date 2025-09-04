<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
     protected $table = 'project_documents';
    protected $fillable = ['project_id', 'filename', 'path'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
