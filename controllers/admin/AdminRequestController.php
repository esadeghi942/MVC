<?php
namespace Controllers\Admin;

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