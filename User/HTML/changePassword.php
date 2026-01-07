<?php
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

$email = $_SESSION['email'];
include("../DB/db.php");

$message = "";
$type = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $old = $_POST['old_password'];
    $new = $_POST['new_password'];
    $confirm = $_POST['confirm_password'];

    if ($new != $confirm) {
        $message = "New password and confirm password do not match";
        $type = "error";
    }
    else if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z]).{6,}$/', $new)) {
        $message = "Password must contain uppercase, lowercase & 6+ characters";
        $type = "error";
    }
    else {

        $res = mysqli_query($conn, "SELECT password FROM users WHERE email='$email'");
        $user = mysqli_fetch_assoc($res);

        if (!password_verify($old, $user['password'])) {
            $message = "Old password incorrect";
            $type = "error";
        }
        else {
            $hash = password_hash($new, PASSWORD_DEFAULT);
            mysqli_query($conn, "UPDATE users SET password='$hash' WHERE email='$email'");
            $message = "Password changed successfully";
            $type = "success";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Change Password</title>

    <style>
        body{
            margin:0;
            height:100vh;
            display:flex;
            justify-content:center;
            align-items:center;
            font-family:Segoe UI, sans-serif;
        }

        .card{
            width:380px;
            background:#fff;
            padding:30px;
            border-radius:14px;
            box-shadow:0 15px 30px rgba(0,0,0,.15);
        }

        h3{
            text-align:center;
            margin-bottom:20px;
            color:#1e293b;
        }

        .input-group{
            margin-bottom:14px;
        }

        input{
            width:100%;
            padding:11px;
            border-radius:8px;
            border:1px solid #cbd5e1;
            font-size:14px;
        }

        button{
            width:100%;
            padding:12px;
            border:none;
            border-radius:8px;
            background:#2563eb;
            color:white;
            font-size:15px;
            cursor:pointer;
        }

        button:hover{
            background:#1e40af;
        }

        .msg{
            margin-bottom:15px;
            padding:10px;
            border-radius:8px;
            font-size:14px;
            text-align:center;
        }

        .success{
            background:#dcfce7;
            color:#166534;
            border:1px solid #bbf7d0;
        }

        .error{
            background:#fee2e2;
            color:#b91c1c;
            border:1px solid #fecaca;
        }

        .back{
            margin-top:15px;
            text-align:center;
        }

        .back a{
            color:#2563eb;
            text-decoration:none;
            font-size:14px;
        }
    </style>
</head>

<body>

<div class="card">

    <h3>🔐 Change Password</h3>

    <?php if ($message) { ?>
        <div class="msg <?= $type ?>">
            <?= $message ?>
        </div>
    <?php } ?>

    <form method="POST">

        <div class="input-group">
            <input type="password" name="old_password" placeholder="Old Password" required>
        </div>

        <div class="input-group">
            <input type="password" name="new_password" placeholder="New Password" required>
        </div>

        <div class="input-group">
            <input type="password" name="confirm_password" placeholder="Confirm New Password" required>
        </div>

        <button type="submit">Update Password</button>
    </form>

    <div class="back">
        <a href="dashboard.php">← Back to Dashboard</a>
    </div>

</div>

</body>
</html>
