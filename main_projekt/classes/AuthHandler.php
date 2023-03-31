<?php

require_once 'Database.php';

class AuthHandler
{
    public function Register(string $username, string $password): void {
        $db = new Database();
        $sql = 'Insert into users (username, password) values (:username, :password)';

        $cleanUsername = trim($username);
        $cleanPassword = trim($password);

        $hashPassword = password_hash($cleanPassword, PASSWORD_BCRYPT);

        $stmt = $db->conn->prepare($sql);
        $stmt->execute([
            ':username' => $cleanUsername,
            ':password' => $hashPassword,
        ]);
    }

    public function Login(string $username, string $password): bool {
        $db = new Database();

        $cleanUsername = trim($username);
        $cleanPassword = trim($password);

        $sql = 'select * from users where username = :username';
        $stmt = $db->conn->prepare($sql);
        $stmt->execute([
            ':username' => $cleanUsername,
        ]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user == false) {
            return false;
        }

        $verifyPassword = password_verify($cleanPassword, $user['password']);

        if ($verifyPassword == false) {
            return false;
        }

        return true;
    }

    private function SetLoggedIn(int $id, string $username, string $password) {

    }

    private function GetPermissions(int $userId): array {
        
    }

}