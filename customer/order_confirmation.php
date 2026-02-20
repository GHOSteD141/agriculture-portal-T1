<?php
session_start();
require('csession.php');
require('../sql.php');

// Check if user is logged in
if(!isset($_SESSION['customer_login_user'])){
    header("location: ../index.php");
    exit;
}

$user_email = $_SESSION['customer_login_user'];
$order_id = $_SESSION['order_id'] ?? '';
$payment_id = $_SESSION['payment_id'] ?? '';

// Get customer details
// ✅ SECURE: Using prepared statements
$stmt = $conn->prepare("SELECT cust_id, cust_name FROM custlogin WHERE email=?");
$stmt->bind_param("s", $user_email);
$stmt->execute();
$result = $stmt->get_result();
$customer = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<?php require('cheader.php'); ?>
<body class="bg-white" id="top">

<?php require('cnav.php'); ?>

<section class="section section-shaped section-lg">
    <div class="shape shape-style-1 shape-primary">
        <span></span><span></span><span></span><span></span><span></span>
        <span></span><span></span><span></span><span></span><span></span>
    </div>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="card border-success">
                    <div class="card-header bg-success text-white text-center">
                        <h2>✓ Payment Successful</h2>
                    </div>
                    <div class="card-body text-center">
                        <p class="text-success" style="font-size: 18px; margin-top: 20px;">
                            <strong>Thank you for your purchase, <?php echo htmlspecialchars($customer['cust_name']); ?>!</strong>
                        </p>
                        
                        <div class="alert alert-info" style="margin-top: 30px;">
                            <h4>Order Details</h4>
                            <p><strong>Order ID:</strong> <?php echo htmlspecialchars($order_id); ?></p>
                            <p><strong>Payment ID:</strong> <?php echo htmlspecialchars($payment_id); ?></p>
                            <p><strong>Customer Email:</strong> <?php echo htmlspecialchars($user_email); ?></p>
                            <p><strong>Date & Time:</strong> <?php echo date('Y-m-d H:i:s'); ?></p>
                        </div>

                        <div class="alert alert-warning" style="margin-top: 20px;">
                            <p>Your order has been placed successfully. We will process your order soon.</p>
                            <p>You will receive a confirmation email shortly.</p>
                        </div>

                        <div style="margin-top: 30px;">
                            <a href="cstock_crop.php" class="btn btn-primary btn-lg">View My Orders</a>
                            <a href="cbuy_crops.php" class="btn btn-secondary btn-lg">Continue Shopping</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require('footer.php'); ?>

</body>
</html>
