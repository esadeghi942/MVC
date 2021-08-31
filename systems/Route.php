<?php
	
class Route
{
	public static function not_found(){
	    echo 'Method Not Found';
		exit;
	}

	public static function get(){
        echo 'Method Get Not Found';
        exit;
	}

	public static function post(){
        echo 'Method Post Not Found';
        exit;
	}

}