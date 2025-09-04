<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Hashidable;

class Subphase extends Model
{
    use Hashidable;
    protected $fillable = ['phase_id', 'name', 'label'];

    public function phase()
    {
        return $this->belongsTo(Phase::class);
    }

    /**
     * A subphase can be associated with multiple projects.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */

    public function projects()
    {
        return $this->belongsToMany(Project::class, 'project_subphase')->withPivot('percentage')->withTimestamps();
    }

    public function developmentDetails()
    {
        return $this->hasMany(DevelopmentDetail::class);
    }
}
