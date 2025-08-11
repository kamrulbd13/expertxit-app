<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Achivement extends Model
{
    public static $achivement;

//    saveData
    public static function saveData($request)
    {
        self::$achivement = new Achivement();
        self::$achivement->achivement_name    = $request->achivement_name;
        self::$achivement->status             = $request->status;
        self::$achivement->author_id          = Auth::id();
        self::$achivement->save();
    }

//    updateData
    public static function updateDate($request, $id)
    {
        self::$achivement = Achivement::find($id);
        self::$achivement->achivement_name   = $request->achivement_name;
        self::$achivement->status            = $request->status;
        self::$achivement->author_id         = Auth::id();
        self::$achivement->save();
    }

//    statusUpdate
    public static function statusUpdate($id)
    {
        self::$achivement   = Achivement::find($id);
        if(self::$achivement->status == 1)
        {
            self::$achivement->status = 0;
        }
        else
        {
            self::$achivement->status = 1;
        }
        self::$achivement->save();
    }
//  deleteData
    public static function deleteData($id)
    {
        self::$achivement   = Achivement::find($id);
        self::$achivement->delete();
    }
}
