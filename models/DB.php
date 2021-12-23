<?php

declare(strict_types=1);

namespace models;

require("config/Config.php");

class DB
{
    protected $hostname = HOST_NAME;
    protected $dbname;
    protected $userdb = USER_LOGIN;
    protected $mdpdb = "";
    protected $driverdb = DRIVER_DB;

    protected $conn;
    public $sql;

    public function __construct($database)
    {
        $this->dbname = $database;
        $this->creation_Connexion();
    }

    protected function creation_Connexion()
    {
        if(empty($this->conn))
        {
            $this->conn = new \PDO($this->driverdb . ':host=' . $this->hostname . ';dbname=' . $this->dbname, $this->userdb, $this->mdpdb);
        }
    }

    public function select(STRING $table, STRING $column = '*', STRING $distinct = ' ')
    {
        $this->sql = 'SELECT ' . $distinct . $column . ' FROM ' . $table;
    }

    public function where(STRING $column, STRING $operator, STRING $value)
    {
        $this->sql .= ' WHERE ' . $column . ' ' . $operator . ' ' . $value;
    }
    
    public function create(STRING $table, STRING $columns)
    {
        $this->sql = 'CREATE TABLE `' . $table . '` (' . $columns . ')';
    }

    public function createDatabase(STRING $database)
    {
        $this->sql = 'CREATE DATABASE IF NOT EXISTS ' . $database;
    }

    public function drop(STRING $table)
    {
        $this->sql = 'DROP TABLE ' . $table;
    }

    public function dropDatabase(STRING $database)
    {
        $this->sql = 'DROP DATABASE IF EXISTS ' . $database;
    }

    public function delete(STRING $table)
    {
        $this->sql = 'DELETE FROM ' . $table;
    }

    public function insert(STRING $table, STRING $columns, STRING $values)
    {
        $this->sql = 'INSERT INTO ' . $table . ' ' . $columns . ' VALUES ' . $values . ';';
    }

    public function update(STRING $table, STRING $values)
    {
        $this->sql = 'UPDATE `' . $table . '` SET ' . $values;
    }

    public function sendQuery()
    {
        if($this->conn->query($this->sql)) return true;
        return false;
    }
    

    public function executeQuery(STRING $type = 'object')
    {
        $data = $this->conn->prepare($this->sql);
        $data->execute();
        if($type === "object") return $data->fetchAll(\PDO::FETCH_CLASS);
        return $data->fetchAll();
    }
}