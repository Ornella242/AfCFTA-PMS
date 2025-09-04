<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Hashidable;
class ProjectDocument extends Model
{
    use Hashidable;
    protected $table = 'project_documents';
    protected $fillable = [
        'project_id', 'filename', 'path', 'mime_type', 'size'
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
