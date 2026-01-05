<?php
session_start();
require_once '../DB/db.php';
include 'dashboard_layout.php';

$email = $_SESSION['email'];
$stmt = $conn->prepare("SELECT name,email,role FROM users WHERE email=?");
$stmt->bind_param("s",$email);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Profile</title>

  
    <link rel="stylesheet" href="../CSS/dashboard.css">
    <link rel="stylesheet" href="../CSS/profile.css">
</head>
<body>

<div class="layout">

    <?php include 'sidebar.php'; ?>

    <main class="content">
        <div class="profile-card">
            <h2>👤 My Profile</h2>

            <div class="avatar"><?= $avatarLetter ?></div>

            <p><strong>Name:</strong> <?= $user['name'] ?></p>
            <p><strong>Email:</strong> <?= $user['email'] ?></p>
            <p><strong>Phone:</strong> Not Provided</p>
            <p><strong>Role:</strong> <?= ucfirst($user['role']) ?></p>
        </div>
    </main>

</div>

</main>
<script src="../JS/dashboard.js"></script>
</body>
</html>
