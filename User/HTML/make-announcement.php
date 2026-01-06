<?php
session_start();
include '../DB/db.php';

if (!isset($_SESSION['email']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

$success = "";

/* ===== Add Announcement ===== */
if (isset($_POST['publish'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];

    $sql = "INSERT INTO announcements (title, description)
            VALUES ('$title', '$description')";

    if ($conn->query($sql)) {
        $success = "✅ Announcement successfully delivered";
    }
}

/* ===== Delete Announcement ===== */
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM announcements WHERE id = $id");
}

/* ===== Fetch Announcements ===== */
$result = $conn->query(
    "SELECT * FROM announcements ORDER BY createdAt DESC"
);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Make Announcement</title>

    <link rel="stylesheet" href="../CSS/dashboard.css">
    <link rel="stylesheet" href="../CSS/make-anouncement.css">
    <link rel="stylesheet" href="../CSS/announcement.css">
</head>
<body>

<div class="layout">
<?php include 'sidebar.php'; ?>

<main class="content">

    <div class="page-header">
        <h1>📢 Make Announcement</h1>
        <p>Notify residents with important updates</p>
    </div>

    <!-- Create Announcement -->
    <div class="card">
        <h3>Create New Announcement</h3>

        <?php
        if ($success) {
            echo "<div class='success-msg'>$success</div>";
        }
        ?>

        <form method="POST" class="announcement-form">

            <div class="form-group">
                <label>Title</label>
                <input type="text" name="title"
                       placeholder="Write announcement title" required>
            </div>

            <div class="form-group">
                <label>Description</label>
                <textarea name="description" rows="5"
                          placeholder="Write announcement details..."
                          required></textarea>
            </div>

            <button type="submit" name="publish">
                📤 Publish Announcement
            </button>

        </form>
    </div>

    <!-- Show Announcements -->
    <h2 style="margin-top:40px;">📋 Previous Announcements</h2>

    <?php
    if ($result->num_rows > 0) {

        while ($row = $result->fetch_assoc()) {

            echo "<div class='announcement-card'>";

            echo "<h3>{$row['title']}</h3>";

            echo "<p class='date'>" .
                 date("d M Y, h:i A", strtotime($row['createdAt'])) .
                 "</p>";

            echo "<p class='description'>{$row['description']}</p>";

            echo "<a class='delete-btn'
                   href='make-announcement.php?delete={$row['id']}'
                   onclick=\"return confirm('Are you sure you want to delete?')\">
                   🗑 Delete
                   </a>";

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
