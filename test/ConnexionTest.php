<?php

declare(strict_types=1);

namespace Test;

use PHPUnit\Framework\TestCase;
use models\Connexion;

require("models/Connexion.php");
// require("models/Autoloader.php");

class ConnexionTest extends TestCase
{
    protected $connxion;

    public function setUp() :void
    {
        parent::setUp();
        $this->connexion = new Connexion("duretkevin@live.fr", "123");
    }

    public function testLogin(): void 
    {
       $this->assertEquals(true, $this->connexion->login());
    }
    
    public function testGetUserId1(): void
    {
        $this->assertEquals([0 => ["id" => "1", "login" => "duretkevin@live.fr", 0 => '1', 1 => 'duretkevin@live.fr', 2 => '$2y$10$JBGtY2LaJInCl7Fq.UaOJ./G6kJBmrFzxdwGNiINgaFVeH.m5cQOe', 'created_at' => '2021-12-18 22:05:05', 3 => '2021-12-18 22:05:05', 'updated_at' => '2021-12-18 22:05:05', 4 => '2021-12-18 22:05:05', 'token' => 'first', 5 => 'first', 'password' => '$2y$10$JBGtY2LaJInCl7Fq.UaOJ./G6kJBmrFzxdwGNiINgaFVeH.m5cQOe']], $this->connexion->getUser([0 => "id", 1 => "=", 2 => "\"1\""], "array"));
    }

    public function testGetUserWhereLoginAndPassword(): void
    {
        $this->assertEquals([0 => ["id" => "1", "login" => "duretkevin@live.fr", 0 => '1', 1 => 'duretkevin@live.fr', 2 => '$2y$10$JBGtY2LaJInCl7Fq.UaOJ./G6kJBmrFzxdwGNiINgaFVeH.m5cQOe', 'created_at' => '2021-12-18 22:05:05', 3 => '2021-12-18 22:05:05', 'updated_at' => '2021-12-18 22:05:05', 4 => '2021-12-18 22:05:05', 'token' => 'first', 5 => 'first', 'password' => '$2y$10$JBGtY2LaJInCl7Fq.UaOJ./G6kJBmrFzxdwGNiINgaFVeH.m5cQOe']], $this->connexion->getUser([0 => "login", 1 => "=", "\"duretkevin@live.fr\""], "array"));
    }
}
