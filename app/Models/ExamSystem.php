<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamSystem extends Model
{
    protected $fillable = [
        'training_id',
        'title',
        'description',
        'duration',       // in minutes (e.g., 30)
        'total_marks',
        'pass_marks',
        'start_time',     // datetime or timestamp
        'end_time',       // datetime or timestamp
        'is_published',   // boolean (0 or 1)
        'created_by',
    ];

    /**
     * Relationship: One ExamSystem has many ExamQuestions
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function questions()
    {
        return $this->hasMany(ExamQuestion::class, 'exam_system_id', 'id');
    }

    public function training()
    {
        return $this->belongsTo(Training::class);
    }


}
