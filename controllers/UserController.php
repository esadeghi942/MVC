<?php

namespace Controllers;

use Models\Bug;
use Models\Comment;
use Models\GroupComment;
use Models\QB;
use Models\Request;
use Models\User;
use Systems\Auth;
use Systems\Url;
use Systems\View;

class UserController
{
    function userIndex(){
        $qb=QB::getInstance();
        $user=Auth::id();
        $comment=$qb->table(GroupComment::table)->where(User::primary,$user)->limit(10)->orderBy(GroupComment::timecreate,'DESC')->get();
        $unrcoment = (new GroupComment())->unreadcomment();
        $res = [];
        foreach ($unrcoment as $item)
            $res[$item['gcomment_id']]['count'] = $item['count_unread'];
        foreach ($comment as $record)
            $record->count_unread = isset($res[$record->gcomment_id]['count']) ? $res[$record->gcomment_id]['count'] : 0;
        $newreq=$qb->table(Request::table)->where(User::primary,$user)->where('request_status',0)->where('request_karshenasi',0)->count();
        $continuereq=$qb->table(Request::table)->where(User::primary,$user)->where('request_status',1)->where('request_karshenasi',0)->count();
        $finishreq=$qb->table(Request::table)->where(User::primary,$user)->where('request_status',2)->where('request_karshenasi',0)->count();
        $newkar=$qb->table(Request::table)->where(User::primary,$user)->where('request_status',0)->where('request_karshenasi',1)->count();
        $continuekar=$qb->table(Request::table)->where(User::primary,$user)->where('request_status',1)->where('request_karshenasi',1)->count();
        $finishkarsh=$qb->table(Request::table)->where(User::primary,$user)->where('request_status',2)->where('request_karshenasi',1)->count();
        $newbug=$qb->table(Bug::table)->where(User::primary,$user)->where('bug_status',0)->count();
        $contbug=$qb->table(Bug::table)->where(User::primary,$user)->where('bug_status',1)->count();
        $finigbug=$qb->table(Bug::table)->where(User::primary,$user)->where('bug_status',2)->count();
        $user=$qb->table(User::table)->where(User::primary,$user)->get()->first();
        return View::make('user/index',['gcomments'=>$comment,
            'req'=>[$newreq,$continuereq,$finishreq],
            'karsh'=>[$newkar,$continuekar,$finishkarsh],
            'cbug'=>[$newbug,$contbug,$finigbug],
            'user'=>$user]);
    }

    function adminIndex(){
        $qb=QB::getInstance();
        $comment=$qb->table(GroupComment::table)->naturalJoin(User::table)->limit(10)->orderBy(GroupComment::timecreate,'DESC')->get();
        $unrcoment = (new GroupComment())->unreadcomment();
        $res = [];
        foreach ($unrcoment as $item)
            $res[$item['gcomment_id']]['count'] = $item['count_unread'];
        foreach ($comment as $record)
            $record->count_unread = isset($res[$record->gcomment_id]['count']) ? $res[$record->gcomment_id]['count'] : 0;
        $karshenasi=$qb->table(Request::table)->naturalJoin(User::table)->where('request_karshenasi',1)->limit(5)->orderBy(Request::timecreate,'DESC')->get();
        $bugs=$qb->table(Bug::table)->naturalJoin(User::table)->limit(5)->orderBy(Bug::timecreate,'DESC')->get();
        $newreq=$qb->table(Request::table)->where('request_status',0)->where('request_karshenasi',0)->count();
        $continuereq=$qb->table(Request::table)->where('request_status',1)->where('request_karshenasi',0)->count();
        $finishreq=$qb->table(Request::table)->where('request_status',2)->where('request_karshenasi',0)->count();
        $newkar=$qb->table(Request::table)->where('request_status',0)->where('request_karshenasi',1)->count();
        $continuekar=$qb->table(Request::table)->where('request_status',1)->where('request_karshenasi',1)->count();
        $finishkarsh=$qb->table(Request::table)->where('request_status',2)->where('request_karshenasi',1)->count();
        $newbug=$qb->table(Bug::table)->where('bug_status',0)->count();
        $contbug=$qb->table(Bug::table)->where('bug_status',1)->count();
        $finigbug=$qb->table(Bug::table)->where('bug_status',2)->count();
        $admin=$qb->table(User::table)->where('user_type',2)->orWhere('user_type',3)->count();
        $cutomer=$qb->table(User::table)->where('user_type',1)->count();
        $user=$qb->table(User::table)->where('user_type',0)->count();
        return View::make('admin/index',['karshenasi'=>$karshenasi,'bugs'=>$bugs,'comments'=>$comment,
                                          'req'=>[$newreq,$continuereq,$finishreq],
                                          'karsh'=>[$newkar,$continuekar,$finishkarsh],
                                          'cbug'=>[$newbug,$contbug,$finigbug],
                                          'user'=>[$admin,$cutomer,$user]
                        ]);
    }

    function adminAll()
    {
        $qb = QB::getInstance();
        $user = $qb->table(User::table)->where('user_type', User::admin)->orWhere('user_type', User::superadmin)->get();
        $user = User::defineAttributeValue($user);
        return View::make('admin/user/index', ['users' => $user]);
    }

    function adminEdit()
    {
        $id=Url::get('id');
        $user=new User($id);
        $user=$user->find();
        return View::make('admin/user/edit',['user'=>$user]);
    }

    function adminDelete()
    {
        $id = $_POST['id'];
        if (!Auth::isSuperAdmin()) {
            Url::response('danger', '?????? ?????????? ?????? ???? ????????????.');
            return;
        }
        $user=new User($id);
        $res=$user->delete();
        if ($res)
            Url::response('success', '?????????? ???? ???????????? ?????? ????.');
        else
            Url::response('danger', '?????????? ???? ?????? ?????????? ???? ???????? ????????.');
    }
}