<?php
include ("API/connect.php");
session_start();

$mobile1 = $_SESSION['userdata']['mobile'];
$check = mysqli_query($conn, "SELECT * FROM receiver WHERE mobile ='$mobile1'");

if (mysqli_num_rows($check) > 0) {
    $requestdata = mysqli_fetch_array($check);

    $check1 = mysqli_query($conn, "INSERT INTO requestsample(receiverName, mobile, email, address, bloodGroup)
        SELECT receiverName, mobile, email, address, bloodGroup
        FROM receiver
        WHERE mobile = '$mobile1'");

    echo '
        <script>
        alert("Request send Successfully");
        window.location = "index.php";
        </script>
        ';
} else {
    echo '
        <script>
        alert("Something went wrong! please try again later");
        window.location = "index.php";
        </script>
        ';
}
?>