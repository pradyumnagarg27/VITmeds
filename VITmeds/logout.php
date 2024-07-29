<?php
session_start();
$_SESSION = array();
session_destroy();

echo '<script>alert("Log Out Successful! Redirecting To Home Page.")</script>';
echo '<script type="text/javascript">window.location.href="index.html"</script>';    
exit;