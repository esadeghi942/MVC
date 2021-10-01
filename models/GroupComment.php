<?php
namespace Models;

use Carbon\Carbon;
use Systems\Auth;
use Systems\DataBase;
use Systems\Url;

class GroupComment extends BaseModel
{
    const table='gcomments',
          primary='gcomment_id',
        timecreate='gcomment_create';

    function delete()
    {
        $comment=self::comments();
        $QB=QB::getInstance();
        foreach ($comment as $item)
            $QB->delete(Comment::table)->where(Comment::primary,$item->comment_id)->exec();
        return parent::delete();
    }

    function comments(){
        $qb=QB::getInstance();
        return $qb->table(Comment::table)->select('`comment_id`')->where('gcomment_id',$this->id)->get();
    }

    public static function custom_input($input)
    {
        if(Auth::isAdmin())
            $id = Url::get('id');
        else
            $id=Auth::id();
        $res = [];
        $date = Carbon::now()->toDateTimeString();
        $res['gcomment_label'] = $input['label'];
        $res['user_id'] = $id;
        $res[self::timecreate] = $date;
        return $res;
    }

    public function toggleActive(){

        $Qb=QB::getInstance();
        $active=$Qb->table(GroupComment::table)->where(GroupComment::primary,$this->id)->get()->first()->gcomment_active;
        $active=intval(!intval($active));
        return $Qb->update(GroupComment::table,['gcomment_active'=> $active])->where(GroupComment::primary,$this->id)->exec();
    }

    public function unreadcomment()
    {
        $DB=new DataBase();
        $query=$DB->pdo->prepare("SELECT gcomment_id, count(*) AS count_unread FROM comments natural join users 
            where comment_readed=0 and ". User::primary ."!=". Auth::id() ." GROUP BY gcomment_id") ;
        $query->execute();
        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }
}