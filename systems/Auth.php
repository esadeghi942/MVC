<?php
namespace Systems;
class Auth
{
    public static function user(){
        if(Session::has('user')){
            return Session::get('user');
        }
        return null;
    }

}