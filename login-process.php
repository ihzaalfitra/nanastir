<?php
  date_default_timezone_set('Asia/Jakarta');
  include("conn.php");

  $username=mysqli_reaL_escape_string($conn,$_POST["username"]);
  $password=mysqli_reaL_escape_string($conn,$_POST["password"]);

  $sql=$db->prepare("SELECT * FROM user WHERE uname='$username' AND pword='$password'");
  //execute sql
  $sql->execute();
  $result=$sql->rowCount();
  if($fetched=$sql->FETCH(PDO::FETCH_ASSOC)){
    //if result is not 1 (maybe multiple or 0), must be signal as error
    if($result==1){
      session_start();
      $_SESSION['username']=$username;
      $_SESSION['name']=$fetched['name'];
      header("location:index.php");
    }else{
      echo $username."<br>".$password;
    }
  }else{
    header("location:login.php?err=404");
  }
?>
