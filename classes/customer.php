<?php

class Customer
{
    public $db;

    public function __construct() {  
    $this->db = new mysqli(HOST, USER, PASS, DBNAME);
      if(mysqli_connect_errno()) {
        echo "Error: Could not connect to database.";
     exit;
    }
        
    }  
    public function addCustomer ($postObject) {
        $createdAt = date("Y-m-d H:i:s");  
        $query="INSERT INTO `customers` (`cID`,`custCatID`, `custSubCatID`,  `firstName`, `middleName`, `lastName`, `phoneNumber`, `officeNumber`, `emails`, `companyName`, `address`, `address2`, `city`, `state`, `zipcode`, `details`, `rating`, `significance`,`contactPersonName`, `contactPersonDesignation`, `contactPersonPhoneNumber`, `contactPersonEmail`, `status`, `deleted`, `createdAt`) VALUES (NULL,'".$postObject['custCatID']."', '".$postObject['custSubCatID']."', '".$postObject['firstName']."', '".$postObject['middleName']."', '".$postObject['lastName']."', '".$postObject['phoneNumber']."', '".$postObject['officeNumber']."', '".$postObject['emails']."', '".$postObject['companyName']."', '".$postObject['address']."', '".$postObject['address2']."', '".$postObject['city']."', '".$postObject['state']."', '".$postObject['zipcode']."', '".$postObject['details']."', '".$postObject['rating']."',' ".$postObject['significance']."',' ".$postObject['status']."', ' ".$postObject['contactPersonName']."', ' ".$postObject['contactPersonDesignation']."',' ".$postObject['contactPersonPhoneNumber']."', ' ".$postObject['contactPersonEmail']."', '0', '".$createdAt."');";

        $result = mysqli_query($this->db,$query) or die(mysqli_connect_errno()."0 - Data cannot be inserted");
        return $result;
    }

    public function getNonDormantCustermerList () {
        $result =  $this->db->query("Select * from `customers` where `status` != '9' ") ;
        return $result;
    }

    public function getCustomerbyID ($id) { 
        $result =  $this->db->query("Select * from `customers` where `cID`=".$id) ;
        return $result;
    }
    
    public function updateCustomer ($postObject) {
        $custSubID = $postObject['custSubCatID'] ?? 0;

        $query="Update `customers` SET `firstName` = '".$postObject['firstName']."', `middleName`='".$postObject['middleName']."', `lastName`= '".$postObject['lastName']."', `phoneNumber`='".$postObject['phoneNumber']."', `officeNumber`= '".$postObject['officeNumber']."', `emails`= '".$postObject['emails']."', `companyName`= '".$postObject['companyName']."', `address`='".$postObject['address']."', `address2`='".$postObject['address2']."', `city`='".$postObject['city']."', `state`='".$postObject['state']."', `zipcode`='".$postObject['zipcode']."', `details`= '".$postObject['details']."', `rating`= '".$postObject['rating']."', `significance`='".$postObject['significance']."', `status`='".$postObject['status']."', `custCatID`='".$postObject['custCatID']."', `custSubCatID`='".$custSubID."',  `contactPersonName`='".$postObject['contactPersonName']."' ,  `contactPersonDesignation`='".$postObject['contactPersonDesignation']."',  `contactPersonPhoneNumber`='".$postObject['contactPersonPhoneNumber']."',  `contactPersonEmail`='".$postObject['contactPersonEmail']."'  where `cID` = '".$postObject['id']."' "; 
        $result = mysqli_query($this->db,$query) or die(mysqli_connect_errno()."0 - Data cannot updated");
        return $result;
    }

    public function deleteCustomer ($id) {
        $query="Update `customers` SET `deleted`= '0' where `cID`=".$id;
        $result = mysqli_query($this->db,$query) or die(mysqli_connect_errno()."0 - Data cannot Deleted");
        return $result;
    }

    public function getCustomerCatergories ($parentId) {
      
        $result =  $this->db->query("Select * from `customer_category` where `Status`='1' and `catParentID`=".$parentId) 
        or die(mysqli_connect_errno());
        
        return $result;

    }

}
