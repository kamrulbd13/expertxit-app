<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LabAccessCredential extends Model
{
    protected $fillable = [
        'user_id',
        'training_id',
        'username',
        'password_access_key',
        'portal_url',
        'vm_rdp_ip',
        'ssh',
        'vpn',
        'assigned_date',
        'expiry_date',
        'status',
    ];

    //    statusUpdate
    public static function statusUpdate($id)
    {
        self::$training   = LabAccessCredential::find($id);
        if(self::$training->status == 1)
        {
            self::$training->status = 0;
        }
        else
        {
            self::$training->status = 1;
        }
        self::$training->save();
    }

//  deleteData
    public static function deleteData($id)
    {
        $data = LabAccessCredential::find($id);

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

// In your LabAccessCredential model

    public function checkExpiryDateAndUpdate()
    {
        $currentDate = now();
        if ($this->expiry_date && $this->expiry_date <= $currentDate) {
            $this->status = 0;  // Update status to 0 if expired
            $this->save();
        }
    }


//    relation
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function training()
    {
        return $this->belongsTo(Training::class);
    }


}
