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

}