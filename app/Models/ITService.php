<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;

class ITService extends Model
{
    public static $itService;
    public static $data, $image, $imageName, $directory, $extension, $imgURL;

//    saveData
    public static function saveData($request)
    {

        self::$itService = new ITService();
        self::$itService->name        = $request->name;
        self::$itService->itService_category_id            = $request->itService_category_id;
        self::$itService->description                     = $request->description;
        self::$itService->core_features                   = $request->core_features;
        self::$itService->advanced_modules                = $request->advanced_modules;
        self::$itService->why_choose_our_solution         = $request->why_choose_our_solution;
        self::$itService->benefits_for_every_stakeholder  = $request->benefits_for_every_stakeholder;
        self::$itService->get_started_today               = $request->get_started_today;
        self::$itService->image_path                      = self::getImageUrl($request);
        self::$itService->status                          = $request->status;
        self::$itService->author_id                       = Auth::id();

        // ✅ First save the training
        self::$itService->save();

    }



//    image url
    public static function getImageUrl($request){
        if ($request->hasFile('image')) {
            self::$image = $request->file('image');
            self::$extension = self::$image->extension();
            self::$imageName = $request->name .'.'. uniqid() . '.' . self::$extension;
            self::$directory = 'backend/images/itService/';
            self::$image->move(self::$directory, self::$imageName);
            self::$imgURL = self::$directory . self::$imageName;
        } else {
            // Set default image URL if no file is uploaded
            self::$imgURL = 'backend/images/itService/defaultImage.jpg';
        }
        return self::$imgURL;
    }


//    updatedata
    public static function updateData($request, $id)
    {
        // Get the IT Service
        self::$itService = ITService::findOrFail($id);

        // Update fields
        self::$itService->name                       = $request->name;
        self::$itService->itService_category_id      = $request->itService_category_id;
        self::$itService->description                = $request->description;
        self::$itService->core_features              = $request->core_features;
        self::$itService->advanced_modules           = $request->advanced_modules;
        self::$itService->why_choose_our_solution    = $request->why_choose_our_solution;
        self::$itService->benefits_for_every_stakeholder = $request->benefits_for_every_stakeholder;
        self::$itService->get_started_today          = $request->get_started_today;
        self::$itService->status                      = $request->status;
        self::$itService->author_id                   = Auth::id();

        // ✅ Handle image update
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if (self::$itService->image_path && file_exists(public_path(self::$itService->image_path))) {
                unlink(public_path(self::$itService->image_path));
            }

            // Store new image
            $image = $request->file('image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/itService'), $imageName);

            // Save image path
            self::$itService->image_path = 'uploads/itService/' . $imageName;
        }

        // Save the record
        self::$itService->save();
    }



//    statusUpdate
    public static function statusUpdate($id)
    {
        self::$itService   = ITService::find($id);
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
        $data = ITService::find($id);

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
        return $this->belongsTo(ITServiceCategory::class, 'itService_category_id');
    }

}
