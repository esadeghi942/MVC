<?php
namespace Systems;
use Models\User;
class Filter
{
    public static function check_auth($url='../login'){
        global $_COOKIE_LOGIN;
        if(Session::has('user')){}
		else if(!Session::has('user') && Cookie::has($_COOKIE_LOGIN)){
		    $login = Cookie::get($_COOKIE_LOGIN); 
		    if(!empty($login)){
		    	$db = new User();
		    	$get_user_by_session = $db->get_user_by_session($login);
		        if($get_user_by_session){
					$user = $get_user_by_session[0];
					$user['u_password'] = '******';
					Session::put('user',$user);
					Cookie::put($_COOKIE_LOGIN, $login, time()+3600*24*365, '/', 'www.tehranftth.ir');
		        }
		    }else{
				View::redirect($url);
		    }
		}
		else{
			View::redirect($url);
		}
	}

	public static function check_customer($url='../profile'){

		// Check auth before check is admin
		self::check_auth();

		if(!Session::has('user') || (Session::has('user') && Session::get('user')['user_type'] != \Models\User::customer)){
			View::redirect($url);
		}
	}

	public static function check_admin($url='../'){

		// Check auth before check is admin
		self::check_auth();

		if(!Session::has('user') || (Session::has('user') && Session::get('user')['user_type'] != \Models\User::admin)){
			View::redirect($url);
		}
	}

	public static function check_superadmin($url='../'){

		// Check auth before check is admin
		self::check_auth();

		if(!Session::has('user') || (Session::has('user') && Session::get('user')['user_type'] != \Models\User::superadmin)){
			View::redirect($url);
		}
	}
}