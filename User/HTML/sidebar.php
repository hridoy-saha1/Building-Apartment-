<?php
$role = $_SESSION['role'] ?? '';
?>

<aside class="sidebar">
    <div class="logo">🏢 Dashboard</div>

    
    <a href="dashboard.php">🏠 Dashboard</a>

    <?php if ($role === 'admin'): ?>
        
        <a href="profile.php">👤 Profile</a>
        <a href="../../Admin/HTML/agreementRequest.php">📢 Agreement Request</a>
<<<<<<< HEAD
        <a href="manage-cupon.php">🎟 Manage Coupon</a>
        <a href="make-announcement.php">📄 Make Announcement</a>

    <?php elseif ($role === 'user'): ?>
        
        <a href="profile.php">👤 My Profile</a>
        <a href="make-payment.php">💳 Make Payment</a>
        <a href="payment-history.php">📄 Payment History</a>
        
=======
         <a href="/Web%20Tech%20Code/Building-Apartment/Admin/HTML/manage-cupon.php">🎟 Manage Coupon</a>
         <a href="/Web%20Tech%20Code/Building-Apartment/Admin/HTML/make-announcement.php">📄 Make Announcement</a>
        
    <?php elseif ($role === 'user'): ?>
        
        <a href="profile.php">👤 My Profile</a>
       
>>>>>>> 8fe480005f28ccfd07fb76b266a1c7184cc5e25e

 <?php elseif ($role === 'member'): ?>
     <a href="profile.php">👤 My Profile</a>
    <a href="/Web%20Tech%20Code/Building-Apartment/User/HTML/announcement.php">📢 Announcements</a>

        <a href="make-payment.php">💳 Make Payment</a>
        <a href="payment-history.php">📄 Payment History</a>
<<<<<<< HEAD
        
=======
        <a href="changePassword.php">Change Password</a>
>>>>>>> 8fe480005f28ccfd07fb76b266a1c7184cc5e25e


    <?php endif; ?>

    <div class="bottom">
        <a href="Home.php">⬅ Back to Home</a>
        <a href="Logout.php" class="logout">Logout</a>
    </div>
</aside>
