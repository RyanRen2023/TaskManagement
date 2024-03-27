<?php
require_once('DataSource.php');
class TaskStatus extends DataSource {
    // Method to get all task statuses
    function getAllTaskStatuses() {
        $sql = "SELECT * FROM TaskStatuses";
        return $this->query($sql);
    }
}