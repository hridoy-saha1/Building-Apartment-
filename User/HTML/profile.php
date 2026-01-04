<?php
session_start();
include '../DB/db.php';

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

$email = $_SESSION['email'];
$sql = "SELECT name, email, role FROM users WHERE email='$email'";
$result = $conn->query($sql);
$user = $result->fetch_assoc();

$avatarLetter = strtoupper(substr($user['name'], 0, 1));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Profile</title>
    <link rel="stylesheet" href="../CSS/dashboard.css">
</head>
<body>

<div class="dashboard">

    
    <aside class="sidebar">
        <h2 class="logo">🏢 Dashboard</h2>
        <a href="profile.php" class="active">👤 My Profile</a>

        <span class="disabled">📢 Announcements</span>
        <span class="disabled">💳 Make Payment</span>
        <span class="disabled">📄 Payment History</span>

        <div class="bottom">
            <a href="Home.php">⬅ Back to Home</a>
            <a href="logout.php" class="logout">Logout</a>
        </div>
    </aside>

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

</body>
</html>
