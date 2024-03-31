<?php
include ("connect.php");
session_start();

$mobile = $_POST['mobile'];
$password = $_POST['password'];
$check = mysqli_query($conn, "SELECT * FROM receiver WHERE mobile ='$mobile' AND password = '$password'");

if (mysqli_num_rows($check) > 0) {
    $userdata = mysqli_fetch_array($check);
    $_SESSION['userdata'] = $userdata;

    echo '
    <script>
    window.location = "../index.php";
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