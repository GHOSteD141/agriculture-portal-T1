<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start(); // Starting Session
$error = ''; // Variable To Store Error Message

require('../sql.php'); // Includes Login Script

if(isset($_POST ['customerlogin'])) {
    $customer_email=$_POST['cust_email'];
    $customer_password=$_POST['cust_password'];
  
    // ✅ SECURE: Using prepared statements
    $stmt = $conn->prepare("SELECT * FROM custlogin WHERE email=? AND password=?");
    $stmt->bind_param("ss", $customer_email, $customer_password);
    $stmt->execute();
    $result = $stmt->get_result();
    $rowcount = $result->num_rows;
    
    if ($rowcount==true) {
    $_SESSION['customer_login_user']=$customer_email; // Initializing Session
	
      $deletequery="DELETE FROM cart";
      $deletecart=mysqli_query($conn,$deletequery);

    header("location: ctwostep.php"); // Redirecting To Other Page
    } 
    else  {
       $error = "Username or Password is invalid";
     }
    
 mysqli_close($conn); // Closing Connection

}


?>
