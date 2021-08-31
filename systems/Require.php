<?php

	require_once('Path.php');
	$all_dirs = array('systems', 'controllers', 'models');
	foreach($all_dirs as $dir){
		foreach(glob($dir.'/*.php') as $file){
		    require_once($file);
		}
	}