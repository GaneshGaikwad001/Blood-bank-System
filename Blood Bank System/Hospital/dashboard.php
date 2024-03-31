<?php
include ("../API/connect.php");
session_start();

$email1 = $_SESSION['userdata']['email'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, 
                        initial-scale=1.0">
    <title>Blood bank System</title>
    <link rel="stylesheet" href="../index.css">
    <link rel="stylesheet" href="dashboard.css">
</head>

<body>
    <header>
        <h1 class="heading">Blood Bank System</h1>
    </header>
    <div class="menubar">
        <div class="topnav" id="myTopnav">
            <a href="dashboard.php" class="active">Home</a>
            <a href="view_request.php">View Request</a>
            <a href="../API/logout.php"
                style="margin: 5px 0px 5px 980px;background-color: rgb(253, 58, 9);padding:7px 12px; border-radius:10px; border: 1px rgb(228, 220, 220) solid;">Log
                Out</a>
            <a href="javascript:void(0);" class="icon" onclick="myFunction()">&#9776;</a>
        </div>
    </div>
    <div class="container">
        <h2>Add Blood Info</h2>
        <form action="add_sample.php" method="POST">
            <label for="blood_type">Blood Type:</label>
            <select id="bloodGroup" name="bloodGroup" required>
                <option value="A+">A+</option>
                <option value="A-">A-</option>
                <option value="B+">B+</option>
                <option value="B-">B-</option>
                <option value="AB+">AB+</option>
                <option value="AB-">AB-</option>
                <option value="O+">O+</option>
                <option value="O-">O-</option>
            </select>
            <label for="quantity">Quantity:</label>
            <input type="number" id="quantity" name="quantity" required>
            <button type="submit">Submit</button>
        </form>
    </div>
    <div>
        <h1>Blood Sample Available</h1>
    </div>
    <div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">sno</th>
                    <th scope="col">bloodGroup</th>
                    <th scope="col">Quantity</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $fetchingData = mysqli_query($conn, "SELECT * FROM sample WHERE email='$email1'") or die (mysqli_error($conn));
                $isAnyElectionAdded = mysqli_num_rows($fetchingData);

                if ($isAnyElectionAdded > 0) {
                    $sno = 1;
                    while ($row = mysqli_fetch_assoc($fetchingData)) {
                        $election_id = $row['id'];
                        ?>
                        <tr>
                            <td>
                                <?php echo $sno++ ?>
                            </td>
                            <td>
                                <?php echo $row['bloodGroup']; ?>
                            </td>
                            <td>
                                <?php echo $row['quantity']; ?>
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
    <script src="../index.js"></script>
</body>

</html>