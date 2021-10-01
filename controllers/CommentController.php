<?php

namespace Controllers;

use Models\Comment;
use Models\GroupComment;
use Models\QB;
use Models\User;
use Systems\Auth;
use Systems\Url;
use Systems\View;

class CommentController
{
    function index()
    {
        $QB = QB::getInstance();
        $user = Auth::id();
        $comments = $QB->table(GroupComment::table)->where('user_id', $user)->get();
        $unrcoment = (new GroupComment())->unreadcomment();
        $res = [];
        foreach ($unrcoment as $item)
            $res[$item['gcomment_id']]['count'] = $item['count_unread'];
        foreach ($comments as $record)
            $record->count_unread = isset($res[$record->gcomment_id]['count']) ? $res[$record->gcomment_id]['count'] : 0;
        return View::make('user/comment/index', ['gcomments' => $comments]);
    }

    function comments()
    {
        $group=Url::get('gid');
        $QB = QB::getInstance();
        $user = Auth::id();
        $comments = $QB->table(Comment::table)->where(GroupComment::primary, $group)->get();
        $active = $QB->table(GroupComment::table)->where(GroupComment::primary, $group)->get()->first()->gcomment_active;
        $QB->update(Comment::table, ['comment_readed' => 1])->where('comment_to', $user)->where(GroupComment::primary,$group)->exec();
        return View::make('user/comment/comment', ['comments' => $comments,'active'=>$active]);
    }

    function store()
    {
        $QB = QB::getInstance();
        $group_id=Url::get('gid');
        $QB->insert(Comment::table, Comment::custom_input($_POST,$group_id));
        return View::redirect('../userComment?gid='.$group_id);
    }

    function delete()
    {
        $id = $_POST['id'];
        $comment = new Comment($id);
        $can = $comment->postcan();
        if (!$can) {
            Url::response('danger', 'شما اجازه حذف این تیکت را ندارید.');
            return;
        }
        $item = $comment->find();
        if ($item->comment_readed == 1) {
            Url::response('danger', 'شما اجازه حذف تیکت خوانده شده را ندارید.');
            return;
        }
        $res = $comment->delete();
        if ($res)
            Url::response('success', 'تیکت با موفقیت حذف شد.');
        else
            Url::response('danger', 'مشکلی در حذف تیکت به وجود امده.');
    }

    function admindelete()
    {
        $id = $_POST['id'];
        $comment = new Comment($id);
        $can = $comment->postcan();
        if (!$can) {
            Url::response('danger', 'شما اجازه حذف این تیکت را ندارید.');
            return;
        }
        $item = $comment->find();
        if ($item->comment_readed == 1) {
            Url::response('danger', 'شما اجازه حذف تیکت خوانده شده را ندارید.');
            return;
        }
        $res = $comment->delete();
        if ($res)
            Url::response('success', 'تیکت با موفقیت حذف شد.');
        else
            Url::response('danger', 'مشکلی در حذف تیکت به وجود امده.');
    }

    function deletegroup()
    {
        $id = $_POST['id'];
        $comment = new GroupComment($id);
        $can = $comment->postcan();
        if (!$can) {
            Url::response('danger', 'شما اجازه حذف این تیکت را ندارید.');
            return;
        }
        $res = $comment->delete();
        if ($res)
            Url::response('success', 'تیکت با موفقیت حذف شد.');
        else
            Url::response('danger', 'مشکلی در حذف تیکت به وجود امده.');
    }

    function toggleclosegroup()
    {
        $id = Url::get('id');
        $comment = new GroupComment($id);
        $comment->getcan();
        $res = $comment->toggleActive();
        if ($res)
            View::redirect('', ['success'=>'تیکت با موفقیت تغییر یافت شد.']);
        else
            View::redirect('',['danger'=> 'مشکلی در تغییر حالت تیکت به وجود امده.']);
    }

    function adminindex()
    {
        $QB = QB::getInstance();
        $groupcomments = $QB->table(GroupComment::table)->naturalJoin(User::table)->orderBy(GroupComment::timecreate, 'DESC')->get();
        $unrcoment = (new GroupComment())->unreadcomment();
        $res = [];

        foreach ($unrcoment as $item)
            $res[$item['gcomment_id']]['count'] = $item['count_unread'];

        foreach ($groupcomments as $record)
            $record->count_unread = isset($res[$record->gcomment_id]['count']) ? $res[$record->gcomment_id]['count'] : 0;

        return View::make('admin/comment/index', ['gcomments' => $groupcomments]);
    }

    function userComment()
    {
        $group = Url::get('gid');
        $QB = QB::getInstance();
        $comments = $QB->table(Comment::table)->naturalJoin(User::table)->where(GroupComment::primary, $group)->orderBy('comment_create')->get();
        $active = $QB->table(GroupComment::table)->where(GroupComment::primary, $group)->get()->first()->gcomment_active;
        $read=$QB->table(Comment::table)->whereStatement("`gcomment_id`=$group AND `comment_to` is null")->get();
        foreach ($read as $r)
            $QB->update(Comment::table, ['comment_readed' => 1])->where(Comment::primary,$r->comment_id)->exec();
        return View::make('admin/comment/comment', ['comments' => $comments,'active'=>$active]);
    }

    function postComment()
    {
        $QB = QB::getInstance();
        $groupid=Url::get('gid');
        $QB->insert(Comment::table, Comment::custom_input($_POST,$groupid));
        return View::redirect('../adminUserCommnet?gid=' . Url::get('gid'));
    }

    function newGroupComment(){
        $QB = QB::getInstance();
        if(isset($_GET['gid']))
            $gcomment=$_GET['gid'];
        else
            $gcomment=$QB->insert(GroupComment::table, GroupComment::custom_input($_POST));
       if(!empty($_POST['comment_text']))
            $QB->insert(Comment::table, Comment::custom_input($_POST,$gcomment));
        return View::redirect('',['success'=>'تیکت ارسال شد']);
    }
}