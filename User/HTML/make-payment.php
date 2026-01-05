<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Make Payment</title>
    <link rel="stylesheet" href="../CSS/dashboard.css">

    <style>
        .payment-card {
            max-width: 520px;
            margin: 20px auto;
            background: #ffffff;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.08);
        }

        .payment-card h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #1e293b;
        }

        .form-group {
            margin-bottom: 14px;
        }

        .form-group label {
            display: block;
            font-size: 14px;
            margin-bottom: 6px;
            color: #334155;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 10px;
            border-radius: 8px;
            border: 1px solid #cbd5e1;
            font-size: 14px;
        }

        .form-group input[readonly] {
            background: #f8fafc;
        }

        .coupon-row {
            display: flex;
            gap: 8px;
        }

        .coupon-row button {
            background: #2563eb;
            color: white;
            border: none;
            padding: 10px 16px;
            border-radius: 8px;
            cursor: pointer;
        }

        .pay-btn {
            width: 100%;
            margin-top: 15px;
            background: #16a34a;
            color: white;
            border: none;
            padding: 12px;
            font-size: 16px;
            border-radius: 10px;
            cursor: pointer;
        }

        .pay-btn:disabled {
            background: #9ca3af;
            cursor: not-allowed;
        }

        .info-text {
            font-size: 13px;
            margin-top: 6px;
        }

        .success {
            color: #16a34a;
        }

        .error {
            color: #dc2626;
        }
    </style>
</head>

<body>

<div class="layout">

<?php include 'sidebar.php'; ?>

<main class="content">

    <div class="payment-card">
        <h1>💳 Make Payment</h1>

        <form id="paymentForm">

            <div class="form-group">
                <label>Email</label>
                <input type="text" value="<?php echo $_SESSION['email'] ?? ''; ?>" readonly>
            </div>

            <div class="form-group">
                <label>Floor</label>
                <input type="text" id="floor" readonly>
            </div>

            <div class="form-group">
                <label>Block</label>
                <input type="text" id="block" readonly>
            </div>

            <div class="form-group">
                <label>Apartment No</label>
                <input type="text" id="room" readonly>
            </div>

            <div class="form-group">
                <label>Rent (৳)</label>
                <input type="text" id="rent" readonly>
            </div>

            <div class="form-group">
                <label>Month</label>
                <select id="month">
                    <option value="">Select Month</option>
                    <option>January</option>
                    <option>February</option>
                    <option>March</option>
                    <option>April</option>
                    <option>May</option>
                    <option>June</option>
                    <option>July</option>
                    <option>August</option>
                    <option>September</option>
                    <option>October</option>
                    <option>November</option>
                    <option>December</option>
                </select>
            </div>

            <div class="form-group">
                <label>Coupon Code</label>
                <div class="coupon-row">
                    <input type="text" id="coupon" placeholder="Enter coupon code">
                    <button type="button" onclick="applyCoupon()">Apply</button>
                </div>
                <p id="couponMsg" class="info-text"></p>
            </div>

            <button type="submit" class="pay-btn" id="payBtn">Pay Now</button>

            <p id="paymentMsg" class="info-text"></p>
        </form>
    </div>

</main>

</div>

<script>
/* Demo JS – later you can replace with AJAX */
function applyCoupon() {
    document.getElementById("couponMsg").innerText =
        "Coupon applied successfully!";
    document.getElementById("couponMsg").className = "info-text success";
}

document.getElementById("paymentForm").addEventListener("submit", function(e) {
    e.preventDefault();
    document.getElementById("paymentMsg").innerText =
        "Payment successful!";
    document.getElementById("paymentMsg").className = "info-text success";
    document.getElementById("payBtn").disabled = true;
});
</script>

</body>
</html>
