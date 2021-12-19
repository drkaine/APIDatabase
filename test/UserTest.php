<?php

declare(strict_types=1);

namespace Test;

use PHPUnit\Framework\TestCase;
use models\User;

require("models/User.php");
// require("models/Autoloader.php");

class UserTest extends TestCase
{
    protected $user;

    public function setUp() :void
    {
        parent::setUp();
        $this->user = new User("test@test.test", "test", "NULL");
    }

    public function testCreateUserTest(): void 
    {
       $this->assertEquals(true, $this->user->create());
    }

    public function testUpdateLoginTestInTest2(): void 
    {
        $this->assertEquals(true, $this->user->update("login=\"test2@test.test\"", [0 => "login", 1 => "=", 2 => "\"test@test.test\""]));
    }

    public function testDeleteLoginTest2(): void
    {
        $this->assertEquals(true, $this->user->delete([0 => "login", 1 => "=", 2 => "\"test2@test.test\""]));
    }

    public function testGetUserId1(): void
    {
        $this->assertEquals([0 => ["id" => "1", "login" => "duretkevin@live.fr", 0 => '1', 1 => 'duretkevin@live.fr', 2 => '123', 'created_at' => '2021-12-18 22:05:05', 3 => '2021-12-18 22:05:05', 'updated_at' => '2021-12-18 22:05:05', 4 => '2021-12-18 22:05:05', 'token' => 'first', 5 => 'first', 'password' => '123']], $this->user->getUser([0 => "id", 1 => "=", 2 => "\"1\""], "array"));
    }
}
