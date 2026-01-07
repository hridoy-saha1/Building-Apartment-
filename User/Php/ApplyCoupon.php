<?php
include '../DB/db.php';
 
$action = $_REQUEST['action'] ?? '';


if ($action === 'list') {
 
    $q = mysqli_query($conn,
        "SELECT code, discount
         FROM coupons
         WHERE available = 1"
    );
 
    while ($c = mysqli_fetch_assoc($q)) {
        echo "<li onclick=\"fillCoupon('{$c['code']}')\">
                <strong>{$c['code']}</strong> — {$c['discount']}% off
              </li>";
    }
    exit();
}


if ($action === 'apply') {
 
    $code = trim($_POST['code'] ?? '');
 
    if ($code === '') {
        echo json_encode([
            "status" => "error",
            "message" => "Coupon code required"
        ]);
        exit();
    }
 
    $q = mysqli_query($conn,
        "SELECT discount
         FROM coupons
         WHERE code='$code' AND available=1"
    );
 
    if (mysqli_num_rows($q) !== 1) {
        echo json_encode([
            "status" => "error",
            "message" => "Invalid or expired coupon"
        ]);
        exit();
    }
 
    $c = mysqli_fetch_assoc($q);
 
    echo json_encode([
        "status"   => "success",
        "discount" => (int)$c['discount']
    ]);
    exit();
}


echo "Invalid request";
 
 