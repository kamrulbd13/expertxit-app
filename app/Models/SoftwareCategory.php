<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;


class SoftwareCategory extends Model
{
    public static $softwareCategory;

//    saveData
    public static function saveData($request)
    {

        self::$softwareCategory = new SoftwareCategory();
        self::$softwareCategory->name  = $request->name;
        self::$softwareCategory->icon_class  = $request->icon_class;
        self::$softwareCategory->status             = $request->status;
        self::$softwareCategory->author_id          = Auth::id();
        self::$softwareCategory->save();
    }

//    updateData
    public static function updateDate($request, $id)
    {
        self::$softwareCategory = SoftwareCategory::find($id);
        self::$softwareCategory->name = $request->name;
        self::$softwareCategory->icon_class = $request->icon_class;
        self::$softwareCategory->status            = $request->status;
        self::$softwareCategory->author_id         = Auth::id();
        self::$softwareCategory->save();
    }

//    statusUpdate
    public static function statusUpdate($id)
    {
        self::$softwareCategory   = SoftwareCategory::find($id);
        if(self::$softwareCategory->status == 1)
        {
            self::$softwareCategory->status = 0;
        }
        else
        {
            self::$softwareCategory->status = 1;
        }
        self::$softwareCategory->save();
    }
//  deleteData
    public static function deleteData($id)
    {
        self::$softwareCategory   = SoftwareCategory::find($id);
        self::$softwareCategory->delete();
    }


//    with training
    public function softwares()
    {
        return $this->hasMany(Software::class, 'software_category_id'); // Adjust 'category_id' if different
    }


}
