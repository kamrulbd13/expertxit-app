<?php

namespace App\Models;

use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Database\Eloquent\Model;
use Auth;

class Trainer extends Model
{
    public static $trainer;

//    saveData
    public static function saveData($request)
    {
        $id = IdGenerator::generate(['table' => 'trainers','field' => 'trainer_id', 'length' => 6, 'prefix' =>'TR-']);
        self::$trainer = new Trainer();
        self::$trainer->trainer_id      = $id;
        self::$trainer->trainer_name    = $request->trainer_name;
        self::$trainer->certification    = $request->certification;
        self::$trainer->trainer_type_id = $request->trainer_type_id;
        self::$trainer->status          = $request->status;
        self::$trainer->author_id       = Auth::id();
        self::$trainer->save();
    }

//    updateData
    public static function updateDate($request, $id)
    {
        self::$trainer = Trainer::find($id);
        self::$trainer->trainer_id      = $id;
        self::$trainer->trainer_name    = $request->trainer_name;
        self::$trainer->certification    = $request->certification;
        self::$trainer->trainer_type_id = $request->trainer_type_id;
        self::$trainer->status          = $request->status;
        self::$trainer->author_id    = Auth::id();
        self::$trainer->save();
    }

//    statusUpdate
    public static function statusUpdate($id)
    {
        self::$trainer   = Trainer::find($id);
        if(self::$trainer->status == 1)
        {
            self::$trainer->status = 0;
        }
        else
        {
            self::$trainer->status = 1;
        }
        self::$trainer->save();
    }
//  deleteData
    public static function deleteData($id)
    {
        self::$trainer   = Trainer::find($id);
        self::$trainer->delete();
    }

//    many to one with trainerType
    public function trainerType()
    {
        return $this->belongsTo(TrainerType::class);
    }
}
