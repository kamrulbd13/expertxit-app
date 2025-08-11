<?php

namespace App\Models;
use Auth;
use Illuminate\Database\Eloquent\Model;

class ITServiceCategory extends Model
{
    public static $itService;

//    saveData
    public static function saveData($request)
    {

        self::$itService = new ITServiceCategory();
        self::$itService->name  = $request->name;
        self::$itService->icon_class  = $request->icon_class;
        self::$itService->status             = $request->status;
        self::$itService->author_id          = Auth::id();
        self::$itService->save();
    }

//    updateData
    public static function updateDate($request, $id)
    {
        self::$itService = ITServiceCategory::find($id);
        self::$itService->name = $request->name;
        self::$itService->icon_class = $request->icon_class;
        self::$itService->status            = $request->status;
        self::$itService->author_id         = Auth::id();
        self::$itService->save();
    }

//    statusUpdate
    public static function statusUpdate($id)
    {
        self::$itService   = ITServiceCategory::find($id);
        if(self::$itService->status == 1)
        {
            self::$itService->status = 0;
        }
        else
        {
            self::$itService->status = 1;
        }
        self::$itService->save();
    }
//  deleteData
    public static function deleteData($id)
    {
        self::$itService   = ITServiceCategory::find($id);
        self::$itService->delete();
    }

//    with training
    public function trainings()
    {
        return $this->hasMany(Training::class, 'training_category_id'); // Adjust 'category_id' if different
    }
}
