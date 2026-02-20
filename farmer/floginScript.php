<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start(); // Starting Session
$error = ''; // Variable To Store Error Message

require('../sql.php'); // Includes Login Script

if(isset($_POST ['farmerlogin'])) {
  $farmer_email=$_POST['farmer_email'];
  $farmer_password=$_POST['farmer_password'];
  
  // ✅ SECURE: Using prepared statements
  $stmt = $conn->prepare("SELECT * FROM farmerlogin WHERE email=? AND password=?");
  $stmt->bind_param("ss", $farmer_email, $farmer_password);
  $stmt->execute();
  $result = $stmt->get_result();
  $rowcount = $result->num_rows;
  
  if ($rowcount==true) {
    $_SESSION['farmer_login_user']=$farmer_email; // Initializing Session
    

    header("location: ftwostep.php"); // Redirecting To Other Page
    } 
    else  {
       $error = "Username or Password is invalid";
     }
    
 mysqli_close($conn); // Closing Connection

}

?>
