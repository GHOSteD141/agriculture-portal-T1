<?php
    // Load environment variables
require_once(__DIR__ . '/env_config.php');

    // connect to database
$servername = getenv('DB_HOST') ?: 'localhost';
$username = getenv('DB_USER') ?: 'root';
$password = getenv('DB_PASSWORD') ?: '';
$dbname = getenv('DB_NAME') ?: 'agriculture_portal';
$conn = mysqli_connect($servername, $username, $password, $dbname);
  // $conn = mysqli_connect('us-cdbr-east-03.cleardb.com','b310794f5353e9','d9f40fcf','heroku_f1cacb29cd6455f');
    if(!$conn){
        echo 'Connection error' . mysqli_connect_error();
    } 
?>


