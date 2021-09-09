<?php

namespace Controllers;

use Models\Comment;
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
        $comments = $QB->table(Comment::table)->where('user_id', $user)->orWhere('comment_to', $user)->get();
        $QB->update(Comment::table, ['comment_readed' => 1])->where('comment_to', $user)->exec();
        return View::make('user/comment', ['comments' => $comments]);
    }

    function store()
    {
        $QB = QB::getInstance();
        $QB->insert(Comment::table, Comment::custom_input($_POST));
        return View::redirect('../userComment');
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

    function adminindex()
    {
        $QB = QB::getInstance();
        $comments = $QB->table(Comment::table)->naturalJoin(User::table)->where('user_type', 1)->group('user_id')->orderBy('comment_create', 'DESC')->get();
        $unrcoment = (new Comment())->unreadcomment();
        $res = [];
        foreach ($unrcoment as $item)
            $res[$item['user_id']]['count'] = $item['count_unread'];

        foreach ($comments as $record) {
            $last = $QB->table(Comment::table)->where('user_id', $record->user_id)->orderBy('comment_create', 'DESC')->QGet();
            $record->count_unread = isset($res[$record->user_id]['count']) ? $res[$record->user_id]['count'] : 0;
            $record->comment_text = $last[0]['comment_text'];
            $record->comment_create = $last[0]['comment_create'];
        }
        return View::make('admin/comment/index', ['comments' => $comments]);
    }

    function userComment()
    {
        $user = Url::get('id');
        $QB = QB::getInstance();
        $comments = $QB->table(Comment::table)->naturalJoin(User::table)->where(User::primary, $user)->orWhere('comment_to', $user)->orderBy('comment_create')->get();
        $QB->update(Comment::table, ['comment_readed' => 1])->where(User::primary, $user)->exec();
        return View::make('admin/comment/comment', ['comments' => $comments]);
    }

    function postComment()
    {
        $QB = QB::getInstance();
        $QB->insert(Comment::table, Comment::custom_input($_POST));
        return View::redirect('../adminUserCommnet?id=' . Url::get('id'));
    }
}