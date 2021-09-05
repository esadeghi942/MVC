<?php

namespace Models;

use Systems\Auth;
use Systems\DataBase;

class User extends DataBase
{
    const auth = 0, //customer user dont complete profile
        customer = 1,
        admin = 2,
        superadmin = 3,
        table='users',
        primary='user_id';

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

    public function users()
    {
        //$query = $this->dbh->prepare('SELECT * FROM users');
        $query = QB::getInstance();
        $query = $query->table(User::table)->get();
        return $query;
    }

    function login($username)
    {
        $query = $this->pdo->prepare('SELECT * FROM users WHERE user_phone="' . $username . '"');
        $query->execute();
        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function find($id){
        $qb=QB::getInstance();
        $user=$qb->table(self::table)->where(self::primary,$id)->QGet();
        return $user[0];
    }

    // Create new acount
    function create_acount($name, $email, $phone, $password, $registerdate)
    {
        $query = $this->pdo->prepare("INSERT INTO users(user_name,user_email,user_phone, user_password,user_create) VALUES ('" . $name . "','" . $email . "','" . $phone . "','" . $password . "','" . $registerdate . "')");
        $query->execute();
        return $this->pdo->lastInsertId();
    }

    // Get user details by session
    function get_user_by_session($session)
    {
        $query = $this->pdo->prepare('SELECT * FROM users WHERE user_session="' . $session . '"');
        $query->execute();
        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }

      /*  function update_session_login($user_id, $sess)
        {
            $query = $this->pdo->prepare('UPDATE users SET user_session="' . $sess . '" WHERE user_id=' . $user_id);
            $query->execute();
            return $query->errorInfo();
        }*/

    // Get All Users
    function get_all_users($field_name)
    {
        $query = $this->pdo->prepare('SELECT ' . $field_name . ' FROM users');
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

}