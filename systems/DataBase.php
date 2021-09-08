<?php

namespace Systems;
$db_config = [
    //current development environment
    "env" => "development",
    //Localhost
    "development" => [
        "host" => "localhost",
        "database" => "tehran_ftth",
        "username" => "root",
        "password" => ""
    ],
    //Server
    "production" => [
        "host" => "tehranftth.ir",
        "database" => "tehran_ftth",
        "username" => "almas",
        "password" => "aSni9lDTH"
    ]
];

class DataBase
{
    private $host = 'localhost';
    private $db = 'tehran_ftth';
    private $user = 'root';
    private $pass = '';

    public $pdo;

    public function __construct()
    {
        try {
            $this->pdo = new \PDO(
                'mysql:host=' . $this->host . ';dbname=' . $this->db, $this->user, $this->pass);
            $this->pdo->exec("set names utf8");
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }
}
