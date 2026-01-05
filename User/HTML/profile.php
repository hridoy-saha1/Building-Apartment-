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

<div class="card">
  <h2>👤 My Profile</h2>
  <div class="avatar"><?= strtoupper($user['name'][0]) ?></div>
  <p><strong>Name:</strong> <?= $user['name'] ?></p>
  <p><strong>Email:</strong> <?= $user['email'] ?></p>
  <p><strong>Role:</strong> <?= ucfirst($user['role']) ?></p>
</div>

</main>
<script src="../JS/dashboard.js"></script>
</body>
</html>
