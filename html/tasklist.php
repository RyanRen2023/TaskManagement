<?php
session_start(); // Start the session to access the session variables

// Check if the user is logged in, if not redirect to login page
if (!isset($_SESSION['userID'])) {
  header("Location: ../php/login.php");
  exit;
}

include '../php/UsersDao.php';
include '../php/TaskDao.php';
include '../php/taskAction.php';

$taskDao = new TaskDAO();
$userID = $_SESSION['userID']; // Use the userID from the session

echo $userID;
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
  <meta name="description" content="this page is the welcome page.">
  <meta name="keywords" content="welcome">
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
    <!-- Button to open the modal -->
    <!--<button id="searchBtn" class="search-btn" class="top-right">Search</button>-->
    <a href="../html/search.php" class="top-right">Search</a>
    <a href="#add" class="top-right">Add</a>
  </div>



  <div class="container-tasks">
    <div class="list" id="todo-list">
      <h2 class="tasklist-header">ToDo</h2>
      <ul class="task-ul">
        <?php foreach ($todoTasks as $task):
          echo '<li class="task-li" id=' . $task['TaskID'] . '>' . htmlspecialchars($task['Title']) . '</li>';
        endforeach;
        ?>
      </ul>
    </div>
    <div class="list" id="doing-list">
      <h2 class="tasklist-header">Doing</h2>
      <ul class="task-ul">
        <?php foreach ($doingTasks as $task):
          echo '<li class="task-li" id=' . $task['TaskID'] . '>' . htmlspecialchars($task['Title']) . '</li>';
        endforeach;
        ?>

      </ul>
    </div>
    <div class="list" id="done-list">
      <h2 class="tasklist-header">Done</h2>
      <ul class="task-ul">
        <?php foreach ($doneTasks as $task):
          echo '<li class="task-li" id=' . $task['TaskID'] . '>' . htmlspecialchars($task['Title']) . '</li>';
        endforeach;
        ?>

      </ul>
    </div>
  </div>

   <!-- Button container -->
   <div class="button-container" id="buttonContainer">
    <button class="edit-button">Edit</button>
    <button class="delete-button">Delete</button>
  </div>

  <!-- Edit task status -->
  <div class="modal edit-task-status" id="edit-task-status">
    <section class="modal-content task-status-content">
      <h2 id="task-title">Task Title</h2>
      <div>
        <input type="hidden" name="taskid" id="taskId" value="">
        <input type="hidden" name="default-status" id="default-status" value="">

        <ul class="task-stauts-list">
          <li>
            <input type="radio" name="status" id="status1" value="1">
            <label for="status1">To Do</label>
          </li>
          <li>
            <input type="radio" name="status" id="status2" value="2">
            <label for="status2">In Progress</label>
          </li>
          <li>
            <input type="radio" name="status" id="status3" value="3">
            <label for="status3">Completed</label>
          </li>
        </ul>
        <button type="button" onclick="updateStatusEvent()" class="edit-button">Confirm</button>&nbsp;
        <button type="button" onclick="closeEditModal()" class="delete-button">Close</button>
      </div>
    </section>
  </div>

   <!-- delete task by ID -->
   <div class="modal delete-task" id="delete-task">
    <section class="modal-content task-status-content">
      <h2 id="task-title">Delete Task</h2>
      <p> Are you sure to delete Task: Task 1?</p>
      <div>
        <button type="button" onclick="confirmDelete()" class="edit-button">Confirm</button>&nbsp;
        <button type="button" onclick="closeDeleteModal()" class="delete-button">Cancel</button>
      </div>
    </section>
  </div>
  <script src="../js/dataScript.js" defer></script>
  <script src="../js/script.js" defer></script>

</body>

</html>