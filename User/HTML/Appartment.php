<?php
session_start();
include '../DB/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$userEmail = $_SESSION['email'];

$min = isset($_GET['min']) && $_GET['min'] !== '' ? (int)$_GET['min'] : null;
$max = isset($_GET['max']) && $_GET['max'] !== '' ? (int)$_GET['max'] : null;

$sql = "SELECT * FROM apartments WHERE status='available'";

if ($min !== null) {
    $sql .= " AND rent >= $min";
}

if ($max !== null) {
    $sql .= " AND rent <= $max";
}

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Apartments</title>
    <link rel="stylesheet" href="../CSS/appartment.css">
</head>
<body>

<?php include 'Navbar.php'; ?>

<div class="container">

    <form method="GET" class="search-box">
        <input type="number" name="min" placeholder="Min Rent"
               value="<?php echo $_GET['min'] ?? ''; ?>">
        <input type="number" name="max" placeholder="Max Rent"
               value="<?php echo $_GET['max'] ?? ''; ?>">
        <button type="submit">Search</button>
    </form>

    <div class="grid">

        <?php if (mysqli_num_rows($result) > 0) { ?>

            <?php while ($apt = mysqli_fetch_assoc($result)) { ?>

                <?php
               
                $checkSql = "SELECT id FROM agreements
                             WHERE user_email = '$userEmail'
                             AND apartment_no = '{$apt['apartment_no']}'";
                $checkRes = mysqli_query($conn, $checkSql);
                $alreadyApplied = mysqli_num_rows($checkRes) > 0;
                ?>

                <div class="card">
                    <div class="image-box">
                        <img src="<?php echo $apt['image']; ?>" alt="Apartment">
                        <span class="rent">৳<?php echo $apt['rent']; ?></span>
                    </div>

                    <div class="card-body">
                        <h3>Apt #<?php echo $apt['apartment_no']; ?></h3>
                        <p>Floor: <?php echo $apt['floor']; ?></p>
                        <p>Block: <?php echo $apt['block']; ?></p>

                       
                        <button
                            class="apply-btn"
                            onclick="applyAgreement(<?php echo $apt['id']; ?>, this)"
                            <?php if ($alreadyApplied) echo 'disabled'; ?>
                        >
                            <?php echo $alreadyApplied ? 'Applied' : 'Apply'; ?>
                        </button>

                        <div class="ajax-msg"></div>
                    </div>
                </div>

            <?php } ?>

        <?php } else { ?>
            <p>No apartments found.</p>
        <?php } ?>

    </div>
</div>

<script src="../JS/Ajax.js"></script>

</body>
</html>
