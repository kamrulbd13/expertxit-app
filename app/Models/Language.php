<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Language extends Model
{
    public static $data;

//    saveData
    public static function saveData($request)
    {
        self::$data = new Language();
        self::$data->name           = $request->name;
        self::$data->status         = $request->status;
        self::$data->author_id      = Auth::id();
        self::$data->save();
    }

//    updateData
    public static function updateDate($request, $id)
    {
        self::$data = Language::find($id);
        self::$data->name              = $request->name              ;
        self::$data->status            = $request->status;
        self::$data->author_id         = Auth::id();
        self::$data->save();
    }

//    statusUpdate
    public static function statusUpdate($id)
    {
        self::$data   = Language::find($id);
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
        self::$data   = Language::find($id);
        self::$data->delete();
    }
}
