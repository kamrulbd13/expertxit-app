<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamAnswer extends Model
{
    protected $fillable = [
        'user_id',
        'exam_id',
        'question_id',
        'selected_option_id',
        'is_correct',
    ];

    protected $casts = [
        'is_correct' => 'boolean',
    ];

    // Define question relationship
    public function question()
    {
        return $this->belongsTo(ExamQuestion::class, 'question_id');
    }

    public function selectedOption()
    {
        return $this->belongsTo(ExamQuestionOption::class, 'selected_option_id');
    }
}
