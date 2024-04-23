<?php
include("con.php");
if(empty($_SESSION['email'])){
    header("Location: 404.php?error=session_email_error!", true, 301);
    exit();
  }

  $result = mysqli_query($conn,"SELECT token FROM Staff WHERE staffemail = '$_SESSION[email]'");
  while($row = mysqli_fetch_assoc($result)){
    $token = $row['token'];
  }

  $count = mysqli_num_rows($result);

  if($count == 1){
    while($row = mysqli_fetch_assoc($result)){
      $token = $row['token'];
    }
    if(isset($_SESSION['token'])){
      if($_SESSION['token'] != $token){
        header("Location: 404.php?error=token_mismatch!", true, 301);
        exit();
      }
    }else{
      header("Location: 404.php?error=session_token_not_set!", true, 301);
      exit();
    }
  }else{
    header("Location: 404.php?error=no_email_found!", true, 301);
    exit();
  }

  ?>