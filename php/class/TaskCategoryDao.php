<?php
require_once('DataSource.php');
class TaskCategory extends DataSource {

    function __construct(){
        parent::__construct();
    }
    // Method to get all task categories
    function getAllTaskCategories() {
        $sql = "SELECT * FROM TaskCategories";
        return $this->query($sql);
    }
}