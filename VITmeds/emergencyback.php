<?php 
session_start();
if(!isset($_SESSION['log'])) {
    echo '<script>alert("Unauthorized Access!")</script>';
    header("Location: index.html");
  exit;
}
$reg=$_POST['reg'];
$mode=$_POST['mode'];
$student_reg=$_POST['student_reg'];
$desc=$_POST['desc'];


$date = date("Y-m-d");
$current_time = date('H:i:s'); // Get current time in HH:MM:SS format
$time = date('H:i:s', strtotime('+3 hours 30 minutes', strtotime($current_time)));

$servername = "sql6.freesqldatabase.com";
$username = "sql6701824";
$pwd = "";
$dbname = "sql6701824";

$conn = mysqli_connect($servername, $username, $pwd, $dbname);
$sql="INSERT INTO emergency (`invoked_by`, `invoked_for`, `date`, `time`, `description`) VALUES ('".$reg."','".$student_reg."','".$date."','".$time."','".$desc."');";
mysqli_query($conn, $sql);

$sql = "SELECT * FROM profile WHERE `reg_no`='$student_reg'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_row($result);

$mother_email=$row[22];
$father_name=$row[8];
$father_mobile=$row[9];
$mother_name=$row[10];
$mother_mobile=$row[11];
$father_email=$row[21];
$gender=$row[4];
$name = $row[1];
$proctor_id=$row[13];
$proctor=$row[12];
$proctor_mobile=$row[14];
$h_d=$row[16];

if($gender=="Male"){$sql = "SELECT * FROM profile WHERE `batch`='Doctor - Boys Hostel'";}
else{$sql = "SELECT * FROM profile WHERE `batch`='Doctor - Girls Hostel'";}
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_row($result);

$doctor_email=$row[2];
$doctor_mobile=$row[5];
$doctor_name=$row[1];

$sql = "SELECT * FROM profile WHERE `reg_no`='$proctor_id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_row($result);

$proctor_email=$row[2];

if(!($h_d=="Day Scholar")){
    $parts = explode(" - ", $h_d);
    $blocks = explode(" ",$parts[1]);
    $block=$blocks[1];

    $sql = "SELECT * FROM profile WHERE `program` like '%$block'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_row($result);
    $warden_email=$row[2];
    $warden_name=$row[1];
    $warden_mobile=$row[5];
}else{
    $warden_email="";
    $warden_name="";
    $warden_mobile="";
}

ini_set('SMTP', 'smtp.gmail.com');
ini_set('smtp_port', 587);
$subject = "VITmeds - Emergency Invoked";

if($mode=="faculty"){
$proctor_body="Dear Proctor,

This is to acknowledge that we have received your request regarding the medical emergency involving $student_reg - $name.

Description: $desc

We are taking immediate action to address the situation and provide the necessary assistance to the student.

The notification has also been sent to the doctor and the parents of $name.

Father: $father_name ($father_mobile)
Mother: $mother_name ($mother_mobile)

Thank you for bringing this matter to our attention.

Regards,
Medical Team,
VITmeds";
$warden_body="Dear Warden,

This is to inform you that a medical emergency has been invoked by $proctor, proctor of $student_reg - $name. 

Description: $desc

The situation requires immediate attention, and as the hostel warden, we kindly request your cooperation and assistance in this matter. Please arrange all the necessary services required in this matter to ensure the well-being of $name.

The notification has also been sent to the doctor and the parents of $name.

Father: $father_name ($father_mobile)
Mother: $mother_name ($mother_mobile)

Thank you for your prompt attention to this urgent matter.

Regards,
Medical Team,
VITmeds";

$doctor_body="Dear Doctor,

This is to inform you that a medical emergency has been invoked by $proctor, proctor of $student_reg - $name. 

Description: $desc

The situation requires immediate attention, and as the hostel doctor, we kindly request your cooperation and assistance in this matter. Please arrange all the necessary services required in this matter to ensure the well-being of $name.

The notification has also been sent to the parents of $name.

Father: $father_name ($father_mobile)
Mother: $mother_name ($mother_mobile)

Thank you for your prompt attention to this urgent matter.

Regards,
Medical Team,
VITmeds";

$parent_body="Dear Parent,

This is to inform you that a medical emergency has been invoked by $proctor, proctor of your child, $name, at our university.

Description: $desc

Please rest assured that we are taking immediate action to address the situation and provide the necessary assistance to your child. The well-being and safety of our students are our top priorities, and we are working diligently to ensure that your child receives the best possible care.

We understand that this may be a concerning time for you, and we want to assure you that we are doing everything in our power to handle the situation with the utmost care and urgency.

You can reach the proctor and doctor at:

Proctor: $proctor ($proctor_mobile)
Doctor: $doctor_name ($doctor_mobile)

Thank you for your understanding and cooperation.

Regards,
Medical Team,
VITmeds";

}elseif($mode=="supervisor"){
$proctor_body="Dear Proctor,
    
This is to inform you that a medical emergency has been invoked by $warden_name, warden of Block $block for your proctee $student_reg - $name. 
    
Description: $desc

The situation requires immediate attention, and as the proctor, we kindly request your cooperation and assistance in this matter. Please arrange all the necessary services required in this matter to ensure the well-being of $name.
    
The notification has also been sent to the doctor and the parents of $name.

Father: $father_name ($father_mobile)
Mother: $mother_name ($mother_mobile)
Warden: $warden_name ($warden_mobile)
    
Thank you for your prompt attention to this urgent matter.
  
Regards,
Medical Team,
VITmeds";
$warden_body="Dear Warden,
    
This is to acknowledge that we have received your request regarding the medical emergency involving $student_reg - $name.

Description: $desc

As the hostel warden, we kindly request your cooperation and assistance in this matter. Please arrange all the necessary services required in this matter to ensure the well-being of $name.

The notification has also been sent to the doctor, proctor and parents of $name.

Father: $father_name ($father_mobile)
Mother: $mother_name ($mother_mobile)
Proctor: $proctor ($proctor_mobile)

Thank you for bringing this matter to our attention.
    
Regards,
Medical Team,
VITmeds";
    
$doctor_body="Dear Doctor,

This is to inform you that a medical emergency has been invoked by $warden_name, warden of Block $block for your proctee $student_reg - $name. 

Description: $desc

The situation requires immediate attention, and as the hostel doctor, we kindly request your cooperation and assistance in this matter. Please arrange all the necessary services required in this matter to ensure the well-being of $name.

The notification has also been sent to the doctor, proctor and parents of $name.

Father: $father_name ($father_mobile)
Mother: $mother_name ($mother_mobile)
Proctor: $proctor ($proctor_mobile)

Thank you for your prompt attention to this urgent matter.

Regards,
Medical Team,
VITmeds";

$parent_body="Dear Parent,

This is to inform you that a medical emergency has been invoked by $warden_name, warden of Block $block in the university hostel for your child $name. 

Description: $desc

Please rest assured that we are taking immediate action to address the situation and provide the necessary assistance to your child. The well-being and safety of our students are our top priorities, and we are working diligently to ensure that your child receives the best possible care.

We understand that this may be a concerning time for you, and we want to assure you that we are doing everything in our power to handle the situation with the utmost care and urgency.

You can reach the proctor, warden and doctor at:

Proctor: $proctor ($proctor_mobile)
Doctor: $doctor_name ($doctor_mobile)
Warden: $warden_name ($warden_mobile)

Thank you for your understanding and cooperation.

Regards,
Medical Team,
VITmeds";}
elseif($mode=="doctor"){
$proctor_body="Dear Proctor,
    
This is to inform you that a medical emergency has been invoked by $doctor_name, doctor of university hostel for your proctee $student_reg - $name. 
    
Description: $desc

The situation requires immediate attention, and as the proctor, we kindly request your cooperation and assistance in this matter. Please arrange all the necessary services required in this matter to ensure the well-being of $name.
    
The notification has also been sent to the parents of $name.

Father: $father_name ($father_mobile)
Mother: $mother_name ($mother_mobile)
Doctor: $doctor_name ($doctor_mobile)
    
Thank you for your prompt attention to this urgent matter.
    
Regards,
Medical Team,
VITmeds";
$warden_body="Dear Warden,
    
This is to inform you that a medical emergency has been invoked by $doctor_name, doctor of university hostel for the student $student_reg - $name. 

Description: $desc

The situation requires immediate attention, and as the hostel warden, we kindly request your cooperation and assistance in this matter. Please arrange all the necessary services required in this matter to ensure the well-being of $name.

The notification has also been sent to the proctor and the parents of $name.

Father: $father_name ($father_mobile)
Mother: $mother_name ($mother_mobile)
Proctor: $proctor ($proctor_mobile)

Thank you for your prompt attention to this urgent matter.
    
Regards,
Medical Team,
VITmeds";
    
$doctor_body="Dear Doctor,

This is to acknowledge that we have received your request regarding the medical emergency involving $student_reg - $name.

Description: $desc

As the hostel doctor, we kindly request your cooperation and assistance in this matter. Please arrange all the necessary services required in this matter to ensure the well-being of $name.

The notification has also been sent to the proctor and parents of $name.

Father: $father_name ($father_mobile)
Mother: $mother_name ($mother_mobile)
Proctor: $proctor ($proctor_mobile)

Thank you for bringing this matter to our attention.

Regards,
Medical Team,
VITmeds";

$parent_body="Dear Parent,

This is to inform you that a medical emergency has been invoked by $doctor_name, doctor of university hostel for your child $name. 

Description: $desc

Please rest assured that we are taking immediate action to address the situation and provide the necessary assistance to your child. The well-being and safety of our students are our top priorities, and we are working diligently to ensure that your child receives the best possible care.

We understand that this may be a concerning time for you, and we want to assure you that we are doing everything in our power to handle the situation with the utmost care and urgency.

You can reach the proctor and doctor at:

Proctor: $proctor ($proctor_mobile)
Doctor: $doctor_name ($doctor_mobile)

Thank you for your understanding and cooperation.

Regards,
Medical Team,
VITmeds";}

$headers = "Urgent: From: VITmeds";
if(!($warden_email=="")){
    mail($warden_email, $subject, $warden_body, $headers);
}
mail($proctor_email, $subject, $proctor_body, $headers);
mail($doctor_email, $subject, $doctor_body, $headers);
mail($father_email, $subject, $parent_body, $headers);
mail($mother_email, $subject, $parent_body, $headers);

echo '<script>alert("Emergency Invoked Successfully! Notification has been sent to all the respective authorities and parents of the student.")</script>';
if ($mode=="faculty"){
    echo '<script type="text/javascript">window.location.href="facultydashboard.php?reg='.$reg.'"</script>';
}elseif($mode=="supervisor"){
    echo '<script type="text/javascript">window.location.href="supervisordashboard.php?reg='.$reg.'"</script>';
}elseif($mode=="doctor"){
    echo '<script type="text/javascript">window.location.href="doctordashboard.php?reg='.$reg.'"</script>';
}else{
    echo '<script>alert("Unauthorised Access!")</script>';
    echo '<script type="text/javascript">window.location.href="index.html"</script>';    
}
