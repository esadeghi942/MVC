<?php
namespace Systems;
class U
{
	public static function baseURL(){
		return 'http://localhost/tehran/';
		//return $_SERVER['HTTP_HOST'];
	}
	public static function vd($d, $vd=false){
		echo '<pre style="direction:ltr; text-align:left">';
		$vd ? var_dump($d) : print_r($d);
		echo '</pre>';
		die();
	}
	public static function reArrayFiles($file_post)
	{
	    $file_ary = array();
	    $file_count = count($file_post['name']);
	    $file_keys = array_keys($file_post);

	    for($i=0; $i<$file_count; $i++){
        	if(strlen($file_post['name'][$i]) > 0){
		        foreach($file_keys as $key){
	            	$file_ary[$i][$key] = $file_post[$key][$i];
		        }
        	}
	    }
		return $file_ary;
	}
}