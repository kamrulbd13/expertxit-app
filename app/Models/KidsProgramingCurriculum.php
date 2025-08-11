<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KidsProgramingCurriculum extends Model
{
    protected $table = 'kids_programing_curricula'; // Ensure this matches your DB table
    protected $fillable = ['kids_programme_id', 'title', 'sub_title', 'description', 'duration'];

    // Belongs to a program
    public function kidsProgramme()
    {
        return $this->belongsTo(KidsProgramming::class, 'kids_programme_id');
    }

    // Has many resources
    public function resources()
    {
        return $this->hasMany(StudyMaterial::class, 'curriculum_id');
    }
}
