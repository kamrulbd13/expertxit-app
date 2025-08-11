<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;

class SystemSetting extends Model
{
    public static $data, $image1, $imageName1, $directory1, $extension1, $imgURL1;
    public static $image2, $imageName2, $directory2, $extension2, $imgURL2;
    public static $image3, $imageName3, $directory3, $extension3, $imgURL3;
    public static $image4, $imageName4, $directory4, $extension4, $imgURL4;
    public static $image5, $imageName5, $directory5, $extension5, $imgURL5;

    public static function updateData($request, $id)
    {
        $setting = SystemSetting::find($id);

        if (!$setting) {
            return false; // or throw new ModelNotFoundException
        }

        $setting->site_name   = $request->site_name;
        $setting->slogan      = $request->slogan;
        $setting->mail1       = $request->mail1;
        $setting->mail2       = $request->mail2;
        $setting->number1     = $request->number1;
        $setting->number2     = $request->number2;
        $setting->logo_width  = $request->logo_width;
        $setting->logo_height = $request->logo_height;
        $setting->address     = $request->address;
        $setting->website_link= $request->website_link;
        $setting->facebook    = $request->facebook;
        $setting->linkedin    = $request->linkedin;
        $setting->twitter     = $request->twitter;
        $setting->youtube     = $request->youtube;
        $setting->map_link    = $request->map_link;
        $setting->copy_right  = $request->copy_right;
        $setting->author_id   = Auth::id();

        // Handle image_logo_color update
        if ($request->hasFile('image_logo_color')) {
            if ($setting->image_logo_color && file_exists(public_path($setting->image_logo_color))) {
                unlink(public_path($setting->image_logo_color));
            }
            $setting->image_logo_color = self::getImageUrl1($request); // Adjust as needed
        }

        // Handle image_logo_white update
        if ($request->hasFile('image_logo_white')) {
            if ($setting->image_logo_white && file_exists(public_path($setting->image_logo_white))) {
                unlink(public_path($setting->image_logo_white));
            }

            $setting->image_logo_white = self::getImageUrl2($request); // Adjust as needed
        }

        // Handle fevicon_icon update
        if ($request->hasFile('fevicon_icon')) {
            if ($setting->fevicon_icon && file_exists(public_path($setting->fevicon_icon))) {
                unlink(public_path($setting->fevicon_icon));
            }

            $setting->fevicon_icon = self::getImageUrl3($request); // Adjust as needed
        }

        // Handle org_seal update
        if ($request->hasFile('org_seal')) {
            if ($setting->org_seal && file_exists(public_path($setting->org_seal))) {
                unlink(public_path($setting->org_seal));
            }

            $setting->org_seal = self::getImageUrl4($request); // Adjust as needed
        }

        // Handle signature update
        if ($request->hasFile('signature')) {
            if ($setting->signature && file_exists(public_path($setting->signature))) {
                unlink(public_path($setting->signature));
            }

            $setting->signature = self::getImageUrl5($request); // Adjust as needed
        }

        $setting->save();
        return true;
    }


//    image url color
    public static function getImageUrl1($request){
        if ($request->hasFile('image_logo_color')) {
            self::$image1 = $request->file('image_logo_color');
            self::$extension1 = self::$image1->extension();
            self::$imageName1 = $request->name .'.'. uniqid() . '.' . self::$extension1;
            self::$directory1 = 'backend/images/systemSetting/';
            self::$image1->move(self::$directory1, self::$imageName1);
            self::$imgURL1 = self::$directory1 . self::$imageName1;
        } else {
            // Set default image URL if no file is uploaded
            self::$imgURL1 = 'backend/images/systemSetting/defaultImage.jpg';
        }
        return self::$imgURL1;
    }

    //    image url color
    public static function getImageUrl2($request){
        if ($request->hasFile('image_logo_white')) {
            self::$image2 = $request->file('image_logo_white');
            self::$extension2 = self::$image2->extension();
            self::$imageName2 = $request->name .'.'. uniqid() . '.' . self::$extension2;
            self::$directory2 = 'backend/images/systemSetting/';
            self::$image2->move(self::$directory2, self::$imageName2);
            self::$imgURL2 = self::$directory2 . self::$imageName2;
        } else {
            // Set default image URL if no file is uploaded
            self::$imgURL2 = 'backend/images/systemSetting/defaultImage.jpg';
        }
        return self::$imgURL2;
    }

    //    image url fevicon_icon
    public static function getImageUrl3($request){
        if ($request->hasFile('fevicon_icon')) {
            self::$image3 = $request->file('fevicon_icon');
            self::$extension3 = self::$image3->extension();
            self::$imageName3 = $request->name .'.'. uniqid() . '.' . self::$extension3;
            self::$directory3 = 'backend/images/systemSetting/';
            self::$image3->move(self::$directory3, self::$imageName3);
            self::$imgURL3 = self::$directory3 . self::$imageName3;
        } else {
            // Set default image URL if no file is uploaded
            self::$imgURL3 = 'backend/images/systemSetting/defaultImage.jpg';
        }
        return self::$imgURL3;
    }

    //    image url org_seal
    public static function getImageUrl4($request){
        if ($request->hasFile('org_seal')) {
            self::$image4 = $request->file('org_seal');
            self::$extension4 = self::$image4->extension();
            self::$imageName4 = $request->name .'.'. uniqid() . '.' . self::$extension4;
            self::$directory4 = 'backend/images/systemSetting/';
            self::$image4->move(self::$directory4, self::$imageName4);
            self::$imgURL4 = self::$directory4 . self::$imageName4;
        } else {
            // Set default image URL if no file is uploaded
            self::$imgURL4 = 'backend/images/systemSetting/defaultImage.jpg';
        }
        return self::$imgURL4;
    }

    //    image url signature
    public static function getImageUrl5($request){
        if ($request->hasFile('signature')) {
            self::$image5 = $request->file('signature');
            self::$extension5 = self::$image5->extension();
            self::$imageName5 = $request->name .'.'. uniqid() . '.' . self::$extension5;
            self::$directory5 = 'backend/images/systemSetting/';
            self::$image5->move(self::$directory5, self::$imageName5);
            self::$imgURL5 = self::$directory5 . self::$imageName5;
        } else {
            // Set default image URL if no file is uploaded
            self::$imgURL5 = 'backend/images/systemSetting/defaultImage.jpg';
        }
        return self::$imgURL5;
    }




}
