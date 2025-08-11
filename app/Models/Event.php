<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Event extends Model
{
    public static $event;
    //    saveData
    public static function saveData($request)
    {
        self::$event = new Event();
        self::$event->category_id          = $request->category_id;
        self::$event->title                 = $request->name;
        self::$event->description          = $request->description;
        self::$event->session_method       = $request->session_method;
        self::$event->start_date           = $request->start_date;
        self::$event->end_date             = $request->end_date;
        self::$event->start_time           = $request->start_time;
        self::$event->end_time             = $request->end_time;
        self::$event->status               = $request->status;
        self::$event->author_id            = Auth::id();
        self::$event->save();
    }

//    updateData
    public static function updateData($request, $id)
    {
        self::$event = Event::find($id);
        self::$event->category_id          = $request->category_id;
        self::$event->title                = $request->name;
        self::$event->description          = $request->description;
        self::$event->session_method       = $request->session_method;
        self::$event->start_date           = $request->start_date;
        self::$event->end_date             = $request->end_date;
        self::$event->start_time           = $request->start_time;
        self::$event->end_time             = $request->end_time;
        self::$event->status               = $request->status;
        self::$event->author_id            = Auth::id();
        self::$event->save();
    }

//    statusUpdate
    public static function statusUpdate($id)
    {
        self::$event   = Event::find($id);
        if(self::$event->status == 1)
        {
            self::$event->status = 0;
        }
        else
        {
            self::$event->status = 1;
        }
        self::$event->save();
    }
//  deleteData
    public static function deleteData($id)
    {
        self::$event   = Event::find($id);
        self::$event->delete();
    }

//    many to one
    public function category() {
        return $this->belongsTo(EventCategory::class);
    }


    public function training(){
        return $this->belongsTo(Training::class);
    }
}
