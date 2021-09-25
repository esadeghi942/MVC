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

    public function postcan()
    {
        if (Auth::isAdmin())
            return true;
        $record = $this->find();
        $user_id=User::primary;
        $user = $record->$user_id;
        if (Auth::id() != $user)
            return false;
        return true;
    }

    public function find()
    {
        $Qb = QB::getInstance();
        return $Qb->table($this::table)->where($this::primary, $this->id)->get()->first();
    }

    public function all($whereStatement = null)
    {
        $Qb = QB::getInstance();
        if ($whereStatement !== null)
            $items = $Qb->table($this::table)->naturalJoin(User::table)->whereStatement($whereStatement)->orderBy($this::timecreate,'DESC')->get();
        else
            $items = $Qb->table($this::table)->naturalJoin(User::table)->orderBy($this::timecreate,'DESC')->get();
        foreach ($items as $item)
            $item->user_password = '******';
        return $items;
    }

    public function delete()
    {
        $Qb = QB::getInstance();
        $i = $Qb->delete($this::table)->where($this::primary, $this->id)->exec();
        if ($i)
            return true;
        return false;
    }
}