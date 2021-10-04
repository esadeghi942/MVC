<?php

namespace Controllers;

use Carbon\Carbon;
use Models\Bnswer;
use Models\Bug;
use Models\Comment;
use Models\Customer;
use Models\File;
use Models\GroupComment;
use Models\Mali;
use Models\QB;
use Models\Request;
use Models\User;
use Systems\Auth;
use Systems\Url;
use Systems\Validation;
use Systems\View;

class CustomerController
{
    function index()
    {
        $user = Auth::id();
        $user = (new User($user))->find();
        $descrition = json_decode($user['user_description'], true);
        $descrition = Customer::defineAttributeValueItem($descrition);
        return View::make('user/profile/index', ['user' => $user, 'description' => $descrition]);
    }

    function adminIndex()
    {
        $customers = new User();
        $customers = $customers->customers();
        return View::make('admin/customer/index', ['customers' => $customers]);
    }

    function adminCustomer()
    {
        $id = Url::get('id');
        $QB = QB::getInstance();
        $groupcomments = $QB->table(GroupComment::table)->naturalJoin(User::table)->where(User::primary, $id)->orderBy(GroupComment::timecreate, 'DESC')->get();
        $unrcoment = (new GroupComment())->unreadcomment();
        $res = [];
        foreach ($unrcoment as $item)
            $res[$item['gcomment_id']]['count'] = $item['count_unread'];
        foreach ($groupcomments as $record)
            $record->count_unread = isset($res[$record->gcomment_id]['count']) ? $res[$record->gcomment_id]['count'] : 0;
        $user = $QB->table(User::table)->where(User::primary, $id)->get()->first();
        $descrition = json_decode($user->user_description, true);
        $descrition = Customer::defineAttributeValueItem($descrition);
        $requsts = $QB->table(Request::table)->where(User::primary, $id)->orderBy(Request::timecreate, 'DESC')->get();
        $bugs = $QB->table(Bug::table)->where(User::primary, $id)->orderBy(Bug::timecreate, 'DESC')->get();
        $malis = $QB->table(Mali::table)->where(User::primary, $id)->orderBy(Mali::timecreate, 'DESC')->get();
        $malis = Mali::defineAttributeValue($malis);
        $documents = $QB->table(File::table)->where('file_model', User::table)->where('model_id', $id)->orderBy(File::timecreate, 'DESC')->get();
        return View::make('admin/customer/customer', ['gcomments' => $groupcomments, 'bugs' => $bugs, 'requsts' => $requsts, 'user' => $user, 'description' => $descrition, 'malis' => $malis, 'document' => $documents]);
    }

    function create()
    {
        $QB = QB::getInstance();
        $item = $QB->table(User::table)->where(User::primary, Auth::id())->get()->first();
        if ($item->user_type == User::customer)
            View::redirect('../userProfileUpdate');
        else
            View::make('user/profile/create');
    }

    function storeProfile()
    {
        $user = Auth::id();
        Validation::Validate($_POST, [
            'phone' => 'numeric',
            'user_type_customer' => 'required'
        ]);
        if ($_POST['user_type_customer'] == '0') {
            Validation::Validate($_POST, [
                'national_code' => 'required|numeric',
            ]);
        } else {
            Validation::Validate($_POST, [
                'company' => 'required',
                'namayande' => 'required',
                'phone_namayande' => 'numeric|required',
                'activity' => 'required',
            ]);
        }
        $QB = QB::getInstance();
        $date = Carbon::now()->toDateTimeString();
        $description = Customer::custom_input($_POST);
        $res = $QB->update(User::table, ['user_type' => 1, 'user_fix_number' => $_POST['user_fix_number'], 'user_address' => $_POST['user_address'], 'user_description' => $description, 'user_update' => $date])->where(User::primary, $user)->exec();
        if ($res) {
            Auth::updateSessionLogin($user);
            return View::redirect('../user', ['success' => 'پروفایل با موفقیت کامل شد .']);
        } else
            return View::redirect('../user', ['danger' => 'مشکلی در تکمیل پروفایل به وجود آمده):']);
    }

    function editProfile()
    {
        $user = Auth::id();
        $user = (new User($user))->find();
        $descrition = json_decode($user['user_description'], true);
        return View::make('user/profile/edit', ['user' => $user, 'description' => $descrition]);
    }

    function updateProfile()
    {
        $user = Auth::id();
        Validation::Validate($_POST, [
            'phone' => 'numeric',
            'user_type_customer' => 'required'
        ]);
        if ($_POST['user_type_customer'] == '0') {
            Validation::Validate($_POST, [
                'national_code' => 'required|numeric',
            ]);
        } else {
            Validation::Validate($_POST, [
                'company' => 'required',
                'namayande' => 'required',
                'phone_namayande' => 'numeric|required',
                'activity' => 'required',
            ]);
        }
        $QB = QB::getInstance();
        $date = Carbon::now()->toDateTimeString();
        $description = Customer::custom_input($_POST);

        $res = $QB->update(User::table, ['user_fix_number' => $_POST['user_fix_number'], 'user_address' => $_POST['user_address'], 'user_description' => $description, 'user_update' => $date])->where(User::primary, $user)->exec();
        if ($res)
            return View::redirect('../user', ['success' => 'پروفایل با موفقیت ویرایش شد .']);
        else
            return View::redirect('', ['danger' => 'مشکلی در ویرایش به وجود آمده):']);

    }

    function delete()
    {
        $id = $_POST['id'];
        $Qb = QB::getInstance();
        $document = $Qb->table(File::table)->where('file_model', User::table)->where('model_id', $id)->get();
        foreach ($document as $item) {
            (new File($item->file_id))->delete();
        }

        $req = $Qb->table(Request::table)->where(User::primary, $id)->get();
        foreach ($req as $item) {
            (new Request($item->request_id))->delete();
        }

        $bug = $Qb->table(Bug::table)->where(User::primary, $id)->get();
        foreach ($bug as $item) {
            (new Bug($item->bug_id))->delete();
        }
        $comment = $Qb->table(GroupComment::table)->where(User::primary, $id)->get();
        foreach ($comment as $item) {
            (new GroupComment($item->gcomment_id))->delete();
        }
        $res = $Qb->delete(User::table)->where(User::primary, $id)->exec();

        if ($res)
            Url::response('success', 'مشتری  با موفقیت حذف شد.');
        else
            Url::response('danger', 'مشکلی در حذف مشتری  به وجود امده.');
    }
}