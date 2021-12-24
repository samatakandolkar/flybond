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
<?php include('includes/navigation.php'); ?>
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h2">Welcome <?php echo $_SESSION['name'];?></h1>
    </div>
     <h2 class="mb-3">Upcoming Calls</h2>     
     <div class="table-responsive">
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th>#</th>
                    <th>Date</th>
                    <th>Company Name</th>
                    <th>Client Name</th>
                    <th>Notes</th>
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