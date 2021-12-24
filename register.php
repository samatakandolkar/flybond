<?php  
   session_start();  
   include_once 'includes/database.php';  
   include_once 'classes/users.php';  
   $user = new User(); 
   $err_message = $success_message = ''; 

   if ($_SERVER["REQUEST_METHOD"] == "POST"){  
    $trn_date = date("Y-m-d H:i:s");  
    $register = $user->register($trn_date,$_REQUEST['department'],$_REQUEST['username'],$_REQUEST['email'],$_REQUEST['password']);  
    if($register){  
        $success_message = "Registration Successful! Please login to continue.";  
    }
    else
    {  
        $err_message = "Entered email already exist!";  
    }
}
      
?>  
<?php include('header.php'); ?>
<body class="outer-page-body d-flex">
    <section class="login-page">
       <div class="form-container">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 d-flex justify-content-center align-self-center">
                        <img src="img/flybond-logo.jpg" alt="Flybond Logo" class="mw-100" height="200">
                    </div>
                    <div class="col-md-8 d-flex justify-content-center text-center">
                        <form action="" method="post" >
                        
                            <h3 class="mb-5">Member Registration</h3>
                            <?php if(!empty($err_message)) { ?>
                                <div class="alert alert-danger" role="alert">
                            <?php echo $err_message; ?>
                            </div>
                            <?php } ?>
                            <?php if(!empty($success_message)) { ?>
                                <div class="alert alert-success" role="alert">
                            <?php echo $success_message; ?>
                            </div>
                            <?php } ?>
                            <div class="input-group mb-3">
                                <input type="text" name="username" required="required" placeholder="Name" class="form-control" required></input>
                            </div>
                            <div class="input-group mb-3">
                                <input type="text" name="email" required="required" placeholder="Email" class="form-control" required></input>
                            </div>
                            <div class="input-group mb-3">
                                <input type="password" name="password" required="required" placeholder="Password" class="form-control" required></input>
                            </div>
                            <div class="input-group mb-3">
                                <select class="custom-select" id="department" name="department">
                                    <option value="1">Admin</option>
                                    <option value="2">Sales</option>
                                    <option value="3">Production</option>
                                    <option value="4">Marketing</option>
                                </select>
                            </div>
                            <div class="input-group">
                                <input type="submit" class="button form-control" name="register" value="Register"></input>
                            </div>
                            <div class="reminder mt-1">
                            <p>Already a member? <a href="index.php">login here</a></p>
                    
                        </div>
                        </form>
                       
                    </div>
                </div>
            </div>
       </div>
    </section>
  
  
</div>

</body>
</html>