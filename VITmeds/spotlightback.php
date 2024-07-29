<?php 
session_start();
if(!isset($_SESSION['log'])) {
    echo '<script>alert("Unauthorized Access!")</script>';
    header("Location: index.html");
  exit;
}
$reg=$_POST['reg'];
$start=$_POST['start'];
$end=$_POST['end'];
$spot=$_POST['spot'];

$servername = "sql6.freesqldatabase.com";
$username = "sql6701824";
$pwd = "";
$dbname = "sql6701824";

$conn = mysqli_connect($servername, $username, $pwd, $dbname);
$sql="INSERT INTO spotlight (`start_date`, `end_date`, `notice`) VALUES ('".$start."','".$end."','".$spot."');";
mysqli_query($conn, $sql);
echo '<script>alert("Notice Added Successfully! It will be reflected between the given dates.")</script>';
echo '<script type="text/javascript">window.location.href="doctordashboard.php?reg='.$reg.'"</script>';
