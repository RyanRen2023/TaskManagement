<?php
session_start(); // Start the session to access the session variables

// Check if the user is logged in, if not redirect to login page
if (!isset($_SESSION['userID'])) {
    header("Location: login.php");
    exit;
}

include '../php/UsersDao.php';
include '../php/TaskDao.php';

$taskDao = new TaskDAO();
$userID = $_SESSION['userID']; // Use the userID from the session
$username = $_SESSION['username'];
$email = $_SESSION['email'];

echo '<div id="username">'.$username.'</div>';
echo '<div id="useremail">'.$email.'</div>';

// Fetch tasks by status for the logged-in user
$todoTasks = $taskDao->getTasksByStatusAndUser(1, $userID);
$doingTasks = $taskDao->getTasksByStatusAndUser(2, $userID);
$doneTasks = $taskDao->getTasksByStatusAndUser(3, $userID);

?>

<!DOCTYPE html>
<html lang="en">
    <!--
    File Name: registration.html
    Created Date: Mar 20 2024
    Brief Description: this page is the welcome page.
  -->
  <head>
    <meta charset="UTF-8">
    <meta name = "description" content = "this page is the welcome page.">
    <meta name = "keywords" content = "welcome">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/style.css">
    
    <title>Task Lists</title>
  </head>
  <body class="welcome">

    <div class="top-nav-1">
      <a href="firstPage.html" class="top-left">Home</a>
      <a href="tasklist.php" class="top-left">Tasks</a>
    </div>

    <div class="top-nav-2">
      <a href="#about" class="top-right">About Us</a>
      <a href="#contact" class="top-right">Contact Us</a>
    </div>

    <!-- add task section -->
    <button class="addtask-btn" onclick="document.getElementById('addTaskForm').style.display='block'">Add Task</button>

    <div id="addTaskForm" style="display:none;">
        <form action="../php/AddTask.php" method="post">
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" required><br>

            <label for="description">Description:</label>
            <textarea id="description" name="description" required></textarea><br>

            <label for="dueDate">Due Date:</label>
            <input type="date" id="dueDate" name="dueDate" required><br>

            <label for="priority">Priority:</label>
            <select id="priority" name="priority">
                <option value="Low">Low</option>
                <option value="Medium">Medium</option>
                <option value="High">High</option>
            </select><br>

            <label for="status">Status:</label>
            <select id="status" name="status">
                <option value="1">To Do</option>
                <option value="2">Doing</option>
                <option value="3">Done</option>
            </select><br>

            <input class="addtask-btn" type="submit" value="Add Task">
        </form>
    </div>

    <!-- render task list -->
    <div class="container-tasks">
      <div class="list" id="todo-list">
        <h2 class="tasklist-header">ToDo</h2>
        <ul class="task-ul">
          <?php foreach ($todoTasks as $task): ?>
            <li class="task-li"><?= htmlspecialchars($task['Title']) ?></li>
          <?php endforeach; ?>
        </ul>
      </div>
      <div class="list" id="doing-list">
        <h2 class="tasklist-header">Doing</h2>
        <ul class="task-ul">
          <?php foreach ($doingTasks as $task): ?>
            <li class="task-li"><?= htmlspecialchars($task['Title']) ?></li>
          <?php endforeach; ?>
        </ul>
      </div>
      <div class="list" id="done-list">
        <h2 class="tasklist-header">Done</h2>
        <ul class="task-ul">
          <?php foreach ($doneTasks as $task): ?>
            <li class="task-li"><?= htmlspecialchars($task['Title']) ?></li>
          <?php endforeach; ?>
        </ul>
      </div>
    </div>


    <script src="script.js"></script>
    
  </body>
</html>