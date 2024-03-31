<?php
include ("../API/connect.php");
session_start();

$email = $_SESSION['userdata']['email'];
$bloodGroup = $_POST["bloodGroup"];
$quantity = $_POST["quantity"];

$fetchingData = mysqli_query($conn, "SELECT * FROM hospital WHERE email='$email'") or die (mysqli_error($conn));
$row = mysqli_fetch_assoc($fetchingData);
$hospitalName = $row['hospitalName'];

$insert = mysqli_query($conn, "INSERT INTO sample(hospitalName, email, bloodGroup, quantity)
VALUES('$hospitalName', '$email', '$bloodGroup', '$quantity')");

if ($insert) {
    echo '
    <script>
    alert("Add Sample Successfully");
    window.location = "dashboard.php";
    </script>
    ';
} else {
    echo '
    <script>
    alert("Some error occured");
    window.location = "dashboard.php";
    </script>
    ';
}

?>