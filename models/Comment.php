<?php

namespace Models;

use Carbon\Carbon;
use Systems\Auth;
use Systems\DataBase;

class Comment extends BaseModel
{
    const table = 'comments',
        primary = 'comment_id',
        fillable = ['comment_text'],
        timecreate='comment_create';

    public static function custom_input($input,$groupcomment)
    {
        $id = Auth::id();
        $res = [];
        $Qb=QB::getInstance();
        $user_id=$Qb->table(GroupComment::table)->where(GroupComment::primary,$groupcomment)->get()->first()->user_id;
        $date = Carbon::now()->toDateTimeString();
        foreach (self::fillable as $record)
            $res[$record] = $input[$record];
        $res['user_id'] = $id;
        $res['gcomment_id'] = $groupcomment;
        $res[self::timecreate] = $date;
        if (Auth::isAdmin())
            $res['comment_to'] =$user_id;
        return $res;
    }
   /* public function unreadcomment()
    {
        $DB=new DataBase();
        $query=$DB->pdo->prepare("SELECT user_id, count(*) AS count_unread FROM comments natural join users 
            where user_type=1 and comment_readed=0 GROUP BY user_id") ;
        $query->execute();
        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }*/
}