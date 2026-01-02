<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Navbar</title>
    <link rel="stylesheet" href="../CSS/navbar.css">
</head>
<body>

<nav class="navbar">
    <div class="nav-container">

        <div class="logo">
            <img src="../Image/logo.jpg" alt="Logo">
            <span style="color: #e0d9d9;" >OneBuilding</span>
        </div>

        <div class="nav-links">
            <?php if (!isset($_SESSION['user_id'])) { ?>
                <a href="Home.php">Home</a>
                <a href="Appartment.php">Apartments</a>
                <a href="Login.php">Login / Register</a>
            <?php } else { ?>
                <a href="Home.php">Home</a>
                <a href="Appartment.php">Apartments</a>
                <a href="Dashboard.php">Dashboard</a>

                
                <div class="dropdown">
                    <img src="<?php echo $_SESSION['photo'] ?? 'https://i.ibb.co/2kR9YQZ/default.png'; ?>" class="avatar">
                    <div class="dropdown-menu">
                        <p class="username"><?php echo $_SESSION['name']; ?></p>
                        <a href="Profile.php">Profile</a>
                        <a href="Logout.php" class="logout">Logout</a>
                    </div>
                </div>
            <?php } ?>
        </div>

        <div class="menu-toggle" onclick="toggleMenu()">☰</div>
    </div>

    <div class="mobile-menu" id="mobileMenu">
        <?php if (!isset($_SESSION['user_id'])) { ?>
            <a href="Home.php">Home</a>
            <a href="Appartment.php">Apartments</a>
            <a href="Login.php">Login / Register</a>
        <?php } else { ?>
            <a href="Home.php">Home</a>
            <a href="Appartment.php">Apartments</a>
            <a href="Dashboard.php">Dashboard</a>
            <a href="Profile.php">Profile</a>
            <a href="Logout.php" class="logout">Logout</a>
        <?php } ?>
    </div>
</nav>

<script>
function toggleMenu() {
    document.getElementById("mobileMenu").classList.toggle("show");
}
</script>

</body>
</html>
