<?php
// Start the session
session_start();

// Include your database connection file
require_once '../php/DataSource.php';
require_once '../php/UsersDao.php';

// Initialize variables to hold form values and potential error messages
$email = $username = $password = "";
$emailErr = $usernameErr = $passwordErr = $termsErr = "";

$usersDao = new UsersDao();

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $isValid = true;

    // Validate email
    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
        $isValid = false;
    } else {
        $email = test_input($_POST["email"]);
        // Check if email address is well-formed
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
            $isValid = false;
        }
    }

    // Validate username
    if (empty($_POST["login"])) {
        $usernameErr = "Username is required";
        $isValid = false;
    } else {
        $username = test_input($_POST["login"]);
        // Further username validation can be added here (e.g., length, allowed characters)
    }

    // Validate password
    if (empty($_POST["pass"])) {
        $passwordErr = "Password is required";
        $isValid = false;
    } else {
        $password = test_input($_POST["pass"]);
        // Check for password complexity, length, etc.
    }

    // Check "terms and conditions" checkbox
    if (!isset($_POST["terms"])) {
        $termsErr = "You must agree to the terms";
        $isValid = false;
    }

    // Proceed with registration if all inputs are valid
    if ($isValid) {
        $usersDao = new UsersDao();

        // Check if email or username already exists
        if ($usersDao->getUserInfoByEmail($email) || $usersDao->getUserInfo($username)) {
            // Handle error if user already exists
            // Redirect back to the registration form or display an error message
        } else {
          $result = $usersDao->addUser($username, $password, $email);

          if ($result) {
              // Registration successful
              // Redirect or inform the user of success
              echo "<script type='text/javascript'>
                    alert('Registration successful!');
                    window.location.href = '../html/firstPage.html';
                    </script>";
              exit;
          } else {
              // Handle insertion failure
              exit('Registration failed');
          }
        }     
    }
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

// Include your HTML form here or redirect the user as needed
?>
