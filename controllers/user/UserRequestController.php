<?php
namespace Controllers\User;

use Models\File;
use Models\QB;
use Models\Request;
use Models\User;
use Rakit\Validation\Validator;
use Systems\Auth;
use Systems\Url;
use Systems\View;

class UserRequestController
{
    function index(){
        $user=Auth::id();
        $QB=new QB();
        $request=$QB->table(Request::table)->where(User::primary,$user)->orderBy(Request::primary, 'DESC')->get();
        $request=Request::defineAttributeValue($request);
        return View::make('user/request/index',['requests'=>$request]);
    }

    function store(){
        $user = Auth::id();
        $validator = new Validator;
        $validation = $validator->make($_POST, [
            'request_count_unit' => 'numeric',
            'request_count_request' => 'numeric',
            'request_build_request' => 'numeric',
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
        $req_id=$QB->insert(Request::table,Request::custom_input($user,$_POST));
        $file=new File();
        if($req_id && $_FILES['request_file']['size'][0] > 0)
            $file->upload_file($_FILES['request_file'],$req_id,Request::table);
        return View::redirect('../userRequestIndex', ['success' => 'درخواست با موفقیت ثبت شد.']);
    }

    function edit(){
        $req_id=Url::get('id');
        $request=new Request($req_id);
        $request->getcan();
        $item=$request->find();
        $files=$request->files();
        return View::make('user/request/edit',['request'=>$item,'files'=>$files]);
    }

    function update(){
        $req_id=Url::get('id');
        $user = Auth::id();
        $validator = new Validator;
        $validation = $validator->make($_POST, [
            'request_count_unit' => 'numeric',
            'request_count_request' => 'numeric',
            'request_build_request' => 'numeric',
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
        $QB->update(Request::table,Request::custom_input($user,$_POST,true))->where(Request::primary,$req_id)->exec();
        $file=new File();
        if($_FILES['request_file']['size'][0] > 0)
            $file->upload_file($_FILES['request_file'],$req_id,Request::table);
        return View::redirect('../userRequestIndex', ['success' => 'درخواست با موفقیت به روز رسانی شد.']);
    }

    function delete(){
        $id=$_POST['id'];
        $request=new Request($id);
        $can=$request->postcan($id);
        if(!$can) {
            Url::response('danger','شما اجازه حذف این درخواست را ندارید.');
            return;
        }
        $files=$request->files();
        foreach ($files as $file){
            $f=new File($file->file_id);
            $f->delete();
        }
        $res=$request->delete();
        if(1)
            Url::response('success','درخواست با موفقیت حذف شد.');
        else
            Url::response('danger','مشکلی در حذف درخواست به وجود امده.');
    }
}