<?php 
session_start();
if(!isset($_SESSION['log'])) {
    echo '<script>alert("Unauthorized Access!")</script>';
    header("Location: index.html");
  exit;
}
$reg=$_POST['reg'];
$slot=$_POST['slot'];
$disease=$_POST['disease'];
$mode=$_POST['mode'];
$gender=$_POST['gender'];


list($date_str, $time) = explode(",", $slot);
$date = date("Y-m-d", strtotime($date_str));

$servername = "sql6.freesqldatabase.com";
$username = "sql6701824";
$pwd = "";
$dbname = "sql6701824";

$conn = mysqli_connect($servername, $username, $pwd, $dbname);
$sql="INSERT INTO appointment (`date_schedule`, `time_allot`, `disease`, `U_C`, `registration_no`) VALUES ('".$date."','".$time."','".$disease."','U','".$reg."');";
mysqli_query($conn, $sql);
if($gender=="Male"){
    $sql="UPDATE doctor_slot SET `$date_str`='Booked' where `slot`='$time';";

}
else{
    $sql="UPDATE female_doctor_slot SET `$date_str`='Booked' where `slot`='$time';";

}
mysqli_query($conn, $sql);
$sql = "SELECT * FROM profile WHERE `reg_no`='$reg'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_row($result);
$name=$row[1];
$email=$row[2];
$sql = "SELECT * FROM appointment WHERE `registration_no`='$reg' and `date_schedule`='$date' and `time_allot`='$time'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_row($result);
$a_id=$row[0];
ini_set('SMTP', 'smtp.gmail.com');
ini_set('smtp_port', 587);
$subject = "VITmeds - Appointment Booked";
$body = "Dear $name,

Thank you for booking an appointment with VITmeds. We are pleased to confirm the details of your upcoming appointment:

Appointment ID: $a_id
Your ID: $reg
Name: $name
Disease: $disease
Date: $date
Time: $time

When you arrive for your appointment, please present this email to our staff. Additionally, for identification purposes, kindly bring along your University ID card.

Should you have any inquiries or require assistance, please don't hesitate to contact us at support@vitbhopal.ac.in.

We appreciate your cooperation and look forward to serving you.

Warm regards,
Medical Team
VITmeds";
$headers = "From: VITmeds";
mail($email, $subject, $body, $headers);


echo '<script>alert("Appointment Scheduled Successfully! You will recieve an E-Mail for the confirmation of your appointment.")</script>';
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
