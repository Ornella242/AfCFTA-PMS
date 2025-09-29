<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use App\Traits\Hashidable;

class Report extends Model
{
    // use Hashidable;
    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    use HasFactory;

    protected $fillable = [
        'project_id',
        'user_id',
        'code',
        'title',
        'description',
        'format',
        'generated_at',
    ];

    protected $dates = [
        'generated_at',
    ];

    /**
     * Relations
     */

    // Le projet associé
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    // L'utilisateur qui a généré le rapport
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Accessors / Mutators ou méthodes utiles
     */

    // public function getFormattedDateAttribute()
    // {
    //     return $this->generated_at ? $this->generated_at->format('d M Y H:i') : null;
    // }
}

