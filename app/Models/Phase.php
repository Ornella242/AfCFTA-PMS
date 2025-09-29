<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use App\Traits\Hashidable;

class Phase extends Model
{
    // use Hashidable;
    protected $fillable = ['name', 'label'];

    public function subphases()
    {
        return $this->hasMany(Subphase::class);
    }

    /**
     * A phase can be associated with multiple projects.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function projects()
    {
        return $this->belongsToMany(Project::class, 'project_phase')->withTimestamps();
    }
}
