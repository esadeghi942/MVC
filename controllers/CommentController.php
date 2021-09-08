<?php
namespace Controllers;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Models\Comment;
use Models\QB;
use Systems\Auth;
use Systems\View;

class CommentController
{
    function index(){
        $QB=QB::getInstance();
        $user=Auth::id();
        $comments=$QB->table(Comment::table)->where('comment_from',$user)->orWhere('comment_to',$user)->get();
        //$comments=Comment::users($comments);
        return View::make('user/comment',['comments'=>$comments]);
    }

    function store(){
        $QB=QB::getInstance();
        $QB->insert(Comment::table,Comment::custom_input($_POST));
        return View::redirect('../userComment');
    }

}