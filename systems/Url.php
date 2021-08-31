<?php
namespace Systems;
class Url
{
	public static function get($get=null){
		if(isset($_GET[$get])){
			return $_GET[$get];
		}
		return null;
	}

	public static function last(){
		// $aa = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		$uri = $_SERVER['REQUEST_URI'];
		$urls = explode('/', $uri);
		$last = $urls[count($urls)-2];
		return $last;
	}

	public static function lasts(){
		$uri = $_SERVER['REQUEST_URI'];
		$urls = explode('/', $uri);
		array_shift($urls);
		array_shift($urls);
		$imp = implode($urls, '/');
		return $imp;
	}

}