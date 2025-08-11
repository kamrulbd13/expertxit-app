<?php

namespace App\Models;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Ebook extends Model
{

    public static $data, $image, $imageName, $directory, $extension, $imgURL;

    protected $fillable = [
        'title', 'author', 'price', 'description', 'cover_image', 'download_link', 'status'
    ];

//    relation

    public function purchases()
    {
        return $this->hasMany(EbookPurchase::class);
    }




//    image url
    public static function getImageUrl($request){
        if ($request->hasFile('cover_image')) {
            self::$image = $request->file('cover_image');
            self::$extension = self::$image->extension();
            self::$imageName = $request->name .'.'. uniqid() . '.' . self::$extension;
            self::$directory = 'backend/images/ebook/';
            self::$image->move(self::$directory, self::$imageName);
            self::$imgURL = self::$directory . self::$imageName;
        } else {
            // Set default image URL if no file is uploaded
            self::$imgURL = 'backend/images/ebook/defaultImage.jpg';
        }
        return self::$imgURL;
    }



}
