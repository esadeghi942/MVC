<?php
namespace Controllers;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Models\Bug;
use Models\Comment;
use Models\File;
use Models\QB;
use Models\User;
use Systems\Auth;
use Systems\Url;
use Systems\View;

class CommentController
{
    function index(){
        $QB=QB::getInstance();
        $user=Auth::id();
        $comments=$QB->table(Comment::table)->where('user_id',$user)->orWhere('comment_to',$user)->get();
        $QB->update(Comment::table,['comment_readed'=>1])->where('comment_to',$user)->exec();
        return View::make('user/comment',['comments'=>$comments]);
    }

    function store(){
        $QB=QB::getInstance();
        $QB->insert(Comment::table,Comment::custom_input($_POST));
        return View::redirect('../userComment');
    }
    function delete(){
        $id=$_POST['id'];
        $comment=new Comment($id);
        $can=$comment->postcan();
        if(!$can) {
            Url::response('danger','شما اجازه حذف این تیکت را ندارید.');
            return;
        }
        $item=$comment->find();
        if($item->comment_readed== 1){
            Url::response('danger','شما اجازه حذف تیکت خوانده شده را ندارید.');
            return;
        }
        $res=$comment->delete();
        if($res)
            Url::response('success','تیکت با موفقیت حذف شد.');
        else
            Url::response('danger','مشکلی در حذف تیکت به وجود امده.');
    }
}