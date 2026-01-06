<?php
session_start();
include '../DB/db.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    echo "<h2>Access Denied</h2>";
    exit;
}

$sql = "SELECT * FROM agreements WHERE status='pending' ORDER BY created_at DESC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Agreement Requests</title>
    <link rel="stylesheet" href="../CSS/dashboard.css">

    <style>
        body {
            background: #f1f5f9;
            font-family: "Segoe UI", Tahoma, sans-serif;
            padding: 20px;
        }

        h2 {
            margin-bottom: 20px;
            color: #1e293b;
        }

        .table-wrapper {
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.08);
            overflow: hidden;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table thead {
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            color: #ffffff;
        }

        .table th {
            padding: 14px;
            font-size: 14px;
            text-transform: uppercase;
        }

        .table td {
            padding: 14px;
            text-align: center;
            color: #334155;
            border-bottom: 1px solid #e2e8f0;
        }

        .table tbody tr:hover {
            background: #f8fafc;
        }

        .accept, .reject {
            border: none;
            padding: 8px 14px;
            border-radius: 20px;
            font-size: 13px;
            cursor: pointer;
            transition: 0.3s ease;
        }

        .accept {
            background: #22c55e;
            color: #ffffff;
        }

        .accept:hover {
            background: #16a34a;
            transform: scale(1.05);
        }

        .reject {
            background: #ef4444;
            color: #ffffff;
            margin-left: 6px;
        }

        .reject:hover {
            background: #dc2626;
            transform: scale(1.05);
        }

        .empty {
            padding: 30px;
            text-align: center;
            color: #64748b;
            font-style: italic;
        }
    </style>
</head>

<body>

<div class="layout">
    <?php include 'sidebar.php'; ?>

    <div class="content">
        <h2>🏠 Agreement Requests</h2>

        <div class="table-wrapper">
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Room</th>
                        <th>Rent</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                <?php if (mysqli_num_rows($result) > 0) { ?>
                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                        <tr id="row-<?php echo $row['id']; ?>">
                            <td><?php echo $row['user_name']; ?></td>
                            <td><?php echo $row['user_email']; ?></td>
                            <td><?php echo $row['apartment_no']; ?></td>
                            <td>৳<?php echo $row['rent']; ?></td>
                            <td>
                                <button class="accept"
                                    onclick="updateStatus(<?php echo $row['id']; ?>,'approved')">
                                    Accept
                                </button>
                                <button class="reject"
                                    onclick="updateStatus(<?php echo $row['id']; ?>,'rejected')">
                                    Reject
                                </button>
                            </td>
                        </tr>
                    <?php } ?>
                <?php } else { ?>
                    <tr>
                        <td colspan="5" class="empty">No pending agreement requests</td>
                    </tr>
                <?php } ?>

                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="../JS/Ajax.js"></script>
</body>
</html>
