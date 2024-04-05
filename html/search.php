


<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}


// Check if the user is logged in, if not redirect to login page
if (!isset($_SESSION['userID'])) {
    header("Location: login.php");
    exit;
}

include_once '../php/UsersDao.php';
include_once '../php/TaskDao.php';

$taskDao = new TaskDAO();
$userID = $_SESSION['userID']; // Use the userID from the session

// echo $userID;
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
      <a href="tasklist.html" class="top-left">Tasks</a>
    </div>

    <div class="top-nav-2">
      <!-- Button to open the modal -->
      <!--<button id="searchBtn" class="search-btn" class="top-right">Search</button>-->
      <a href="../html/search.php" class="top-right">Search</a>
      <a href="#add" class="top-right">Add</a>
    </div>

  <!-------------------------------search------------------------------- *>


<!-- The Modal -->


    <div class="formcontainer">
      <h1 class="form-search">Search Task</h1>
      <hr>
      <form id="myForm" action="searchResult.php" method="post">

        <div class="textfield">
          <label for="searchKeywords">Key Words:</label>
          <input type="text" id="searchKeywords" class="search-input" name="keywords"><br><br>
        </div>
        <div class="textfield">
          <label for="searchStatus">Status:</label>
          <select id="searchStatus" class="search-input" name="taskStatus">
            <option value="To Do">To Do</option>
            <option value="In Progress">In Progress</option>
            <option value="Completed">Completed</option>
          </select><br><br>
        </div>
        <div class="button-container"> 
          <button type="submit" class="search-submit" value="search">Submit</button>
          <button type="reset" class="search-reset">Reset</button>
        </div>
      </form>

    </div>
    <!-----------------------------search end------------------------------ >
  <?php

    // Check if the user is logged in, if not redirect to login page
    if (!isset($_SESSION['userID'])) {
        header("Location: login.php");
        exit;
    }

    // Include the TaskDao file
    include_once '../php/TaskDao.php';

    // Create a new TaskDao object
    $taskDao = new TaskDAO();

    // Get the userID from the session
    $userID = $_SESSION['userID'];

    // Initialize the tasks array
    $tasks = array();

    

    // display the search form
    include_once 'search.php';

    // save the search form data
    $keywords = $_POST['keywords'] ?? ''; 
    $taskStatus = $_POST['taskStatus'] ?? '';

    $taskDao = new TaskDAO();
    $tasks = $taskDao->searchTasks($keywords, $taskStatus, $userID);

    foreach ($tasks as $task) {
        echo '<div class="task">';
        echo '<h2>' . $task['Title'] . '</h2>';
        echo '<p>' . $task['Description'] . '</p>';
        echo '<p>' . $task['DueDate'] . '</p>';
        echo '<p>' . $task['Status'] . '</p>';
        echo '</div>';
    }
  ?>




    <script src="script.js"></script>
    
  </body>
</html>