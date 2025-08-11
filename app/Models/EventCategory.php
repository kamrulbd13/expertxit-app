<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;
class EventCategory extends Model
{
    public static $data;

//    saveData
    public static function saveData($request)
    {
        self::$data = new EventCategory();
        self::$data->name  = $request->name;
        self::$data->color  = $request->color;
        self::$data->status       = $request->status;
        self::$data->author_id    = Auth::id();
        self::$data->save();
    }

//    updateData
    public static function updateDate($request, $id)
    {
        self::$data = EventCategory::find($id);
        self::$data->name  = $request->name;
        self::$data->color  = $request->color;
        self::$data->status       = $request->status;
        self::$data->save();
    }

//    statusUpdate
    public static function statusUpdate($id)
    {
        self::$data   = EventCategory::find($id);
        if(self::$data->status == 1)
        {
            self::$data->status = 0;
        }
        else
        {
            self::$data->status = 1;
        }
        self::$data->save();
    }
//  deleteData
    public static function deleteData($id)
    {
        self::$data   = EventCategory::find($id);
        self::$data->delete();
    }

    public function events()
    {
        return $this->hasMany(Event::class, category_id);
    }


}
