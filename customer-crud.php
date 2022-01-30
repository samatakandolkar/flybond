<?php 
session_start();  
include_once 'includes/database.php';  
 include_once 'classes/customer.php'; 
 $customer = new Customer(); 
  if($_POST['mode'] == 'ADD') {
    $result = $customer->addCustomer($_POST);
    if($result) {
      echo '1-Customer added successfully!';
    } else {
      echo '0-Error while adding!';
    }
  } else if($_POST['mode'] == 'EDIT') {

    $result = $customer->updateCustomer($_POST);
    if($result) {
      echo '1-Customer details updated successfully!';
    } else {
      echo '0-Error while adding!';
      
    }
  } else if($_POST['mode'] == 'GET_CATEGORY') {
    $subCatID = $_POST['sub_category_id'];
    $result = $customer->getCustomerCatergories($_POST['category_id']);
    $rowcount=mysqli_num_rows($result);
    if($rowcount) {
?>
    <option> Select Sub Category </option>
<?php
      while($row = mysqli_fetch_array($result)) {
      ?>
      <option value="<?php echo $row["categoryID"];?>" <?php if($row['categoryID'] == $subCatID ) echo "Selected";?> ><?php echo $row["Name"];?></option>
      <?php
      }
      
    } else {
      $result = '';
    }
  }

?>