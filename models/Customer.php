<?php
namespace Models;
use Carbon\Carbon;
use Systems\Auth;

class Customer extends BaseModel
{
    const table='customers';
    const fillable=['cu_company', 'cu_namayande', 'cu_addresss', 'cu_phone'];

    public function find(){
        $qb = QB::getInstance();
        $customer=$qb->table(self::table)->where(User::primary,$this->id)->QGet();
        return $customer[0];
    }

    public static function custom_input($input,$edit=false){
        $res =[];
        $id=Auth::id();
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