<?php

namespace Controllers;

use Models\QB;
use Models\User;
use Rakit\Validation\Validator;
use Systems\Auth;
use Systems\View;
use Models\Customer;

class UserController{
    function create(){
        $user=Auth::id();
        $QB=QB::getInstance();
        $count=$QB->table(Customer::table)->where(User::primary,$user)->count();
        if($count > 0)
            View::redirect('../userProfileUpdate');
        else
            View::make('user/profile/create');
    }

    function storeProfile()
    {
        $user = Auth::id();
        $validator = new Validator;
        $validation = $validator->make($_POST, [
            'phone' => 'numeric'
        ]);
        $validation->validate();
        if ($validation->fails()) {
            $errors = $validation->errors();
            $errors = $errors->firstOfAll();
            $msg = '';
            foreach ($errors as $error)
                $msg .= "<pre>$error</pre>";
            return View::redirect('', ['danger' => $msg], true);
        }
        $QB = QB::getInstance();
        $QB->insert(Customer::table, Customer::custom_input($user, $_POST));
        $QB->update(User::table, ['user_type' => 1])->where(User::primary,$user)->exec();
        Auth::updateSessionLogin($user);
        return View::redirect('../user', ['success' => 'پروفایل با موفقیت کامل شد .']);
    }

    function editProfile()
    {
        $user = Auth::user()[User::primary];
        $customer = (new Customer($user))->find();
        return View::make('user/profile/edit', ['profile' => $customer]);
    }

    function updateProfile()
    {
        $user = Auth::id();
        $validator = new Validator;
        $validation = $validator->make($_POST, [
            'phone' => 'numeric'
        ]);
        $validation->validate();
        if ($validation->fails()) {
            $errors = $validation->errors();
            $errors = $errors->firstOfAll();
            $msg = '';
            foreach ($errors as $error)
                $msg .= "<pre>$error</pre>";
            return View::redirect('', ['danger' => $msg], true);
        }
        $QB = QB::getInstance();
        $res=$QB->update(Customer::table, Customer::custom_input($user, $_POST,true))->where(User::primary,$user)->exec();
        if($res)
            return View::redirect('../user', ['success' => 'پروفایل با موفقیت ویرایش شد .']);
       else
           return View::redirect('', ['danger' => 'مشکلی در ویرایش به وجود آمده):']);

    }
}