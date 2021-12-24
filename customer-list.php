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
    
   }

?> 
<?php include('header.php'); ?>

<body>

<?php include('includes/navigation.php'); ?>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4 customer-list">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1>Customers</h1>
          
          </div>
          <div class="mb-2 clearfix">
            <h3 class="float-left">Customers List </h3>
            <button type="button" class="btn btn-secondary mb-2 float-right" onclick="location.href='customer-card.php?mode=ADD';">+</button>
          </div>
          <div class="table-responsive">
            <table class="table ">
              <thead class="thead-dark">
                <tr>
                  <th>#</th>
                  <th>Company Name</th>
                  <th>Name</th>
                  <th>Address</th>
                  <th>Handle</th>
                </tr>
              </thead>
              <tbody>
              <?php
                $customer = new Customer();
                $result = $customer->getCustermerList();
              $cnt=1;
              while($row=mysqli_fetch_array($result))
              {
            ?>
            <tr>
              <td scope="row"><?php echo $cnt; ?></td>
              <td><?php echo $row['companyName']; ?></td>
              <td><?php echo $row['firstName'] .' '. $row['lastName']; ?></td>
              <td><?php echo $row['address']; ?></td>
              <td> <a href="customer-card.php?mode=EDIT&id=<?php echo $row['cID']; ?>" ><i class="fa fa-pencil" data-toggle="tooltip" data-placement="bottom" title="Edit"></i> </a> 
              | 
              <a href="schedule-call.php?mode=ADD&custid=<?php echo $row['cID']; ?>"> <i class="fa fa-phone" data-toggle="tooltip" data-placement="bottom" title="Schedule a call"></i> </a>
              | 
              <a href="customer-call-list.php?custid=<?php echo $row['cID']; ?>"><i class="fa fa-eye" data-toggle="tooltip" data-placement="bottom" title="View Call Details"></i> </a>
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
<!-- <div class="modal fade" id="callModal" tabindex="-1" role="dialog" aria-labelledby="callModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Call Schedule</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <label>Schedule call for </label>
        <form name="shedule_call">
        <div class="form-group row">
          <label for="inputDate" class="col-sm-2 col-form-label">Date</label>
          <div class="col-sm-6">
            <input type="date" class="form-control" id="date" name="date" min="<?php echo date("Y-m-d"); ?>" required>
          </div>
        </div>
        <div class="form-group row">
          <label for="inputNote" class="col-sm-2 col-form-label">Notes</label>
          <div class="col-sm-6">
            <textarea class="w-100" name="note" id="note" required></textarea>
          </div>
        </div>
        <div class="form-group row">
          <label for="inputstatus" class="col-sm-2 col-form-label">Status</label>
          <div class="col-sm-6">
            <select id="inputstatus" class="form-control">
              <option value="Scheduled">Scheduled</option>
              <option value="Completed">Completed</option>
            </select>
          </div>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
        </form>
    </div>
  </div>
</div> -->