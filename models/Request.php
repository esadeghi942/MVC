<?php

namespace Models;

class Request
{
    const table='requests',
        primary='request_id',
        fillable=['cu_company', 'cu_namayande', 'cu_addresss', 'cu_phone'];

    public static function find($id)
    {
        $qb=QB::getInstance();
        $user=$qb->table(self::table)->where(self::primary,$id)->QGet();
        return $user[0];
    }

    public static function custom_input($id,$input){
        $res=[];
        foreach (self::fillable as $record){
            $res[$record]=$input[$record];
            $res['user_id']=$id;
        }
        return $res;
    }

}