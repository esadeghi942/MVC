<?php
namespace Controllers;
use Models\Bnswer;
use Systems\Url;

class AnswerController
{
    function delete(){
        $id=$_POST['id'];
        $item=new Bnswer($id);
        $i=$item->delete();
        if($i)
            Url::response('success','پاسخ  با موفقیت حذف شد.');
        else
            Url::response('danger','مشکلی در حذف به وجود امده.');
    }
}