<?php  
   session_start();  
   include_once 'includes/database.php';  
   include_once 'classes/users.php'; 
   include_once 'classes/customer.php'; 
   include_once 'classes/calls.php'; 
   $user = new User(); 
    $calls = new Calls (); 
    $customer = new Customer(); 

   if (!$user->session())  
   {  
      header("location:index.php");  
   }  else {

    $uid = $_SESSION['id'];
    $mode = $_GET['mode'];
    $id = $_GET['id'] ?? '';
    $custid = $_GET['custid'] ?? '';
    
    $result = $customer->getCustomerbyID($custid);
    $r = mysqli_fetch_assoc($result);
    $custName = $r['firstName'] . ' '. $r['middleName']. ' '.$r['lastName'];

        
    if($mode == 'ADD') {
      $date = '';
      $note = '';
      $status = 'Scheduled';

    } else if(!empty($id) && $mode== 'EDIT') {
      $result = $calls->getCallDetailsbyID($id);
      $r = mysqli_fetch_assoc($result);
      $date = $r['scheduleDate'];
      $note = $r['notes'];
      $status = $r['status'];
    }
   
    }
?> 

<?php include('header.php'); ?>
<script>
$( document ).ready(function() {
$( "#submit-form" ).click(function(e) {
  e.preventDefault();
  var data = $('form').serialize();
  alert(data)
      $.ajax({
        type: "POST",
        url: "calls-crud.php",
        data: data, // get all form field value in 
        dataType: 'text',
        success: function(res) {
          var resText = res.split("-");
          alert(resText[1])
          if(resText[0] == 1) {
          $('#alert-message').removeClass('d-none');
          $('#alert-message').addClass('alert-success');
          $('#alert-message').html(resText[1]);
          } else {
            $('#alert-message').removeClass('d-none');
          $('#alert-message').addClass('alert-danger');
          $('#alert-message').html(resText[1]);
          }
      
        },
        error: function (res) {
          $('#alert-message').removeClass('d-none');
          $('#alert-message').addClass('alert-danger');
          $('#alert-message').html('Something went Wrong!');
        }
    });
  
});
});
  </script>

<body>

<?php include('includes/navigation.php'); ?>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h3>Call Schedule</h3>
          </div>
          <div class="alert d-none" role="alert" id="alert-message">
          </div>   
        <form>
          <input type="hidden" name="mode" value="<?php echo $mode; ?>" >
          <input type="hidden" name="id" value="<?php echo $id; ?>" >
          <input type="hidden" name="custid" value="<?php echo $custid; ?>" >
  
          <label>Schedule call for : <b><?php echo strtoupper($custName);?> </b> </label>
          <div class="form-group row">
          <label for="inputDate" class="col-sm-2 col-form-label">Date</label>
          <div class="col-sm-6">
            <input type="date" class="form-control" id="date" name="date" min="<?php echo date("Y-m-d"); ?>" required value=<?php echo $date;?>>
          </div>
        </div>
        <div class="form-group row">
          <label for="inputNote" class="col-sm-2 col-form-label">Notes</label>
          <div class="col-sm-6">
            <textarea class="w-100" name="note" id="note" required><?php echo $note;?></textarea>
          </div>
        </div>
        <div class="form-group row">
          <label for="inputstatus" class="col-sm-2 col-form-label">Status</label>
          <div class="col-sm-6">
            <select id="inputstatus" class="form-control" name="status">
              <option value="Scheduled"<?php if($status == "Scheduled") echo 'Selected'; ?>>Scheduled</option>
              <option value="Completed" <?php if($status == "Completed") echo 'Selected'; ?>>Completed</option>
            </select>
          </div>
        </div>

      
    <button type="submit" class="btn-primary btn-lg" id="submit-form">Submit </button>
    <button  type="button" class=" btn-secondary btn-lg" id="submit-form" onclick="history.back()"> Back </button>
</form></div>
          </div>
        </main>
      </div>
    </div>
</body>
</html>