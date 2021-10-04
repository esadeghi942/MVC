<?php

use Controllers\UserController;
use Controllers\AuthController;
use Controllers\FileController;
use Controllers\CommentController;
use Controllers\RequestController;
use Controllers\BugController;
use Controllers\CustomerController;
use Controllers\MaliController;
use Controllers\AnswerController;

$paths = array(
    'index' => array('before' => '', 'get' => ['index'], 'post' => '', 'after' => ''),
    '404' => array('before' => '', 'get' => ['404'], 'post' => '', 'after' => ''),

    //Auth
    'login' => array('before' => '', 'get' => ['auth/login'], 'post' => [AuthController::class, 'login'], 'after' => ''),
    'logout' => array('before' => '', 'get' => [AuthController::class, 'logout'], 'post' => '', 'after' => ''),

    'register' => array('before' => '', 'get' => ['auth/register'], 'post' => [AuthController::class, 'register'], 'after' => ''),
    'verifie' => array('before' => '', 'get' => ['auth/verifie'], 'post' => [AuthController::class, 'verifie'], 'after' => ''),
    'sendcode' => array('before' => '', 'get' => ['auth/sendcode'], 'post' => [AuthController::class, 'sendcode'], 'after' => ''),

    'forget' => array('before' => '', 'get' => ['auth/forget'], 'post' => [AuthController::class, 'forget_password'], 'after' => ''),
    'recovery_password' => array('before' => '', 'get' => ['auth/recovery_password'], 'post' => [AuthController::class, 'recovery_password'], 'after' => ''),
    'new_password' => array('before' => '', 'get' => ['auth/new_password'], 'post' => [AuthController::class, 'new_password'], 'after' => ''),

    'edit' => array('before' => 'check_auth', 'get' => [AuthController::class, 'edit'], 'post' => [AuthController::class, 'update'], 'after' => ''),


    //users
    'user' => array('before' => 'check_auth', 'get' => [UserController::class,'userIndex'], 'post' =>  [CommentController::class, 'store'], 'after' => ''),
    'admin' => array('before' => 'check_admin', 'get' => [UserController::class,'adminIndex'], 'post' => '', 'after' => ''),

    //profile
    'userProfileCreate' => array('before' => 'check_auth', 'get' => [CustomerController::class,'create'], 'post' => [CustomerController::class, 'storeProfile'], 'after' => ''),
    'userProfileUpdate' => array('before' => 'check_customer', 'get' => [CustomerController::class, 'editProfile'], 'post' => [CustomerController::class, 'updateProfile'], 'after' => ''),
    'userProfile' => array('before' => 'check_auth', 'get' => [CustomerController::class, 'index'], 'post' => [CustomerController::class, 'updateProfile'], 'after' => ''),

//document
    'document' => array('before' => 'check_customer', 'get' => [FileController::class, 'document'], 'post' => [FileController::class, 'storeDocument'], 'after' => ''),

//admin
    'adminDocumentIndex' => array('before' => 'check_admin', 'get' => [FileController::class, 'AdminIndex'], 'post' => [FileController::class, 'DeleteDocument'], 'after' => ''),
    'adminDocument' => array('before' => 'check_admin', 'get' => [FileController::class, 'AdminDocument'], 'post' => '', 'after' => ''),

    //request
    'userRequestCreate' => array('before' => 'check_customer', 'get' => ['user/request/create'], 'post' => [RequestController::class, 'store'], 'after' => ''),
    'userRequestUpdate' => array('before' => 'check_customer', 'get' => [RequestController::class, 'edit'],  'post' => [RequestController::class, 'update'], 'after' => ''),
    'userRequestIndex'  => array('before' => 'check_customer', 'get' => [RequestController::class, 'index'], 'post' => '', 'after' => ''),
    'userRequestDelete' => array('before' =>'check_customer',  'get'  => '','post' => [RequestController::class, 'delete'], 'after' => ''),
    'userRequest' => array('before' =>'check_customer',  'get'  =>  [RequestController::class, 'userRequest'],'post' =>'', 'after' => ''),

    //PayPal
    'payment' => array('before' =>'check_customer',  'get'  =>  [MaliController::class, 'request'],'post' =>'', 'after' => ''),
    'verify_payment' => array('before' =>'check_customer',  'get'  =>  [MaliController::class, 'verify'],'post' =>'', 'after' => ''),
//admin
    'adminRequestIndex' => array('before' => 'check_admin', 'get' => [RequestController::class, 'adminIndex'], 'post' => '', 'after' => ''),
    'adminRequest' => array('before' => 'check_admin', 'get' => [RequestController::class, 'adminRequest'], 'post' => [RequestController::class,'postAnswer'], 'after' => ''),
    'adminSetPayment' => array('before' => 'check_admin', 'get' => [MaliController::class, 'adminPayment'], 'post' => [MaliController::class,'adminSetPayment'], 'after' => ''),

    //bug
    'userBugCreate' => array('before' => 'check_customer', 'get' => ['user/bug/create'], 'post' => [BugController::class, 'store'], 'after' => ''),
    'userBugUpdate' => array('before' => 'check_customer', 'get' => [BugController::class, 'edit'],  'post' => [BugController::class, 'update'], 'after' => ''),
    'userBugIndex'  => array('before' => 'check_customer', 'get' => [BugController::class, 'index'], 'post' => '', 'after' => ''),
    'userBugDelete' => array('before' => 'check_customer',  'get'  => '','post' => [BugController::class, 'delete'], 'after' => ''),
    'userBug' => array('before' => 'check_customer', 'get' => [BugController::class, 'userBug'], 'post' =>'', 'after' => ''),

////admin
    'adminBugIndex' => array('before' => 'check_admin', 'get' => [BugController::class, 'adminIndex'], 'post' => [BugController::class,'postAnswer'], 'after' => ''),
    'adminBug' => array('before' => 'check_admin', 'get' => [BugController::class, 'adminBug'], 'post' => [BugController::class,'postAnswer'], 'after' => ''),

//mali
    'adminMaliIndex' => array('before' => 'check_admin', 'get' => [MaliController::class, 'adminIndex'], 'post' => [MaliController::class,'DeleteMali'], 'after' => ''),

    //file
    'userFileDelete' => array('before' =>'check_customer', 'get' => '', 'post' => [FileController::class, 'delete'], 'after' => ''),
    'answerDelete' => array('before' =>'check_admin', 'get' => '', 'post' => [AnswerController::class, 'delete'], 'after' => ''),


    //comment
    'userGroupComment' => array('before' => 'check_customer', 'get' => [CommentController::class, 'index'], 'post' => [CommentController::class, 'newGroupComment'], 'after' => ''),
    'userComment' => array('before' => 'check_customer', 'get' => [CommentController::class, 'comments'], 'post' => [CommentController::class, 'store'], 'after' => ''),
    'commentDelete' => array('before' => 'check_customer', 'get' => '', 'post' => [CommentController::class, 'delete'], 'after' => ''),
    'groupCommentDelete' => array('before' => 'check_customer', 'get' => '', 'post' => [CommentController::class, 'deletegroup'], 'after' => ''),
    'groupCommentTClose' => array('before' => 'check_customer', 'get' => [CommentController::class, 'toggleclosegroup'], 'post' =>'', 'after' => ''),

    ////////admin
    'adminComment' => array('before' => 'check_admin', 'get' => [CommentController::class, 'adminIndex'], 'post' => '', 'after' => ''),
    'adminUserCommnet' => array('before' => 'check_admin', 'get' => [CommentController::class, 'userComment'], 'post' => [CommentController::class, 'postComment'], 'after' => ''),
    'commentAdminDelete' => array('before' => 'check_admin', 'get' => '', 'post' => [CommentController::class, 'admindelete'], 'after' => ''),

    'adminCustomerIndex' => array('before' => 'check_admin', 'get' => [CustomerController::class, 'adminIndex'], 'post' => '', 'after' => ''),
    'adminCustomer' => array('before' => 'check_admin', 'get' => [CustomerController::class, 'adminCustomer'], 'post' => [CommentController::class,'newGroupComment'], 'after' => ''),
    'adminDeleteCustomer' => array('before' => 'check_admin', 'get' => '', 'post' => [CustomerController::class,'delete'], 'after' => ''),

    //SMS Rest Payment
    'adminGetSms' => array('before' => 'check_admin', 'get' => [MaliController::class,'restSms'], 'post' => '', 'after' => ''),

    //superAdmin
    'adminUserCreate' => array('before' => 'check_superadmin', 'get' => ['admin/user/create'], 'post' => [AuthController::class, 'adminStore'], 'after' => ''),
    'adminUserIndex' => array('before' => 'check_superadmin', 'get' => [UserController::class, 'adminAll'], 'post' => '', 'after' => ''),
    'adminUserEdit' => array('before' => 'check_superadmin', 'get' => [UserController::class, 'adminEdit'], 'post' => [AuthController::class, 'adminUpdate'], 'after' => ''),
    'adminUserDelete' => array('before' => 'check_superadmin', 'get' => '', 'post' => [UserController::class, 'adminDelete'], 'after' => ''),
);