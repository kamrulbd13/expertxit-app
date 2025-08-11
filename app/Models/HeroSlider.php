<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;



use Auth;

class HeroSlider extends Model
{
    public static $data, $image, $imageName, $imgURL, $directory, $extension;

//    saveData
    public static function saveData($request)
    {
        self::$data = new HeroSlider();
        self::$data->title           = $request->title;
        self::$data->description    = $request->description;
        self::$data->image_path     = self::getImageUrl($request);
        self::$data->status         = $request->status;
        self::$data->author_id      = Auth::id();
        self::$data->save();
    }



//    image url
    public static function getImageUrl($request){
        if ($request->hasFile('image')) {
            self::$image = $request->file('image');
            self::$extension = self::$image->extension();
            self::$imageName = $request->title .'.'. uniqid() . '.' . self::$extension;
            self::$directory = 'backend/images/heroSlider/';
            self::$image->move(self::$directory, self::$imageName);
            self::$imgURL = self::$directory . self::$imageName;
        } else {
            // Set default image URL if no file is uploaded
            self::$imgURL = 'backend/images/heroSlider/defaultImage.jpg';
        }
        return self::$imgURL;
    }

//    updateData
    public static function updateData($request, $id)
    {
        $data = HeroSlider::find($id);

        if (!$data) {
            return false; // or throw an exception
        }

        $data->title        = $request->title;
        $data->description = $request->description;
        $data->status      = $request->status;

        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($data->image_path && file_exists(public_path($data->image_path))) {
                unlink(public_path($data->image_path));
            }

            // Upload new image and update path
            $data->image_path = self::getImageUrl($request);
        }

        $data->save();

        return true; // or return the updated model
    }


//  deleteData
    public static function deleteData($id)
    {
        $data = HeroSlider::find($id);

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
}
