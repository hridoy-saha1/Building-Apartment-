<?php
session_start();
include '../DB/db.php';

if (!isset($_SESSION['name']) || !isset($_SESSION['email'])) {
    echo "Login required";
    exit();
}

if (!isset($_POST['apartment_id'])) {
    echo "Invalid request";
    exit();
}

$user_name  = $_SESSION['name'];
$user_email = $_SESSION['email'];
$apartment_id = (int) $_POST['apartment_id'];

$aptSql = "SELECT * FROM apartments WHERE id = $apartment_id";
$aptRes = mysqli_query($conn, $aptSql);

if (mysqli_num_rows($aptRes) !== 1) {
    echo "Apartment not found";
    exit();
}

$apt = mysqli_fetch_assoc($aptRes);

$checkSql = "SELECT id FROM agreements 
             WHERE user_email='$user_email'
             AND apartment_no='{$apt['apartment_no']}'";
$checkRes = mysqli_query($conn, $checkSql);

if (mysqli_num_rows($checkRes) > 0) {
    echo "Already applied";
    exit();
}

$insertSql = "INSERT INTO agreements
(user_name, user_email, floor, block, apartment_no, rent, status)
VALUES
(
 '$user_name',
 '$user_email',
 {$apt['floor']},
 '{$apt['block']}',
 '{$apt['apartment_no']}',
 {$apt['rent']},
 'pending'
)";

if (mysqli_query($conn, $insertSql)) {
    echo "success";  
} else {
    echo "Failed";
}
