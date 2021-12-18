<?php

declare(strict_types=1);

namespace Test;

use PHPUnit\Framework\TestCase;
use models\DB;

require("models/DB.php");

class DBTest extends TestCase
{
    protected $db;

    public function setUp() :void
    {
        parent::setUp();
        $this->db = new DB("test");
    }

    public function testSelectAllColumnInTableTest(): void 
    {
        $this->db->select("test");
        $this->assertEquals([0 => ["id" => "1", "nom" => "test", 1 => "test", 0 => '1'], 1 => ["id" => "2", "nom" => "test2", 1 => "test2", 0 => '2'],  2 => ["id" => "3", "nom" => "test2", 1 => 'test2', 0 => '3']], $this->db->executeQuery(''));
    }

    public function testSelectColumnIdInTableTest(): void 
    {
        $this->db->select("test", "id");
        $this->assertEquals([0 => ["id" => "1", 0 => '1'], 1 => ["id" => "2", 0 => '2'],  2 => ["id" => "3", 0 => '3']], $this->db->executeQuery(''));
    }

    public function testSelectDistinctColumnIdInTableTest(): void 
    {
        $this->db->select("test", "nom", 'DISTINCT ');
        $this->assertEquals([0 => ["nom" => "test", 0 => 'test'], 1 => ["nom" => "test2", 0 => 'test2']], $this->db->executeQuery(''));
    }

    public function testWhereIdEqual1(): void
    {
        $this->db->select("test");
        $this->db->where("id", "=", "1");
        $this->assertEquals([0 => ["id" => "1", "nom" => "test", 1 => "test", 0 => '1']], $this->db->executeQuery(''));
    }

    public function testCreateTableTest2(): void
    {
        $this->db->create("test2", "id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        firstname VARCHAR(30) NOT NULL");
        $this->assertEquals(true, $this->db->sendQuery());
    }

    public function testDropTableTest2(): void
    {
        $this->db->drop("test2");
        $this->assertEquals(true, $this->db->sendQuery());
    }

    public function testCreateDatabaseTest(): void
    {
        $this->db->createDatabase("test2");
        $this->assertEquals(true, $this->db->sendQuery());
    }

    public function testDropDatabaseTest(): void
    {
        $this->db->dropDatabase("test2");
        $this->assertEquals(true, $this->db->sendQuery());
    }

    public function testInsertOneInTableTest3(): void
    {
        $this->db->insert("`test3`", "(`id`, `nom`)", '(NULL, \'hello\')');
        $this->assertEquals([], $this->db->executeQuery());
    }

    public function testUpdateHelloInBlobInTableTest3(): void
    {
        $this->db->update("`test3`", "nom = \"blob\"");
        $this->db->where("nom", "=", "\"hello\"");
        $this->assertEquals([], $this->db->executeQuery());
    }

    public function testDeleteTableTest3(): void
    {
        $this->db->delete("test3");
        $this->assertEquals(true, $this->db->SendQuery());
    }
}
