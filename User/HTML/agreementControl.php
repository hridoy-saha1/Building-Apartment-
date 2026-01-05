<?php
session_start();
include '../DB/db.php';


if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    echo "Unauthorized";
    exit;
}

if (!isset($_POST['id'], $_POST['status'])) {
    echo "Invalid request";
    exit;
}

$id = (int) $_POST['id'];
$status = $_POST['status'];

if (!in_array($status, ['approved', 'rejected'])) {
    echo "Invalid status";
    exit;
}


$updateAgreement = "UPDATE agreements SET status='$status' WHERE id=$id";

if (!mysqli_query($conn, $updateAgreement)) {
    echo mysqli_error($conn);
    exit;
}


if ($status === 'approved') {

    
    $getInfo = "SELECT user_email, apartment_no 
                FROM agreements 
                WHERE id=$id";
    $res = mysqli_query($conn, $getInfo);
    $row = mysqli_fetch_assoc($res);

    $userEmail   = $row['user_email'];
    $apartmentNo = $row['apartment_no'];

    $promoteUser = "UPDATE users 
                    SET role='member' 
                    WHERE email='$userEmail'";
    mysqli_query($conn, $promoteUser);

    $disableApartment = "UPDATE apartments 
                         SET status='unavailable' 
                         WHERE apartment_no='$apartmentNo'";
    mysqli_query($conn, $disableApartment);
}

echo "success";
