<?php include('header.php'); ?>
<?php  
   session_start();  
   include_once 'includes/database.php';  
   include_once 'classes/users.php'; 
   include_once 'classes/calls.php'; 

   $user = new User();   
   if (!$user->session())  
   {  
      header("location:index.php");  
   }  else {
    $uid = $_SESSION['id'];
    
   }

?> 
<body>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" class="init">
$(document).ready(function() {
	$('#call-list').DataTable({
    columnDefs: [ { type: 'date', 'targets': [1] } ],
    order: [[ 1, 'asc' ]]
  });
} );
</script>
<?php include('includes/navigation.php'); ?>
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h2">Welcome <?php echo $_SESSION['name'];?></h1>
    </div>
     <h2 class="mb-3">Upcoming Calls</h2>     
     <div class="table-responsive">
        <table class="table" id="call-list">
            <thead class="thead-dark">
                <tr>
                    <th>#</th>
                    <th>Date</th>
                    <th>Company Name</th>
                    <th>Client Name</th>
                    <th>Notes</th>
                    <th>Handle</th>
                </tr>
            </thead>  <?php
              $calls = new Calls (); 
              $result = $calls->getUpcomingCalls();
              
              $cnt=1;
              while($r=mysqli_fetch_array($result))
              {
            ?>
            <tbody>
          
                <td scope="row"><?php echo $cnt;?></td>
                <td><?php echo $r['scheduleDate'];?></td>
                <td><?php echo $r['companyName'];?></td>
                <td><?php echo $r['firstName'] .' ' . $r['lastName'] ;?></td>
                <td><?php echo $r['notes'];?></td>
                <td>
            
                   <a href="schedule-call.php?mode=EDIT&custid=<?php echo  $r['cID']; ?>&id=<?php echo $r['callID']; ?>" >
                   <i class="fa fa-pencil" data-toggle="tooltip" data-placement="bottom" title="Edit"></i> </a> 
             
              </td>
            </tbody><?php }
                ?>
        </table>
     </div>
</main>
</div>
</div>
</body>
</html>
<?php include('includes/footer.php'); ?>