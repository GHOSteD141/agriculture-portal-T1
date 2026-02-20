<?php
session_start();
require('../sql.php'); // Includes SQL connection script

if (isset($_POST['crops']) && isset($_POST['quantity'])) {
$flag=0;
$temp=0;

  $crop=$_POST['crops'];
  $quantity=$_POST['quantity'];
  
  $query1="SELECT Trade_crop from farmer_crops_trade";
  $result1 = mysqli_query($conn, $query1);
  while($row1 = $result1->fetch_assoc()) {
    if(!strcasecmp($crop,$row1["Trade_crop"])){
      $flag=1;
      break;
    }
  }
  
  $stmt2 = $conn->prepare("SELECT Crop_quantity FROM farmer_crops_trade WHERE Trade_crop=?");
  $stmt2->bind_param("s", $crop);
  $stmt2->execute();
  $result2 = $stmt2->get_result();
  while($row2 = $result2->fetch_assoc()) {
    $temp+=$row2["Crop_quantity"];
  }
  
  $stmt8 = $conn->prepare("SELECT quantity FROM cart WHERE cropname=?");
  $stmt8->bind_param("s", $crop);
  $stmt8->execute();
  $result8 = $stmt8->get_result();
if (isset($result8) && $result8->num_rows > 0) {
    $row8 = $result8->fetch_assoc();
    $temp -= $row8['quantity'];
	if($flag==1){
		if($quantity>$temp)
		$flag=0;
		else $flag=1;
	}
}

  
  
  $stmt = $conn->prepare("SELECT msp FROM farmer_crops_trade WHERE Trade_crop=?");
  $stmt->bind_param("s", $crop);
  $stmt->execute();
  $result = $stmt->get_result();
  $row = $result->fetch_assoc();
  $x=$row["msp"]*$quantity;
  
  $stmt3 = $conn->prepare("SELECT trade_id FROM farmer_crops_trade WHERE Trade_crop=?");
  $stmt3->bind_param("s", $crop);
  $stmt3->execute();
  $result3 = $stmt3->get_result();
  $row2 = $result3->fetch_assoc();
  $TradeId=$row2["trade_id"]; //trade id
  
    $response = array(
    "flagR" => $flag,
    "xR" => $x,
	"TradeIdR" => $TradeId,
	"cropR" => $crop,
	"quantityR" => $quantity,
  );
  
    echo json_encode($response);



}

?>

				
