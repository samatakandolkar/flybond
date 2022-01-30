<?php  
   session_start();  
   include_once 'includes/database.php';  
   include_once 'classes/users.php'; 
   include_once 'classes/customer.php'; 
   include_once 'classes/calls.php'; 

   $user = new User();   
   if (!$user->session())  
   {  
      header("location:index.php");  
   }  else {
    $uid = $_SESSION['id'];
    
    $customer = new Customer(); 
    $custid = $_GET['custid'] ?? '';
    $result = $customer->getCustomerbyID($custid);
    $r = mysqli_fetch_assoc($result);
    $custName = $r['firstName'] . ' '. $r['middleName']. ' '.$r['lastName'];
    $companyName = $r['companyName'];
    $contactPersonName =  $r['contactPersonName'];
    $contactPersonDesignation =  $r['contactPersonDesignation'];
    $contactPersonPhoneNumber =  $r['contactPersonPhoneNumber'];
    $contactPersonEmail =  $r['contactPersonEmail'];
    
   }
?> 
<?php include('header.php'); ?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" class="init">
$(document).ready(function() {
	$('#call-list').DataTable({
    columnDefs: [ { type: 'date', 'targets': [1] } ],
    order: [[ 1, 'desc' ]]
  });
} );
</script>
<body>

<?php include('includes/navigation.php'); ?>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4 customer-list">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h3>Call List</h3>
            <button type="button" class="btn btn-secondary mb-2 float-right"  title="Schedule Call" onclick="location.href='schedule-call.php?mode=ADD&custid=<?php echo $custid; ?>'">+</button>
         
          </div>
          <div class="card">
            <div class="card-header font-weight-bold">
             Customer Details
            </div>
            <div class="card-body">
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="firstName">Customer Name: </label> <?php echo $custName;?>
              </div>
              <div class="form-group col-md-6">
                <label for="middleName">Company Name:</label> <?php echo $companyName;?>
               
              </div>
            </div>
            </div>
          </div>

          <div class="card">
            <div class="card-header font-weight-bold">
              Contact Person Details
            </div>
            <div class="card-body">
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="firstName">Name: </label> <?php echo $contactPersonName;?>
              </div>
              <div class="form-group col-md-6">
                <label for="middleName">Designation:</label> <?php echo $contactPersonDesignation;?>
               
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="firstName">Phone Number:</label> <?php echo $contactPersonPhoneNumber;?>
                
              </div>
              <div class="form-group col-md-6">
                <label for="middleName">Email:</label> <?php echo $contactPersonEmail;?>
                
              </div>
            </div>

            </div>
          </div>

          <div class="table-responsive pt-2">
            <table class="table" id="call-list">
              <thead class="thead-dark">
                <tr>
                  <!-- <th>#</th> -->
                  <th>Date</th>
                  <th>Notes</th>
                  <th>Status</th>
                  <th>Significance</th>
                  <th>Handle</th>
                </tr>
              </thead>
              <tbody>
              <?php
              $calls = new Calls (); 
              $result = $calls->getCallListForCustomer($custid);
              
              $cnt=1;
              while($row=mysqli_fetch_array($result))
              {
               $sign = '-'
                if ($row['significance'] == '1') {
                  $sign = 'Significant';
                } else if ($row['significance'] == '0') {
                  $sign = 'Insignificant';
                }
                 
            ?>
            <tr>
              <!-- <td scope="row"><?php echo $cnt; ?></td> -->
              <td><?php echo $row['scheduleDate']; ?></td>
              <td><?php echo $row['notes'] ; ?></td>
              <td><?php echo $row['status']; ?></td>
              <td><?php echo $sign; ?></td>
              <td>
                <?php if($row['status'] != 'Completed')  { ?>
                   <a href="schedule-call.php?mode=EDIT&custid=<?php echo $custid; ?>&id=<?php echo $row['callID']; ?>" >
                   <i class="fa fa-pencil" data-toggle="tooltip" data-placement="bottom" title="Edit"></i> </a> 
                <?php } ?>
              </td>
            </tr>
            <?php
            $cnt++;
          }
          ?>
                
              </tbody>
            </table>
          </div>
        </main>
      </div>
    </div>
</body>
</html>
