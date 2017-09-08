<?php

namespace App\Http\Controllers\Backend;

use App\Permission;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    //
    public function addRole()
    {
//        $owner = new Role();
//        $owner->name         = 'ordinary';
//        $owner->display_name = '普通用户'; // optional
//        $owner->description  = '刚注册的普通用户'; // optional
//        $owner->save();
//
//        $owner = new Role();
//        $owner->name         = 'vip';
//        $owner->display_name = 'vip用户'; // optional
//        $owner->description  = '每月交钱的vip用户'; // optional
//        $owner->save();

//        $admin = new Role();
//        $admin->name         = 'admin';
//        $admin->display_name = 'User Administrator'; // optional
//        $admin->description  = 'User is allowed to manage and edit other users'; // optional
//        $admin->save();

//        $role = Role::where('name','admin')->first();
//        $user = User::where('name', '=', 'xun1009a')->first();
//
//// role attach alias
//        $user->attachRole($role); // parameter can be an Role object, array, or id

// or eloquent's original technique
       // $user->roles()->attach($admin->id); // id only

            $owner = User::where('name','xun1009')->first();
            $role = Role::where('name','owner')->first();
            $owner->attachRole($role);

//        $createPost = new Permission();
//        $createPost->name         = 'create-post';
//        $createPost->display_name = 'Create Posts'; // optional
//// Allow a user to...
//        $createPost->description  = 'create new blog posts'; // optional
//        $createPost->save();
//
//        $editUser = new Permission();
//        $editUser->name         = 'edit-user';
//        $editUser->display_name = 'Edit Users'; // optional
//// Allow a user to...
//        $editUser->description  = 'edit existing users'; // optional
//        $editUser->save();
//        $admin = Role::where('name','admin')->first();
//        $createPost = Permission::where('name','create-post')->first();
//
//
//        $admin->attachPermission($createPost);
// equivalent to $admin->perms()->sync(array($createPost->id));

        //$owner->attachPermissions(array($createPost, $editUser));
//        $user = User::where('name','xun1009a')->first();
//
//        dd($user->can('edit-user'));
    }
}
