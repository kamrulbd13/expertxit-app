<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KidsProgramReview extends Model
{
    use HasFactory;

    protected $fillable = ['kidsProgramme_id', 'user_id', 'rating', 'review'];

    // Reviews relationship
    public function reviews()
    {
        return $this->hasMany(KidsProgramReview::class, 'kidsProgramme_id');
    }

    public function kidsProgramme()
    {
        return $this->belongsTo(KidsProgramming::class, 'kidsProgramme_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
