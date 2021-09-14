<?php

namespace Models;

use Systems\Auth;
use Systems\DataBase;

class User extends BaseModel
{
    const auth = 0, //customer user dont complete profile
        customer = 1,
        admin = 2,
        superadmin = 3,
        table = 'users',
        primary = 'user_id',
        timecreate = 'user_create';

    static public function redirect()
    {
        $user = Auth::user();
        $address = '';
        switch ($user['user_type']) {
            case User::auth:
                $address = 'userProfileCreate';
                break;
            case User::customer:
                $address = 'user';
                break;
            case User::admin:
            case User::superadmin:
                $address = 'admin';
                break;
        }
        return $address;
    }

    function login($username)
    {
        $DB=new DataBase();
        $query = $DB->pdo->prepare('SELECT * FROM users WHERE user_phone="' . $username . '"');
        $query->execute();
        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }

    function create_acount($name, $email, $phone, $password, $registerdate)
    {
        $DB=new DataBase();
        $query = $DB->pdo->prepare("INSERT INTO users(user_name,user_email,user_phone, user_password,user_create) VALUES ('" . $name . "','" . $email . "','" . $phone . "','" . $password . "','" . $registerdate . "')");
        $query->execute();
        return $DB->pdo->lastInsertId();
    }
    function create_admin($name, $email, $phone, $password, $registerdate)
    {
        $DB=new DataBase();
        $query = $DB->pdo->prepare("INSERT INTO users(user_name,user_email,user_phone, user_password,user_type,user_create) VALUES ('" . $name . "','" . $email . "','" . $phone . "','" . $password . "','2','" . $registerdate . "')");
        $query->execute();
        return $DB->pdo->lastInsertId();
    }

    function get_user_by_session($session)
    {
        $DB=new DataBase();
        $query = $DB->pdo->prepare('SELECT * FROM users WHERE user_session="' . $session . '"');
        $query->execute();
        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }

    public static function defineAttributeValue(MareiCollection $users)
    {
        foreach ($users as $user) {
            $str = '';
            switch ($user->user_type) {
                case 0:
                    $str = 'کاربر';
                    break;
                case 1:
                    $str = 'مشتری';
                    break;
                case 2:
                    $str = 'مدیر';
                    break;
                case 3:
                    $str = 'مدیر کل';
                    break;
            }
            $user->user_type = $str;
        }
        return $users;
    }

    public function find()
    {
        $Qb = QB::getInstance();
        $item = $Qb->table($this::table)->where($this::primary, $this->id)->QGet();
        return isset($item[0]) ? $item[0] : [];
    }
}