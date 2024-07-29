<?php
session_start();
if (!isset($_SESSION['log'])) {
    echo '<script>alert("Unauthorized Access!")</script>';
    header("Location: index.html");
    exit;
}
$mode=$_GET['mode'];
$reg=$_GET['reg'];
$aid=$_GET['aid'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- Boxicons CSS -->
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <title>VITmeds - Edit Prescription</title>
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
            <center><?php if($mode=='edit'){ echo 'Edit';}else{echo 'Add';}?> Prescription</center>
        </h2>
        <form style="margin-bottom:40px;margin-top:20px;" action="editprescriptionback.php" method="post">
            <div class="form-group">
                <label for="aid">Appointment ID:</label>
                <span><?php echo $aid; ?></span>
            </div>
            <div class="form-group">
                <label for="prescription">Medicines:</label>
                <input type="text" id="prescription" name="prescription" required>
            </div>
            <div class="form-group">
            <label for="remark">Remarks:</label>
            <input type="text" id="remark" name="remark" required>
            </div>
            <input type="hidden" id="reg" name="reg" value="<?php echo $reg; ?>">
            <input type="hidden" id="aid" name="aid" value="<?php echo $aid; ?>">
            <input type="hidden" id="mode" name="mode" value="<?php echo $mode; ?>">
            <center><button type="submit">Save</button></center>
        </form>
    </div>

    <footer class="footer">
        <img src="assets/logo.jpg" alt="" width="200" height="50" style="margin-top: 20px; margin-bottom:20px; margin-left:200px;">

        <p style="text-align: center; background-color:#27c0eb;margin-bottom:0px;"> For support, mail us at: <a href="mailto:support@vitbhopal.ac.in">support@vitbhopal.ac.in</a></p>


    </footer>

</body>

</html>