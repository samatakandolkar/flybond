<?php  
   session_start();  
   include_once 'includes/database.php';  
   include_once 'classes/users.php'; 
   include_once 'classes/customer.php'; 

   $user = new User();   
   if (!$user->session())  
   {  
      header("location:index.php");  
   }  else {

    $uid = $_SESSION['id'];
    $mode = $_GET['mode'];
    $id = $_GET['id'] ?? '';
    $pageTitle = $errorMessage = $successMessage = '';
    $customer = new Customer();   
    if($mode == 'ADD') {
      $pageTitle = 'Add Customer Details';
      $firstName = '';
      $middleName = '';
      $lastName = '';
      $phoneNumber = '';
      $officeNumber = '';
      $companyName = '';
      $emails = '';
      $address = '';
      $address2 = '';
      $city = '';
      $state = '';
      $zipcode = '';
      $details = "";
      $rating = 1;
      $status = 1;
      $significance = 1;
      $custCatID = '';
      $custSubCatID = '';
      $contactPersonName = '';
      $contactPersonDesignation = '';
      $contactPersonPhoneNumber = '';
      $contactPersonEmail = '';

      $displaySubcategory = false;

    } else if(!empty($id) && $mode== 'EDIT') {
      $pageTitle = 'Edit Customer Details';
      $result = $customer->getCustomerbyID($id);
      $r = mysqli_fetch_assoc($result);
      $firstName = $r['firstName'];
      $middleName = $r['middleName'];
      $lastName = $r['lastName'];
      $phoneNumber = $r['phoneNumber'];
      $officeNumber = $r['officeNumber'];
      $companyName = $r['companyName'];
      $emails = $r['emails'];
      $address = $r['address'];
      $address2 = $r['address2'];
      $city = $r['city'];
      $state = $r['state'];
      $zipcode = $r['zipcode'];
      $details = $r['details'];
      $rating = $r['rating'];
      $status = $r['status'];
      $significance = $r['significance'];
      $custCatID =  $r['custCatID'];
      $custSubCatID =  $r['custSubCatID'];
      $contactPersonName =  $r['contactPersonName'];
      $contactPersonDesignation =  $r['contactPersonDesignation'];
      $contactPersonPhoneNumber =  $r['contactPersonPhoneNumber'];
      $contactPersonEmail =  $r['contactPersonEmail'];

      if($custSubCatID) {
        $displaySubcategory = true;
      }
    }
 }
?> 

<?php include('header.php'); ?>
<script>

$( document ).ready(function() {
$( "#submit-form" ).click(function(e) {
  e.preventDefault();
  var data = $('form').serialize();
      $.ajax({
        type: "POST",
        url: "customer-crud.php",
        data: data, // get all form field value in 
        dataType: 'text',
        success: function(res) {
          var resText = res.split("-");
          if(resText[0] == 1) {
            $('#alert-message').removeClass('d-none');
            $('#alert-message').addClass('alert-success');
            $('#alert-message').html(resText[1]);
            window.scrollTo(0, 0);
          } else {
            $('#alert-message').removeClass('d-none');
            $('#alert-message').addClass('alert-danger');
            $('#alert-message').html(resText[1]);
            window.scrollTo(0, 0);
          }
        },
        error: function (res) {
          $('#alert-message').removeClass('d-none');
          $('#alert-message').addClass('alert-danger');
          $('#alert-message').html('Something went Wrong!');
          window.scrollTo(0, 0);
        }
    });
  });
});

function onCategoryChange (selctedObject) {
    var category_id = selctedObject;
    $.ajax({
    url: "customer-crud.php",
    type: "POST",
    data: {
    mode: 'GET_CATEGORY',
    category_id: category_id,
    sub_category_id: <?php echo $custSubCatID;?>
    },
    cache: false,
    success: function(result) {
      if (!$.trim(result)){   
        $("#sub-category-dropdown").hide(); 
      } else {
        $("#sub-category-dropdown").show(); 
        $("#sub-category-dropdown-data").html(result);
      }
     
    }
    });
  }
  </script>
  <?php if($mode == 'EDIT' && $custCatID) { ?>
    <script>
    $('#category-dropdown').ready(function() {
      onCategoryChange(<?php echo $custCatID;?>);
   });
</script>
  <?php } ?>
<body>

<?php include('includes/navigation.php'); ?>
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h3><?php echo $pageTitle; ?></h3>
          </div>
          <div class="alert  d-none" role="alert" id="alert-message">
          </div>   
        <form name="customers">
          <input type="hidden" name="mode" value="<?php echo $mode; ?>" >
          <input type="hidden" name="id" value="<?php echo $id; ?>" >
          <div class="form-row">
            <div class="form-group col-md-4">
              <label for="firstName">First Name*</label>
              <input type="text" class="form-control" id="firstName" name="firstName"  value="<?php echo $firstName;?>" required>
            </div>
            <div class="form-group col-md-4">
              <label for="middleName">Middle Name</label>
              <input type="text" class="form-control" id="middleName" name="middleName" value="<?php echo $middleName;?>">
            </div>
            <div class="form-group col-md-4">
              <label for="lastName">Last Name*</label>
              <input type="text" class="form-control" id="lastName" name="lastName" required value="<?php echo $lastName;?>">
            </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="phoneNumber">Personal Phone Number*</label>
            <input type="text" class="form-control" id="phoneNumber" name="phoneNumber" value="<?php echo $phoneNumber;?>" required> 
          </div>
          <div class="form-group col-md-6">
            <label for="officeNumber">Office Phone Number</label>
            <input type="text" class="form-control" id="officeNumber"  name="officeNumber" value="<?php echo $officeNumber;?>">
          </div>
       </div>
       <div class="form-row">
          <div class="form-group col-md-6">
            <label for="companyName">Company Name*</label>
            <input type="text" class="form-control" id="companyName" name="companyName"  value="<?php echo $companyName;?>" required> 
          </div>
          <div class="form-group col-md-6">
            <label for="emails">Email </label>
            <input type="emails" class="form-control" id="emails"  name="emails"  value="<?php echo $emails;?>">
          </div>
       </div>
   <div class="form-row">
      <div class="form-group col-md-6">
        <label for="address">Address*</label>
        <input type="text" class="form-control" id="address" name="address" required value="<?php echo $address;?>">
      </div>
      <div class="form-group col-md-6" >
          <label for="address2">Address Line 2</label>
          <input type="text" class="form-control" id="address2" name="address2" value="<?php echo $address2;?>">
      </div>
    </div>
     <div class="form-row">
      <div class="form-group col-md-6">
        <label for="category-dropdown"> Category*</label>
        <select class="form-control" id="category-dropdown" name="custCatID" onchange="onCategoryChange(this.value)">
        <option value="">Select Category</option>
        <?php
            $result = $customer->getCustomerCatergories(0);
            while($row=mysqli_fetch_array($result))
              {
            ?>
            <option value="<?php echo $row['categoryID'];?>" <?php if($row['categoryID'] == $custCatID ) echo "Selected";?>><?php echo $row["Name"];?></option>
        <?php
              }
            ?>
            </select>
      </div>
      <div id="sub-category-dropdown" class="form-group col-md-6" style="display:none">
          <label for="sub-category-dropdown">Select Subcategory</label>
          <select class="form-control" id="sub-category-dropdown-data" name="custSubCatID" required>
          </select>
      </div>
    </div> 
    <div class="form-row">
        <div class="form-group col-md-4">
          <label for="city">City</label>
          <input type="text" class="form-control" id="city" name="city"  value="<?php echo $city;?>">
        </div>
        <div class="form-group col-md-4">
          <label for="state">State</label>
          <input type="text" class="form-control" id="state" name="state" value="<?php echo $state;?>">
        </div>
        <div class="form-group col-md-4">
          <label for="zipcode">zipcode</label>
          <input type="text" class="form-control" id="zipcode" name="zipcode" value="<?php echo $zipcode;?>">
        </div>
  </div>
  <div class="form-row">
  <div class="form-group col-md-4">
          <label for="state">Ratings</label>
          <select id="rating" name="rating" class="form-control">
                <option>Choose...</option>
                <option value="1" <?php if($rating == 1) echo 'Selected'; ?>>1</option>
                <option value="2" <?php if($rating == 2) echo 'Selected'; ?>>2</option>
                <option value="3" <?php if($rating == 3) echo 'Selected'; ?>>3</option>
                <option value="4" <?php if($rating == 4) echo 'Selected'; ?>>4</option>
                <option value="5" <?php if($rating == 5) echo 'Selected'; ?>>5</option>
              </select>
        </div>
  <div class="form-group col-md-4">
    <label>Status</label>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="status" id="statusActive" value="1" <?php if($status == 1) echo 'Checked'; ?>>
        <label class="form-check-label" for="statusActive">Active</label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="status" id="statusInactive" value="0"  <?php if($status == 0) echo 'Checked'; ?>>
        <label class="form-check-label" for="statusInactive">Inactive</label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="status" id="statusDormant" value="9"  <?php if($status == 9) echo 'Checked'; ?>>
        <label class="form-check-label" for="statusDormant">Dormant</label>
      </div>
  </div>   
  <div class="form-group col-md-4">
    <label >Significance </label>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="significance" id="significance1" value="1"  <?php if($significance == 1) echo 'Checked'; ?>>
        <label class="form-check-label" for="significance1">Responsive</label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="significance" id="significance2" value="0" <?php if($significance == 0) echo 'Checked'; ?>>
        <label class="form-check-label" for="significance2">Non-Responsive</label>
      </div>
  </div>
  </div>
  <div class="form-group">
    <label for="details">Details</label>
    <textarea class="form-control" id="details" name="details" rows="3" ><?php echo $details; ?></textarea>
  </div>
  <div>
</div>
<div><h4>Contact Person Details:<h4> </div>
<div class="form-row">
          <div class="form-group col-md-6">
            <label for="contactPersonName">Name*</label>
            <input type="text" class="form-control" id="contactPersonName" name="contactPersonName" value="<?php echo $contactPersonName;?>" required> 
          </div>
          <div class="form-group col-md-6">
            <label for="contactPersonDesignation">Designation</label>
            <input type="text" class="form-control" id="contactPersonDesignation"  name="contactPersonDesignation" value="<?php echo $contactPersonDesignation;?>">
          </div>
       </div>
       <div class="form-row">
          <div class="form-group col-md-6">
            <label for="contactPersonPhoneNumber">Phone Number</label>
            <input type="text" class="form-control" id="contactPersonPhoneNumber" name="contactPersonPhoneNumber"  value="<?php echo $contactPersonPhoneNumber;?>" required> 
          </div>
          <div class="form-group col-md-6">
            <label for="contactPersonEmail">Email </label>
            <input type="emails" class="form-control" id="contactPersonEmail"  name="contactPersonEmail"  value="<?php echo $contactPersonEmail;?>">
          </div>
       </div>
    
<button type="submit" class="btn-primary btn-lg" id="submit-form">Submit </button>
<button  type="button" class=" btn-secondary btn-lg" id="submit-form" onclick="history.back()"> Back </button>
</form>
          </div>
        </main>
      </div>
    </div>
</body>
</html>