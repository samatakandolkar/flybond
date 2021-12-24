 <?php  
   session_start();  
   include_once 'includes/database.php';  
   include_once 'classes/users.php'; 
   $user = new User();  
   $message = ''; 
   //print_r($_SESSION['login']);
   if ($user->session()) {  
       header("location:dashboard.php");  
   }

   if ($_SERVER["REQUEST_METHOD"] == "POST") {  
    $login = $user->login($_REQUEST['email'],$_REQUEST['password']);  
    if($login) {  
        header("location:dashboard.php");  
    }
    else {  
        $message = "Login Failed!";  
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
                        
                            <h3 class="mb-5">Member Login</h3>
                            
                            <?php if(!empty($message)) { ?>
                                <div class="alert alert-danger" role="alert">
                            <?php echo $message; ?>
                            </div>
                            <?php } ?>
                           
                            <div class="input-group mb-3">
                                <input type="text" name="email" required="required" placeholder="Email" class="form-control" required></input>
                            </div>
                            <div class="input-group mb-3">
                                <input type="password" name="password" required="required" placeholder="Password" class="form-control" required></input>
                            </div>
                            <div class="input-group">
                                <input type="submit" class="button form-control" name="login" value="Login"></input>
                            </div>
                            <div class="reminder mt-1">
                            <p>Not a member? <a href="register.php">Sign up now</a></p>
                            <!-- <p><a href="#">Forgot password?</a></p> -->
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