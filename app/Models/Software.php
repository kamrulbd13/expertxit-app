<?php

namespace App\Models;

use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Database\Eloquent\Model;
use Auth;

class Software extends Model
{
    public static $software;
    public static $data, $image, $imageName, $directory, $extension, $imgURL;

//    saveData
    public static function saveData($request)
    {

        self::$software = new Software();
        self::$software->name        = $request->name;
        self::$software->software_category_id            = $request->software_category_id;
        self::$software->description                     = $request->description;
        self::$software->core_features                   = $request->core_features;
        self::$software->advanced_modules                = $request->advanced_modules;
        self::$software->why_choose_our_solution         = $request->why_choose_our_solution;
        self::$software->benefits_for_every_stakeholder  = $request->benefits_for_every_stakeholder;
        self::$software->get_started_today               = $request->get_started_today;
        self::$software->image_path                      = self::getImageUrl($request);
        self::$software->status                          = $request->status;
        self::$software->author_id                       = Auth::id();

        // ✅ First save the training
        self::$software->save();

    }



//    image url
    public static function getImageUrl($request){
        if ($request->hasFile('image')) {
            self::$image = $request->file('image');
            self::$extension = self::$image->extension();
            self::$imageName = $request->name .'.'. uniqid() . '.' . self::$extension;
            self::$directory = 'backend/images/software/';
            self::$image->move(self::$directory, self::$imageName);
            self::$imgURL = self::$directory . self::$imageName;
        } else {
            // Set default image URL if no file is uploaded
            self::$imgURL = 'backend/images/software/defaultImage.jpg';
        }
        return self::$imgURL;
    }


//    updateData
// updateData
    public static function updateData($request, $id)
    {
        // Get the software
        self::$software = Software::findOrFail($id);

        // Update fields
        self::$software->name                           = $request->name;
        self::$software->software_category_id           = $request->software_category_id;
        self::$software->description                    = $request->description;
        self::$software->core_features                  = $request->core_features;
        self::$software->advanced_modules               = $request->advanced_modules;
        self::$software->why_choose_our_solution        = $request->why_choose_our_solution;
        self::$software->benefits_for_every_stakeholder = $request->benefits_for_every_stakeholder;
        self::$software->get_started_today              = $request->get_started_today;
        self::$software->status                         = $request->status;
        self::$software->author_id                      = Auth::id();

        // ✅ Handle image update
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if (self::$software->image_path && file_exists(public_path(self::$software->image_path))) {
                unlink(public_path(self::$software->image_path));
            }

            // Use the same function for consistency
            self::$software->image_path = self::getImageUrl($request);
        }

        // Save the software
        self::$software->save();
    }




//    statusUpdate
    public static function statusUpdate($id)
    {
        self::$software   = Software::find($id);
        if(self::$software->status == 1)
        {
            self::$software->status = 0;
        }
        else
        {
            self::$software->status = 1;
        }
        self::$software->save();
    }

//  deleteData
    public static function deleteData($id)
    {
        $data = Software::find($id);

        if (!$data) {
            return false; // or throw an exception
        }

        // Delete the image if it exists
        if ($data->image_path && file_exists(public_path($data->image_path))) {
            unlink(public_path($data->image_path));
        }

        // Delete the record from the database
        $data->delete();

        return true;
    }



    public function category()
    {
        return $this->belongsTo(SoftwareCategory::class, 'software_category_id');
    }



}
