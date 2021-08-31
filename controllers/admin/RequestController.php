<?php
namespace Controllers\admin;

class RequestController
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