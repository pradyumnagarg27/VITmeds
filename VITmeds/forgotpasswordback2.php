<?php
$servername = "sql6.freesqldatabase.com";
$username = "sql6701824";
$pwd = "";
$dbname = "sql6701824";

$conn = mysqli_connect($servername, $username, $pwd, $dbname);
$reg=$_GET["reg"];
$otp = $_GET['otp'];
$dbotp = $_GET['dbotp'];
if($otp!=$dbotp){
    echo '<script>alert("Invalid OTP!")</script>';
    echo '<script type="text/javascript">window.location.href="index.html"</script>';
}
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
            <form id="forgot-password-form" action="forgotpasswordback3.php">
                <div class="input-group-forgot-password">
                    <label for="new">Enter New Password:</label>
                    <input type="password" class="new" id="new" name="new" required>
                </div>
                <div class="input-group-forgot-password">
                    <label for="newc">Confirm Password:</label>
                    <input type="password" class="newc" id="newc" name="newc" required>
                </div>
                <input type="hidden" class="otp" id="otp" name="otp" value="<?php echo $otp;?>">
                <input type="hidden" name="reg" id="reg" value="<?php echo $reg; ?>">
                <button type="forgot-password-submit">Submit</button>
            </form>
        </div>
    </div>
</body>
</html>
