<?php

namespace Controllers;

use Carbon\Carbon;
use Models\Bug;
use Models\File;
use Models\QB;
use Models\Bnswer;
use Models\User;
use Systems\Auth;
use Systems\Url;
use Systems\Validation;
use Systems\View;

class BugController
{
    function index(){
        $user=Auth::id();
        $QB=QB::getInstance();
        if(Url::get('status') !== null)
            $bug = $QB->table(Bug::table)->where(User::primary,$user)->where('bug_status',Url::get('status'))->orderBy(Bug::timecreate,'DESC')->get();
        else
            $bug = $QB->table(Bug::table)->where(User::primary,$user)->orderBy(Bug::timecreate,'DESC')->get();
        $bug=Bug::defineAttributeValue($bug);
        return View::make('user/bug/index',['bugs'=>$bug]);
    }

    function store(){
        Validation::Validate($_POST , [
            'bug_virtual_number' => 'required|numeric',
            'bug_description' => 'required',
        ],$_FILES['bug_file']);
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
        Validation::Validate($_POST,[
            'bug_virtual_number' => 'required|numeric',
            'bug_description' => 'required',
        ],$_FILES['bug_file']);
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
        $can=$bug->postcan();
        if(!$can) {
            Url::response('danger','شما اجازه حذف این اعلام خرابی  را ندارید.');
            return;
        }
        $res=$bug->delete();
        if($res)
            Url::response('success','اعلام خرابی  با موفقیت حذف شد.');
        else
            Url::response('danger','مشکلی در حذف اعلام خرابی  به وجود امده.');
    }

    function adminIndex(){
        $bug=new Bug();
        $where=null;
        if(Url::get('status') !== null)
            $where='bug_status='.Url::get('status');
        $bug=$bug->all($where);
        $bug=Bug::defineAttributeValue($bug);
        return View::make('admin/bug/index',['bugs'=>$bug]);
    }

    function adminBug(){
        $id=Url::get('id');
        $bug=new Bug($id);
        $qb=QB::getInstance();
        $item=$bug->find();
        $user=(new User($item->user_id))->find();
        $answer=$bug->answers();
        $item=Bug::defineAttributeItem($item);
        $files=$bug->files();
        if($item->bug_status == '0')
            $qb->update(Bug::table,['bug_status'=>1])->where(Bug::primary,$id)->exec();
        return View::make('admin/bug/bug',['bug'=>$item,'user'=>$user,'files'=>$files,'answers'=>$answer]);
    }

    function userBug(){
        $id=Url::get('id');
        $bug=new Bug($id);
        $answer=$bug->answers();
        $item=$bug->find();
        $item=Bug::defineAttributeItem($item);
        $files=$bug->files();
        return View::make('user/bug/bug',['bug'=>$item,'files'=>$files,'answers'=>$answer]);
    }

    function postAnswer(){
        Validation::Validate($_POST,['bug_payment'=>'numeric']);
        $id=Url::get('id');
        $text=$_POST['txt'];
        $payment=$_POST['bug_payment'];
        $qb=QB::getInstance();
        $qb->update(Bug::table,['bug_status'=>2,'bug_payment'=>$payment])->where(Bug::primary,$id)->exec();
        $date = Carbon::now()->toDateTimeString();
        if(!empty($text))
            $qb->insert(Bnswer::table,['answer_model'=>Bug::table,'model_id'=>$id,'asnswer_text'=>$text,'answer_create'=>$date]);
        return View::redirect('',['success'=>'جوابیه با موفقیت ارسال شد.']);
    }
}