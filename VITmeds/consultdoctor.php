<?php
session_start();
if (!isset($_SESSION['log'])) {
    echo '<script>alert("Unauthorized Access!")</script>';
    header("Location: index.html");
    exit;
}
$reg_no = $_GET['reg'];
$mode = $_GET['mode'];
if ($mode == "student") {
    $reg = "Registration No.";
} elseif ($mode == "faculty") {
    $reg = "Faculty ID";
} elseif ($mode == "pc") {
    $reg = "Faculty ID";
} elseif ($mode == "supervisor") {
    $reg = "Warden ID";
} elseif ($mode == "doctor") {
    $reg = "Doctor ID";
}
$servername = "sql6.freesqldatabase.com";
$username = "sql6701824";
$pwd = "";
$dbname = "sql6701824";
$conn = mysqli_connect($servername, $username, $pwd, $dbname);
$sql="SELECT * from profile where reg_no='$reg_no'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_row($result);
$gender=$row[4];

$current_time = time();
$future_time = strtotime('+3 hours 30 minutes', $current_time);
$time = date("H:i:s", $future_time);


if($time>"00:00:00" && $time<"03:30:00"){
    $x=date("Fj", strtotime("+1 day"));
    $today=date("F j", strtotime("+1 day"));    
    $y=date("Fj", strtotime("+2 day"));
    $tomm=date("F j", strtotime("+2 day"));    
}else{
    $x=date("Fj");
$today=date("F j");
$y=date("Fj", strtotime("+1 day"));
$tomm=date("F j", strtotime("+1 day"));

}

if($gender=="Male"){
    $sql = "SHOW COLUMNS FROM doctor_slot LIKE '$x'";
    $result = mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($result) > 0) {
        $sql = "SELECT slot FROM doctor_slot WHERE $x='Free' and slot>'$time'";
        $result1 = mysqli_query($conn, $sql);
    } else {
        $alter_query = "ALTER TABLE doctor_slot ADD COLUMN $x VARCHAR(10) DEFAULT 'Free'";
        mysqli_query($conn, $alter_query);
        $update_query = "UPDATE doctor_slot SET $x = 'Free'";
        mysqli_query($conn, $update_query);
        $sql = "SELECT slot FROM doctor_slot WHERE $x='Free'";
        $result1 = mysqli_query($conn, $sql);
    }
    $sql = "SHOW COLUMNS FROM doctor_slot LIKE '$y'";
    $result = mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($result) > 0) {
        $sql = "SELECT slot FROM doctor_slot WHERE $y='Free'";
        $result2 = mysqli_query($conn, $sql);
    } else {
        $alter_query = "ALTER TABLE doctor_slot ADD COLUMN $y VARCHAR(10) DEFAULT 'Free'";
        mysqli_query($conn, $alter_query);
        $update_query = "UPDATE doctor_slot SET $y = 'Free'";
        mysqli_query($conn, $update_query);
        $sql = "SELECT slot FROM doctor_slot WHERE $y='Free'";
        $result2 = mysqli_query($conn, $sql);
    }
    
}
else{
    $sql = "SHOW COLUMNS FROM female_doctor_slot LIKE '$x'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $sql = "SELECT slot FROM female_doctor_slot WHERE $x='Free' and slot>'$time'";
    $result1 = mysqli_query($conn, $sql);
} else {
    $alter_query = "ALTER TABLE female_doctor_slot ADD COLUMN $x VARCHAR(10) DEFAULT 'Free'";
    mysqli_query($conn, $alter_query);
    $update_query = "UPDATE female_doctor_slot SET $x = 'Free'";
    mysqli_query($conn, $update_query);
    $sql = "SELECT slot FROM female_doctor_slot WHERE $x='Free'";
    $result1 = mysqli_query($conn, $sql);
}
$sql = "SHOW COLUMNS FROM female_doctor_slot LIKE '$y'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $sql = "SELECT slot FROM female_doctor_slot WHERE $y='Free'";
    $result2 = mysqli_query($conn, $sql);
} else {
    $alter_query = "ALTER TABLE female_doctor_slot ADD COLUMN $y VARCHAR(10) DEFAULT 'Free'";
    mysqli_query($conn, $alter_query);
    $update_query = "UPDATE female_doctor_slot SET $y = 'Free'";
    mysqli_query($conn, $update_query);
    $sql = "SELECT slot FROM female_doctor_slot WHERE $y='Free'";
    $result2 = mysqli_query($conn, $sql);
}
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- Boxicons CSS -->
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <title>VITmeds - Book Appointment</title>
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
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-height: 340px;
            /* Adding max-height to prevent the container from expanding infinitely */
        }

        .form-group {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .form-group label {
            font-weight: bold;
            width: 150px;
        }

        .form-group span,input,select {
            flex: 1;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        .image-preview {
            max-width: 100%;
            height: auto;
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
            <center>Book Your Appointment</center>
        </h2>
        <form style="margin-bottom:40px;margin-top:20px;" action="appointment.php" method="post">
            <div class="form-group">
                <label for="reg_no"><?php echo $reg; ?>:</label>
                <span><?php echo $reg_no; ?></span>
            </div>
            <div class="form-group">
                <label for="disease">Disease Description:</label>
                <input type="text" id="disease" name="disease" required>
            </div>
            <div class="form-group">
                <label for="slot">Available Slots:</label>
                <select name="slot" id="slot" required>
                    <option>Select Slot</option>
                    <?php
                    if (mysqli_num_rows($result1) > 0 || mysqli_num_rows($result2) > 0) {
                        while ($row = mysqli_fetch_assoc($result1)) {
                            echo '<option value="' . $x.','.$row["slot"] . '">' . $today.', '.$row["slot"] . '</option>';
                        }
                        while ($row = mysqli_fetch_assoc($result2)) {
                            echo '<option value="' . $y.','.$row["slot"] . '">' . $tomm.', '.$row["slot"] . '</option>';
                        }
                    } else {
                        echo '<option>No Slots Available!</option>';
                    }
                    ?>
                </select>
            </div>
            <input type="hidden" id="reg" name="reg" value="<?php echo $reg_no; ?>">
            <input type="hidden" id="gender" name="gender" value="<?php echo $gender; ?>">
            <input type="hidden" id="mode" name="mode" value="<?php echo $mode; ?>">
            <center><button type="submit">Book</button></center>
        </form>
    </div>

    <footer class="footer">
        <img src="assets/logo.jpg" alt="" width="200" height="50" style="margin-top: 20px; margin-bottom:20px; margin-left:200px;">

        <p style="text-align: center; background-color:#27c0eb;margin-bottom:0px;"> For support, mail us at: <a href="mailto:support@vitbhopal.ac.in">support@vitbhopal.ac.in</a></p>


    </footer>

</body>

</html>
