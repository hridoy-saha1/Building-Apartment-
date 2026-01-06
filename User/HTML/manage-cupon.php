<?php
session_start();
include '../DB/db.php';

if (!isset($_SESSION['email']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

if (isset($_POST['add_coupon'])) {
    $code = $_POST['code'];
    $discount = $_POST['discount'];
    $description = $_POST['description'];

    $conn->query("INSERT INTO coupons (code, discount, description, available)
                  VALUES ('$code', '$discount', '$description', 1)");
}

if (isset($_GET['toggle'])) {
    $id = $_GET['toggle'];
    $conn->query("UPDATE coupons SET available = IF(available=1,0,1) WHERE id=$id");
}

$result = $conn->query("SELECT * FROM coupons ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Coupons</title>

    <link rel="stylesheet" href="../CSS/dashboard.css">
    <link rel="stylesheet" href="../CSS/manage-cupon.css">
</head>
<body>

<div class="layout">

    <?php include 'sidebar.php'; ?>

    <main class="content">

        <div class="page-header">
            <h1>🎟 Manage Coupons</h1>
            <p>Create, activate or deactivate coupons</p>
        </div>

        <div class="card add-card">
            <h3>Add New Coupon</h3>

            <form method="POST" class="coupon-form">
                <div class="form-group">
                    <label>Coupon Code</label>
                    <input type="text" name="code" placeholder="e.g. NEW20" required>
                </div>

                <div class="form-group">
                    <label>Discount (%)</label>
                    <input type="number" name="discount" placeholder="e.g. 20" required>
                </div>

                <div class="form-group">
                    <label>Description</label>
                    <input type="text" name="description" placeholder="New member offer" required>
                </div>

                <div class="btn-group form-group">
                    <button type="submit" name="add_coupon">+ Add Coupon</button>
                </div>
            </form>
        </div>

        <div class="table-card card">
            <h3>Coupon List</h3>

            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>Code</th>
                            <th>Discount</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                    <?php while ($row = $result->fetch_assoc()) { ?>
                        <tr>
                            <td><strong><?= $row['code'] ?></strong></td>
                            <td><?= $row['discount'] ?>%</td>
                            <td><?= $row['description'] ?></td>
                            <td>
                                <span class="status <?= $row['available'] ? 'active' : 'inactive' ?>">
                                    <?= $row['available'] ? 'Available' : 'Unavailable' ?>
                                </span>
                            </td>
                            <td>
                                <a href="?toggle=<?= $row['id'] ?>"
                                   class="btn <?= $row['available'] ? 'danger' : 'success' ?>">
                                   <?= $row['available'] ? 'Deactivate' : 'Activate' ?>
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

    </main>
</div>

</body>
</html>
