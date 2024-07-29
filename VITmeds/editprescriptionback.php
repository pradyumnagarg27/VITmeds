<?php 
session_start();
if(!isset($_SESSION['log'])) {
    echo '<script>alert("Unauthorized Access!")</script>';
    header("Location: index.html");
  exit;
}
$mode=$_POST['mode'];
$reg=$_POST['reg'];
$prescription=$_POST['prescription'];
$remark=$_POST['remark'];
$aid=$_POST['aid'];

$servername = "sql6.freesqldatabase.com";
$username = "sql6701824";
$pwd = "";
$dbname = "sql6701824";

$conn = mysqli_connect($servername, $username, $pwd, $dbname);
if($mode=="edit"){
  $sql="UPDATE prescriptions set `Prescription`='$prescription' where `appointment_id`=$aid";
  mysqli_query($conn, $sql);
  $sql="UPDATE prescriptions set `Remarks`='$remark' where `appointment_id`=$aid";
  mysqli_query($conn, $sql);
  echo '<script>alert("Prescription Edited Successfully!")</script>';
  echo '<script type="text/javascript">window.location.href="doctordashboard.php?reg='.$reg.'"</script>';
}else{
  $sql = "SELECT * FROM profile WHERE reg_no='$reg'";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_row($result);
  $doctor=$row[1];
  $sql="INSERT INTO `prescriptions`(`appointment_id`, `Doctor`, `Prescription`, `Remarks`) VALUES ('$aid', '$doctor', '$prescription', '$remark')";
  mysqli_query($conn, $sql);
  $sql="UPDATE appointment set `U_C`='C' where `appoint_ID`=$aid";
  mysqli_query($conn, $sql);
  echo '<script>alert("Prescription Added Successfully!")</script>';
  echo '<script type="text/javascript">window.location.href="doctordashboard.php?reg='.$reg.'"</script>';
}
