<?php

namespace Models;

use Systems\Auth;
use Systems\Url;
use Systems\View;

class BaseModel
{
    protected $id;

    public function __construct($id = 0)
    {
        $this->id = $id;
    }

    public function getcan()
    {
        if (Auth::isAdmin())
            return;
        $id = Url::get('id');
        $model = get_called_class();
        $model = new $model($id);
        $record = $model->find();
        $userid = User::primary;
        $user = $record->$userid;
        if (Auth::id() != $user)
            return View::redirect('../user', ['danger' => 'شما اجازه دسترسی به این صفحه را ندارید']);
    }

    public function postcan($id)
    {
        if (Auth::isAdmin())
            return;
        $model = get_called_class();
        $model = new $model($id);
        $record = $model->find();
        $userid = User::primary;
        $user = $record->$userid;
        if (Auth::id() != $user)
           return false;
        return true;
    }

    public function find()
    {
        $qb = QB::getInstance();
        $item = $qb->table($this::table)->where($this::primary, $this->id)->get();
        return isset($item[0]) ? $item[0] : [];
    }

    public function delete(){
        $QB = QB::getInstance();
        $i=$QB->delete($this::table)->where($this::primary, $this->id)->exec();
        if($i)
            return true;
        return false;
    }
}