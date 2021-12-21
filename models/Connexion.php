<?php

declare(strict_types=1);

namespace models;
use models\DB;
require("models/DB.php");

class Connexion
{
    protected $login;
    protected $password;
    protected $table;
    protected $db;

    public function __construct($login, $password)
    {
        $this->login = $login;
        $this->password = $password;
        $this->db = new DB( DATABASE_USER );
        $this->table = TABLE_USER;
    }

    public function login()
    {
        $user = $this->getUser([0 => "login", 1 => "=", '"' . $this->login . "\""]);
        return password_verify($this->password, $user[0]->password) ? true : false;
    }
    public function crypt($password)
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    public function getUser(ARRAY $condition, STRING $type = "object")
    {
        $this->db->select($this->table);
        $this->where($condition);
        return $this->executeQuery($type);
    }

    public function sendQuery()
    {
        return $this->db->sendQuery();
    }

    public function executeQuery(STRING $type)
    {
        return $this->db->executeQuery($type);
    }

    public function where(array $condition): void
    {
        $this->db->where($condition[0], $condition[1], $condition[2]);
    }
}