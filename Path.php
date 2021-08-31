<?php
use Controllers\Admin\RequestController as AdminRequest;
use Controllers\Admin\UserController;
use Controllers\AuthController;

$paths = array(
    'index' => array('before' => '', 'get' => ['index'], 'post' => '', 'after' => ''),
    //Auth
    'login' => array('before' => '', 'get' => [AuthController::class,'loginIndex'], 'post' => [AuthController::class,'login'], 'after' => ''),
    'logout' => array('before' => '', 'get' => [AuthController::class,'logout'], 'post' => '', 'after' => ''),
    'register' => array('before' => '', 'get' => ['auth/register'], 'post' => [AuthController::class,'register'], 'after' => ''),
    'forget' => array('before' => '', 'get' => ['auth/forget'], 'post' => [AuthController::class,'forget_password'], 'after' => ''),
    'recovery_password' => array('before' => '', 'get' => ['auth/recovery_password'], 'post' => [AuthController::class,'recovery_password'], 'after' => ''),
    'new_password' => array('before' => '', 'get' => ['auth/new_password'], 'post' => [AuthController::class,'new_password'], 'after' => ''),


     //users
    'profile' => array('before' => 'check_auth', 'get' => ['user/profile'], 'post' => '', 'after' => ''),
    'user' => array('before' => 'check_auth', 'get' => ['user/index'], 'post' => '', 'after' => ''),

    //admin
    'admin' => array('before' => 'check_superadmin', 'get' => ['admin/index'], 'post' => '', 'after' => ''),
    'adminRequest' => array('before' => 'check_superadmin', 'get' => [AdminRequest::class,'index'], 'post' => '', 'after' => ''),
    'users' => array('before' => 'check_superadmin', 'get' => [UserController::class,'alluser'], 'post' => '', 'after' => ''),
    'test' => array('before' => 'check_auth', 'get' => [RequestController::class,'index'], 'post' => '', 'after' => ''),
   );