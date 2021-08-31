<?php
use Systems\Filter;
use Systems\View;
// echo 'wait...';return;
// locale_set_default('fa_IR.UTF-8');
// locale_set_default('fa_IR');
// setlocale(LC_ALL, 'fa_IR');
// setlocale(LC_ALL, 'fa_IR.UTF-8');
// define('AJXP_LOCALE', 'fa_IR.UTF-8');
// TODO
ob_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);
ini_set('memory_limit', '3000M');
ini_set('max_execution_time', 3000); // Secounds
ini_set('serialize_precision', 14);

// set_time_limit(0);
// end todo
$_COOKIE_LOGIN = 'login';
$_COOKIE_JWT = 'token';
$jwt_key = '26ZP7az8ca4JqBfS95Dlpjzk4EFH00Ue';
date_default_timezone_set('Asia/Tehran');
require_once('systems/Require.php');
require_once ('vendor/autoload.php');
$sub_directory = 1;
$sub = $sub_directory;
$URL_base = explode('/', $_SERVER['REQUEST_URI']);


$url_exist = 0;
$method_exist = 0;
if (count($URL_base) - $sub == 2) {
    View::redirect('index');
} else if (count($URL_base) - $sub == 3) {
    // }else{
    $URL = $URL_base[count($URL_base) - 2];
    foreach ($paths as $path => $actions) {

        if (strtoupper($URL) == strtoupper($path)) {
            $url_exist++;
            foreach ($actions as $method => $action) {

                // todo -> check for project access
                //Filter::permissions();
                // Filter before
                if ((strtoupper($method) == 'BEFORE' || strtoupper($method) == 'AFTER') && !empty($action)) {
                    $action = explode(',', str_replace(' ', '', $action));
                    foreach ($action as $act) {
                        (new Filter)->$act();
                    }
                }


                if ($_SERVER['REQUEST_METHOD'] === 'POST' && strtoupper($method) === 'POST' || $_SERVER['REQUEST_METHOD'] === 'GET' && strtoupper($method) == 'GET') {

                    // Validate route action not empty
                    if ($method && empty($action)) {
                        (new Route)->$method();
                    }
                   $method_exist++;
                    $act_exp =$action;
                    if (count($act_exp) == 1) {
                        $act_exp_1 = $act_exp[0];
                        View::make($act_exp_1);
                    } else if (count($act_exp) == 2) {
                        $act_exp_1 = $act_exp[0];
                        $act_exp_2 = $act_exp[1];
                        $this_class = new $act_exp_1();
                        $this_class->$act_exp_2();
                    }
                }

            }
        }

    }
} else if (count($URL_base) - $sub == 4) {
    $URL0 = $URL_base[count($URL_base) - 3];
    $URL1 = $URL_base[count($URL_base) - 2];
    // print_r($URL0);return;
    if ($URL0 == 'user') {
        return UserController::profile();
    }else if ($URL0 == 'api') {
        return ApiController::index();
    }

} else if (count($URL_base) - $sub == 5) {
    $URL0 = $URL_base[count($URL_base) - 4];
    $URL1 = $URL_base[count($URL_base) - 3];
    $URL2 = $URL_base[count($URL_base) - 2];

    if ($URL0 == 'api' && $URL1 == 'v1') {
        return ApiController::v1($URL2);
    }
}


if ($url_exist == 0) {
    View::make('404');
} else if ($method_exist == 0) {
    Route::not_found();
}
?>