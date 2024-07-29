<?php 
session_start();
if(!isset($_SESSION['log'])) {
  echo '<script>alert("Unauthorized Access!")</script>';
  header("Location: index.html");
  exit;
}
$reg=$_GET['reg'];
$opass=$_GET['oldPassword'];
$npass=$_GET['newPassword'];
$servername = "sql6.freesqldatabase.com";
$username = "sql6701824";
$pwd = "";
$dbname = "sql6701824";

$conn = mysqli_connect($servername, $username, $pwd, $dbname);
$sql = "SELECT * FROM profile WHERE reg_no='$reg'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_row($result);
if($row[3]==$opass){
    $sql="update profile set password='".$npass."' where reg_no='".$reg."'";
    $conn->query($sql);
    echo '<script>alert("Password Changed Successfully! Please Login Again.")</script>';
    echo '<script type="text/javascript">window.location.href="index.html"</script>';    
}else{
    echo '<script>alert("Invalid Password!")</script>';
    echo '<script type="text/javascript">window.location.href="changepassword.php?reg='.$reg.'"</script>';    
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <!-- Boxicons CSS -->
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
  <title>VITmeds - Change Password</title>
  <link rel="icon" type="image/x-icon" href="assets/favicon.jpg">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="css/administrator.css" />
  <style>
    body {
        font-family: Arial, sans-serif;
    }
    .container {
        max-width: 400px;
        margin: 50px auto;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    .form-group {
        margin-bottom: 15px;
    }
    label {
        display: block;
        font-weight: bold;
    }
    input[type="password"] {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }
    .error-message {
        color: red;
        font-size: 0.8em;
        margin-top: 5px;
    }
</style>
</head>

<nav class="navbar">
    <div class="logo_item">
      <i class="bx bx-menu" id="sidebarOpen"></i>
      <img src="assets/logo.jpg" alt="">
    </div>
    <h3 style="margin-right:40%">Change Your Password</h3>
  </nav>

<div style="margin-top:7%" class="container">
    <!-- <h2>Password Change</h2> -->
    <form id="passwordForm" onsubmit="return validateForm()">
        <div class="form-group">
            <label for="oldPassword">Old Password</label>
            <input style="height:30px" type="password" id="oldPassword" name="oldPassword" required>
        </div>
        <div class="form-group">
            <label for="newPassword">New Password</label>
            <input style="height:30px" type="password" id="newPassword" name="newPassword" required>
            <span class="error-message" id="newPasswordError"></span>
        </div>
        <div class="form-group">
            <label for="confirmPassword">Confirm Password</label>
            <input style="height:30px" type="password" id="confirmPassword" name="confirmPassword" required>
            <span class="error-message" id="confirmPasswordError"></span>
        </div>
        <button style="margin-left:26%;border-radius:5px;background-color:skyblue;padding:5px" type="submit">Change Password</button>
    </form>
</div>

<script>
    function validateForm() {
        var newPassword = document.getElementById("newPassword").value;
        var confirmPassword = document.getElementById("confirmPassword").value;
        var newPasswordError = document.getElementById("newPasswordError");
        var confirmPasswordError = document.getElementById("confirmPasswordError");
        newPasswordError.innerHTML = "";
        confirmPasswordError.innerHTML = "";

        if (newPassword.length < 8) {
            newPasswordError.innerHTML = "Password must be at least 8 characters long.";
            return false;
        }

        if (newPassword !== confirmPassword) {
            confirmPasswordError.innerHTML = "Passwords do not match.";
            return false;
        }

        return true;
    }
</script>


  <footer class="footer">
    <img src="assets/logo.jpg" alt="" width="200" height="50"
      style="margin-top: 20px; margin-bottom:20px; margin-left:200px;">

    <p style="text-align: center; background-color:#27c0eb;margin-bottom:0px;"> For support, mail us at: <a
        href="mailto:support@vitbhopal.ac.in">support@vitbhopal.ac.in</a></p>


    <div class="bottom-details">
      <div class="bottom_text">
        <span class="copyright_text">Copyright © 2024 <a href="Team196.html">Team No 196.</a>All rights reserved</span>
      </div>
    </div>
  </footer>

</body>

</html> 
