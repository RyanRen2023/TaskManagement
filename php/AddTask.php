<?php
session_start();
require_once '../php/TaskDao.php';

// Check if the user is logged in
if (!isset($_SESSION['userID'])) {
    header("Location: login.php");
    exit;
}

$taskDao = new TaskDao();

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $dueDate = $_POST['dueDate'];
    $priority = $_POST['priority'];

    // Assume statusID and categoryID are predefined or derived from somewhere
    $statusID = $_POST['status']; // Example: 1 for "To Do"
    $categoryID = 1; // Example category
    $listID = 1;
    $userID = $assignedToUserID = $_SESSION['userID']; // Logged-in user's ID

    // Call the method to create a new task
    $result = $taskDao->createTask($title, $description, $dueDate, $priority, $statusID, $categoryID, $listID, $assignedToUserID, $userID);

    if ($result) {
        // Redirect back to task list with success message
        $_SESSION['success_message'] = 'Task added successfully!';
        header("Location: ../html/tasklist.php");
        exit;
    } else {
        // Handle failure (e.g., show an error message)
        echo "Failed to add the task.";
    }
}
?>
