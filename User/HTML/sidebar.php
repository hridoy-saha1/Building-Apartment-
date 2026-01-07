<?php
$role = $_SESSION['role'] ?? '';
?>

<aside class="sidebar">
    <div class="logo">🏢 Dashboard</div>

    
    <a href="dashboard.php">🏠 Dashboard</a>

    <?php if ($role === 'admin'): ?>
        
        <a href="profile.php">👤 Profile</a>
        <a href="../../Admin/HTML/agreementRequest.php">📢 Agreement Request</a>
         <a href="/Web%20Tech%20Code/Building-Apartment/User/HTML/manage-cupon.php">🎟 Manage Coupon</a>
         <a href="/Web%20Tech%20Code/Building-Apartment/Admin/HTML/make-announcement.php">📄 Make Announcement</a>

    <?php elseif ($role === 'user'): ?>
        
        <a href="profile.php">👤 My Profile</a>
       

 <?php elseif ($role === 'member'): ?>
     <a href="profile.php">👤 My Profile</a>
    <a href="/Web%20Tech%20Code/Building-Apartment/User/HTML/announcement.php">📢 Announcements</a>

        <a href="make-payment.php">💳 Make Payment</a>
        <a href="payment-history.php">📄 Payment History</a>


    <?php endif; ?>

    <div class="bottom">
        <a href="Home.php">⬅ Back to Home</a>
        <a href="Logout.php" class="logout">Logout</a>
    </div>
</aside>
