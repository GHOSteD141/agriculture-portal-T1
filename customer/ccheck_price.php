<?php
session_start();
require('../sql.php'); // Includes SQL connection script

if (isset($_POST['crops']) && isset($_POST['quantity'])) {

  $crop=$_POST['crops'];
  $quantity=$_POST['quantity'];
  
  $stmt = $conn->prepare("SELECT msp FROM farmer_crops_trade WHERE Trade_crop=?");
  $stmt->bind_param("s", $crop);
  $stmt->execute();
  $result = $stmt->get_result();
  $row = $result->fetch_assoc();
  $x=$row["msp"]*$quantity;
  
   echo ($x);
}