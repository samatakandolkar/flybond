<?php

class Calls
{
    public $db;

    public function __construct() {  
    $this->db = new mysqli(HOST, USER, PASS, DBNAME);
      if(mysqli_connect_errno()) {
        echo "Error: Could not connect to database.";
     exit;
    }
        
    }  
    public function addCalls($postObject) {
        $query="INSERT INTO `customer_calls` (`callID`, `custID`, `userID`, `scheduleDate`, `notes`, `status`) VALUES (NULL, '".$postObject['custid']."', '".$_SESSION['id']."', '".$postObject['date']."', '".$postObject['note']."', '".$postObject['status']."');";
        $result = mysqli_query($this->db,$query) or die(mysqli_connect_errno()." - Data cannot inserted");
        return $result;
    }

    public function getCallListForCustomer ($custID){
        $result =  $this->db->query("Select * from `customer_calls` where custID =".$custID) ;
        return $result;
    }

    public function getCallDetailsbyID ($id) {
       $result =  $this->db->query("Select * from `customer_calls` where `callID`=".$id) ;
     return $result;

    }

    public function updateCallDetails ($postObject) {
  
        $query="Update `customer_calls` SET `userID` = '".$_SESSION['id']."', `scheduleDate`='".$postObject['date']."', `notes`= '".$postObject['note']."', `status`='".$postObject['status']."' where `callID` = '".$postObject['id']."' "; 
        $result = mysqli_query($this->db,$query) or die(mysqli_connect_errno()." - Data cannot updated");
        return $result;
    }

    public function getUpcomingCalls () {
        $today = date("Y-m-d");   
        $result =  $this->db->query("Select `call`.`scheduleDate`, `call`.`notes`, `call`.`status`, `cust`.`firstName`, `cust`.`lastName`, `cust`.`companyName` from `customer_calls` AS `call`, `customers` AS `cust` where  `call`.`custID` =`cust`.`cID` and `call`.status='Scheduled' and `call`.scheduleDate >=". $today) ;
        return $result;

    }
  
  
}
