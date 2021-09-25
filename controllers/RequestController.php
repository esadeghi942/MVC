<?php

namespace Controllers;

use Models\File;
use Models\QB;
use Models\Request;
use Systems\Auth;
use Systems\Url;
use Systems\Validation;
use Systems\View;

class RequestController
{
    function index()
    {
        $user = Auth::id();
        $QB = new QB();
        $where[]='user_id='.$user;
        if(Url::get('status') !== null)
            $where[]='request_status='.Url::get('status');
        if(Url::get('karshenasi') !== null)
            $where[]='request_karshenasi='.Url::get('karshenasi');
        $where=count($where) ? implode(' AND ',$where):null;
        $request = $QB->table(Request::table)->whereStatement($where)->orderBy(Request::timecreate, 'DESC')->get();
        $request = Request::defineAttributeValue($request);
        return View::make('user/request/index', ['requests' => $request]);
    }

    function store()
    {
        Validation::Validate($_POST, [
            'request_count_unit' => 'numeric',
            'request_count_request' => 'numeric',
            'request_build_request' => 'numeric',
        ],$_FILES['request_file']);

        $QB = QB::getInstance();
        $req_id = $QB->insert(Request::table, Request::custom_input($_POST));
        $file = new File();
        if ($req_id && $_FILES['request_file']['size'][0] > 0)
            $file->upload_file($_FILES['request_file'], $req_id, Request::table);
        if($_POST['request_karshenasi'] == 1)
            return  View::redirect('../payment?request_id='.$req_id);
        return View::redirect('../userRequestIndex', ['success' => 'درخواست با موفقیت ثبت شد.']);
    }

    function edit()
    {
        $req_id = Url::get('id');
        $request = new Request($req_id);
        $request->getcan();
        $item = $request->find();
        $files = $request->files();
        return View::make('user/request/edit', ['request' => $item, 'files' => $files]);
    }

    function update()
    {
        $req_id = Url::get('id');
        Validation::Validate($_POST, [
            'request_count_unit' => 'required|numeric',
            'request_count_request' => 'required|numeric',
            'request_build_request' => 'required|numeric',
            'request_address' => 'required',
        ],$_FILES['request_file']);
        $QB = QB::getInstance();
        $QB->update(Request::table, Request::custom_input($_POST, true))->where(Request::primary, $req_id)->exec();
        $file = new File();
        if ($_FILES['request_file']['size'][0] > 0)
            $file->upload_file($_FILES['request_file'], $req_id, Request::table);
        $request=(new Request($req_id))->find();
        if($_POST['request_karshenasi'] == 1 && $request->request_payment==0)
            return  View::redirect('../payment?request_id='.$req_id);
        return View::redirect('../userRequestIndex', ['success' => 'درخواست با موفقیت به روز رسانی شد.']);
    }

    function delete()
    {
        $id = $_POST['id'];
        $request = new Request($id);
        $can = $request->postcan();
        if (!$can) {
            Url::response('danger', 'شما اجازه حذف این درخواست را ندارید.');
            return;
        }
        $res = $request->delete();
        if ($res)
            Url::response('success', 'درخواست با موفقیت حذف شد.');
        else
            Url::response('danger', 'مشکلی در حذف درخواست به وجود امده.');
    }

    function adminIndex()
    {
        $request = new Request();
        $where=[];
        if(Url::get('status') !== null)
            $where[]='request_status='.Url::get('status');
        if(Url::get('karshenasi') !== null)
            $where[]='request_karshenasi='.Url::get('karshenasi');
        $where=count($where) ?implode(' AND ',$where):null;
        $request = $request->all($where);
        $request = Request::defineAttributeValue($request);
        return View::make('admin/request/index', ['requests' => $request]);
    }

    function userRequest()
    {
        $id = Url::get('id');
        $request = new Request($id);
        $item = $request->find();
        $files = $request->files();
        $item = Request::defineAttributeValueItem($item);
        return View::make('user/request/request', ['requset' => $item, 'files' => $files]);
    }


    function adminRequest()
    {
        $id = Url::get('id');
        $request = new Request($id);
        $qb = QB::getInstance();
        $item = $request->find();
        $files = $request->files();
        if ($item->request_status == 0)
            $qb->update(Request::table, ['request_status' => 1])->where(Request::primary, $id)->exec();
        $item = Request::defineAttributeValueItem($item);
        return View::make('admin/request/request', ['requset' => $item, 'files' => $files]);
    }

    function postAnswer()
    {
        $id = Url::get('id');
        $text = $_POST['txt'];
        $qb = QB::getInstance();
        $qb->update(Request::table, ['request_answer' => $text, 'request_status' => 2])->where(Request::primary, $id)->exec();
        return View::redirect('', ['success' => 'جوابیه با موفقیت ارسال شد.']);
    }
}