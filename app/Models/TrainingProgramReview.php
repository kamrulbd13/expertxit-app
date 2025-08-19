<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingProgramReview extends Model
{
    use HasFactory;

    protected $fillable = ['training_id', 'user_id', 'rating', 'review'];

    public function training()
    {
        return $this->belongsTo(Training::class, 'training_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
