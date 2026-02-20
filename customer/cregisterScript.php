<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start(); // Starting Session

require('../sql.php'); // Includes Login Script
global $error;

// function for email validation
function is_valid_email($email)
{
	global $conn;
	global $error;
	
     $stmt = $conn->prepare("SELECT cust_id FROM custlogin WHERE email = ?");
	 $stmt->bind_param("s", $email);
	 $stmt->execute();
     $selectresult = $stmt->get_result();
	 $rowcount=$selectresult->num_rows;
	   
	 if ($rowcount==true) {
		 
		$error = '
		
		<div class="alert alert-info alert-dismissible fade show text-center" id="popup" role="alert">
			<strong class="text-center text-dark ">This email already exists</strong>
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			  </button>
			</div>
		
		';
			
		return false;		
 }
    else  {
        return true;
     }

}


 
// function for password verification
function is_valid_passwords($password,$cpassword) 
{
	global $error;
	
if ($password != $cpassword) {
	
			$error = '
		
		<div class="alert alert-info alert-dismissible fade show text-center" id="popup" role="alert">
			<strong class="text-center text-dark ">Your passwords do not match. Please type carefully</strong>
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			  </button>
			</div>
		
		';
		
         return false;
     }
 else  {
        return true;
     }
}

// function for creating user
function create_user($name, $password, $email, $mobile, $statename, $city, $address, $pincode) 
{
	global $conn;
	
      $stmt = $conn->prepare("INSERT INTO custlogin (cust_name, password, email, phone_no, state, city, address, pincode) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
	  $stmt->bind_param("ssssssss", $name, $password, $email, $mobile, $statename, $city, $address, $pincode);
      $result = $stmt->execute();
      if($result){
          return true; // Success
      }else{
          return false; // Error somewhere
      }
}


// Code execution starts here after submit
if (isset($_POST['email']) && isset($_POST['password']) && isset($_POST['confirmpassword'])){

    // Reading form values
    $name = $_POST['name'];
    $email = $_POST['email'];	
	$mobile = $_POST['mobile'];
    $state = $_POST['state'];
	$city = $_POST['city'];
	$address = $_POST['address'];
	$pincode = $_POST['pincode'];
    $password = $_POST['password'];
    $cpassword = $_POST['confirmpassword'];


$stmt5 = $conn->prepare("SELECT StateName FROM state WHERE StCode=?");
	$stmt5->bind_param("s", $state);
	$stmt5->execute();
	$ses_sq5 = $stmt5->get_result();
              $row5 = $ses_sq5->fetch_assoc();
              $statename = $row5['StateName'];
			  
			  
    if (is_valid_email($email) == true && is_valid_passwords($password,$cpassword) == true)
    {	
        if (create_user($name, $password, $email, $mobile, $statename, $city, $address, $pincode )) {
			$_SESSION['customer_login_user']=$email; // Initializing Session    
        header("location: ctwostep.php");
        }else{
			
						$error = '
		
		<div class="alert alert-info alert-dismissible fade show text-center" id="popup" role="alert">
			<strong class="text-center text-dark ">Error While Registering User</strong>
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			  </button>
			</div>
		
		';

        }
    }
}
    // You don't need to write another 'else' since this is the end of PHP code 
?>