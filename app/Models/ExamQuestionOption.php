<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ExamQuestion;

class ExamQuestionOption extends Model
{
    protected $fillable = [
        'exam_question_id',
        'option_text',
        'is_correct',
    ];

    /**
     * Get the question that this option belongs to.
     */
    public function question()
    {
        return $this->belongsTo(ExamQuestion::class, 'exam_question_id', 'id');
    }

    public function correctOption()
    {
        return $this->belongsTo(ExamOption::class, 'correct_option_id');
    }

}
