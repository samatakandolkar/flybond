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
   }

?> 
<?php include('header.php'); ?>

<body>

<?php include('includes/navigation.php'); ?>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4 customer-list">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1>Call List</h1>
          
          </div>
          <div class="mb-2 clearfix">
            <h3 class="float-left">Customer: <b><?php echo $custName;?> </b> 
            <br/>
           Company Name: <b><?php echo $companyName;?> </b> </h3>
            <button type="button" class="btn btn-secondary mb-2 float-right" onclick="location.href='schedule-call.php?mode=ADD&custid=<?php echo $custid; ?>'">+</button>
          </div>
          <div class="table-responsive">
            <table class="table ">
              <thead class="thead-dark">
                <tr>
                  <th>#</th>
                  <th>Date</th>
                  <th>Notes</th>
                  <th>Status</th>
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
            ?>
            <tr>
              <td scope="row"><?php echo $cnt; ?></td>
              <td><?php echo $row['scheduleDate']; ?></td>
              <td><?php echo $row['notes'] .' '. $row['lastName']; ?></td>
              <td><?php echo $row['status']; ?></td>
              <td> <a href="schedule-call.php?mode=EDIT&custid=<?php echo $custid; ?>&id=<?php echo $row['callID']; ?>" ><i class="fa fa-pencil" data-toggle="tooltip" data-placement="bottom" title="Edit"></i> </a> 
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
