<?php
  date_default_timezone_set('Asia/Jakarta');
  include("conn.php");
  if(!isset($_SESSION['username']) && !isset($_SESSION['name'])){
    header("location:login.php");
  }
  $_SESSION = array();
  session_destroy();
  header("location: login.php");
  die();
?>
