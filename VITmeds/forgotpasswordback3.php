<?php
$servername = "sql6.freesqldatabase.com";
$username = "sql6701824";
$pwd = "";
$dbname = "sql6701824";

$conn = mysqli_connect($servername, $username, $pwd, $dbname);
$reg=$_GET["reg"];
$new = $_GET['new'];
$newc = $_GET['newc'];
if($new==$newc){
    $sql="Update profile set password='$new' where reg_no='$reg'";
    $conn->query($sql);
    echo '<script>alert("Password Updated Successfully!")</script>';
    echo '<script type="text/javascript">window.location.href="index.html"</script>';
}else{
    echo '<script>alert("Passwords Do Not Match!")</script>';
    echo '<script type="text/javascript">window.location.href="forgotpasswordback2.php?otp='.$otp.'&reg='.$reg.'&dbotp='.$otp.'"</script>';
}
