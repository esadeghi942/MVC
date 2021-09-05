<?php

use Controllers\UserController;
use Controllers\AuthController;
use Controllers\FileController;
use Controllers\User\UserRequestController;
use Controllers\Admin\AdminRequestController;
$paths = array(
    'index' => array('before' => '', 'get' => ['index'], 'post' => '', 'after' => ''),
    '404' => array('before' => '', 'get' => ['404'], 'post' => '', 'after' => ''),

    //Auth
    'login' => array('before' => '', 'get' => ['auth/login'], 'post' => [AuthController::class, 'login'], 'after' => ''),
    'logout' => array('before' => '', 'get' => [AuthController::class, 'logout'], 'post' => '', 'after' => ''),
    'register' => array('before' => '', 'get' => ['auth/register'], 'post' => [AuthController::class, 'register'], 'after' => ''),
    'forget' => array('before' => '', 'get' => ['auth/forget'], 'post' => [AuthController::class, 'forget_password'], 'after' => ''),
    'recovery_password' => array('before' => '', 'get' => ['auth/recovery_password'], 'post' => [AuthController::class, 'recovery_password'], 'after' => ''),
    'new_password' => array('before' => '', 'get' => ['auth/new_password'], 'post' => [AuthController::class, 'new_password'], 'after' => ''),
    'edit' => array('before' => 'check_auth', 'get' => [AuthController::class, 'edit'], 'post' => [AuthController::class, 'store'], 'after' => ''),


    //users
    'user' => array('before' => 'check_auth', 'get' => ['user/index'], 'post' => '', 'after' => ''),

    //profile
    'userProfileCreate' => array('before' => 'check_auth', 'get' => [UserController::class,'create'], 'post' => [UserController::class, 'storeProfile'], 'after' => ''),
    'userProfileUpdate' => array('before' => 'check_customer', 'get' => [UserController::class, 'editProfile'], 'post' => [UserController::class, 'updateProfile'], 'after' => ''),

    //request
    'userRequestCreate' => array('before' => 'check_customer', 'get' => ['user/request/create'], 'post' => [UserRequestController::class, 'store'], 'after' => ''),
    'userRequestUpdate' => array('before' => 'check_customer', 'get' => [UserRequestController::class, 'edit'],  'post' => [UserRequestController::class, 'update'], 'after' => ''),
    'userRequestIndex'  => array('before' => 'check_customer', 'get' => [UserRequestController::class, 'index'], 'post' => '', 'after' => ''),
    'userRequestDelete' => array('before' =>'check_customer', 'get'  => '','post' => [UserRequestController::class, 'delete'], 'after' => ''),

    //file
    'userFileDelete' => array('before' =>'check_customer', 'get' => '', 'post' => [FileController::class, 'delete'], 'after' => ''),


    //comment
    'userComment' => array('before' => 'check_customer', 'get' => [UserController::class, 'comment'], 'post' => '', 'after' => ''),

    //admin
    'admin' => array('before' => 'check_admin', 'get' => ['admin/index'], 'post' => '', 'after' => ''),
    'adminRequest' => array('before' => 'check_admin', 'get' => [AdminRequestController::class, 'index'], 'post' => '', 'after' => ''),

    //superAdmin
    'users' => array('before' => 'check_superadmin', 'get' => [UserController::class, 'alluser'], 'post' => '', 'after' => ''),
);