<?php

namespace App\Models;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Relations\Relation;

class ChatMessage extends Model
{


    protected $fillable = [
        'from_id', 'from_type', 'to_id', 'to_type',
        'message', 'file_path', 'file_name', 'file_type', 'reply_to_id',
    ];

    protected $appends = ['file_url'];

    public function getFileUrlAttribute()
    {
        return $this->file_path ? Storage::url($this->file_path) : null;
    }


    public function from()
    {
        return $this->morphTo();
    }

    public function to()
    {
        return $this->morphTo();
    }


    // online live status
    protected $casts = [
        'last_seen_at' => 'datetime',
    ];
    public function isOnline()
    {
        return $this->last_seen_at && $this->last_seen_at->gt(now()->subMinutes(2));
    }



}
