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

<div class="layout">

<?php include 'sidebar.php'; ?>

<main class="content">
    <div class="card">
        <h1>Welcome to Dashboard</h1>
        <p>Select an option from the left menu.</p>
    </div>
</main>

</div>

</body>
</html>
