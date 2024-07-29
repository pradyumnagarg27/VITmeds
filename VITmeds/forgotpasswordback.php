<?php
$servername = "sql6.freesqldatabase.com";
$username = "sql6701824";
$pwd = "";
$dbname = "sql6701824";

$conn = mysqli_connect($servername, $username, $pwd, $dbname);
$mode = $_GET['mode'];
$reg=$_GET["reg"];
$dbotp=rand(1000,9999);
$sql = "UPDATE profile set otp='".$dbotp."' where reg_no='$reg'";
$conn->query($sql);
$sql = "SELECT * FROM profile WHERE reg_no='$reg'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_row($result);
$name=$row[1];
$email=$row[2];
ini_set('SMTP', 'smtp.gmail.com');
ini_set('smtp_port', 587);
$subject = "VITmeds - Forgot Password";
$body = "Dear $name,

You've requested to reset your password for VITmeds. To proceed, please use the following One-Time Password (OTP).

OTP: $dbotp
    
Please enter this OTP on the forgot password page to complete the process. If you didn't request this reset, please report this to support@vitbhopal.ac.in.
Do not disclose this OTP to anyone.
    
If you need further assistance, feel free to contact our support team.
    
Best regards,
Support Team
VITmeds";
$headers = "From: VITmeds";
mail($email, $subject, $body, $headers);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="icon" type="image/x-icon" href="assets/favicon.jpg">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VITmeds - Forgot Password</title>
    <link rel="stylesheet" href="css/loginstyles.css">
</head>
<body>
    <div class="forgot-password-container">
        <div class="background">
            <img src="assets/loginbackground.jpg" alter="background">
        </div>
        <div class="forgot-password-box">
            <img class="logo" src="assets/logo.jpg" alter="logo">
            <form id="forgot-password-form" action="forgotpasswordback2.php">
                <div class="input-group-forgot-password">
                    <label for="reg">Enter <?php echo $mode; ?></label>
                    <input type="text" placeholder="<?php echo $reg; ?>">
                </div>
                <div class="input-group-forgot-password">
                    <label for="otp">Enter Email OTP:</label>
                    <input type="text" class="otp" id="otp" name="otp" required>
                </div>
                <input type="hidden" class="reg" id="reg" name="reg" value="<?php echo $reg;?>">
                <input type="hidden" name="dbotp" id="dbotp" value="<?php echo $dbotp; ?>">
                <button type="forgot-password-submit">Submit</button>
            </form>
        </div>
    </div>
</body>
</html>
