<!DOCTYPE html>
<html lang="en">
<head>
  <title>Login</title>
  <link rel="stylesheet" href="../CSS/login.css">
 
</head>


<?php 
session_start();
 include '../DB/db.php';
  $error = '';

  
 if($_SERVER['REQUEST_METHOD'] == 'POST'){

     $email = $_POST['email'];  
     $password = $_POST['password'];
     
     if (empty($email) || empty($password)){    
        $error = 'Fill All Filed';
 }
 else{

     $sql = "SELECT * FROM users WHERE email='$email'";
     $result = $conn->query($sql);
     if($result->num_rows > 0){ 
        $user = $result->fetch_assoc();
      if(password_verify($password,$user["password"])){
                
                $_SESSION['name']    = $user['name'];
                $_SESSION['email']   = $user['email'];
                $_SESSION['photo']   = $user['photo'];
                $_SESSION['role']    = $user['role'];
                $_SESSION['user_id'] = $user['id'];  
          header("Location: Home.php");
                exit;
     }
     else{
        $error = "Invalid Password";
     }

    }
    else{
        $error="Invalid Email"; 

    }
}
 }


?>







<body>

<div class="page">
  <div class="login-box">
    <h2>Welcome Back</h2>

    <form method="POST" action="login.php">
      <div class="form-group">
        <label>Email</label>
        <input type="email" name="email" placeholder="example@mail.com" required>
      </div>

      <div class="form-group">
        <label>Password</label>
        <input type="password" name="password" placeholder="••••••" required>
      </div>

      <button type="submit" class="btn-primary">Login</button>
    </form>

    <div class="divider">
      <span>OR</span>
    </div>


    <p class="footer-text">
      Don't have an account?
      <a href="register.php">Register</a>
    </p>
  </div>
</div>

</body>
</html>
