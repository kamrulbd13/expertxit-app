<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;

class TrainerType extends Model
{
    public static $trainerType;

//    saveData
    public static function saveData($request)
    {
        self::$trainerType = new TrainerType();
        self::$trainerType->trainer_type = $request->trainer_type;
        self::$trainerType->status       = $request->status;
        self::$trainerType->author_id    = Auth::id();
        self::$trainerType->save();
    }

//    updateData
    public static function updateDate($request, $id)
    {
        self::$trainerType = TrainerType::find($id);
        self::$trainerType->trainer_type = $request->trainer_type;
        self::$trainerType->status       = $request->status;
        self::$trainerType->author_id    = Auth::id();
        self::$trainerType->save();
    }

//    statusUpdate
    public static function statusUpdate($id)
    {
        self::$trainerType   = TrainerType::find($id);
        if(self::$trainerType->status == 1)
        {
            self::$trainerType->status = 0;
        }
        else
        {
            self::$trainerType->status = 1;
        }
        self::$trainerType->save();
    }
//  deleteData
    public static function deleteData($id)
    {
        self::$trainerType   = TrainerType::find($id);
        self::$trainerType->delete();
    }
}
