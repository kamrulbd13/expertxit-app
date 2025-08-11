<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ExamSystem;
use App\Models\ExamQuestionOption;

class ExamQuestion extends Model
{
    protected $fillable = [
        'exam_system_id',
        'question_text',
        'marks',
        // add other fillable columns if needed
    ];

    /**
     * The exam this question belongs to.
     */
    public function exam()
    {
        return $this->belongsTo(ExamSystem::class, 'exam_system_id', 'id');
    }


    /**
     * The options for this question.
     */
    public function options()
    {
        return $this->hasMany(ExamQuestionOption::class, 'exam_question_id', 'id');
    }
// App\Models\ExamQuestion
    public function correctOption()
    {
        return $this->belongsTo(ExamQuestionOption::class, 'correct_option_id');
    }


}
