<?php
include ("../API/connect.php");
session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, 
                        initial-scale=1.0">
    <title>Blood bank System</title>
    <link rel="stylesheet" href="../index.css">
</head>

<body>
    <header>
        <h1 class="heading">Blood Bank System</h1>
    </header>
    <div class="menubar">
        <div class="topnav" id="myTopnav">
            <a href="dashboard.php">Home</a>
            <a href="view_request.php" class="active">View Request</a>
            <a href="../API/logout.php"
                style="margin-left: 980px;background-color: rgb(253, 58, 9); border-radius:10px; border: 1px rgb(228, 220, 220) solid;">Log
                Out</a>
            <a href="javascript:void(0);" class="icon" onclick="myFunction()">&#9776;</a>
        </div>
    </div>
    <div>
        <h1>Request Received</h1>
    </div>
    <div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">sno</th>
                    <th scope="col">Receiver Name</th>
                    <th scope="col">Mobile</th>
                    <th scope="col">Email</th>
                    <th scope="col">Address</th>
                    <th scope="col">Blood Group</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $fetchingData = mysqli_query($conn, "SELECT * FROM requestsample") or die (mysqli_error($conn));
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
                                <?php echo $row['receiverName']; ?>
                            </td>
                            <td>
                                <?php echo $row['mobile']; ?>
                            </td>
                            <td>
                                <?php echo $row['email']; ?>
                            </td>
                            <td>
                                <?php echo $row['address']; ?>
                            </td>
                            <td>
                                <?php echo $row['bloodGroup']; ?>
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