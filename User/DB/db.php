<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "building-mannegement";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

function emailExists($conn, $email) {
    $sql = "SELECT id FROM users WHERE email='$email'";
    $res = mysqli_query($conn, $sql);
    return ($res && mysqli_num_rows($res) > 0);
}


function registerUser($conn, $name, $email, $photo, $password) {
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO users (name, email, photo, password)
            VALUES ('$name','$email','$photo','$hash')";
    return mysqli_query($conn, $sql);
}

function logInUserByEmail($conn, $email) {

    $sql = "SELECT * FROM users WHERE email='$email' LIMIT 1";
    return mysqli_query($conn, $sql);
}



function getPaymentHistory($conn, $userEmail) {

    $sql = "SELECT * FROM payments 
            WHERE user_email='$userEmail' 
            ORDER BY paid_at DESC";

    return mysqli_query($conn, $sql);
}


function showApartment($conn, $min = null, $max = null){
    $sql = "SELECT * FROM apartments WHERE status='available'";

if ($min !== null) {
    $sql .= " AND rent >= $min";
}

if ($max !== null) {
    $sql .= " AND rent <= $max";
}

return mysqli_query($conn, $sql);
}






function paymentFilled($conn, $userEmail){
$sql = "SELECT * FROM agreements 
        WHERE user_email='$userEmail' 
        AND status='approved' 
        LIMIT 1";

return mysqli_query($conn, $sql);


}