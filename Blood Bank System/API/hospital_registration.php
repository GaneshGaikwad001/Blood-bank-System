<?php
include ("connect.php");
$hospitalName = $_POST["hospitalName"];
$address = $_POST["address"];
$email = $_POST["email"];
$password = $_POST["password"];
$Cpassword = $_POST["Cpassword"];

if ($password == $Cpassword) {
    $insert = mysqli_query($conn, "INSERT INTO hospital(hospitalName, address, email,password)
     VALUES('$hospitalName', '$address', '$email', '$password')");

    if ($insert) {
        echo '
        <script>
        alert("registration succesfully");
        window.location = "../Login/login1.html";
        </script>
        ';
    } else {
        echo '
        <script>
        alert("Some error occured");
        window.location = "../registration/hospital.html";
        </script>
        ';
    }
} else {
    echo '
    <script>
    alert("password not matched");
    window.location = "../registration/hospital.html";
    </script>
    ';
}
?>