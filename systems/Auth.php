<?php
namespace Systems;
use Firebase\JWT\JWT;
use Models\User;

class Auth
{
    const primary='user_id';
    public static function user(){
        if(Session::has('user')){
            return Session::get('user');
        }
        return null;
    }

    public static function id(){
        if(Session::has('user')){
            $user=Session::get('user');
            return $user[self::primary];
        }
        return null;
    }

    public static function setSessionLogin($user){
        $user['user_password'] = '******';
        Session::put('user', $user);
    }
    public static function updateSessionLogin($id){
        $user=User::find($id);
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