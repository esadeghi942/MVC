<?php

namespace Controllers;

use Carbon\Carbon;
use Models\Bug;
use Models\Comment;
use Models\Customer;
use Models\QB;
use Models\Request;
use Models\User;
use Systems\Auth;
use Systems\Url;
use Systems\Validation;
use Systems\View;

class CustomerController
{
    function index(){
        $user = Auth::id();
        $user = (new User($user))->find();
        $descrition=json_decode($user['user_description'],true);
        $descrition=Customer::defineAttributeValueItem($descrition);
        return View::make('user/profile/index',['user' => $user,'description'=>$descrition]);
    }

    function adminIndex(){
        $customers=new Customer();
        $customers=$customers->all();
        return View::make('admin/customer/index',['customers'=>$customers]);
    }

    function adminCustomer(){
        $id=Url::get('id');
        $QB = QB::getInstance();
        $comments = $QB->table(Comment::table)->naturalJoin(User::table)->where(User::primary, $id)->orWhere('comment_to', $id)->orderBy('comment_create')->get();
        $user = $QB->table(User::table)->where(User::primary, $id)->get()->first();
        $requsts=$QB->table(Request::table)->where(User::primary,$id)->orderBy(Request::timecreate,'DESC')->get();
        $bugs=$QB->table(Bug::table)->where(User::primary,$id)->orderBy(Bug::timecreate,'DESC')->get();
        $QB->update(Comment::table, ['comment_readed' => 1])->where(User::primary, $id)->exec();
        return View::make('admin/customer/customer',['comments'=>$comments,'bugs'=>$bugs,'requsts'=>$requsts,'user'=>$user]);
    }

    function create(){
        $QB=QB::getInstance();
        $count=$QB->table(User::table)->where('user_type',User::customer)->count();
        if($count > 0)
            View::redirect('../userProfileUpdate');
        else
            View::make('user/profile/create');
    }

    function storeProfile()
    {
        $user = Auth::id();
        Validation::Validate($_POST, [
            'phone' => 'numeric',
            'user_type_customer'=>'required'
        ]);
        if($_POST['user_type_customer'] == '0') {
            Validation::Validate($_POST, [
                'national_code' => 'required|numeric',
            ]);
        }
        else{
            Validation::Validate($_POST, [
                'company' => 'required',
                'namayande' => 'required',
                'phone_namayande' => 'required',
                'activity' => 'required',
            ]);
        }
        $QB = QB::getInstance();
        $date= Carbon::now()->toDateTimeString();
        $description=Customer::custom_input($_POST);
        $res=$QB->update(User::table, ['user_type' => 1,'user_fix_number'=>$_POST['user_fix_number'],'user_address'=>$_POST['user_address'],'user_description'=>$description,'user_update'=>$date])->where(User::primary,$user)->exec();
        if($res) {
            Auth::updateSessionLogin($user);
            return View::redirect('../user', ['success' => 'پروفایل با موفقیت کامل شد .']);
        }
        else
            return View::redirect('../user', ['danger' => 'مشکلی در تکمیل پروفایل به وجود آمده):']);
    }

    function editProfile()
    {
        $user = Auth::id();
        $user = (new User($user))->find();
        $descrition=json_decode($user['user_description'],true);
        return View::make('user/profile/edit', ['user' => $user,'description'=>$descrition]);
    }

    function updateProfile()
    {
        $user = Auth::id();
        Validation::Validate($_POST, [
            'phone' => 'numeric',
            'user_type_customer'=>'required'
        ]);
        if($_POST['user_type_customer'] == '0') {
            Validation::Validate($_POST, [
                'national_code' => 'required|numeric',
            ]);
        }
        else{
            Validation::Validate($_POST, [
                'company' => 'required',
                'namayande' => 'required',
                'phone_namayande' => 'required',
                'activity' => 'required',
            ]);
        }
        $QB = QB::getInstance();
        $date= Carbon::now()->toDateTimeString();
        $description=Customer::custom_input($_POST);

        $res=$QB->update(User::table, ['user_fix_number'=>$_POST['user_fix_number'],'user_address'=>$_POST['user_address'],'user_description'=>$description,'user_update'=>$date])->where(User::primary,$user)->exec();
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