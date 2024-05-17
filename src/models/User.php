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
       $sql = "
            SELECT users.*, 
                   categories.name as category_name, 
                   sizes.name as size_name, 
                   conditions.name as condition_name
            FROM users
            LEFT JOIN categories ON users.category_id = categories.id 
            LEFT JOIN sizes ON users.size_id = sizes.id 
            LEFT JOIN conditions ON users.condition_id = conditions.id
        ";
        $this->db->query($sql);
        return $this->db->resultSet();
    }
    

    public function getUsersAndSellerInfo(): array
    {
        $this->db->query("SELECT users.id, users.username, users.hashed_password, users.full_name, users.email, users.created_at, users.hasRequested, sellers.user_id as seller, admins.user_id as admin FROM users LEFT JOIN sellers ON users.id = sellers.user_id LEFT JOIN admins on users.id=admins.user_id");
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
    public function requestToBeSeller($id) : bool
    {
        $user_id = $id['id'];
        $this->db->query('UPDATE users set hasRequested = 1 where users.id = :user_id');
        $this->db->bind(':user_id', $user_id);

        return $this->db->execute();
    }

    public function promoteToAdmin($id) : bool
    {
        $user_id = $id['id'];
        $this->db->query('INSERT INTO admins(user_id) VALUES (:user_id)');
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

    public function changePreferences($category){

        $this->db->query('UPDATE users SET category_id = :category, size_id = :size, condition_id = :condition WHERE id = :user_id');
        $this->db->bind(':user_id', $category['user_id']);
        $this->db->bind(':category', $category['category']);
        $this->db->bind(':size', $category['size']);
        $this->db->bind(':condition', $category['condition']);

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
