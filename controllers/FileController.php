<?php
namespace Controllers;
use Models\File;
use Systems\Url;

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
}