<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['name', 'description'];

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'permission_roles'); // pivot table name
    }


    public function users()
    {
        return $this->belongsToMany(User::class, 'role_users');
    }


}
