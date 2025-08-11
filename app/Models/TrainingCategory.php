<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;

class TrainingCategory extends Model
{
    public static $trainingCategory;

//    saveData
    public static function saveData($request)
    {
        self::$trainingCategory = new TrainingCategory();
        self::$trainingCategory->training_category  = $request->training_category;
        self::$trainingCategory->status             = $request->status;
        self::$trainingCategory->author_id          = Auth::id();
        self::$trainingCategory->save();
    }

//    updateData
    public static function updateDate($request, $id)
    {
        self::$trainingCategory = TrainingCategory::find($id);
        self::$trainingCategory->training_category = $request->training_category;
        self::$trainingCategory->status            = $request->status;
        self::$trainingCategory->author_id         = Auth::id();
        self::$trainingCategory->save();
    }

//    statusUpdate
    public static function statusUpdate($id)
    {
        self::$trainingCategory   = TrainingCategory::find($id);
        if(self::$trainingCategory->status == 1)
        {
            self::$trainingCategory->status = 0;
        }
        else
        {
            self::$trainingCategory->status = 1;
        }
        self::$trainingCategory->save();
    }
//  deleteData
    public static function deleteData($id)
    {
        self::$trainingCategory   = TrainingCategory::find($id);
        self::$trainingCategory->delete();
    }

//    with training
    public function trainings()
    {
        return $this->hasMany(Training::class, 'training_category_id'); // Adjust 'category_id' if different
    }

}
