<!DOCTYPE html>
<html lang="en">

<?php
include '../DB/db.php';

$error = $nameerror = $emailerror = $errorPass = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name     = $_POST['name'];
    $email    = $_POST['email'];
    $photo    = $_POST['photo'];
    $password = $_POST['password'];

    if (empty($name) || empty($email) || empty($photo) || empty($password)) {
        $error = "Please Fill All Field";
    }
    elseif (!preg_match("/^[a-zA-Z ]*$/", $name)) {
        $nameerror = "Only Letter And White space Allowed";
    }
    elseif (!preg_match('/^(?=.*[a-z])(?=.*[A-Z]).{6,}$/', $password)) {
        $errorPass = "Password must contain uppercase, lowercase and be at least 6 characters";
    }
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailerror = "Enter Valid Email";
    }
    elseif (emailExists($conn, $email)) {
        $emailerror = "This email is already registered";
    }
    else {
        if (registerUser($conn, $name, $email, $photo, $password)) {
            header("Location: Login.php");
            exit();
        } else {
            $error = "Registration failed";
        }
    }
}
?>




<head>
    <title>Register</title>
    <link rel="stylesheet" href="../CSS/register.css">
</head>

<body>

    <div class="page">
        <div class="register-box">

            <h2>Create an Account</h2>

            <form method="POST" action="register.php">

                <div class="form-group">
                    <label>Full Name</label>
                    <input type="text" name="name" >
                    <?php if (!empty($nameerror)) { ?>
                    <p style="color:red;"><?php echo $nameerror; ?></p>
                <?php } ?>
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" required>
                      <?php if (!empty($emailerror)) { ?>
                    <p style="color:red;"><?php echo $emailerror; ?></p>
                <?php } ?>
                </div>

                <div class="form-group">
                    <label>Photo URL</label>
                    <input type="text" name="photo" placeholder="https://...">
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" required>
                    <small>
                        Must contain uppercase, lowercase, and be at least 6 characters.
                    </small>
                    <?php if (!empty($errorPass)) { ?>
                    <p style="color:red;"><?php echo $errorPass; ?></p>
                <?php } ?>
                </div>

                <?php if (!empty($error)) { ?>
                    <p style="color:red;"><?php echo $error; ?></p>
                <?php } ?>

                <button type="submit" class="btn-primary">
                    Register
                </button>

            </form>

            <p class="footer-text">
                Already have an account?
                <a href="Login.php">Login</a>
            </p>

        </div>
    </div>

</body>

</html>