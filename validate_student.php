<?php
session_start();
include("con.php");
if(empty($_SESSION['iitid'])){
  header("Location: 404.php?error=session_email_error!", true, 301);
  exit();
}
?>