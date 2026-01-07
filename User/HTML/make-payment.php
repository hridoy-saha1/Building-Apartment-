<?php
session_start();
include '../DB/db.php';
 
if (!isset($_SESSION['email'])) {
    header("Location: Login.php");
    exit();
}
 
$userEmail = $_SESSION['email'];

$res=paymentFilled($conn, $userEmail);
$agreement = null;
if (mysqli_num_rows($res) === 1) {
    $agreement = mysqli_fetch_assoc($res);
}
?>
 
<!DOCTYPE html>
<html>
<head>
    <title>Make Payment</title>
    <link rel="stylesheet" href="../CSS/dashboard.css">
   <link rel="stylesheet" href="../CSS/makePayment.css">
</head>
 
<body>
 
<div class="layout">
<?php include 'sidebar.php'; ?>
 
<main class="content">
 
<?php if (!$agreement) { ?>
 
    <div class="payment-card">
        <div class="msg-box msg-error" style="display:block;">
            ❌ No approved agreement found for your account.
        </div>
    </div>
 
<?php } else { ?>
 
    <div class="payment-card">
        <h2>💳 Make Payment</h2>
 
        <div id="msgBox" class="msg-box"></div>
 
        <form id="paymentForm">
 
            <div class="form-group">
                <label>Email</label>
                <input type="text" value="<?= $userEmail ?>" readonly>
            </div>
 
            <div class="form-group">
                <label>Apartment</label>
                <input type="text" value="<?= $agreement['apartment_no'] ?>" readonly>
            </div>
 
            <div class="form-group">
                <label>Block</label>
                <input type="text" value="<?= $agreement['block'] ?>" readonly>
            </div>
 
            <div class="form-group">
                <label>Floor</label>
                <input type="text" value="<?= $agreement['floor'] ?>" readonly>
            </div>
 
            <div class="form-group">
                <label>Rent (৳)</label>
             <input type="text" id="rent" value="<?= $agreement['rent'] ?>" readonly>
            </div>
 
            <div class="form-group">
                <label>Month</label>
                <select id="month" required>
                    <option value="">Select Month</option>
                    <?php
                    $months=["January","February","March","April","May","June","July","August","September","October","November","December"];
                    foreach($months as $m) echo "<option>$m</option>";
                    ?>
                </select>
            </div>
 
       
 
<div class="coupon-box">
 
    <label class="coupon-label">🎟️ Coupon Code</label>
 
    <div class="coupon-input-row">
    <input type="text" id="couponCode" placeholder="Enter coupon code">
    <button type="button" id="couponBtn" onclick="applyCoupon()">Apply</button>
    </div>
 
    <div id="couponMsg" class="msg-box"></div>
 
    <div class="coupon-list">
        <p class="coupon-title">Available Coupons</p>
        <ul id="couponList"></ul>
    </div>
 
</div>
            <button class="pay-btn" type="submit">Pay Now</button>
        </form>
    </div>
 
<?php } ?>
 
</main>
</div>
 
<?php if ($agreement) { ?>
 
 
<script src="../JS/Ajax.js"></script>
<script>
    loadCoupons();
 document.getElementById("paymentForm").addEventListener("submit", function(e){
    e.preventDefault();
 
    

    let month = document.getElementById("month").value;
    let box = document.getElementById("msgBox");
 
    let x = new XMLHttpRequest();
    x.onreadystatechange = function(){
        if (x.readyState === 4 && x.status === 200) {
 
            let res = x.responseText.trim();
            box.style.display = "block";
 
            if (res === "success") {
                box.innerText = "✅ Payment Successful!";
                box.className = "msg-box msg-success";
            }
            else if (res.includes("Already paid")) {
                box.innerText = "⚠️ You have already paid for this month.";
                box.className = "msg-box msg-error";
            }
            else {
                box.innerText = "❌ " + res;
                box.className = "msg-box msg-error";
            }
        }
    };
 
    x.open("POST", "../Php/make_payment_action.php", true);
    x.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
   let rent = document.getElementById("rent").value;

     x.send(
    "month=" + encodeURIComponent(month) +
    "&amount=" + encodeURIComponent(rent)
);

});
</script>
 
 
 
<?php } ?>
 
</body>
</html>