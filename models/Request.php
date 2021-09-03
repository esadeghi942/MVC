<?php

namespace Models;

use Carbon\Carbon;

class Request
{
    const table='requests',
        primary='request_id',
        userfillable=['request_address', 'request_buildstatus', 'request_owner', 'request_count_unit', 'request_count_request', 'request_build_request', 'request_fix_number', 'request_base', 'request_karshenasi'],
        adminfillable=['request_answer'];

    public static function find($id)
    {
        $qb=QB::getInstance();
        $user=$qb->table(self::table)->where(self::primary,$id)->QGet();
        return $user[0];
    }

    public static function custom_input($id,$input,$edit=false){
        $res=[];
        $date= Carbon::now()->toDateTimeString();
        $str = $edit ?'request_update':'request_create';
        foreach (self::userfillable as $record){
            $res[$record]=$input[$record];
            $res[User::primary]=$id;
            $res[$str]=$date;
        }
        return $res;
    }

}