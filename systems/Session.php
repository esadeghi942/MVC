<?php
namespace Systems;
// server should keep session data for AT LEAST 1 hour
ini_set('session.gc_maxlifetime', 9999999999);

// each client should remember their session id for EXACTLY 1 hour
session_set_cookie_params(9999999999, "/");

session_start(); // ready to go!

class Session
{
	public static function all(){
		return $_SESSION;
	}

	public static function get($sess){
		return $_SESSION[$sess];
	}

	public static function put($index, $value){
		$_SESSION[$index] = $value;
	}

	public static function has($sess){
		if(isset($_SESSION[$sess])){
			return true;
		}
		return false;
	}

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

}