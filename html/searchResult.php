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

  <!----------------- The Search Result ---------------------->

  <?php
    // Check if data has been submitted via the POST method
if (isset($_POST['keywords']) && isset($_POST['taskStatus'])) {
  // Retrieve data from the POST request
  $keywords = $_POST['keywords'] ?? ''; 
  $status = $_POST['taskStatus'] ?? '';

  $taskDao = new TaskDAO();
  $tasks = $taskDao->searchTasks($keywords, $status, $userID);

  // Process data, for example: perform a database query
  // The actual database query logic is omitted here
  // $results = searchTasks($keywords, $status);

  // foreach ($tasks as $task) {
  //   echo "<p>Task Title: " . htmlspecialchars($task['Title']) . "</p>";
  //   echo "<p>Task Status: " . htmlspecialchars($task['StatusName']) . "</p>";
  //   // Adjust field names according to your data structure
  // }

  // Display the results
  if ($tasks) {
      foreach ($tasks as $task) {
          echo "<p class='sr'>Task Title: " . htmlspecialchars($task['Title']) . "</p>";
          echo "<p class='sr'>Task Status: " . htmlspecialchars($task['StatusName']) . "</p>";
          // Adjust field names according to your data structure
      }
  } else {
      echo "<p>No matching tasks found.</p>";
  }

}


    ?>

  <!----------------- The Search Result End ---------------------->




    <script src="../js/script.js"></script>
    
  </body>
</html>