<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "building-mannegement";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}
function getPaymentHistory($conn, $userEmail) {

    $sql = "SELECT * FROM payments 
            WHERE user_email='$userEmail' 
            ORDER BY paid_at DESC";

    return mysqli_query($conn, $sql);
}