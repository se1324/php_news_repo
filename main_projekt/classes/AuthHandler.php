<?php

require_once 'Database.php';

class AuthHandler
{
    public function Register(string $username, string $password, string $name, string $surname): void {
        $db = new Database();
        $sql = 'Insert into authors (name, surname, created_at, username, password) 
                values (:name, :surname, default, :username, :password)';

        $cleanUsername = trim($username);
        $cleanPassword = trim($password);
        $cleanName = trim($name);
        $cleanSurname = trim($surname);

        $hashPassword = password_hash($cleanPassword, PASSWORD_BCRYPT);

        $stmt = $db->conn->prepare($sql);
        $stmt->execute([
            ':username' => $cleanUsername,
            ':password' => $hashPassword,
            ':name' => $cleanName,
            ':surname' => $cleanSurname,
        ]);

        $insertedDataId = $db->conn->lastInsertId();

        $this->SetLoggedIn($insertedDataId, $cleanUsername);
    }

    public function Login(string $username, string $password): bool {
        $db = new Database();

        $cleanUsername = trim($username);
        $cleanPassword = trim($password);

        $sql = 'select * from authors where username = :username';
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

        $this->SetLoggedIn($user['id'], $user['username']);

        return true;
    }

    public function Logout(): void {
        if (!isset($_SESSION)) {
            session_start();
        }

        $_SESSION = array();

        session_destroy();
    }

    private function SetLoggedIn(int $id, string $username): void {
        if (!isset($_SESSION)) {
            session_start();
        }
        session_regenerate_id();

        $_SESSION['user_id'] = $id;
        $_SESSION['username'] = $username;
        $_SESSION['logged_in'] = true;
        $_SESSION['perms_data'] = $this->GetPermissions($id);
    }

    private function GetPermissions(int $userId): array {
        $db = new Database();

        $sql = 'select rc.resource_name, pr.perm_name 
        from resources rc 
            inner join roles_perms rp on rp.resource_id = rc.resource_id 
            inner join permissions pr on pr.perm_id = rp.perm_id 
            inner join roles r on r.role_id = rp.role_id 
            inner join authors au on au.role_id = r.role_id 
        where au.id = :id';

        $stmt = $db->conn->prepare($sql);
        $stmt->execute([
            ':id' => $userId,
        ]);

        $perms = $stmt->fetchAll(PDO::FETCH_GROUP | PDO::FETCH_ASSOC);

        return $perms;
    }

    public function IsUserLoggedIn(): bool {
        if (!isset($_SESSION)) {
            session_start();
        }

        if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
            return true;
        }

        return false;
    }

    public function UpdateUserDetails(string $name, string $surname, string $username, string $password, bool $mustSetNewPassword): void {
        if (!isset($_SESSION)) {
            session_start();
        }

        $cleanName = trim($name);
        $cleanSurname = trim($surname);
        $cleanUsername = trim($username);

        $db = new Database();

        if ($mustSetNewPassword) {
            $cleanPassword = trim($password);
            $hashPassword = password_hash($cleanPassword, PASSWORD_BCRYPT);

            $sql = 'Update authors set name = :name, surname = :surname, username = :username, password = :password
                where id = :id';
            $stmt = $db->conn->prepare($sql);
            $stmt->execute([
                ':name' => $cleanName,
                ':surname' => $cleanSurname,
                ':username' => $cleanUsername,
                ':password' => $hashPassword,
                ':id' => $_SESSION['user_id'],
            ]);
        }
        else {
            $sql = 'Update authors set name = :name, surname = :surname, username = :username
                where id = :id';
            $stmt = $db->conn->prepare($sql);
            $stmt->execute([
                ':name' => $cleanName,
                ':surname' => $cleanSurname,
                ':username' => $cleanUsername,
                ':id' => $_SESSION['user_id'],
            ]);
        }

        $_SESSION['username'] = $cleanUsername;
    }

    public function GetCurrentUserDetails(): array {
        if (!isset($_SESSION)) {
            session_start();
        }
        return $_SESSION;
    }
}