<?php
session_start();
require_once("../sql.php");

$otp=$_POST['otp'];
$email=$_SESSION['customer_login_user'];

$stmt = $conn->prepare("SELECT * FROM custlogin WHERE email=? AND otp=?");
$stmt->bind_param("ss", $email, $otp);
$stmt->execute();
$res = $stmt->get_result();
$count=$res->num_rows;

if($count>0){
	$stmt2 = $conn->prepare("UPDATE custlogin SET otp='' WHERE email=?");
	$stmt2->bind_param("s", $email);
	$stmt2->execute();
	$_SESSION['IS_LOGIN']=$email;
	echo "yes";
}else{
	echo "not_exist";
}
?>