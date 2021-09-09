<?php

use Controllers\UserController;
use Controllers\AuthController;
use Controllers\FileController;
use Controllers\CommentController;
use Controllers\RequestController;
use Controllers\BugController;
use Controllers\CustomerController;
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
    'edit' => array('before' => 'check_auth', 'get' => [AuthController::class, 'edit'], 'post' => [AuthController::class, 'update'], 'after' => ''),


    //users
    'user' => array('before' => 'check_auth', 'get' => ['user/index'], 'post' => '', 'after' => ''),
    'admin' => array('before' => 'check_admin', 'get' => ['admin/index'], 'post' => '', 'after' => ''),

    //profile
    'userProfileCreate' => array('before' => 'check_auth', 'get' => [CustomerController::class,'create'], 'post' => [CustomerController::class, 'storeProfile'], 'after' => ''),
    'userProfileUpdate' => array('before' => 'check_customer', 'get' => [CustomerController::class, 'editProfile'], 'post' => [CustomerController::class, 'updateProfile'], 'after' => ''),

    //request
    'userRequestCreate' => array('before' => 'check_customer', 'get' => ['user/request/create'], 'post' => [RequestController::class, 'store'], 'after' => ''),
    'userRequestUpdate' => array('before' => 'check_customer', 'get' => [RequestController::class, 'edit'],  'post' => [RequestController::class, 'update'], 'after' => ''),
    'userRequestIndex'  => array('before' => 'check_customer', 'get' => [RequestController::class, 'index'], 'post' => '', 'after' => ''),
    'userRequestDelete' => array('before' =>'check_customer',  'get'  => '','post' => [RequestController::class, 'delete'], 'after' => ''),

    //bug
    'userBugCreate' => array('before' => 'check_customer', 'get' => ['user/bug/create'], 'post' => [BugController::class, 'store'], 'after' => ''),
    'userBugUpdate' => array('before' => 'check_customer', 'get' => [BugController::class, 'edit'],  'post' => [BugController::class, 'update'], 'after' => ''),
    'userBugIndex'  => array('before' => 'check_customer', 'get' => [BugController::class, 'index'], 'post' => '', 'after' => ''),
    'userBugDelete' => array('before' => 'check_customer',  'get'  => '','post' => [BugController::class, 'delete'], 'after' => ''),
    //////////////admin

    //file
    'userFileDelete' => array('before' =>'check_customer', 'get' => '', 'post' => [FileController::class, 'delete'], 'after' => ''),


    //comment
    'userComment' => array('before' => 'check_customer', 'get' => [CommentController::class, 'index'], 'post' => [CommentController::class, 'store'], 'after' => ''),
    'commentDelete' => array('before' => 'check_customer', 'get' => '', 'post' => [CommentController::class, 'delete'], 'after' => ''),
    ////////admin
    'adminComment' => array('before' => 'check_admin', 'get' => [CommentController::class, 'adminIndex'], 'post' => '', 'after' => ''),
    'adminUserCommnet' => array('before' => 'check_admin', 'get' => [CommentController::class, 'userComment'], 'post' => [CommentController::class, 'postComment'], 'after' => ''),

    //admin
    'adminRequest' => array('before' => 'check_admin', 'get' => [RequestController::class, 'adminIndex'], 'post' => '', 'after' => ''),
    'adminCustomerIndex' => array('before' => 'check_admin', 'get' => [CustomerController::class, 'adminIndex'], 'post' => '', 'after' => ''),
    'adminCustomer' => array('before' => 'check_admin', 'get' => [CustomerController::class, 'adminCustomer'], 'post' => '', 'after' => ''),

    //superAdmin
    'adminUserCreate' => array('before' => 'check_superadmin', 'get' => ['admin/user/create'], 'post' => [AuthController::class, 'adminStore'], 'after' => ''),
    'adminUser' => array('before' => 'check_superadmin', 'get' => [UserController::class, 'adminAll'], 'post' => '', 'after' => ''),
    'adminUserEdit' => array('before' => 'check_superadmin', 'get' => [UserController::class, 'adminEdit'], 'post' => [AuthController::class, 'adminUpdate'], 'after' => ''),
    'adminUserDelete' => array('before' => 'check_superadmin', 'get' => '', 'post' => [UserController::class, 'adminDelete'], 'after' => ''),
);