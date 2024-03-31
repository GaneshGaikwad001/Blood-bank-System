<?php
include ("/API/connect.php");
session_start();

$mobile1 = $_SESSION['userdata']['mobile'];

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset ($_POST['bloodGroup'])) {
    $availableBloodGroup = $_POST['bloodGroup'];

    // Fetch available blood group from the database
    $query = "SELECT * FROM receiver WHERE mobile ='$mobile1'"; // Assuming there's only one blood group available
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $userBloodGroup = $row['bloodGroup'];

        if ($availableBloodGroup === $userBloodGroup) {
            echo "success";
        } else {
            // Blood groups don't match
            echo "false";
        }
    } else {
        // No blood group available
        echo "error";
    }
} else {
    echo "error";
}
?>