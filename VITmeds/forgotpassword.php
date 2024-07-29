<?php
$mode = $_GET['mode'];
if($mode=="student"){
    $mode="Registration No.";
}elseif($mode=="faculty"){
    $mode="Faculty ID";
}elseif($mode=="pc"){
    $mode="Faculty ID";
}elseif($mode=="supervisor"){
    $mode="Warden ID";
}elseif($mode=="doctor"){
    $mode="Doctor ID";
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
            <form id="forgot-password-form" action="forgotpasswordback.php">
                <div class="input-group-forgot-password">
                    <label for="reg">Enter <?php echo $mode; ?></label>
                    <input type="text" class="reg" id="reg" name="reg" required>
                </div>
                <input type="hidden" name="mode" id="mode" value="<?php echo $mode; ?>">
                <button type="forgot-password-submit">Send OTP</button>
            </form>
        </div>
    </div>
</body>
</html>
