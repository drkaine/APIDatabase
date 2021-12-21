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
        $this->user = new User("test@test.test", "123", "NULL");
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
}
