<?php
session_start();
include '../DB/db.php';
 
if (!isset($_SESSION['email'])) {
    echo "Login required";
    exit();
}
 
$userEmail = $_SESSION['email'];
$month = $_POST['month'] ?? '';
 
if ($month === '') {
    echo "Select a month";
    exit();
}
 
/* 🔍 Get approved agreement */
$agr = mysqli_query($conn, "
    SELECT rent
    FROM agreements
    WHERE user_email='$userEmail'
    AND status='approved'
");
 
if (mysqli_num_rows($agr) !== 1) {
    echo "No approved agreement found";
    exit();
}
 
$a = mysqli_fetch_assoc($agr);
<<<<<<< HEAD
$rent = $a['rent'];
 
=======
$rent = (int) ($_POST['amount'] ?? $a['rent']);

>>>>>>> 8d8ca4d63f8d65fd25ef7e951fdba48766ba365d
/* ❌ Prevent duplicate payment */
$chk = mysqli_query($conn, "
    SELECT id FROM payments
    WHERE user_email='$userEmail'
    AND month='$month'
");
 
if (mysqli_num_rows($chk) > 0) {
    echo "Already paid for this month";
    exit();
}
 
/* 💾 Insert payment (MATCHES TABLE) */
$sql = "INSERT INTO payments
(user_email, amount, month, method)
VALUES
('$userEmail', $rent, '$month', 'Card')";
 
if (mysqli_query($conn, $sql)) {
    echo "success";
} else {
    echo "Payment failed";
}
 
 
 