<?php
require_once('DataSource.php');
class Users extends DataSource {

    function __construct(){
        parent::__construct();
    }
    // Method to add a new user to the database
    function addUser($username, $password, $email) {
        $sql = "INSERT INTO Users (Username, Password, Email, CreatedDate, UpdatedDate) VALUES ('$username', '$password', '$email', NOW(), NOW())";
        return $this->query($sql);
    }

    // Method to get user information
    function getUserInfo($username) {
        $sql = "SELECT * FROM Users WHERE Username='$username'";
        $result = $this->query($sql);
        return ($result && $result->num_rows > 0) ? $result->fetch_assoc() : null;
    }

    // Method to get user information
    function getAllUsers() {
        $sql = "SELECT * FROM Users";
        $result = $this->query($sql);
        return $result;
    }

    // Method to delete a user from the database
    function deleteUser($username) {
        $sql = "DELETE FROM Users WHERE Username='$username'";
        return $this->query($sql);
    }
}

