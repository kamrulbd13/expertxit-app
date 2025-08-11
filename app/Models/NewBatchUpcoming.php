<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;


class NewBatchUpcoming extends Model
{
    public static $data;

//    saveData
    public static function saveData($request)
    {
        self::$data = new NewBatchUpcoming();
        self::$data->training_category_id   = $request->training_category_id;
        self::$data->course_id              = $request->training_id;
        self::$data->trainer_id             = $request->trainer_id;
        self::$data->batch_id               = $request->batch_id;
        self::$data->start_date             = $request->start_date;
        self::$data->end_date               = $request->end_date;
        self::$data->status                 = $request->status;
        self::$data->author_id              = Auth::id();
        self::$data->save();
    }

//    updateData
    public static function updateDate($request, $id)
    {
        self::$data = NewBatchUpcoming::find($id);
        self::$data->training_category_id   = $request->training_category_id;
        self::$data->course_id             = $request->training_id;
        self::$data->trainer_id             = $request->trainer_id;
        self::$data->batch_id               = $request->batch_id;
        self::$data->start_date             = $request->start_date;
        self::$data->end_date               = $request->end_date;
        self::$data->status                 = $request->status;
        self::$data->author_id              = Auth::id();
        self::$data->save();
    }

//    statusUpdate
    public static function statusUpdate($id)
    {
        self::$data   = NewBatchUpcoming::find($id);
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
        self::$data   = NewBatchUpcoming::find($id);
        self::$data->delete();
    }



//  relation
    public function training(){
        return $this->belongsTo(Training::class,'course_id');
    }

    public function trainingCategory(){
        return $this->belongsTo(TrainingCategory::class,'training_category_id');
    }

    public function trainer(){
        return $this->belongsTo(Trainer::class);
    }

    public function trainerType(){
        return $this->belongsTo(TrainerType::class);
    }












}
