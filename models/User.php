<?php

declare(strict_types=1);

namespace models;
use models\DB;
require("models/DB.php");

class User
{
    protected $login;
    protected $password;
    protected $token;
    protected $date;
    protected $table;
    protected $db;

    public function __construct($login = NULL, $password = NULL, $token = NULL)
    {
        $this->login = $login;
        $this->password = $password;
        $this->token = $token;
        $this->date = new \DateTime();
        $this->db = new DB( DATABASE_USER );
        $this->table = 'user';
    }

    public function create()
    {
        $this->db->insert($this->table, '(`login`, `password`, `created_at`, `updated_at`, `token`)', '("' . $this->login . '", "' . $this->crypt($this->password) . '", "' . $this->date->format('Y-m-d H:i:s.u') . '", "' . $this->date->format('Y-m-d H:i:s.u') . '", "' . $this->token . '")');
        return $this->sendQuery();
    }

    public function update(STRING $set, ARRAY $condition)
    {
        $this->db->update($this->table, $set);
        $this->where($condition);
        return $this->sendQuery();
    }

    public function delete(ARRAY $condition)
    {
        $this->db->delete($this->table);
        $this->where($condition);
        return $this->sendQuery();
    }

    public function sendQuery()
    {
        return $this->db->sendQuery();
    }

    /**
     * @return bool
     */
    public function executeQuery(STRING $type)
    {
        return $this->db->executeQuery($type);
    }

    /**
     * @param array $condition
     * @return void
     */
    public function where(array $condition): void
    {
        $this->db->where($condition[0], $condition[1], $condition[2]);
    }

    public function crypt($password)
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }
}