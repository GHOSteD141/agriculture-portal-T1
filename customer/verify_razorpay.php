<?php
session_start();
require('../sql.php');
require('../env_config.php');

// Check if user is logged in
if(!isset($_SESSION['customer_login_user'])){
    header("location: ../index.php");
    exit;
}

$razorpay_key_secret = getenv('RAZORPAY_SECRET_KEY');
$user_email = $_SESSION['customer_login_user'];

// Get payment details from POST
$razorpay_payment_id = $_POST['razorpay_payment_id'] ?? '';
$razorpay_order_id = $_POST['razorpay_order_id'] ?? '';
$razorpay_signature = $_POST['razorpay_signature'] ?? '';

// Verify payment signature
$generated_signature = hash_hmac('sha256', 
    $razorpay_order_id . "|" . $razorpay_payment_id, 
    $razorpay_key_secret
);

if ($generated_signature === $razorpay_signature) {
    // Signature is valid - Payment successful
    
    // Get customer ID
    // ✅ SECURE: Using prepared statements
    $stmt = $conn->prepare("SELECT cust_id FROM custlogin WHERE email=?");
    $stmt->bind_param("s", $user_email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if(!$result || $result->num_rows == 0) {
        die("Customer not found");
    }
    
    $customer = $result->fetch_assoc();
    $cust_id = $customer['cust_id'];
    
    // Process shopping cart and save order
    if(isset($_SESSION["shopping_cart"]) && !empty($_SESSION["shopping_cart"])){
        
        // Create order record
        $order_date = date('Y-m-d H:i:s');
        $total_amount = $_SESSION['Total_Cart_Price'] ?? 0;
        
        foreach($_SESSION["shopping_cart"] as $keys => $values) {
            $crop_name = $values["crop_name"];
            $quantity = $values["crop_quantity"];
            $price = $values["crop_price"];
            
            // Insert order details into database
            $insert_query = "INSERT INTO orders (cust_id, crop_name, quantity, price, payment_id, order_status, order_date) 
                           VALUES ('$cust_id', '$crop_name', '$quantity', '$price', '$razorpay_payment_id', 'Completed', '$order_date')";
            
            $insert_result = mysqli_query($conn, $insert_query);
            
            if(!$insert_result) {
                echo "Error saving order: " . mysqli_error($conn);
                exit;
            }
        }
        
        // Store order details in session for confirmation page
        $_SESSION['order_id'] = $razorpay_order_id;
        $_SESSION['payment_id'] = $razorpay_payment_id;
        $_SESSION['payment_status'] = 'Success';
        
        // Clear shopping cart
        unset($_SESSION["shopping_cart"]);
        
        // Redirect to order confirmation
        header("location: order_confirmation.php");
        exit;
        
    } else {
        echo "No items in cart";
        exit;
    }
    
} else {
    // Signature mismatch - Payment verification failed
    $_SESSION['payment_status'] = 'Failed';
    $_SESSION['error_message'] = 'Payment verification failed. Please try again.';
    header("location: cbuy_crops.php");
    exit;
}
?>
