<?php
namespace Models;
use Carbon\Carbon;
class Customer
{
    const table='customers';

    const fillable=['cu_company', 'cu_namayande', 'cu_addresss', 'cu_phone'];

    public static function find($id){
        $qb=(new QB());
        $customer=$qb->table(self::table)->where(User::primary,$id)->QGet();
        return $customer[0];
    }

    public static function custom_input($id,$input,$edit=false){
        $res =[];
        $date= Carbon::now()->toDateTimeString();
        $str = $edit ?'cu_update':'cu_create';
        foreach (self::fillable as $record){
            $res[$record]=$input[$record];
            $res[User::primary]=$id;
            $res[$str]=$date;
        }
        return $res;
    }

}