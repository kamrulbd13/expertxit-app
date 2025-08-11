<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class CustomerChatMessage extends Model
{
    protected $fillable = [
        'from_id', 'to_id', 'from_type', 'to_type', 'message', 'file', 'file_type'
    ];


//    relation
    public function fromUser()
    {
        return $this->belongsTo(User::class, 'from_id')->orWhereHas('customer', 'id');
    }

}
