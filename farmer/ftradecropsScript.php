<?php 
session_start();
ini_set('memory_limit', '-1');
$userlogin=$_SESSION['farmer_login_user'];

require('../sql.php'); // Includes Login Script

if(isset($_POST['Crop_submit'])){
    $x=0.0;
    $y=0;
    $trade_crop=$_POST['crops'];
    $quantity=$_POST['trade_farmer_cropquantity'];
    $costperkg=$_POST['trade_farmer_cost'];

    
    $stmt1 = $conn->prepare("SELECT farmer_id FROM farmerlogin WHERE email=?");
    $stmt1->bind_param("s", $userlogin);
    $stmt1->execute();
    $run = $stmt1->get_result();
    $row=$run->fetch_array();
    $farmer_pid= $row[0];
    
    $stmt2 = $conn->prepare("INSERT INTO farmer_crops_trade(farmer_fkid, Trade_crop, Crop_quantity, costperkg) VALUES (?, ?, ?, ?)");
    $stmt2->bind_param("isid", $farmer_pid, $trade_crop, $quantity, $costperkg);
    $result = $stmt2->execute();


    $stmt = $conn->prepare("SELECT costperkg FROM farmer_crops_trade WHERE Trade_crop=?");
    $stmt->bind_param("s", $trade_crop);
    $stmt->execute();
    $result = $stmt->get_result();
    while($row = $result->fetch_assoc()) {
        $x=$x+$row["costperkg"];
        $y++;
    }

    $x=CEIL($x/$y);
    $x=$x+CEIL($x*0.5);

    $stmt3 = $conn->prepare("UPDATE farmer_crops_trade SET msp=? WHERE Trade_crop=?");
    $stmt3->bind_param("ds", $x, $trade_crop);
    $stmt3->execute();


    $stmt4 = $conn->prepare("UPDATE production_approx SET quantity=quantity+? WHERE crop=?");
    $stmt4->bind_param("is", $quantity, $trade_crop);
    $stmt4->execute();

    	echo 
"<script type='text/javascript'>alert('Crop Details Added Successfully');
      window.location='ftradecrops.php';</script>";

}

?>