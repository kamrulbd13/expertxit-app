<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;


class SystemMailSetting extends Model
{
    public static $data;

//    saveData
    public static function saveData($request)
    {
        self::$data = new SystemMailSetting();
        self::$data->mail_mailer         = $request->mail_mailer;
        self::$data->mail_host           = $request->mail_host;
        self::$data->mail_port           = $request->mail_port;
        self::$data->mail_username       = $request->mail_username;
        self::$data->mail_password       = $request->mail_password;
        self::$data->mail_encryption     = $request->mail_encryption;
        self::$data->mail_from_address   = $request->mail_from_address;
        self::$data->mail_from_name      = $request->mail_from_name;
        self::$data->status              = $request->status;
        self::$data->author_id           = Auth::id();
        self::$data->save();
    }

//    updateData
    public static function updateDate($request, $id)
    {
        self::$data = SystemMailSetting::find($id);
        self::$data->mail_mailer         = $request->mail_mailer;
        self::$data->mail_host           = $request->mail_host;
        self::$data->mail_port           = $request->mail_port;
        self::$data->mail_username       = $request->mail_username;
        self::$data->mail_password       = $request->mail_password;
        self::$data->mail_encryption     = $request->mail_encryption;
        self::$data->mail_from_address   = $request->mail_from_address;
        self::$data->mail_from_name      = $request->mail_from_name;
        self::$data->status              = $request->status;
        self::$data->author_id         = Auth::id();
        self::$data->save();
    }

//    statusUpdate
    public static function statusUpdate($id)
    {
        self::$data   = SystemMailSetting::find($id);
        if(self::$data->status == 1)
        {
            self::$data->status = 0;
        }
        else
        {
            self::$data->status = 1;
        }
        self::$data->save();
    }
//  deleteData
    public static function deleteData($id)
    {
        self::$data   = SystemMailSetting::find($id);
        self::$data->delete();
    }
}
