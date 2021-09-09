<?php

namespace Controllers;

use Models\QB;
use Models\User;
use Rakit\Validation\Validator;
use Systems\Auth;
use Systems\Url;
use Systems\View;
use Models\Customer;

class UserController
{

    function adminAll()
    {
        $qb = QB::getInstance();
        $user = $qb->table(User::table)->where('user_type', User::admin)->orWhere('user_type', User::superadmin)->get();
        $user = User::defineAttributeValue($user);
        return View::make('admin/user/index', ['users' => $user]);
    }

    function adminEdit()
    {
        $id=Url::get('id');
        $user=new User($id);
        $user=$user->find();
        return View::make('admin/user/edit',['user'=>$user]);
    }

    function adminDelete()
    {
        $id = $_POST['id'];
        if (!Auth::isSuperAdmin()) {
            Url::response('danger', 'شما اجازه حذف را ندارید.');
            return;
        }
        $user=new User($id);
        $res=$user->delete();
        if ($res)
            Url::response('success', 'کاربر با موفقیت حذف شد.');
        else
            Url::response('danger', 'مشکلی در حذف کاربر به وجود امده.');
    }
}