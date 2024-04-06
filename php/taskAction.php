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

function updateTaskById($taskID, $statusID){
    global $taskDao;
    $task = $taskDao->updateTaskStatus($taskID, $statusID);
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
        $taskID = $_POST["taskId"];
        $statusID = $_POST["StatusID"];
        echo updateTaskById($taskID, $statusID);
    }else if ($func == "deleteTaskById") {
        $taskID = $_POST["taskId"];
        echo deleteTaskById($taskID);
    }
}

