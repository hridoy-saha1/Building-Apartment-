<?php
include '../DB/db.php';

$query = "SELECT * FROM apartments";
$result = mysqli_query($conn, $query);
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
  <h2>Available Appartments</h2>

  <div class="grid">

    <?php while ($apt = mysqli_fetch_assoc($result)) { ?>

      <div class="card">
        <div class="image-box">
            <img src="<?php echo $apt['image']; ?>" alt="Apartment">

          <span class="rent">Rent: ৳<?php echo $apt['rent']; ?></span>
        </div>

        <div class="card-body">
          <h3>Apt #<?php echo $apt['apartment_no']; ?></h3>
          <p>Floor: <?php echo $apt['floor']; ?></p>
          <p>Block: <?php echo $apt['block']; ?></p>

          <form method="POST" action="agreement.php">
            <input type="hidden" name="apartment_id" value="<?php echo $apt['id']; ?>">
            <button class="apply-btn">
              Apply for Agreement
            </button>
          </form>
        </div>
      </div>

    <?php } ?>

  </div>
</div>

</body>
</html>
