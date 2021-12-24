<?php    

class User  
  
{  
    public $db;

    public  
  
    function __construct() {  
        $this->db = new mysqli(HOST, USER, PASS, DBNAME);
      if(mysqli_connect_errno()) {
        echo "Error: Could not connect to database.";
         exit;
    }
        
    }  
  
    public function register($trn_date, $department, $username, $email, $pass) {  
        $pass = md5($pass);  
        $check =  $this->db->query("Select id from users where email='$email'") ;
        $count_row = $check->num_rows;
        //if the username is not in db then insert to the table
        if ($count_row == 0) {
        $query="insert into users (deptID, username, email, password, deleted, status, createdAt) values ('$department','$username','$email','$pass', 0, 1, '$trn_date')";
        $result = mysqli_query($this->db,$query) or die(mysqli_connect_errno()."Data cannot inserted");
        return $result;
        } else { 
            return false;
        }
    }  
  
    public  
  
    function login($email, $pass) {  
        $pass = md5($pass);
        $result =  $this->db->query("Select * from users where email='$email' and password='$pass' and status='1'") ;
        $count_row = $result->num_rows;
        $data = mysqli_fetch_array($result);
        if ($count_row == 1) {  
            $_SESSION['login'] = true;  
            $_SESSION['id'] = $data['id'];  
            $_SESSION['name'] = $data['userName'];  
            return true;  
        } else {  
            return false;  
        }  
    }   
  
    public function session() {  
        if (isset($_SESSION['login'])) {  
            return $_SESSION['login'];  
        }  
    }  
  
    public  
  
    function logout() {  
        $_SESSION['login'] = false;  
        session_destroy();  
    }  
}  
  
?> 