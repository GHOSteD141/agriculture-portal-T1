<?php
require_once("../sql.php");

if(!empty($_POST["state_id"])) 
{
$stmt = $conn->prepare("SELECT * FROM district WHERE StCode = ?");
$stmt->bind_param("s", $_POST["state_id"]);
$stmt->execute();
$query = $stmt->get_result();
?>
<option value="">Select District</option>
<?php
while($row=mysqli_fetch_array($query))  
{
?>
<option value="<?php echo $row["DistrictName"]; ?>"><?php echo $row["DistrictName"]; ?></option>
<?php
}
}


?>


