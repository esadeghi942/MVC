<?php
namespace Models;

class Customer
{
    const table='customers';

    const fillable=['cu_company', 'cu_namayande', 'cu_addresss', 'cu_phone'];

    public static function find($id){
        $qb=(new QB());
        $customer=$qb->table(self::table)->where('user_id',$id)->QGet();
        return $customer[0];
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