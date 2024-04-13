<?php

namespace Models;

use \Models\Database;

class UserModel
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

    public function getUserByEmail($email)
    {
        $this->db->query('SELECT * FROM users WHERE email = :email');
        $this->db->bind(':email', $email);
        $user = $this->db->single();

        if ($user) {
            // Convert the stdClass object to an array
            $user = get_object_vars($user);

            // Check if the user is an admin
            $this->db->query('SELECT * FROM admins WHERE user_id = :user_id');
            $this->db->bind(':user_id', $user['id']);
            $isAdmin = $this->db->single() !== false;

            // Check if the user is a seller
            $this->db->query('SELECT * FROM sellers WHERE user_id = :user_id');
            $this->db->bind(':user_id', $user['id']);
            $isSeller = $this->db->single() !== false;

            // Add the isAdmin and isSeller properties to the user object
            $user['isAdmin'] = $isAdmin;
            $user['isSeller'] = $isSeller;
        }

        return $user;
    }
}
