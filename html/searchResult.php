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
$username = $_SESSION['username'];
$email = $_SESSION['email'];
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

  <div class="top-nav-2 ">
    <?php
        echo '<h1 id="username" class="welcome-h1">' . $username . '</h1>';
        echo '<h2 id="useremail" class="welcome-p">' . $email . '</h2>';
    ?>   
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
    $tasklist = ""; // Initialize an empty string to hold the task list HTML
  
    if ($tasks) {
      $tasklist .= "<ul class='task-ul'>"; // Start the task list unordered list
      foreach ($tasks as $task) {
        // Append each task as a list item to the task list
        $tasklist .= "<li class='task-li'>" . htmlspecialchars($task['Title']) . " -- " . htmlspecialchars($task['StatusName']) . "</li>";
        // Adjust field names according to your data structure
      }
      $tasklist .= "</ul>"; // Close the task list unordered list
    } else {
      // If no tasks found, display a message
      $tasklist .= "<p>No matching tasks found.</p>";
    }


  }


  ?>

  <!----------------- The Search Result End ---------------------->

  <div class="list">
    <?php
    echo $tasklist
      ?>



  </div>


  <script src="../js/script.js"></script>

</body>

</html>