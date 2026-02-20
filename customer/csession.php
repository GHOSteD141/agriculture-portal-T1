<?php
// mysqli_connect() function opens a new connection to the MySQL server.
$conn = mysqli_connect("localhost", "root", "", "agriculture_portal");
session_start();// Starting Session
// Storing Session
$user_check = $_SESSION['customer_login_user'];
// SQL Query To Fetch Complete Information Of User
$stmt = $conn->prepare("SELECT cust_name FROM custlogin WHERE email = ?");
$stmt->bind_param("s", $user_check);
$stmt->execute();
$ses_sql = $stmt->get_result();
$row = $ses_sql->fetch_assoc();
