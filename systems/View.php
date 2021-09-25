<?php
namespace Systems;
class View
{
	public static function make($page, $parameters2202017=null){
		if(strlen($page) == 0){
			// $page = '404';
		}
		// parameters
		if(isset($parameters2202017)){
			foreach($parameters2202017 as $parameters2202017_key => $parameters2202017_value){
				$$parameters2202017_key = $parameters2202017_value;
			}
		}

		// add HTML5 scope header tag

        $lang_dir = 'rtl';
		$html_tag = '<html lang="fa" dir="'.$lang_dir.'">';
		echo "<!DOCTYPE html>\n".$html_tag."\n";
		// Show page
		require_once('views/'.$page.'.php');

		View::old_input();
	}

	// if address is '' -> redirected to back :)
	public static function redirect($address='', $custom_message=null, $old_input=null,$parameter=null, $require_inputs=null){
		// Custom message to passed to view page
		if($custom_message){
			$_SESSION['message'] = $custom_message;
		}

		// Old input passed to back to show view page
        // For Post Form
		if($old_input){
			$_SESSION['input'] = $_POST;
		}
		//This is custom parameter
		if($parameter){
			$_SESSION['params'] = $parameter;
		}

		// Require input visible to highlighted by view page
		if($require_inputs){
			$_SESSION['require'] = $require_inputs;
		}
		// redirect back
		if($address == ''){
        	if(isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] !== ''){
				$address = $_SERVER['HTTP_REFERER'];
			} // else its to be -> ''
		}

		header('location:'.$address);
		exit();
	}

	public static function error($error){
		echo $error;
	}

	public static function old_input(){
		if(isset($_SESSION['message'])){
			$message = json_encode($_SESSION['message']);
			unset($_SESSION['message']);
			echo '<script type="text/javascript">'
				.'var system_message = '.$message.';'
				.'$(function(){'
					.'$.each(system_message, function(message_type, message_value){'
						.'message.show(message_type, message_value);'
					.'});'
				.'});'
				.'</script>';
		}

		if(isset($_SESSION['input'])){
			$input = json_encode($_SESSION['input']);
			unset($_SESSION['input']);
			echo '<script type="text/javascript">'
				.'var input = '.$input.';'
				.'$(function(){'
					.'setTimeout(function(){'
						.'$.each(input, function(input_name, input_value){'
							.'$("form input#"+input_name).attr("value",input_value);'
							.'$("form select#"+input_name).val(input_value);'
							.'$("form textarea[name="+input_name+"]").html(input_value);'
                            .'$("form input[type=radio][name="+input_name+"][value="+input_value+"]").prop("checked", true);'
                            .'$("form input[type=checkbox][name="+input_name+"][value="+input_value+"]").prop("checked", true);'
						.'});'
					.'},300)'
				.'});'
				.'</script>';
		}

		if(isset($_SESSION['params'])){
			$input = json_encode($_SESSION['params']);
			unset($_SESSION['params']);
			echo '<script type="text/javascript">'
				.'var input = '.$input.';'
				.'$(function(){'
					.'setTimeout(function(){'
						.'$.each(input, function(input_name, input_value){'
							.'$("form input#"+input_name).val(input_value);'
							.'$("form select#"+input_name).val(input_value);'
							//.'set_select_val($(".ag-select[name="+input_name+"]"), input_value);'
						.'});'
					.'},300)'
				.'});'
				.'</script>';
		}

		if(isset($_SESSION['require'])){
			$require = json_encode($_SESSION['require']);
			unset($_SESSION['require']);

			echo '<script type="text/javascript">'
				.'var require = '.$require.';'
				.'$(function(){'
					// .'if(typeof input !== "undefined" && input){'
						.'$.each(require, function(require_name, require_value){'
							.'$("input[name="+require_name+"]").before("<div class=\"required-field\">"+require_value+"</div>");'
							// .'$("select[name="+require_name+"]").val(require_value);'
						.'});'
					// .'}'
				.'});'
				.'</script>';
		}
	}


}