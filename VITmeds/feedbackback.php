<?php 
session_start();
if(!isset($_SESSION['log'])) {
    echo '<script>alert("Unauthorized Access!")</script>';
    header("Location: index.html");
  exit;
}
$reg=$_POST['reg'];
$feedback=$_POST['rating'];
$mode=$_POST['mode'];
$servername = "sql6.freesqldatabase.com";
$username = "sql6701824";
$pwd = "";
$dbname = "sql6701824";

$conn = mysqli_connect($servername, $username, $pwd, $dbname);
$sql="INSERT INTO feedbacks (`Registration_no`, `feedback`) VALUES ('".$reg."', '".$feedback."');";
mysqli_query($conn, $sql);
echo '<script>alert("Feedback Submitted Successfully! Thank You For Your Valuable Feedback.")</script>';
if($mode=="student"){
    echo '<script type="text/javascript">window.location.href="studentdashboard.php?reg='.$reg.'"</script>';
} elseif ($mode=="faculty"){
    echo '<script type="text/javascript">window.location.href="facultydashboard.php?reg='.$reg.'"</script>';
}elseif($mode=="pc"){
    echo '<script type="text/javascript">window.location.href="pcdashboard.php?reg='.$reg.'"</script>';
}elseif($mode=="supervisor"){
    echo '<script type="text/javascript">window.location.href="supervisordashboard.php?reg='.$reg.'"</script>';
}elseif($mode=="doctor"){
    echo '<script type="text/javascript">window.location.href="doctordashboard.php?reg='.$reg.'"</script>';
}else{
    echo '<script>alert("Unauthorised Access!")</script>';
    echo '<script type="text/javascript">window.location.href="index.html"</script>';    
}
