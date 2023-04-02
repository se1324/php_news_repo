<?php

require_once 'classes/Database.php';

class UserUtils
{
    public static function CreateNewUser(string $name, string $surname, string $username, string $password): void {
        $cleanName = trim($name);
        $cleanSurname = trim($surname);
        $cleanUsername = trim($username);
        $cleanPassword = trim($password);

        $hashPassword = password_hash($cleanPassword, PASSWORD_BCRYPT);

        $db = new Database();

        $sql = 'Insert into authors (name, surname, created_at, username, password) 
                values (:name, :surname, default, :username, :password)';

        $stmt = $db->conn->prepare($sql);
        $stmt->execute([
           ':name' => $cleanName,
           ':surname' => $cleanSurname,
           ':username' => $cleanUsername,
           ':password' => $hashPassword,
        ]);
    }
}