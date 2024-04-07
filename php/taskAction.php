<?php
// session_start(); // Start the session to access the session variables

// // Check if the user is logged in, if not redirect to login page
// if (!isset($_SESSION['userID'])) {
//     header("Location: login.php");
//     exit;
// }
require_once ('TaskDao.php');

$taskDao = new TaskDao();

function getTaskById($taskID)
{
    global $taskDao;
    $task = $taskDao->getTaskDetails($taskID);    
    return json_encode($task);
}

function updateTaskById($taskID, $title, $description, $dueDate, $priority, $statusID,$userID){
    global $taskDao;
    $task = $taskDao->updateTask($taskID, $title, $description, $dueDate, $priority, $statusID, 1, $userID);
    return $task;
}

function deleteTaskById($taskID){
    global $taskDao;
    $task = $taskDao->updateTaskStatus($taskID, 4);
    return $task;
}


// echo "task aciton get your request!" .$_SERVER['REQUEST_METHOD'] . var_dump($_POST) . var_dump($_GET) . var_dump($_REQUEST);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $func = $_POST["func"];
    // echo '\n$_POST["func"]==>'. $func;
    if ($func == "getTaskById") {
        $taskID = $_POST["taskId"];
        echo getTaskById($taskID);
    }else if ($func == "updateTaskById") {
        echo var_dump($_POST);
        $taskID = $_POST["taskId"];
        $title = $_POST["title"];
        $description = $_POST["description"];
        $dueDate = $_POST["dueDate"];
        $priority = $_POST["priority"];
        $status = $_POST["status"];
        $userId = $_POST["userId"];

        echo updateTaskById($taskID, $title, $description, $dueDate, $priority, $status,$userId);
    }else if ($func == "deleteTaskById") {
        $taskID = $_POST["taskId"];
        echo deleteTaskById($taskID);
    }
}

