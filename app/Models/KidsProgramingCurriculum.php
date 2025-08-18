<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KidsProgramingCurriculum extends Model
{
    protected $table = 'kids_programing_curricula';

    protected $fillable = [
        'kidsProgramme_id', // must match the foreign key in KidsProgramming model
        'title',
        'sub_title',
        'description',
        'duration',
    ];

    /* ===================== Relationships ===================== */

    // Each curriculum belongs to a KidsProgramming
    public function kidsProgramme()
    {
        return $this->belongsTo(KidsProgramming::class, 'kidsProgramme_id', 'id');
    }

    // Each curriculum can have many resources/study materials
    public function resources()
    {
        return $this->hasMany(StudyMaterial::class, 'curriculum_id', 'id');
    }
}
