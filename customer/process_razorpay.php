<?php
session_start();
require('../sql.php');
require('../env_config.php');

// Check if user is logged in
if(!isset($_SESSION['customer_login_user'])){
    header("location: ../index.php");
    exit;
}

// Get Razorpay credentials from environment
$razorpay_key_id = getenv('RAZORPAY_PUBLIC_KEY');
$razorpay_key_secret = getenv('RAZORPAY_SECRET_KEY');

// Get payment details from POST
$amount = $_POST['amount'] ?? 0;
$order_id = $_POST['order_id'] ?? '';
$email = $_POST['email'] ?? '';

if ($amount <= 0) {
    echo "Invalid amount";
    exit;
}

// Convert amount to INR (Razorpay expects amount in smallest currency unit - paise)
$amount_in_paise = intval($amount);

// Create Razorpay order using cURL
$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.razorpay.com/v1/orders",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => json_encode(array(
        "amount" => $amount_in_paise,
        "currency" => "INR",
        "receipt" => $order_id,
        "notes" => array(
            "customer_email" => $email,
            "order_id" => $order_id
        )
    )),
    CURLOPT_HTTPAUTH => CURLAUTH_BASIC,
    CURLOPT_USERPWD => "$razorpay_key_id:$razorpay_key_secret",
    CURLOPT_HTTPHEADER => array(
        "Content-Type: application/json",
    ),
));

$response = curl_exec($curl);
$err = curl_error($curl);
curl_close($curl);

if ($err) {
    die("cURL Error #:" . $err);
}

$order_details = json_decode($response, true);

// Check if order was created successfully
if (!isset($order_details['id'])) {
    die("Failed to create order: " . $response);
}

$razorpay_order_id = $order_details['id'];

// Store order details in session for verification later
$_SESSION['razorpay_order_id'] = $razorpay_order_id;
$_SESSION['razorpay_amount'] = $amount;
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Razorpay Payment - Agriculture Portal</title>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .payment-container {
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            text-align: center;
        }
        .payment-container h2 {
            color: #333;
            margin-bottom: 20px;
        }
        .amount-display {
            font-size: 28px;
            color: #667eea;
            font-weight: bold;
            margin: 20px 0;
        }
        .btn-pay {
            background-color: #667eea;
            color: white;
            padding: 12px 30px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }
        .btn-pay:hover {
            background-color: #764ba2;
        }
    </style>
</head>
<body>
    <div class="payment-container">
        <h2>Complete Your Payment</h2>
        <div class="amount-display">₹<?php echo number_format($amount / 100, 2); ?></div>
        <p>Order ID: <?php echo htmlspecialchars($razorpay_order_id); ?></p>
        
        <form id="razorpayForm" method="POST" action="verify_razorpay.php">
            <input type="hidden" id="razorpay_payment_id" name="razorpay_payment_id" />
            <input type="hidden" id="razorpay_order_id" name="razorpay_order_id" value="<?php echo $razorpay_order_id; ?>" />
            <input type="hidden" id="razorpay_signature" name="razorpay_signature" />
            
            <button type="button" class="btn-pay" id="pay-button">Pay ₹<?php echo number_format($amount / 100, 2); ?></button>
        </form>
    </div>

    <script>
        var options = {
            "key": "<?php echo $razorpay_key_id; ?>",
            "amount": "<?php echo $amount_in_paise; ?>",
            "currency": "INR",
            "name": "Agriculture Portal",
            "description": "Crop Purchase",
            "image": "../assets/img/logo.png",
            "order_id": "<?php echo $razorpay_order_id; ?>",
            "handler": function (response) {
                document.getElementById('razorpay_payment_id').value = response.razorpay_payment_id;
                document.getElementById('razorpay_order_id').value = response.razorpay_order_id;
                document.getElementById('razorpay_signature').value = response.razorpay_signature;
                document.getElementById('razorpayForm').submit();
            },
            "prefill": {
                "email": "<?php echo htmlspecialchars($email); ?>"
            },
            "theme": {
                "color": "#667eea"
            },
            "modal": {
                "ondismiss": function () {
                    alert("Payment Cancelled");
                    window.location.href = 'cbuy_crops.php';
                }
            }
        };
        
        var rzp1 = new Razorpay(options);
        
        document.getElementById('pay-button').onclick = function(e){
            rzp1.open();
            e.preventDefault();
        }
    </script>
</body>
</html>
