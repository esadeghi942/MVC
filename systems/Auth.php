<?php
namespace Systems;
use Firebase\JWT\JWT;
use Models\User;

class Auth
{
    public static function user(){
        if(Session::has('user')){
            return Session::get('user');
        }
        return null;
    }

    public static function id(){
        if(Session::has('user')){
            $user=Session::get('user');
            return $user[User::primary];
        }
        return null;
    }

    public static function isAdmin(){
        if(Session::has('user')){
            $user=Session::get('user')['user_type'];
            if($user == User::admin || $user == User::superadmin)
                return true;
        }
        return false;
    }

    public static function isSuperAdmin(){
        if(Session::has('user')){
            $user=Session::get('user')['user_type'];
            if($user == User::superadmin)
                return true;
        }
        return false;
    }

    public static function setSessionLogin($user){
        $user['user_password'] = '******';
        Session::put('user', $user);
    }

    public static function updateSessionLogin($id){
        $user=(new User($id))->find();
        $user['user_password'] = '******';
        Session::put('user', $user);
    }

    public static function setCookieLogin(){
        global $_COOKIE_JWT;
        global $jwt_key;
        $payload = array(
            "iss" => "",
            "iat" => time(),
            "user" => Session::get('user')
        );
        $jwt = JWT::encode($payload, $jwt_key);
        //$login = Cookie::get($_COOKIE_LOGIN);
        //Cookie::put($_COOKIE_LOGIN, $login, time()+3600*24*365, '/', 'www.tehranftth.ir');
        Cookie::put($_COOKIE_JWT, $jwt, time() + 3600 * 24 * 30, '/', '');
    }
}