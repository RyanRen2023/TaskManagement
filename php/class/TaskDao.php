<?php
require_once('DataSource.php');
class Task extends DataSource
{
    function __construct(){
        parent::__construct();
    }
    // Method to create a new task
    function createTask($title, $description, $dueDate, $priority, $statusID, $categoryID, $listID, $assignedToUserID, $createdByUserID)
    {
        $sql = "INSERT INTO Tasks (Title, Description, DueDate, Priority, StatusID, CategoryID, ListID, AssignedToUserID, CreatedByUserID, CreatedDate, UpdatedDate) VALUES ('$title', '$description', '$dueDate', '$priority', $statusID, $categoryID, $listID, $assignedToUserID, $createdByUserID, NOW(), NOW())";
        return $this->query($sql);
    }

    // Method to get details of a task
    function getTaskDetails($taskID)
    {
        $sql = "SELECT * FROM Tasks WHERE TaskID=$taskID";
        $result = $this->query($sql);
        return ($result && $result->num_rows > 0) ? $result->fetch_assoc() : null;
    }

    // Method to update a task
    function updateTask($taskID, $title, $description, $dueDate, $priority, $statusID, $categoryID, $assignedToUserID)
    {
        $sql = "UPDATE Tasks SET Title='$title', Description='$description', DueDate='$dueDate', Priority='$priority', StatusID=$statusID, CategoryID=$categoryID, AssignedToUserID=$assignedToUserID, UpdatedDate=NOW() WHERE TaskID=$taskID";
        return $this->query($sql);
    }

    // Method to delete a task from the database
    function deleteTask($taskID)
    {
        $sql = "DELETE FROM Tasks WHERE TaskID=$taskID";
        return $this->query($sql);
    }
}

?>