<?php
namespace Controllers;
use Models\File;
use Models\QB;
use Models\User;
use Systems\Auth;
use Systems\Url;
use Systems\View;

class FileController
{
    function delete(){
        $id=$_POST['id'];
        $file=new File($id);
        $res=$file->delete();
        if($res)
            Url::response('success','فایل با موفقیت حذف شد.');
        else
            Url::response('danger','مشکلی در حذف فایل به وجود امده.');
    }

    function document(){
        $qb=QB::getInstance();
        $doc=$qb->table(File::table)->where('file_model',User::table)->where('model_id',Auth::id())->get();
        return View::make('user/document',['document'=>$doc]);
    }

    function storeDocument(){
        if ($_FILES['file']['size'][0] > 0) {
            $file = new File();
            $file->upload_file($_FILES['file'],Auth::id(),User::table,$_POST['title']);
        }
        return View::redirect('');
    }

    function AdminIndex(){
        $QB=QB::getInstance();
        $files=$QB->table(File::table)->join(User::table,'files`.`model_id`=`users`.`user_id')->select('COUNT(*) as count,`user_id`,`user_name`,`user_phone`,`file_create`')->where('file_model',User::table)->group(User::primary)->get();
        return View::make('admin/document/index',['documents'=>$files]);
    }

    function DeleteDocument(){
        $user_id=$_POST['id'];
        $Qb=QB::getInstance();
        $files=$Qb->table(File::table)->where('file_model',User::table)->where('model_id',$user_id)->get();
        foreach ($files as $file){
            $f=new File($file->file_id);
            $f->delete();
        }
        Url::response('success','مدارک با موفقیت حذف شدند.');
    }

    function AdminDocument(){
        $id=Url::get('id');
        $Qb=QB::getInstance();
        $files=$Qb->table(File::table)->join(User::table,'files`.`model_id`=`users`.`user_id')->where('file_model',User::table)->where('model_id',$id)->get();
        return View::make('admin/document/document',['document'=>$files]);
    }

}