<?php
session_start();
if (!isset($_SESSION['log'])) {
  echo '<script>alert("Unauthorized Access!")</script>';
  header("Location: index.html");
  exit;
}
$reg = $_GET['reg'];
$servername = "sql6.freesqldatabase.com";
$username = "sql6701824";
$pwd = "";
$dbname = "sql6701824";

$conn = mysqli_connect($servername, $username, $pwd, $dbname);
$sql = "SELECT * FROM profile WHERE reg_no='$reg'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_row($result);
$img = $row[17];
$sql = "SELECT notice FROM spotlight WHERE start_date <= CURDATE() AND end_date >= CURDATE();";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <!-- Boxicons CSS -->
  <link rel="icon" type="image/x-icon" href="assets/favicon.jpg">
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
  <title>VITmeds - Dashboard</title>
  <link rel="stylesheet" href="css/dashboard.css" />
</head>

<body>
  <!-- navbar -->
  <nav class="navbar">
    <div class="logo_item">
      <i class="bx bx-menu" id="sidebarOpen"></i>
      <img src="assets/logo.jpg" alt="">
    </div>



    <div class="navbar_content">

    <a href="emergency.php?reg=<?php echo $reg;?>&mode=doctor" style="border-radius:8px;"><button class="styled-button" style="background-color:#27c0eb;border: none;color: white;padding: 15px 20px;text-align: center;
        text-decoration: none;font-size: 16px;cursor: pointer;border-radius: 8px;" onmouseover="this.style.backgroundColor='red';" onmouseout="this.style.backgroundColor='#27c0eb';">Emergency</button></a>
      <div class="dropdown">
        <button class="dropbtn" style="height:60px;width:60px;">
          <img src="<?php echo $img; ?>" style="height: 50px; cursor:pointer; width:50px; border-radius:80%;margin-left:-11px;margin-top:-9px;">
        </button>
        <div class="dropdown-content" style="margin-left:-130px;cursor:pointer;">
          <a href="studentprofile.php?reg=<?php echo $reg; ?>&mode=doctor">Profile</a>
          <a href="changepassword.php?reg=<?php echo $reg; ?>">Change Password</a>
          <a href="logout.php">Logout</a>
        </div>
      </div>




    </div>
  </nav>

  <!-- sidebar -->
  <nav class="sidebar" style="margin-top:30px;width:300px;">
    <div class="menu_content">
      <ul class="menu_items">
        <div class="menu_title menu_dahsboard"></div>

        <li class="item">
          <div href="#" class="nav_link submenu_item">
            <span class="navlink_icon">
              <i class='bx bxs-clinic'></i>
            </span>
            <a href="upcomingapp.php?reg=<?php echo $reg;?>" style="text-decoration:none;">Upcoming Appointments</a>

          </div>


        </li>
        <!-- end -->



        <li class="item">
          <div href="#" class="nav_link submenu_item">
            <span class="navlink_icon">
              <i class='bx bxs-book-alt'></i>
            </span>
            <a href="completedapp.php?reg=<?php echo $reg; ?>" style="text-decoration:none;">Completed Appointments</a>

          </div>
        </li>


        <li class="item">
          <div href="#" class="nav_link submenu_item">
            <span class="navlink_icon">
              <i class='bx bxs-injection'></i>
            </span>
            <a href="https://dashboard.razorpay.com/app/paymentpages/storefront/st_O5BkjY3iaueozQ/payments#storefront" style="text-decoration:none;">Manage Inventory</a>

          </div>
        </li>
        <li class="item">
          <div href="#" class="nav_link submenu_item">
            <span class="navlink_icon">
              <i class='bx bx-food-menu'></i>
            </span>
            <a href="addtospotlight.php?reg=<?php echo $reg; ?>" style="text-decoration:none;">Add To Spotlight</a>

          </div>
        </li>

        <li class="item">
          <div href="#" class="nav_link submenu_item">
            <span class="navlink_icon">
              <i class='bx bxs-book-alt'></i>
            </span>
            <a href="procteedetails.php?reg=<?php echo $reg; ?>&mode=doctor" style="text-decoration:none;">All Student Details</a>
          </div>
        </li>
        <li class="item">
          <div href="#" class="nav_link submenu_item">
            <span class="navlink_icon">
              <i class='bx bx-food-menu'></i>
            </span>
            <a href="feedback.php?mode=supervisor&reg=<?php echo $reg; ?>" style="text-decoration:none;">Feedback</a>

          </div>
        </li>


      </ul>


    </div>
  </nav>
  <br><br><br><br><br>
  <center>
    <h3><u style="margin-left:200px;"><i>Spotlight</i></u></h3>
  </center><br>
<?php while($row = mysqli_fetch_row($result)){
  $notice = $row[0];?>
  <marquee style="margin-left:30%; margin-right:5%;color:red;"><i><?php echo $notice; ?></i></marquee>
<?php }
?>

  <br><br><br><br><br><br>
  <h4 style="margin-left:300px;color:green;position:fixed;">&emsp;<u>Emergency Contacts:</u></h4><br>
  <p style="margin-left:300px;position:fixed;">&emsp;<b>Hostel Warden - 6372956394 (Boys), 9428465647 (Girls)</b></p>


  <footer class="footer">
    <img src="assets/logo.jpg" alt="" width="200" height="50" style="margin-top: 20px; margin-bottom:20px; margin-left:200px;">

    <p style="text-align: center; background-color:#27c0eb;"> For support, mail us at: <a href="mailto:support@vitbhopal.ac.in">support@vitbhopal.ac.in</a></p>


    <div class="bottom-details">
      <div class="bottom_text">
        <span class="copyright_text">Copyright © 2024 <a href="Team196.html">Team No 196.</a>All rights reserved</span>
      </div>
    </div>
  </footer>




</body>

</html>
