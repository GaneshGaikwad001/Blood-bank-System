<?php
include ("connect.php");
$receiverName = $_POST["receiverName"];
$mobile = $_POST["mobile"];
$email = $_POST["email"];
$address = $_POST["address"];
$bloodGroup = $_POST["bloodGroup"];
$password = $_POST["password"];
$Cpassword = $_POST["Cpassword"];

if ($password == $Cpassword) {
   $insert = mysqli_query($conn, "INSERT INTO receiver(receiverName, mobile, email, address, bloodGroup, password)
     VALUES('$receiverName', '$mobile', '$email', '$address','$bloodGroup', '$password')");

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
        window.location = "../registration/receiver.html";
        </script>
        ';
   }
} else {
   echo '
    <script>
    alert("password not matched");
    window.location = "../registration/receiver.html";
    </script>
    ';
}
?>