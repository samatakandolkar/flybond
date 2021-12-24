<?php

class Task
{
    public $db;

    public function __construct() {  
    $this->db = new mysqli(HOST, USER, PASS, DBNAME);
      if(mysqli_connect_errno()) {
        echo "Error: Could not connect to database.";
     exit;
    }
        
    } 
    public function addTask ($postObject) {
        $createdAt = date("Y-m-d H:i:s");  
        $query="INSERT INTO `task` (`created_by`, `task_details`, `assigned_to`, `estimated_time`) VALUES (NULL, '".$postObject['createdBy']."', '".$postObject['taskDetails']."', '".$postObject['assignedTo']."', '".$postObject['estimatedTime']."');";
        $result = mysqli_query($this->db,$query) or die(mysqli_connect_errno()."Data cannot inserted");
        return $result;
    }
}

?>