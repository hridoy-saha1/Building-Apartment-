<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../CSS/dashboard.css">
</head>
<body>

<div class="dashboard">

   
    <aside class="sidebar">
        <h2 class="logo">🏢 Dashboard</h2>

        <a href="profile.php" class="active">👤 My Profile</a>

        
        <span class="disabled">📢 Announcements (Coming Soon)</span>
        <span class="disabled">💳 Make Payment (Coming Soon)</span>
        <span class="disabled">📄 Payment History (Coming Soon)</span>

        <div class="bottom">
            <a href="Home.php">⬅ Back to Home</a>
            <a href="logout.php" class="logout">Logout</a>
        </div>
    </aside>

   
    <main class="content">
        <h1>Welcome to your Dashboard</h1>
        <p>Select <strong>My Profile</strong> to view your information.</p>
    </main>

</div>

</body>
</html>
