<?php
require_once('DataSource.php');
class TaskStatusDao extends DataSource {

    function __construct(){
        parent::__construct();
    }
    // Method to get all task statuses
    function getAllTaskStatuses() {
        $sql = "SELECT * FROM TaskStatuses";
        return $this->query($sql);
    }
}