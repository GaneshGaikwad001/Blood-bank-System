<?php
include ("connect.php");
session_start();

$email = $_POST['email'];
$password = $_POST['password'];
$check = mysqli_query($conn, "SELECT * FROM hospital WHERE email ='$email' AND password = '$password'");

if (mysqli_num_rows($check) > 0) {
    $userdata = mysqli_fetch_array($check);
    $_SESSION['userdata'] = $userdata;

    echo '
    <script>
    window.location = "../Hospital/dashboard.php";
    </script>
    ';
} else {
    echo '
    <script>
    alert("username and password are incorrect");
    window.location = "../Login/login1.html";
    </script>
    ';
}

?>