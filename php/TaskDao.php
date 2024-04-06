<?php
require_once('DataSource.php');
class TaskDao extends DataSource
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

    function updateTaskStatus($taskID,$statusID)
    {
        $sql = "UPDATE Tasks SET StatusID=$statusID, UpdatedDate=NOW() WHERE TaskID=$taskID";
        return $this->query($sql);
    }

    // Method to delete a task from the database
    function deleteTask($taskID)
    {
        $sql = "DELETE FROM Tasks WHERE TaskID=$taskID";
        return $this->query($sql);
    }

    // In TaskDao.php or a similar file
    function getTasksByStatusAndUser($statusID, $userID) {
        $conn = $this->getConnection(); // Use the getConnection method to get the $conn object
        $stmt = $conn->prepare("SELECT * FROM Tasks WHERE StatusID=? AND AssignedToUserID=? ORDER BY DueDate ASC");
        $stmt->bind_param("ii", $statusID, $userID);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    function searchTasks(string $keywords, string $status, int $userID) {
        $conn = $this->getConnection();
        $stmt = $conn->prepare("SELECT t.Title, ts.StatusName
        FROM task_management_db.tasks AS t
        JOIN task_management_db.taskstatuses AS ts ON t.StatusID = ts.StatusID
        WHERE (t.Title LIKE ?
        OR ts.StatusName = ?)
        AND t.CreatedByUserID = ?;");
        // $stmt->execute(['keywords' => $keywords, 'taskStatus' => $status, 'userID' => $userID]);
        $kw = "%$keywords%";
        $stmt->bind_param("ssi", $kw, $status, $userID);
        $stmt->execute();
        $tasks = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $tasks;
    }
}

?>