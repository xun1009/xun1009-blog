<?php
namespace App;

use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{
    public function hasUser()
    {
        return $this->belongsToMany(User::class,'role_user');
    }
}