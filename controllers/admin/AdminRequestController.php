<?php
namespace Controllers\admin;

class AdminRequestController
{
    public function setUp()
    {
        echo 'SetUp';
    }
    public function index()
    {
       \View::make('admin/index');
    }
}