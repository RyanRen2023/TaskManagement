<?php
// Start the session at the very beginning
session_start();

// Initialize an error message variable
$error = '';

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize the form data

    $email = isset($_POST['email']) ? filter_var($_POST['email'], FILTER_SANITIZE_EMAIL) : '';
    $password = isset($_POST['pass']) ? $_POST['pass'] : '';

    // Validate the email
    if (empty($email)) {
        $error = 'Email address is required.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Invalid email format.';
    }

    // Validate the password
    if (empty($password)) {
        $error = 'Password is required.';
    } elseif (strlen($password) < 6) {
        $error = 'Password must be at least 4 characters long.';
    }

    // If there are no errors so far, proceed to authenticate
    if (empty($error)) {
        // Include your user DAO class for database operations
        require_once '../php/UsersDao.php'; // adjust the path as needed
        $usersDao = new UsersDao();
        $userInfo = $usersDao->getUserInfoByEmail($email); // Assume getUserInfo() method exists and returns false if user not found

        // Check if user exists and password is correct
        if ($userInfo && $password == $userInfo['Password']) {
            // Authentication successful
            $_SESSION['userID'] = $userInfo['UserID'];
            $_SESSION['username'] = $userInfo['Username'];
            $_SESSION['email'] = $userInfo['Email'];

            // Redirect the user to the task list page
            header("Location: ../html/tasklist.php");
            exit();
        } else {
            // Authentication failed
            $error = "Invalid email or password.";
        }
    }
}

if (!empty($error)) {
    // Redirect back to login with an error message
    // Here, you should implement a way to display the error message on the login page
    header("Location: login.php?error=" . urlencode($error));
    exit();
}
?>
