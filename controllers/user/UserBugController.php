<?php

namespace Controllers\User;

use Models\Bug;
use Models\File;
use Models\QB;
use Models\User;
use Rakit\Validation\Validator;
use Systems\Auth;
use Systems\Url;
use Systems\View;

class UserBugController
{
    function index(){
        $user=Auth::id();
        $QB=new QB();
        $bug=$QB->table(Bug::table)->where(User::primary,$user)->orderBy(Bug::primary, 'DESC')->get();
        $bug=Bug::defineAttributeValue($bug);
        return View::make('user/bug/index',['bugs'=>$bug]);
    }

    function store(){
        $user = Auth::id();
        $validator = new Validator;
        $validation = $validator->make($_POST, [
            'bug_virtual_number' => 'numeric',
            'bug_description' => 'required',
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
        $bug_id=$QB->insert(Bug::table,Bug::custom_input($_POST));
        $file=new File();
        if($bug_id && $_FILES['bug_file']['size'][0] > 0)
            $file->upload_file($_FILES['bug_file'],$bug_id,Bug::table);
        return View::redirect('../userBugIndex', ['success' => 'اعلام خرابی  با موفقیت ثبت شد.']);
    }

    function edit(){
        $bug_id=Url::get('id');
        $bug=new Bug($bug_id);
        $bug->getcan();
        $item=$bug->find();
        $files=$bug->files();
        return View::make('user/bug/edit',['bug'=>$item,'files'=>$files]);
    }

    function update(){
        $bug_id=Url::get('id');
        $validator = new Validator;
        $validation = $validator->make($_POST, [
            'bug_virtual_number' => 'numeric',
            'bug_description' => 'required',
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
        $QB->update(Bug::table,Bug::custom_input($_POST,true))->where(Bug::primary,$bug_id)->exec();
        $file=new File();
        if($_FILES['bug_file']['size'][0] > 0)
            $file->upload_file($_FILES['bug_file'],$bug_id,Bug::table);
        return View::redirect('../userBugIndex', ['success' => 'اعلام خرابی  با موفقیت به روز رسانی شد.']);
    }

    function delete(){
        $id=$_POST['id'];
        $bug=new Bug($id);
        $can=$bug->postcan($id);
        if(!$can) {
            Url::response('danger','شما اجازه حذف این اعلام خرابی  را ندارید.');
            return;
        }
        $files=$bug->files();
        foreach ($files as $file){
            $f=new File($file->file_id);
            $f->delete();
        }
        $res=$bug->delete();
        if($res)
            Url::response('success','اعلام خرابی  با موفقیت حذف شد.');
        else
            Url::response('danger','مشکلی در حذف اعلام خرابی  به وجود امده.');
    }
}