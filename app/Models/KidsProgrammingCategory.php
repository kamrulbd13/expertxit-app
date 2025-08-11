<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;
class KidsProgrammingCategory extends Model
{
    public static $kidsProgramme;

//    saveData
    public static function saveData($request)
    {

        self::$kidsProgramme = new KidsProgrammingCategory();
        self::$kidsProgramme->name  = $request->name;
        self::$kidsProgramme->icon_class  = $request->icon_class;
        self::$kidsProgramme->status             = $request->status;
        self::$kidsProgramme->author_id          = Auth::id();
        self::$kidsProgramme->save();
    }

//    updateData
    public static function updateDate($request, $id)
    {
        self::$kidsProgramme = KidsProgrammingCategory::find($id);
        self::$kidsProgramme->name = $request->name;
        self::$kidsProgramme->icon_class = $request->icon_class;
        self::$kidsProgramme->status            = $request->status;
        self::$kidsProgramme->author_id         = Auth::id();
        self::$kidsProgramme->save();
    }

//    statusUpdate
    public static function statusUpdate($id)
    {
        self::$kidsProgramme   = KidsProgrammingCategory::find($id);
        if(self::$kidsProgramme->status == 1)
        {
            self::$kidsProgramme->status = 0;
        }
        else
        {
            self::$kidsProgramme->status = 1;
        }
        self::$kidsProgramme->save();
    }
//  deleteData
    public static function deleteData($id)
    {
        self::$kidsProgramme   = KidsProgrammingCategory::find($id);
        self::$kidsProgramme->delete();
    }

//    with training
    public function kidsProgrammes()
    {
        return $this->hasMany(KidsProgramming::class, 'kidsProgramming_category_id'); // Adjust 'category_id' if different
    }
}
