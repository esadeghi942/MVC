<?php

namespace Models;

use Carbon\Carbon;
use Systems\Auth;
use Systems\DataBase;
use Systems\Url;

class Comment extends BaseModel
{
    const table = 'comments',
        primary = 'comment_id',
        fillable = ['comment_text'],
        timecreate='comment_create';

    public static function custom_input($input)
    {
        $id = Auth::id();
        $res = [];
        $date = Carbon::now()->toDateTimeString();
        foreach (self::fillable as $record) {
            $res[$record] = $input[$record];
            $res['user_id'] = $id;
            $res[self::timecreate] = $date;
            if (Auth::isAdmin())
                $res['comment_to'] = Url::get('id');
        }
        return $res;
    }

    public function unreadcomment()
    {
        $DB=new DataBase();
        $query=$DB->pdo->prepare("SELECT user_id, count(*) AS count_unread FROM comments natural join users 
            where user_type=1 and comment_readed=0 GROUP BY user_id") ;
        $query->execute();
        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }

}