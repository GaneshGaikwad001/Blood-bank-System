<?php
include ("API/connect.php");
session_start();

if (isset ($_SESSION['userdata'])) {
    $buttonState = 'enabled';
} else {
    $buttonState = 'disabled';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, 
                    initial-scale=1.0">
    <title>Blood bank System</title>
    <link rel="stylesheet" href="index.css">
</head>

<body>
    <header>
        <h1 class="heading">Blood Bank System</h1>
    </header>
    <div class="menubar">
        <div class="topnav" id="myTopnav">
            <a href="index.php" class="active">Home</a>
            <a href="news.html">News</a>
            <a href="contact.html">Contact</a>
            <a href="about.html">About</a>
            <div class="dropdown">
                <button class="dropbtn">Register
                    <i class="fa fa-caret-down"></i>
                </button>
                <div class="dropdown-content">
                    <a href="registration/hospital.html">Hospital Registration</a>
                    <a href="registration/receiver.html">Receiver Registration</a>
                </div>
            </div>
            <a href="Login/login1.html">Login</a>
            <div>
                <?php if ($buttonState === 'enabled'): ?>
                    <button onclick="handleButtonClick()" class="logout"><a href="API/logout.php">Log Out</a></button>
                <?php endif; ?>
            </div>
            <a href="javascript:void(0);" class="icon" onclick="myFunction()">&#9776;</a>
        </div>
    </div>
    <div class="container1">
        <div class="image-container">
            <img src="Blood_bank_image.jpg" alt="Blood Bank Image">
        </div>
        <div class="content">
            <div class="head">
                <h1 id="h1">Welcome to Blood Bank</h1>
            </div>
            <h2 class="h2">About Us</h2>
            <p>Blood Bank Inc. is committed to saving lives through the provision of life-saving blood donations to
                communities in need. With a steadfast dedication to ensuring a stable blood supply, we tirelessly work
                to meet the demands of hospitals and patients across regions. Our team of skilled professionals upholds
                the highest standards of safety and efficiency in blood collection, processing, and distribution. At
                Blood Bank Inc., we strive to make a positive impact on public health by fostering awareness and
                education about the importance of blood donation and its vital role in saving lives</p>
            <h2 class="h2">Contact Us</h2>
            <p>Email: info@bloodbank.com<br> Phone: +1234567890</p>
        </div>
    </div>
    <div>
        <h1 id="h11">Blood Sample Available</h1>
    </div>
    <div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">sno</th>
                    <th scope="col">Hospital Name</th>
                    <th scope="col">bloodGroup</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Request For sample</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $fetchingData = mysqli_query($conn, "SELECT * FROM sample") or die (mysqli_error($conn));
                $isAnySampleAdded = mysqli_num_rows($fetchingData);

                if ($isAnySampleAdded > 0) {
                    $sno = 1;
                    while ($row = mysqli_fetch_assoc($fetchingData)) {
                        ?>
                        <tr>
                            <td>
                                <?php echo $sno++ ?>
                            </td>
                            <td>
                                <?php echo $row['hospitalName']; ?>
                            </td>
                            <td>
                                <?php echo $row['bloodGroup']; ?>
                            </td>
                            <td>
                                <?php echo $row['quantity']; ?>
                            </td>
                            <td>
                                <button
                                    style="margin-left:15px; padding:7px; color:white; border-radius:6px; background-color:red;"
                                    onclick="handleRequest('<?php echo $row['bloodGroup']; ?>')">Request
                                    Blood</button>
                            </td>
                        </tr>
                        <?php
                    }

                } else {
                    ?>
                    <h4>Not any Blood sample is available</h4>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </div>
    <script>
        function handleRequest(bloodGroup) {
            // Check if user is logged in
            var isLoggedIn = <?php echo json_encode(isset ($_SESSION['userdata'])); ?>;

            if (!isLoggedIn) {
                window.location.href = "Login/login1.html";
            } else {
                // Send AJAX request to check if user's blood group matches available blood group
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "check_blood_group.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            var response = xhr.responseText;
                            if (response === "success") {
                                window.location.href = "send_request.php";
                            } else if (response === "false") {
                                alert("Please request your blood group sample."); // Inform the user if blood groups don't match
                            } else {
                                console.error("Error: " + response); // Log an error if something unexpected happens
                            }
                        } else {
                            console.error("Error:", xhr.status); // Log an error if the request fails
                        }
                    }
                };
                xhr.send("bloodGroup=" + encodeURIComponent(bloodGroup));

            }
        }
    </script>
    <script src="index.js"></script>
</body>

</html>