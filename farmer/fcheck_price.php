<?php 
session_start(); 
require('../sql.php'); // Includes SQL connection script

$crops = $_POST['crops'];    
$x = 0.0;    
$y = 0;

$stmt = $conn->prepare("SELECT costperkg FROM farmer_crops_trade WHERE Trade_crop=?");
$stmt->bind_param("s", $crops);
$stmt->execute();
$result = $stmt->get_result();

while($row = $result->fetch_assoc()) {
	$x = $x + $row["costperkg"];
	$y++;
}

if ($y != 0) {
    $x = CEIL($x / $y);
} else {
    $x = 0; // or handle the error in some other way
}

echo $x; 
?> 
