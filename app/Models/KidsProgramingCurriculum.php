<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KidsProgramingCurriculum extends Model
{
    protected $table = 'kids_programing_curricula';

    protected $fillable = [
        'kids_programme_id', // Must match DB column exactly
        'title',
        'sub_title',
        'description',
        'duration',
    ];

    public function kidsProgramme()
    {
        return $this->belongsTo(KidsProgramming::class, 'kids_programme_id', 'kidsProgramme_id');
    }

    public function resources()
    {
        return $this->hasMany(StudyMaterial::class, 'curriculum_id');
    }
}
