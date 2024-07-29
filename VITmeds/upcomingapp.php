<?php
session_start();
if (!isset($_SESSION['log'])) {
    echo '<script>alert("Unauthorized Access!")</script>';
    header("Location: index.html");
    exit;
}
$reg = $_GET['reg'];
$servername = "sql6.freesqldatabase.com";
$username = "sql6701824";
$pwd = "";
$dbname = "sql6701824";

$conn = mysqli_connect($servername, $username, $pwd, $dbname);
$sql="SELECT * from profile where reg_no='$reg'";
$result = mysqli_query($conn, $sql);
$row=mysqli_fetch_assoc($result);
$gender=$row["gender"];
$sql = "SELECT appoint_ID,date_schedule,time_allot, disease, registration_no FROM appointment a,profile p WHERE a.registration_no=p.reg_no and gender='$gender' and U_C='U'";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- Boxicons CSS -->
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <title>VITmeds - Upcoming Appointments</title>
    <link rel="icon" type="image/x-icon" href="assets/favicon.jpg">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/administrator.css" />
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        .container {
            background-image: linear-gradient(120deg, #e0c3fc 0%, #8ec5fc 100%);
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow-y: auto;
            /* Adding vertical scroll bar */
            max-height: 350px;
            /* Adding max-height to prevent the container from expanding infinitely */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        button {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <!-- navbar -->
    <nav class="navbar">
        <div class="logo_item">
            <i class="bx bx-menu" id="sidebarOpen"></i>
            <img src="assets/logo.jpg" alt="">
        </div>
    </nav>


    <div class="container" style="margin-top:100px;">
        <h2>
            <center>Upcoming Appointments</center>
        </h2>
        <?php
        if (mysqli_num_rows($result) > 0) { ?>
            <table style="margin-bottom:40px;margin-top:20px;">
                <tr class="form-group">
                    <th>Appointment ID</th>
                    <th>Patient ID</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Disease</th>
                    <th>Prescription</th>
                </tr>
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                    $a_id = $row["appoint_ID"];
                    $date = $row["date_schedule"];
                    $time = $row["time_allot"];
                    $disease = $row["disease"];
                    $reg_no = $row["registration_no"];
                ?>
                    <tr>
                        <td><?php echo $a_id; ?></td>
                        <td><?php echo $reg_no; ?></td>
                        <td><?php echo $date; ?></td>
                        <td><?php echo $time; ?></td>
                        <td><?php echo $disease; ?></td>
                        <td><a href="editprescription.php?mode=add&reg=<?php echo $reg; ?>&aid=<?php echo $a_id;?>" style="color: blue;text-decoration:none;background:yellow;padding:4px;border-radius:15px;">Generate</a></td>
                    </tr>
                <?php        } ?>
            </table><?php
                } else {?>
                <br><br><br><center><h5>No Appointments Found !</h5><center><br><br><br><?php
                }

                    ?>
    </div>

    <footer class="footer">
        <img src="assets/logo.jpg" alt="" width="200" height="50" style="margin-top: 20px; margin-bottom:20px; margin-left:200px;">

        <p style="text-align: center; background-color:#27c0eb;margin-bottom:0px;"> For support, mail us at: <a href="mailto:support@vitbhopal.ac.in">support@vitbhopal.ac.in</a></p>


    </footer>

</body>

</html>
