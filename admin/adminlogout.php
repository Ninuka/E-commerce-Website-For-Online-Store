<?php

session_start();

if(isset($_GET['adminlogout']) &&  $GET['adminlogout'] ==1 ){
  if(isset($_SESSION['admin_logged_in'])){
    unset($_SESSION['admin_logged_in']);
    unset($_SESSION['admin_user_email']);
    unset($_SESSION['admin_name']);
    header('location: adminlogin.php');
    exit;
  }
}

?>
