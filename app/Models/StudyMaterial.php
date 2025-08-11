<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudyMaterial extends Model
{
    use HasFactory;

    protected $fillable = ['training_id','slug', 'curriculum_id', 'pdf_path', 'youtube_url'];

    public function training()
    {
        return $this->belongsTo(Training::class,'training_id', 'id');
    }

    public function curriculum()
    {
        return $this->belongsTo(TrainingCurriculum::class, 'curriculum_id');
    }

    public function trainingCurriculam()
    {
        return $this->hasMany(TrainingCurriculum::class, 'training_id', 'id');
    }

    public function trainer()
    {
        return $this->belongsTo(Trainer::class); // adjust class name if needed
    }

    public function systemInfo()
    {
        return $this->belongsTo(SystemSetting::class, 'system_info_id'); // Adjust key as needed
    }


}
