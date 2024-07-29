<?php
session_start();

$servername = "sql6.freesqldatabase.com";
$username = "sql6701824";
$pwd = "";
$dbname = "sql6701824";

$conn = mysqli_connect($servername, $username, $pwd, $dbname);
$regNumber = $_GET['regNumber'];
$password = $_GET['password'];
$mode = $_GET['mode'];
$sql = "SELECT * FROM profile WHERE reg_no='$regNumber'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_row($result);
if($row[3]==$password){
    if($mode=="student" && $row[6]=="B. Tech."){
        $_SESSION['log'] = 1;
        echo '<script type="text/javascript">window.location.href="studentdashboard.php?reg='.$regNumber.'"</script>';
    } elseif ($mode=="faculty" && $row[6]=="Faculty"){
        $_SESSION['log'] = 1;
        echo '<script type="text/javascript">window.location.href="facultydashboard.php?reg='.$regNumber.'"</script>';
    }elseif($mode=="pc" && $row[6]=="Programme Chair"){
        $_SESSION['log'] = 1;
        echo '<script type="text/javascript">window.location.href="pcdashboard.php?reg='.$regNumber.'"</script>';
    }elseif($mode=="supervisor" && substr($row[6], 0, 10)=="Supervisor"){
        $_SESSION['log'] = 1;
        echo '<script type="text/javascript">window.location.href="supervisordashboard.php?reg='.$regNumber.'"</script>';
    }elseif($mode=="doctor" && substr($row[6], 0, 6)=="Doctor"){
        $_SESSION['log'] = 1;
        echo '<script type="text/javascript">window.location.href="doctordashboard.php?reg='.$regNumber.'"</script>';
    }else{
        echo '<script>alert("Invalid Credentials!")</script>';
        echo '<script type="text/javascript">window.location.href="index.html"</script>';    
    }
}else{
    echo '<script>alert("Invalid Credentials!")</script>';
    echo '<script type="text/javascript">window.location.href="index.html"</script>';
}
