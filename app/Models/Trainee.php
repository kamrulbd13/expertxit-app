<?php

namespace App\Models;

use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Database\Eloquent\Model;
use Auth;

class Trainee extends Model
{
    public static $child, $image, $imageName, $imgURL, $directory, $extension;

//    saveData
    public static function saveData($request)
    {
        $id = IdGenerator::generate(['table' => 'children','field' => 'child_id', 'length' => 6, 'prefix' =>'CH-']);
        self::$child = new Trainee();
        self::$child->child_id          = $id;
        self::$child->school_id         = $request->school_id;
        self::$child->child_name        = $request->child_name;
        self::$child->birth_of_date     = $request->birth_of_date;
        self::$child->age               = $request->age;
        self::$child->gender            = $request->gender;
        self::$child->education         = $request->education;
        self::$child->current_therapy   = $request->current_therapy;
        self::$child->autism_level      = $request->autism_level;
        self::$child->cell              = $request->cell;
        self::$child->email             = $request->email;
        self::$child->father_name       = $request->father_name;
        self::$child->father_education  = $request->father_education;
        self::$child->father_occupation = $request->father_occupation;
        self::$child->mother_name       = $request->mother_name;
        self::$child->mother_education  = $request->mother_education;
        self::$child->mother_occupation = $request->mother_occupation;
        self::$child->address           = $request->address;
        self::$child->image_path        = self::getImageUrl($request);
        self::$child->status            = $request->status;
        self::$child->author_id         = Auth::id();
        self::$child->save();
    }

//    image url
    private static function getImageUrl($request)
    {
        self::$image    =   $request->file('image');
        self::$extension=   self::$image->extension();
        self::$imageName=   rand(000, 999).'.'.self::$extension;
        self::$directory=   'backend/images/childes/';
        self::$image->move(self::$directory, self::$imageName);
        self::$imgURL   =   self::$directory.self::$imageName;
        return self::$imgURL;
    }
//    updateData
    public static function updateDate($request, $id)
    {
        self::$child = Trainee::find($id);
        self::$child->child_id          = $id;
        self::$child->school_id         = $request->school_id;
        self::$child->child_name        = $request->child_name;
        self::$child->birth_of_date     = $request->birth_of_date;
        self::$child->age               = $request->age;
        self::$child->gender            = $request->gender;
        self::$child->education         = $request->education;
        self::$child->current_therapy   = $request->current_therapy;
        self::$child->autism_level      = $request->autism_level;
        self::$child->cell              = $request->cell;
        self::$child->email             = $request->email;
        self::$child->father_name       = $request->father_name;
        self::$child->father_education  = $request->father_education;
        self::$child->father_occupation = $request->father_occupation;
        self::$child->mother_name       = $request->mother_name;
        self::$child->mother_education  = $request->mother_education;
        self::$child->mother_occupation = $request->mother_occupation;
        self::$child->address            = $request->address;
        self::$child->status            = $request->status;
        self::$child->author_id         = Auth::id();

        if($request->file('image'))
        {
            if(file_exists(self::$child->image_path))
            {
                unlink(self::$child->image_path);
            }
            self::$child->image_path = self::getImageUrl($request);
        }
        self::$child->save();
    }

//    statusUpdate
    public static function statusUpdate($id)
    {
        self::$child   = Trainee::find($id);
        if(self::$child->status == 1)
        {
            self::$child->status = 0;
        }
        else
        {
            self::$child->status = 1;
        }
        self::$child->save();
    }
//  deleteData
    public static function deleteData($id)
    {
        self::$child   = Trainee::find($id);
        self::$child->delete();
    }

//    many to one with trainerType
    public function school()
    {
        return $this->belongsTo(School::class);
    }
}
