<?php
include '../DB/db.php';

$min = isset($_GET['min']) ? (int)$_GET['min'] : '';
$max = isset($_GET['max']) ? (int)$_GET['max'] : '';


$sql = "SELECT * FROM apartments WHERE 1";

if ($min !== '') {
    $sql .= " AND rent >= $min";
}

if ($max !== '') {
    $sql .= " AND rent <= $max";
}

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
  <title>Appartments</title>
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
        <div class="card">
          <div class="image-box">
            <img src="<?php echo $apt['image']; ?>" alt="Apartment">
            <span class="rent">৳<?php echo $apt['rent']; ?></span>
          </div>

          <div class="card-body">
            <h3>Apt #<?php echo $apt['apartment_no']; ?></h3>
            <p>Floor: <?php echo $apt['floor']; ?></p>
            <p>Block: <?php echo $apt['block']; ?></p>

            <form method="POST" action="agreement.php">
              <input type="hidden" name="apartment_id"
                     value="<?php echo $apt['id']; ?>">
              <button class="apply-btn">Apply</button>
            </form>
          </div>
        </div>
      <?php } ?>

    <?php } else { ?>
      <p>No apartments found.</p>
    <?php } ?>

  </div>
</div>

</body>
</html>
