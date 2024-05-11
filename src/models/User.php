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
        $this->db->query("SELECT * FROM users ");
        return $this->db->resultSet();
    }

    public function getUsersAndSellerInfo(): array
    {
        $this->db->query("SELECT * FROM users LEFT JOIN sellers ON users.id = sellers.user_id");
        return $this->db->resultSet();
    }

    public function getSellers(): array
    {
        $this->db->query("SELECT * FROM users JOIN sellers ON users.id = sellers.user_id");
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

    public function promoteToSeller($id) : bool
    {
        $user_id = $id['id'];
        $this->db->query('INSERT INTO sellers(user_id) VALUES (:user_id)');
        $this->db->bind(':user_id', $user_id);

        return $this->db->execute();
    }

    public function getSellerItems($user_id)
    {
        $this->db->query('SELECT * from items join sellers on sellers.user_id = items.seller_id JOIN images ON items.id = images.item_id where sellers.user_id = :user_id');
        $this->db->bind(':user_id', $user_id);
        return $this->db->resultSet();
    }

    public function changeEmail($email){

            $this->db->query('UPDATE users SET email = :email WHERE id = :user_id');
            $this->db->bind(':user_id', $email['user_id']);
            $this->db->bind(':email', $email['email']);

            return $this->db->execute();

    }

    public function changeUsername($change){

        $this->db->query('UPDATE users SET username = :username WHERE id = :user_id');
        $this->db->bind(':user_id', $change['user_id']);
        $this->db->bind(':username', $change['username']);

        return $this->db->execute();

    }

    public function changeFullname($change){

        $this->db->query('UPDATE users SET full_name = :fullname WHERE id = :user_id');
        $this->db->bind(':user_id', $change['user_id']);
        $this->db->bind(':fullname', $change['fullname']);

        return $this->db->execute();

    }

    public function changePassword($change){

        $this->db->query('UPDATE users SET hashed_password = :hashed_password WHERE id = :user_id');
        $this->db->bind(':user_id', $change['user_id']);
        $this->db->bind(':hashed_password', $change['hashed_password']);

        return $this->db->execute();

    }
}
