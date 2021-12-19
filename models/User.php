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

    public function __construct($login, $password, $token)
    {
        $this->login = $login;
        $this->password = $password;
        $this->token = $token;
        $this->date = new \DateTime();
        $this->db = new DB('apidatabase');
        $this->table = 'user';
    }

    public function create()
    {
        $this->db->insert($this->table, '(`login`, `password`, `created_at`, `updated_at`, `token`)', '("' . $this->login . '", "' . $this->password . '", "' . $this->date->format('Y-m-d H:i:s.u') . '", "' . $this->date->format('Y-m-d H:i:s.u') . '", "' . $this->token . '")');
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
}