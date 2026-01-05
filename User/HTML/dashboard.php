<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

$role = $_SESSION['role'] ?? 'user';
$current = basename($_SERVER['PHP_SELF']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Dashboard</title>
<link rel="stylesheet" href="../CSS/dashboard.css">
</head>
<body>

<!-- Mobile Header -->
<div class="mobile-header">
  <h2>🏢 Dashboard</h2>
  <button id="menuBtn"><i class="fas fa-bars"></i></button>
</div>

<!-- Sidebar -->
<aside class="sidebar" id="sidebar">
  <h2 class="logo">🏢 Dashboard</h2>

  <nav>
    <a href="profile.php" class="<?= $current=='profile.php'?'active':'' ?>">
      <i class="fas fa-user"></i> My Profile
    </a>

    <a href="announcements.php" class="<?= $current=='announcements.php'?'active':'' ?>">
      <i class="fas fa-bullhorn"></i> Announcements
    </a>

    <?php if ($role === 'member'): ?>
      <a href="payment.php">
        <i class="fas fa-credit-card"></i> Make Payment
      </a>
    <?php endif; ?>

    <?php if ($role === 'admin'): ?>
      <a href="manage-members.php"><i class="fas fa-users"></i> Manage Members</a>
      <a href="agreements.php"><i class="fas fa-home"></i> Agreement Requests</a>
      <a href="coupons.php"><i class="fas fa-money-bill-wave"></i> Manage Coupons</a>
    <?php endif; ?>
  </nav>

  <div class="sidebar-bottom">
    <a href="home.php"><i class="fas fa-arrow-left"></i> Back to Home</a>
    <a href="logout.php" class="logout">Logout</a>
  </div>
</aside>

<div class="overlay" id="overlay"></div>

<!-- Main -->
<main class="content">
