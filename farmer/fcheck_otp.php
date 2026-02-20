<?php
session_start();
require('../sql.php'); // Use centralized database connection

$otp=$_POST['otp'];
$email=$_SESSION['farmer_login_user'];

// ✅ SECURE: Using prepared statements
$stmt = $conn->prepare("SELECT * FROM farmerlogin WHERE email=? AND otp=?");
$stmt->bind_param("ss", $email, $otp);
$stmt->execute();
$res = $stmt->get_result();
$count = $res->num_rows;

if($count>0){
	// ✅ SECURE: Using prepared statements for UPDATE
	$update_stmt = $conn->prepare("UPDATE farmerlogin SET otp='' WHERE email=?");
	$update_stmt->bind_param("s", $email);
	$update_stmt->execute();
	
	$_SESSION['IS_LOGIN']=$email;
	echo "yes";
}else{
	echo "not_exist";
}
?>