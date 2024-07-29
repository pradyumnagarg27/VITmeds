<?php 
session_start();
if(!isset($_SESSION['log'])) {
    echo '<script>alert("Unauthorized Access!")</script>';
    header("Location: index.html");
  exit;
}
$reg=$_GET['reg'];
$mode=$_GET['mode'];
if($mode=="student"){
    $id="Registration No.";
}elseif($mode=="studentbyfaculty"){
    $id="Registration No.";
}elseif($mode=="faculty"){
    $id="Faculty ID";
}elseif($mode=="pc"){
    $id="Faculty ID";
}elseif($mode=="supervisor"){
    $id="Warden ID";
}elseif($mode=="doctor"){
    $id="Doctor ID";
}
$servername = "sql6.freesqldatabase.com";
$username = "sql6701824";
$pwd = "";
$dbname = "sql6701824";

$conn = mysqli_connect($servername, $username, $pwd, $dbname);
$sql = "SELECT * FROM profile WHERE reg_no='$reg'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_row($result);
$img=$row[17];
$name=$row[1];
$email=$row[2];
$gender=$row[4];
$contact=$row[5];
$program=$row[6];
if($mode=="student"){
    $batch_name="Batch";
}else{
    $batch_name="Designation";
}
$batch=$row[7];
$father=$row[8];
$f_mobile=$row[9];
$mother=$row[10];
$m_mobile=$row[11];
$proctor=$row[12];
$p_id=$row[13];
$p_mobile=$row[14];
$address=$row[15];
$h_d=$row[16];
$age=$row[19];
$pmh=$row[20];
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <!-- Boxicons CSS -->
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
  <title>VITmeds - Profile</title>
  <link rel="icon" type="image/x-icon" href="assets/favicon.jpg">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="css/administrator.css" />
  <style>
     body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
    }
    .container {
        background-image: linear-gradient(120deg, #e0c3fc 0%, #8ec5fc 100%);
        max-width: 800px;
        margin: 50px auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        overflow-y: auto; /* Adding vertical scroll bar */
        max-height: 350px; /* Adding max-height to prevent the container from expanding infinitely */
    }
    .form-group {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }
    .form-group label {
        font-weight: bold;
        width: 150px;
    }
    .form-group span {
        flex: 1;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        background-color: #f9f9f9;
    }
    .image-preview {
        max-width: 100%;
        height: auto;
    }
    button {
        padding: 10px 20px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }
    button:hover {
        background-color: #0056b3;
    }
</style>
</head>

<body>
  <!-- navbar -->
  <nav class="navbar">
    <div class="logo_item">
      <i class="bx bx-menu" id="sidebarOpen"></i>
      <img src="assets/logo.jpg" alt="">
    </div>
  </nav>


  <div class="container" style="margin-top:100px;">
    <h2>
        <center><?php if($mode=="studentbyfaculty"){echo "Student";}else{echo "My";}?> Profile</center>
    </h2>
    <form style="margin-bottom:40px;margin-top:20px;" method="post">
        <div class="form-group">
            <img class="image-preview" src="<?php echo $img;?>" alt="Photo Preview" style="height:100px;width=100px;border-radius:70%;margin-left:43%;">
        </div>
        <div class="form-group">
            <label for="reg_no"><?php echo $id; ?>:</label>
            <span><?php echo $reg;?></span>
        </div>
        <div class="form-group">
            <label for="name">Name:</label>
            <span><?php echo $name;?></span>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <span><?php echo $email;?></span>
        </div>
        <?php if(!($mode=='student' || $mode=="studentbyfaculty")){ ?>
            <div class="form-group">
            <label for="cabin">Cabin No.:</label>
            <span><?php echo $h_d;?></span>
        </div>

        <?php } ?>

        <div class="form-group">
            <label for="gender">Gender:</label>
            <span><?php echo $gender;?></span>
        </div>
        <div class="form-group">
            <label for="age">Age:</label>
            <span><?php echo $age;?></span>
        </div>
        <div class="form-group">
            <label for="contact">Phone No.:</label>
            <span><?php echo $contact;?></span>
        </div>
        <div class="form-group">
            <label for="address">Address:</label>
            <span><?php echo $address;?></span>
        </div>
        <div class="form-group">
            <label for="batch"><?php echo $batch_name; ?>:</label>
            <span><?php echo $batch;?></span>
        </div>
        <?php if($mode=='student' || $mode=="studentbyfaculty"){ ?>
            <div class="form-group">
            <label for="program">Programme:</label>
            <span><?php echo $program;?></span>
        </div>
        <div class="form-group">
            <label for="father_name">Father's Name:</label>
            <span><?php echo $father;?></span>
        </div>
        <div class="form-group">
            <label for="father_mobile">Father's Mobile:</label>
            <span><?php echo $f_mobile;?></span>
        </div>
        <div class="form-group">
            <label for="mother_name">Mother's Name:</label>
            <span><?php echo $mother;?></span>
        </div>
        <div class="form-group">
            <label for="mother_mobile">Mother's Mobile:</label>
            <span><?php echo $m_mobile;?></span>
        </div>
        <div class="form-group">
            <label for="h_d">Residential Status:</label>
            <span><?php echo $h_d;?></span>
        </div>
        <div class="form-group">
            <label for="pmh">Previous Medical History:</label>
            <span><?php echo $pmh;?></span>
        </div>
        <?php if($mode=='student'){ ?>
        <div class="form-group">
            <label for="proctor_id">Proctor ID:</label>
            <span><?php echo $p_id;?></span>
        </div>
        <div class="form-group">
            <label for="proctor">Proctor:</label>
            <span><?php echo $proctor;?></span>
        </div>
        <div class="form-group">
            <label for="proctor_mobile">Proctor's Mobile:</label>
            <span><?php echo $p_mobile;?></span>
        </div>
        <?php }}?>
    </form>
</div>

  <footer class="footer">
    <img src="assets/logo.jpg" alt="" width="200" height="50"
      style="margin-top: 20px; margin-bottom:20px; margin-left:200px;">

    <p style="text-align: center; background-color:#27c0eb;margin-bottom:0px;"> For support, mail us at: <a
        href="mailto:support@vitbhopal.ac.in">support@vitbhopal.ac.in</a></p>


  </footer>

</body>

</html>
