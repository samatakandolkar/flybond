<?php 
session_start();  
include_once 'includes/database.php';  
 include_once 'classes/task.php'; 
 $task = new Task(); 
  //if($_POST['mode'] == 'ADD') {
    $result = $customer->addTask($_POST);
    if($result) {
      echo '1-Customer added successfully!';
    } else {
      echo '0-Error while adding!';
    }
  // } else if($_POST['mode'] == 'EDIT') {

  //   $result = $customer->updateCustomer($_POST);
  //   if($result) {
  //     echo '1 - Customer details updated successfully!';
  //   } else {
  //     echo '0 - Error while adding!';
      
  //   }

  // }
?>