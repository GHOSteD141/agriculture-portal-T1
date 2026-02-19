<?php
	require_once "stripe-php-master/init.php";
	require_once "products.php";
	require_once "../../env_config.php";

$stripeDetails = array(
		"secretKey" => getenv('STRIPE_SECRET_KEY'),  //Your Stripe Secret key
		"publishableKey" => getenv('STRIPE_PUBLIC_KEY')  //Your Stripe Publishable key
	);

	// Razorpay configuration (alternative to Stripe)
	$razorpayDetails = array(
		"secretKey" => getenv('RAZORPAY_SECRET_KEY'),
		"publicKey" => getenv('RAZORPAY_PUBLIC_KEY')
	);

	// Set your secret key: remember to change this to your live secret key in production
	// See your keys here: https://dashboard.stripe.com/account/apikeys
	\Stripe\Stripe::setApiKey($stripeDetails['secretKey']);

	
?>
