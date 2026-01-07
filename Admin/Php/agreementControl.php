<?php
session_start();
include '../../User/DB/db.php';

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

if ($status === 'approved') {

    $updateAgreement = "UPDATE agreements SET status='approved' WHERE id=$id";
    if (!mysqli_query($conn, $updateAgreement)) {
        echo "Failed";
        exit;
    }

    $getInfo = "SELECT user_email, apartment_no 
                FROM agreements 
                WHERE id=$id";
    $res = mysqli_query($conn, $getInfo);
    $row = mysqli_fetch_assoc($res);

    $userEmail   = $row['user_email'];
    $apartmentNo = $row['apartment_no'];

    
    mysqli_query($conn,
        "UPDATE users 
         SET role='member' 
         WHERE email='$userEmail'"
    );

    
    mysqli_query($conn,
        "UPDATE apartments 
         SET status='unavailable' 
         WHERE apartment_no='$apartmentNo'"
    );

    echo "success";
    exit;
}


if ($status === 'rejected') {

    $deleteAgreement = "DELETE FROM agreements WHERE id=$id LIMIT 1";

    if (mysqli_query($conn, $deleteAgreement)) {
        echo "success";
    } else {
        echo "Delete failed";
    }
    exit;
}
