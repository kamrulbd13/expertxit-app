<?php

namespace App\Models;
use Carbon\Carbon;
use App\Mail\CustomerApprovalMail;
use App\Notifications\CustomerResetPassword;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Mail;

class Customer extends Authenticatable implements MustVerifyEmail

{
    use Notifiable;

    // No need for static property here, just use instance methods
    protected $fillable = ['name', 'email', 'phone', 'terms_condition_status', 'password'];


   public static $data, $image, $imageName, $directory, $extension, $imgURL;
   public static $systemInfo;

//   save data
    public static function saveData($request)
    {
        // Create an instance of Customer (no need for static $data)
        $customer = new self();
        $customer->name                     = $request->name;
        $customer->email                    = $request->email;
        $customer->phone                    = $request->phone;
        $customer->image_path               = self::getImageUrl($request);
        $customer->terms_condition_status   = $request->terms_condition_status;
        $customer->password                 = Hash::make($request->password);

        // Save the customer
        $customer->save();
    }

//    image url
    public static function getImageUrl($request){
        if ($request->hasFile('image')) {
            self::$image = $request->file('image');
            self::$extension = self::$image->extension();
            self::$imageName = $request->name .'.'. uniqid() . '.' . self::$extension;
            self::$directory = 'backendCustomer/images/user/';
            self::$image->move(self::$directory, self::$imageName);
            self::$imgURL = self::$directory . self::$imageName;
        } else {
            // Set default image URL if no file is uploaded
            self::$imgURL = 'backendCustomer/images/user/defaultImage.jpg';
        }
        return self::$imgURL;
    }

//    update Data
    public static function updateData($request, $id)
    {
        // Find the customer by ID
        $data = Customer::find($id);

        // Update customer details
        $data->name = $request->name;
        // Check if a new password is provided
        if ($request->password) {
            $data->password = Hash::make($request->password);  // Update password if provided
        }
        $data->occupation = $request->occupation;
        $data->city_district = $request->city_district;
        $data->state_country = $request->state_country;
        $data->linkedin = $request->linkedin;
        $data->facebook = $request->facebook;
        $data->twitter = $request->twitter;
        $data->instagram = $request->instagram;

        // Check if a new image is uploaded
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($data->image_path && file_exists(public_path($data->image_path))) {
                unlink(public_path($data->image_path));  // Delete the old image
            }

            // Upload new image and update the path
            $data->image_path = self::getImageUrl($request);  // Assuming you have a method to handle image uploads
        }

        // Save updated data to the database
        $data->save();

        return true;  // You can return the updated model if needed
    }

// Toggle and approve/reject customer status and send email notification
    public static function statusUpdate($id)
    {
        self::$data = Customer::find($id);

        if (!self::$data) {
            return;
        }

        // Store original status
        $originalStatus = self::$data->status;

        // Toggle status
        self::$data->status = $originalStatus == 1 ? 0 : 1;
        self::$data->save();

        // Only send mail if status changed from 0 to 1
        if ($originalStatus == 0 && self::$data->status == 1) {
            self::$systemInfo = SystemSetting::first();
            Mail::to(self::$data->email)->send(new CustomerApprovalMail(self::$data, self::$systemInfo));
        }
    }



//  deleteData
    public static function deleteData($id)
    {
        self::$data   = Customer::find($id);
        self::$data->delete();
    }


    // Tell Laravel how to send password reset notification to this model
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new CustomerResetPassword($token));
    }


    // online live status
    protected $casts = [
        'last_seen_at' => 'datetime',
    ];
    public function isOnline()
    {
        return $this->last_seen_at && $this->last_seen_at->gt(now()->subMinutes(2));
    }


//    last online
    public function lastSeenHuman()
    {
        if (!$this->last_seen_at) {
            return 'Never seen';
        }
        if ($this->isOnline()) {
            return 'available';
        }
        return 'Last seen ' . $this->last_seen_at->diffForHumans(null, true) . ' ago';
    }


//    relation
    public function ebookPurchases()
    {
        return $this->hasMany(EbookPurchase::class);
    }


    public function purchasedEbooks()
    {
        return $this->belongsToMany(Ebook::class, 'ebook_purchases', 'customer_id', 'ebook_id')
            ->withTimestamps(); // optional
    }


}
