<?php  
   session_start();  
   include_once 'includes/database.php';  
   include_once 'classes/users.php'; 
   include_once 'classes/task.php'; 

   $user = new User();   
   if (!$user->session())  
   {  
      header("location:index.php");  
   }  else {
    $uid = $_SESSION['id'];
    
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
        url: "task-crud.php",
        data: data, // get all form field value in 
        dataType: 'text',
        success: function(res) {
          var resText = res.split("-");
          if(resText[0] == 1) {
         alert(resText[1]);
         window.reload();
          } else {
            alert(resText[1]);
         window.reload();
          }
      
        },
        error: function (res) {
        
          alert('Something went Wrong!');
         window.reload();
        }
    });
  
});
});
  </script>

<body>

<?php include('includes/navigation.php'); 
?>
<!DOCTYPE html>
<html>
<head>
	<title>ToDo List</title>
</head>
<body>
	<main class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
    <div class="container-fluid">
        <div class="row">
            <div class="d-flex pb-2 mb-3 border-bottom w-100">
                <h1 class="h2">Tasks List</h1>
            </div>
            <form method="post" action="task-list.php" class="w-100">
                <div class="form-row">
                    <div class="form-group col-12">
                        <label for="firstName" class="d-block">Task Description</label>
                        <textarea  name="taskDetails" class="form-control"></textarea>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="firstName" class="d-block">Created By</label>
                        <input type="text" name="createdBy" class="form-control">
                    </div>
                
                    <div class="form-group col-md-4">
                        <label for="firstName" class="d-block">Assigned To</label>
                        <input type="text" name="assignedTo" class="form-control"> 
                    </div>

                    <div class="form-group col-md-4">
                        <label for="firstName" class="d-block">Estimated Time</label>
                        <input type="text" name="estimatedTime" class="form-control w-80 d-inline-block"> 
                        <label> min</label> 
                    </div>
                </div>
                
                
                <button type="submit" name="submit" id="add_btn" class="btn-primary btn-lg mb-5">Add Task</button>
            </form>
        </div>
        <div class="row">
            <div class="table-responsive">
            <table class="table" style=" border: 2px solid black" cellspacing=0 cellpadding=0>
                <thead class="thead-dark">
                    <tr>
                        <th>N</th>
                        <th>Created By</th>
                        <th>Tasks</th>
                        <th>Assigned To</th>
                        <th>Estimated Time</th>
                        <th>Tasks Status</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                        <th colspan=3>Action</th>
                    </tr>
                </thead>

                <tbody>
                    <?php 
                    // select all tasks if page is visited or refreshed
                    $tasks = mysqli_query($db, "SELECT * FROM task");
                    $i = 1; 
                    while ($row = mysqli_fetch_array($tasks)) { ?>
                        <tr <?php if($row['task_status'] == 'Started')
                        { echo ("bgcolor=#ffa500");}
                        elseif($row['task_status'] == 'Closed')
                        {echo ("bgcolor=#008000");}
                        else {
                            echo ("bgcolor=#ff0000"); 
                        } ?>
                            <td> <?php echo $i; ?> </td>
                            <td> <?php echo $row['created_by']; ?> </td>
                            <td><?php echo $row['task_details']; ?> </td>
                            <td><?php echo $row['assigned_to']; ?> </td>
                            <td><?php echo $row['estimated_time']; ?> </td>
                            <td><?php echo $row['task_status']; ?> </td>
                            <td><?php echo $row['start_time']; ?> </td>
                            <td><?php echo $row['end_time']; ?> </td>
                            <td> 
                                <a href="task_list.php?del_task=<?php echo $row['id'] ?>">X</a> 
                            </td>
                            <td>
                                <a href="task_list.php?start_task=<?php echo $row['id'] ?>">Start</a>
                            </td>
                            <td>
                                <a href="task_list.php?finish_task=<?php echo $row['id'] ?>">Finish</a>
                            </td>
                        </tr>
                    <?php $i++; } ?>	
                </tbody>
            </table>
            </div>
           
        </div>
    </div>
    </main>
</body>
</html>