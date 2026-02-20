<?php
session_start();
require('../sql.php'); // Includes SQL connection script

if (isset($_POST['crops'])) {

  $crop=$_POST['crops'];
  
  $stmt2 = $conn->prepare("SELECT quantity FROM production_approx WHERE crop=?");
  $stmt2->bind_param("s", $crop);
  $stmt2->execute();
  $result2 = $stmt2->get_result();
  while($row2 = $result2->fetch_assoc()) {
  $Cquantity=$row2["quantity"]; 
  }
  
  $stmt3 = $conn->prepare("SELECT trade_id FROM farmer_crops_trade WHERE Trade_crop=?");
  $stmt3->bind_param("s", $crop);
  $stmt3->execute();
  $result3 = $stmt3->get_result();
  $row2 = $result3->fetch_assoc();
  $TradeId=$row2["trade_id"]; //trade id
					  
					  
$result = array(
	"TradeIdR" => $TradeId,
	"quantityR" => $Cquantity,
  );
  
    echo json_encode($result);

}