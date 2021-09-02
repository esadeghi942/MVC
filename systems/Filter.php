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
		            Auth::setSessionLogin($get_user_by_session[0]);
		            Auth::setCookieLogin();
					Cookie::put($_COOKIE_LOGIN, $login, time()+3600*24*365, '/', 'www.tehranftth.ir');
		        }
		    }else{
				View::redirect($url,['warning'=>'ابتدا  باید وارد سایت شوید']);
		    }
		}
		else{
			View::redirect($url,['warning'=>'ابتدا باید وارد سایت شوید']);
		}
	}

	public static function check_customer($url='../userProfileCreate'){

		// Check auth before check is admin
		self::check_auth();

		if(!Session::has('user') || (Session::has('user') && Session::get('user')['user_type'] != \Models\User::customer)){
			View::redirect($url,['warning'=>'ابتدا باید پروفایل خود را کامل کنید']);
		}
	}

	public static function check_admin($url='../'){

		// Check auth before check is admin
		self::check_auth();

		if(!Session::has('user') || (Session::has('user') && Session::get('user')['user_type'] != \Models\User::admin)){
			View::redirect($url,['danger'=>'شما اجازه دسترسی به این صفحه را ندارید']);
		}
	}

	public static function check_superadmin($url='../'){

		// Check auth before check is admin
		self::check_auth();

		if(!Session::has('user') || (Session::has('user') && Session::get('user')['user_type'] != \Models\User::superadmin)){
			View::redirect($url,['danger'=>'شما اجازه دسترسی به این صفحه را ندارید']);
		}
	}
}