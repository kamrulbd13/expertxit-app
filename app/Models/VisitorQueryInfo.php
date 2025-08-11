<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VisitorQueryInfo extends Model
{
    protected $fillable = ['name', 'email', 'phone', 'course', 'message'];

}
