<?php
require_once('DataSource.php');
class UsersDao extends DataSource {

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
    
    // Method to get user information by email
    function getUserInfoByEmail($email) {
        $sql = "SELECT * FROM Users WHERE Email = ?"; // Use a placeholder for the email
        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            // Handle error if statement couldn't be prepared
            die("Failed to prepare statement: " . $this->conn->error);
        }

        $stmt->bind_param("s", $email); // Bind the email parameter as a string
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        return ($result && $result->num_rows > 0) ? $result->fetch_assoc() : null;
    }

    

}

