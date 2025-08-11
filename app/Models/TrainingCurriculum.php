<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrainingCurriculum extends Model
{
    //

    protected $table = 'training_curricula';
    protected $fillable = ['training_id', 'title','sub_title', 'description', 'duration'];

//    with training
    public function training()
    {
        return $this->belongsTo(Training::class, 'training_id');
    }

    public function resources()
    {
        return $this->hasMany(StudyMaterial::class, 'curriculum_id');
    }

    public function trainingCurriculum()
    {
        return $this->hasMany(TrainingCurriculum::class, 'training_id', 'id');
    }

}
