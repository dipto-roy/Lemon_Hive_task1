<?php
namespace LH\Models;

class Auth {
    private const USERNAME = 'lemon';
    private const PASSWORD = 'lemon';

    public function checkCredentials(string $username, string $password): bool {
        return $username === self::USERNAME && $password === self::PASSWORD;
    }
}
?>