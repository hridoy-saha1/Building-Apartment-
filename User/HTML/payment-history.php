<?php
session_start();
include '../DB/db.php';

if (!isset($_SESSION['email'])) {
    header("Location: Login.php");
    exit();
}

$userEmail = $_SESSION['email'];


$result = getPaymentHistory($conn, $userEmail);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Payment History</title>
    <link rel="stylesheet" href="../CSS/dashboard.css">

    <style>
        .history-card{
            max-width:800px;
            margin:20px auto;
            background:#fff;
            padding:20px;
            border-radius:12px;
            box-shadow:0 6px 20px rgba(0,0,0,.08);
        }

        table{
            width:100%;
            border-collapse:collapse;
        }

        th, td{
            padding:12px;
            text-align:center;
            border-bottom:1px solid #e5e7eb;
            font-size:14px;
        }

        th{
            background:#2563eb;
            color:#fff;
        }

        tr:hover{
            background:#f8fafc;
        }

        .empty{
            text-align:center;
            padding:20px;
            color:#64748b;
            font-style:italic;
        }
    </style>
</head>

<body>

<div class="layout">
<?php include 'sidebar.php'; ?>

<main class="content">

<div class="history-card">
    <h2>💰 Payment History</h2>

    <table>
        <thead>
            <tr>
                <th>Month</th>
                <th>Amount (৳)</th>
                <th>Method</th>
                <th>Paid At</th>
            </tr>
        </thead>
        <tbody>

        <?php if (mysqli_num_rows($result) > 0) { ?>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?= htmlspecialchars($row['month']) ?></td>
                    <td><?= htmlspecialchars($row['amount']) ?></td>
                    <td><?= htmlspecialchars($row['method']) ?></td>
                    <td><?= date("d M Y, h:i A", strtotime($row['paid_at'])) ?></td>
                </tr>
            <?php } ?>
        <?php } else { ?>
            <tr>
                <td colspan="4" class="empty">
                    ❌ No payment history found
                </td>
            </tr>
        <?php } ?>

        </tbody>
    </table>
</div>

</main>
</div>

</body>
</html>
