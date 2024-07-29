<?php
$mode=$_GET['mode'];
if($mode=="student"){
    $reg="Registration No.";
}elseif($mode=="faculty"){
    $reg="Faculty ID";
}elseif($mode=="pc"){
    $reg="Faculty ID";
}elseif($mode=="supervisor"){
    $reg="Warden ID";
}elseif($mode=="doctor"){
    $reg="Doctor ID";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VITmeds - Login</title>
    <link rel="icon" type="image/x-icon" href="assets/favicon.jpg">
    <link rel="stylesheet" href="css/loginstyles.css">
</head>
<body>
    <div class="login-container">
        <div class="background">
            <img src="assets/loginbackground.jpg" alter="background">
        </div>
        <div class="login-box">
            <img class="logo" src="assets/logo.jpg" alter="logo">
            <form id="login-form" action="loginback.php">
                <div class="input-group">
                    <label for="regNumber"><?php echo $reg;?>:</label>
                    <input type="text" id="regNumber" name="regNumber" required>
                </div>
                <div class="input-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <input type="hidden" name="mode" id="mode" value="<?php echo $mode; ?>">
                <button type="submit" id="login">Login</button>
            </form>
            <div class="forgot-password">
                <a href="forgotpassword.php?mode=<?php echo $mode;?>">Forgot Password?</a>
            </div>
        </div>
    </div>
</body>
</html>
