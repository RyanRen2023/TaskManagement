<?php
require_once('DataSource.php');
class TaskCategory extends DataSource {
    // Method to get all task categories
    function getAllTaskCategories() {
        $sql = "SELECT * FROM TaskCategories";
        return $this->query($sql);
    }
}