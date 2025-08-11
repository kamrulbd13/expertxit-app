<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;

class AcademicSession extends Model
{
    public static $academicSession;

//    saveData
    public static function saveData($request)
    {
        self::$academicSession = new AcademicSession();
        self::$academicSession->training_id     = $request->training_id;
        self::$academicSession->child_id        = $request->child_id;
        self::$academicSession->trainer_id      = $request->trainer_id;
        self::$academicSession->date            = $request->date;
        self::$academicSession->actual_duration = $request->actual_duration;
        self::$academicSession->achivement_id   = $request->achivement_id;
        self::$academicSession->status          = $request->status;
        self::$academicSession->author_id       = Auth::id();
        self::$academicSession->save();
    }

//    updateData
    public static function updateDate($request, $id)
    {
        self::$academicSession = AcademicSession::find($id);
        self::$academicSession->training_id     = $request->training_id;
        self::$academicSession->child_id        = $request->child_id;
        self::$academicSession->trainer_id      = $request->trainer_id;
        self::$academicSession->date            = $request->date;
        self::$academicSession->actual_duration = $request->actual_duration;
        self::$academicSession->achivement_id   = $request->achivement_id;
        self::$academicSession->status          = $request->status;
        self::$academicSession->author_id       = Auth::id();
        self::$academicSession->save();
    }

//    statusUpdate
    public static function statusUpdate($id)
    {
        self::$academicSession   = AcademicSession::find($id);
        if(self::$academicSession->status == 1)
        {
            self::$academicSession->status = 0;
        }
        else
        {
            self::$academicSession->status = 1;
        }
        self::$academicSession->save();
    }
//  deleteData
    public static function deleteData($id)
    {
        self::$academicSession   = AcademicSession::find($id);
        self::$academicSession->delete();
    }

//    many to one with training
    public function training()
    {
        return $this->belongsTo(Training::class);
    }

    //    many to one with trainee
    public function child()
    {
        return $this->belongsTo(Trainee::class);
    }

    //    many to one with training
    public function trainer()
    {
        return $this->belongsTo(Trainer::class);
    }
}
