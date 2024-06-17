<?php

use PHPUnit\Framework\TestCase;
use App\Auth;

class AuthTest extends TestCase
{
    /**
     * @var Auth
     */
    private $auth;

    /**
     * @before
     */
    public function setAuth() {
      $pdo = new PDO('sqlite::memory:', null, null, [
          PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
          PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
      ]);
      $pdo->exec('CREATE TABLE users (username TEXT, password TEXT)');
      for ($i = 0; $i <= 10; $i++) {
          $password = password_hash("user$i", PASSWORD_BCRYPT);
          $pdo->query("INSERT INTO users (username, password) VALUES ('user$i', '$password')");
      }
      $this->auth = new Auth($pdo);
    }
    public function testValidLoginBadUsername()
    {
        $this->assertNull($this->auth->login('fjwiujwi', 'user2'));
    }

    public function testValidLoginBadPassword()
    {
        $this->assertNull($this->auth->login('user1', 'rjfejoef'));
    }

    public function testLoginSucces()
    {
        $this->assertObjectHasProperty('username', $this->auth->login('user1', 'user1'));
    }
}