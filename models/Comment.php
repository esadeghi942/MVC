<?php
namespace Models;

use Carbon\Carbon;
use Systems\Auth;

class Comment extends BaseModel
{
    const table='comments',
    primary='comment_id',
    fillable=['comment_text'];

    /*public static function user(MareiCollection $comments)
    {
        foreach ($comments as $comment){
            $comment[user_name]
        }
    }*/

    public static function custom_input($input)
    {
        $id=Auth::id();
        $res = [];
        $date = Carbon::now()->toDateTimeString();
        foreach (self::fillable as $record) {
            $res[$record] = $input[$record];
            $res['comment_from'] = $id;
            $res['comment_create'] = $date;
        }
        return $res;
    }

}