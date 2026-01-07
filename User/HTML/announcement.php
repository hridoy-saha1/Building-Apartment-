<?php
session_start();
include '../DB/db.php';

if (!isset($_SESSION['email']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}





$sql = "SELECT * FROM announcements ORDER BY createdAt DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Announcements</title>

    <link rel="stylesheet" href="../CSS/dashboard.css">
    <link rel="stylesheet" href="../CSS/announcement.css">
</head>
<body>

<div class="layout">

<?php include 'sidebar.php'; ?>

<main class="content">

    <?php
    if ($result->num_rows > 0) {

        while ($row = $result->fetch_assoc()) {

            echo "<div class='announcement-card'>";

            echo "<h3>" . $row['title'] . "</h3>";

            echo "<p class='date'>" .
                 date("d M Y, h:i A", strtotime($row['createdAt'])) .
                 "</p>";

            echo "<p class='description'>" . $row['description'] . "</p>";

           

            echo "</div>";
        }

    } else {
        echo "<p>No announcements found.</p>";
    }
    ?>

</main>

</div>

</body>
</html>
