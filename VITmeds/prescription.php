<?php
session_start();
if (!isset($_SESSION['log'])) {
    echo '<script>alert("Unauthorized Access!")</script>';
    header("Location: index.html");
    exit;
}
$reg = $_GET['reg'];
$aid = $_GET['aid'];
$servername = "sql6.freesqldatabase.com";
$username = "sql6701824";
$pwd = "";
$dbname = "sql6701824";

$conn = mysqli_connect($servername, $username, $pwd, $dbname);
$sql1 = "SELECT * FROM appointment WHERE appoint_ID='$aid'";
$sql2 = "SELECT * FROM prescriptions WHERE appointment_id='$aid'";
$result = mysqli_query($conn, $sql1);
$row = mysqli_fetch_assoc($result);
$date = $row["date_schedule"];
$time = $row["time_allot"];
$disease = $row["disease"];
$result = mysqli_query($conn, $sql2);
$row = mysqli_fetch_assoc($result);
$pid = $row["prescription_ID"];
$prescription = $row["Prescription"];
$doctor = $row["Doctor"];
$remark = $row["Remarks"];
$sql = "SELECT * FROM profile WHERE reg_no='$reg'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$name = $row["name"];
$age = $row["age"];
$gender = $row["gender"];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- Boxicons CSS -->
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <title>VITmeds - Prescription</title>
    <link rel="icon" type="image/x-icon" href="assets/favicon.jpg">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/administrator.css" />
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        .container2 {
            max-width: 800px;
            margin: 20px auto;
            background-color: #fff;
            margin-top: 100px;
            overflow-y: auto;
            max-height: 350px;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
        }

        .hospital-name {
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .address {
            text-align: center;
            font-style: italic;
            margin-bottom: 20px;
        }

        .prescription-details {
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        .download-btn,
        .print-btn {
            display: block;
            margin: 10px auto;
            margin-top: 30px;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            text-align: center;
            text-decoration: none;
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
    <header class="header">
        <nav class="navbar">
            <div class="logo_item">
                <i class="bx bx-menu" id="sidebarOpen"></i>
                <img src="assets/logo.jpg" alt="">
            </div>
        </nav>
    </header>

    <div class="container2" id="container2">

        <div class="hospital-name">
            <img src="assets/logo.jpg" style="width:25%;">
        </div>

        <div class="address">
            VIT Bhopal University, Kothri Kalan, Sehore, MP
        </div>

        <div class="prescription-details">
            <table>
                <tr>
                    <th>Prescription ID</th>
                    <td id="prescription-id"><?php echo $pid; ?></td>
                    <th>Appointment ID</th>
                    <td id="prescription-id"><?php echo $aid; ?></td>
                </tr>
                <tr>
                    <th>Patient ID</th>
                    <td id="patient-id"><?php echo $reg; ?></td>
                    <th>Patient's Name</th>
                    <td id="patient-name"><?php echo $name; ?></td>
                </tr>
                <tr>
                    <th>Age</th>
                    <td id="age"><?php echo $age; ?></td>
                    <th>Gender</th>
                    <td id="gender"><?php echo $gender; ?></td>
                </tr>
                <tr>
                    <th>Doctor's Name</th>
                    <td id="doctor-name" colspan="3"><?php echo $doctor; ?></td>
                </tr>
                <tr>
                    <th>Disease</th>
                    <td colspan="3" id="disease"><?php echo $disease; ?></td>
                </tr>
                <tr>
                    <th>Medicines</th>
                    <td id="medicines" colspan="3"><?php echo $prescription; ?></td>
                </tr>
                <tr>
                    <th>Remarks</th>
                    <td id="description" colspan="3"><?php echo $remark; ?></td>
                </tr>
            </table>
            <button id="printBtn" class="print-btn">Print Prescription</button>
        </div>
    </div>
    <script>
        document.getElementById("printBtn").addEventListener("click", function() {
            var contentToPrint = document.getElementById("container2").innerHTML;
            var originalContent = document.body.innerHTML;

            document.body.innerHTML = contentToPrint;

            window.print();

            document.body.innerHTML = originalContent;
        });
    </script>

    <footer class="footer">
        <img src="assets/logo.jpg" alt="" width="200" height="50" style="margin-top: 20px; margin-bottom:20px; margin-left:200px;">

        <p style="text-align: center; background-color:#27c0eb;margin-bottom:0px;"> For support, mail us at: <a href="mailto:support@vitbhopal.ac.in">support@vitbhopal.ac.in</a></p>


    </footer>

</body>

</html>
