<?php
include '../DB/db.php';
 
$action = $_REQUEST['action'] ?? '';
<<<<<<< HEAD
 
/* =========================
   1️⃣ LOAD COUPON LIST
   ========================= */
=======


>>>>>>> 8fe480005f28ccfd07fb76b266a1c7184cc5e25e
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
<<<<<<< HEAD
 
/* =========================
   2️⃣ APPLY COUPON
   ========================= */
=======


>>>>>>> 8fe480005f28ccfd07fb76b266a1c7184cc5e25e
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
<<<<<<< HEAD
 
/* =========================
   INVALID REQUEST
   ========================= */
=======


>>>>>>> 8fe480005f28ccfd07fb76b266a1c7184cc5e25e
echo "Invalid request";
 
 