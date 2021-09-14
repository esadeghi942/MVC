<?php

namespace Controllers;

use Models\Bug;
use Models\Comment;
use Models\Customer;
use Models\QB;
use Models\Request;
use Models\User;
use Rakit\Validation\Validator;
use Systems\Auth;
use Systems\Url;
use Systems\View;

class CustomerController
{
    function adminIndex(){
        $customers=new Customer();
        $customers=$customers->all();
        return View::make('admin/customer/index',['customers'=>$customers]);
    }

    function adminCustomer(){
        $id=Url::get('id');
        $QB = QB::getInstance();
        $comments = $QB->table(Comment::table)->naturalJoin(User::table)->where(User::primary, $id)->orWhere('comment_to', $id)->orderBy('comment_create')->get();
        $user = $QB->table(Customer::table)->naturalJoin(User::table)->where(User::primary, $id)->get()[0];
        $requsts=$QB->table(Request::table)->where(User::primary,$id)->orderBy(Request::timecreate,'DESC')->get();
        $bugs=$QB->table(Bug::table)->where(User::primary,$id)->orderBy(Bug::timecreate,'DESC')->get();
        $QB->update(Comment::table, ['comment_readed' => 1])->where(User::primary, $id)->exec();
        return View::make('admin/customer/customer',['comments'=>$comments,'bugs'=>$bugs,'requsts'=>$requsts,'user'=>$user]);
    }

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
        $QB->insert(Customer::table, Customer::custom_input($_POST));
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
        $res=$QB->update(Customer::table, Customer::custom_input($_POST,true))->where(User::primary,$user)->exec();
        if($res)
            return View::redirect('../user', ['success' => 'پروفایل با موفقیت ویرایش شد .']);
        else
            return View::redirect('', ['danger' => 'مشکلی در ویرایش به وجود آمده):']);

    }

    function sendComment(){
        $QB = QB::getInstance();
        $QB->insert(Comment::table, Comment::custom_input($_POST));
        return View::redirect('',['success'=>'تیکت ارسال شد']);
    }
}