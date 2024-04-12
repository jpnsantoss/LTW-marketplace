<?php

namespace Models;

use \Models\Database;

class User
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getUsers(): array
    {
        $this->db->query("SELECT * FROM users");
        return $this->db->resultSet();
    }

    public function userExists($email, $username)
    {
        // Prepare a SQL statement
        $this->db->query('SELECT * FROM users WHERE email = :email OR username = :username');

        // Bind values
        $this->db->bind(':email', $email);
        $this->db->bind(':username', $username);

        // Execute the statement and fetch the result
        $user = $this->db->single();

        // If a user was found, return true, otherwise return false
        return $user !== false;
    }

    //$username, $full_name, $email, $hashed_password
    public function createUser($userRequest): bool
    {
        $this->db->query("INSERT INTO users (`username`, `full_name`, `email`, `hashed_password`) VALUES (:username, :name, :email, :hashed_password)");
        foreach ($userRequest as $key => $value) {
            $this->db->bind(':' . $key, $value);
        }
        if ($this->db->execute()) return true;
        return false;
    }
}
