<?php 
session_start();  
include_once 'includes/database.php';  
 include_once 'classes/calls.php'; 
 $calls = new Calls(); 
  if($_POST['mode'] == 'ADD') {
    $result = $calls->addCalls($_POST);
    if($result) {
      echo '1 - Details addedd successfully!';
    } else {
      echo '0 - Error while adding!';
    }
  } else if($_POST['mode'] == 'EDIT') {

    $result = $calls->updateCallDetails($_POST);
    if($result) {
      echo '1 -  Details updated successfully!';
    } else {
      echo '0 - Error while adding!';
      
    }

  }
?>