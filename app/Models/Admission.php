<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Admission extends Model
{
    public static $data;

    public static function saveData($request)
    {

        self::$data = new Admission();

        // customer id
        $customerId = Auth::guard('customer')->id();

        // Find the training by ID (assuming course_id is training id)
        $training = Training::find($request->course_id);
        $trainingCategoryId = $training ? $training->training_category_id : null;
        $skillLevelId = $training ? $training->skill_level_id : null;

        // Find NewBatchUpcoming record based on course_id (might be batch_id if needed)
        $batch = NewBatchUpcoming::find($request->course_id);
        $trainerId = $batch ? $batch->trainer_id : null;

        // Assign values
        self::$data->customer_id            = $customerId;
        self::$data->batch_id               = $request->batch_id;
        self::$data->course_id              = $request->course_id;
        self::$data->skill_level_id         = $skillLevelId;
        self::$data->trainer_id             = $trainerId;
        self::$data->training_category_id   = $trainingCategoryId;
        self::$data->save();
    }




//    updateData
    public static function updateDate($request, $id)
    {
        self::$data = Admission::find($id);
        self::$data->name              = $request->name              ;
        self::$data->status            = $request->status;
        self::$data->author_id         = Auth::id();
        self::$data->save();
    }

//    statusUpdate
    public static function statusUpdate($id)
    {
        self::$data   = Admission::find($id);
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
        self::$data   = Admission::find($id);
        self::$data->delete();
    }


//    relation
//    batch info
    public function newBatchId(){
        return $this->belongsTo(NewBatchUpcoming::class,'batch_id');
    }
//    customer
    public function customer()
    {
        return $this->belongsTo(\App\Models\Customer::class, 'customer_id');
    }


//    training
public function training(){
        return $this->belongsTo(Training::class,'course_id', 'id');
}
//    many to one with Training Category
    public function trainingCategory()
    {
        return $this->belongsTo(TrainingCategory::class, 'training_category_id');
    }
//    many ot one with trainer
    public function trainer(){
        return $this->belongsTo(Trainer::class);
    }

    //    many ot one with trainer type
    public function trainerType(){
        return $this->belongsTo(TrainerType::class);
    }

    //    many ot one with tlanguage
    public function language(){
        return $this->belongsTo(Language::class);
    }

    //    many ot one with skillLevel
    public function skillLevel(){
        return $this->belongsTo(SkillLevel::class);
    }

    public function customerPayment()
    {
        return $this->belongsTo(CustomerPayment::class, 'course_id'); // assuming course_id refers to training ID
    }

    public function trainingCurricula()
    {
        return $this->hasMany(TrainingCurriculum::class, 'training_id');
    }

    public function trainingCurriculam()
    {
        return $this->hasMany(TrainingCurriculum::class, 'training_id', 'id');
    }













}
