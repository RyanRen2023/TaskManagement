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
$username = $_SESSION['username'];
$email = $_SESSION['email'];




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

  <!-- <div class="top-nav-2">
    <!-- Button to open the modal -->
  <!--<button id="searchBtn" class="search-btn" class="top-right">Search</button>-->
  <!-- <a href="../html/search.php" class="top-right">Search</a>
    <a href="#add" class="top-right">Add</a> -->
  <!-- </div> -->

  <div class="top-nav-2 ">
    <?php
    echo '<h1 id="username" class="welcome-h1">' . $username . '</h1>';
    echo '<h2 id="useremail" class="welcome-p">' . $email . '</h2>';
    ?>
  </div>

  <!-- add task section -->
  <div class="button-container">
    <button class="addtask-btn" id="addTaskButton">Add Task</button>
    <button class="addtask-btn" id="searchButton" onclick="goToSearch()">Search</button>
  </div>




  <!-- render task list -->


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
  <div class="task-button-container" id="buttonContainer">
    <button class="edit-button">Edit</button>
    <button class="delete-button">Delete</button>
  </div>

  <!-- Edit task status develop by Xihai Ren-->
  <div class="modal" id="edit-task-status">
    <section class="modal-content">
      <h2 id="task-title">Edit Task</h2>
      <div class="taskForm">
        <form action="" id="editTaskForm">
          <label for="taskId">taskId:</label>
          <input type="text" name="taskId" id="taskId" value="" readonly><br>

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
          <button type="button" onclick="updateTaskFormSubmit()" class="submit">Update</button>&nbsp;
          <button type="button" onclick="closeEditModal()" class="reset">Close</button>

          <input type="hidden" name="userId" value="<?php echo $userID?>">
        </form>
      </div>
    </section>
  </div>

  <!-- delete task by ID -->
  <div class="modal" id="delete-task">
    <section class="modal-content task-status-content">
      <h2 id="task-title">Delete Task</h2>
      <p id="delete-confirm-message"> Are you sure to delete Task: Task 1?</p>
      <div>
        <input type="hidden" id="deleteTaskId" value="">
        <button type="button" onclick="confirmDelete()" class="edit-button">Confirm</button>&nbsp;
        <button type="button" onclick="closeDeleteModal()" class="delete-button">Cancel</button>
      </div>
    </section>
  </div>

  <!-- Add task form develop by Elton-->
  <div class="modal" id="add-task">
    <section class="modal-content addTaskForm-content">
      <h2 id="task-title">Add Task</h2>
      <div id="addTaskForm" class=".taskForm">
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
          <input class="reset-btn" type="reset" id="cancelButton" value="Cancel">
        </form>
      </div>
    </section>
  </div>
  <script src="../js/dataScript.js" defer></script>
  <script src="../js/script.js" defer></script>

</body>

</html>