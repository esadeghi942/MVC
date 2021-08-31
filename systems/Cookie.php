<?php
namespace Systems;
class Cookie
{
	public static function all(){
		return $_COOKIE;
	}

	public static function get($cook){
		return $_COOKIE[$cook];
	}

	public static function put($name, $value, $time, $domain, $host){
		return setcookie($name, $value, $time, $domain, $host);
	}

	public static function has($cook){
		if(isset($_COOKIE[$cook])){
			return true;
		}
		return false;
	}
	/*
	public static function unput($sess=null){
		if($sess){
			unset($_SESSION[$sess]);
		}else{
			session_unset();
		}
	}

	public static function destroy(){
		session_destroy();
	}
	*/

}