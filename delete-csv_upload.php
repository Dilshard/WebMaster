<?php
session_start();
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

if(isset($_POST['student_upload'])){

    // Allowed mime types
    $csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
    
    // Validate whether selected file is a CSV file
    if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $csvMimes)){
        
        // If the file is uploaded
        if(is_uploaded_file($_FILES['file']['tmp_name'])){
            
            // Open uploaded CSV file with read-only mode
            $csvFile = fopen($_FILES['file']['tmp_name'], 'r');
            
            // Skip the first line
            fgetcsv($csvFile);
            
            // Parse data from CSV file line by line
            while(($line = fgetcsv($csvFile)) !== FALSE){
                // Get row data
                $iitid = $line[0];
                $email = $line[1];
                $password = $line[2];
                $uowno = $line[3];
                $studentname = $line[4];
                $projtitle = $line[5];
                $stream = $line[6];
                $resarea = $line[7];
                $shortdes = $line[8];
                
                
                // Check whether member already exists in the database with the same email
                $prevQuery = "SELECT iitid FROM Student WHERE email = '".$line[1]."'";
                $prevResult = $conn->query($prevQuery);
                
                if($prevResult->num_rows > 0){
                    // Update member data in the database
                    $conn->query("UPDATE Student SET email = '".$email."',pass = '".$password."',uowno = '".$uowno."',studentname = '".$studentname."',projtitle = '".$projtitle."',stream = '".$stream."',resarea = '".$resarea."',shortdes = '".$shortdes."'  WHERE iitid = '".$iitid."'");
                }else{
                    // Insert member data in the database
                    $conn->query("INSERT INTO `Student` (`iitid`, `email`, `pass`, `uowno`, `studentname`, `projtitle`, `stream`, `resarea`, `shortdes`) VALUES ('$iitid', '$email', '$password', '$uowno', '$studentname', '$projtitle', '$stream', '$resarea', '$shortdes');");
                }
            }
            
            // Close opened CSV file
            fclose($csvFile);
            
            $qstring = '?status=succ';
            $_SESSION['status_staff_csv_load'] = "Success!";
        }else{
            $qstring = '?status=err';
            $_SESSION['status_staff_csv_load'] = "Error!";
        }
    }else{
        $qstring = '?status=invalid_file';
        $_SESSION['status_staff_csv_load'] = "Invalid file type!";
    }
  }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form method="post" enctype="multipart/form-data">
    <input type="file" name="file" />
    <input type="submit" class="btn btn-primary" name="student_upload" value="IMPORT">
    <span><?php if(isset($_SESSION['status_staff_csv_load'])){echo $_SESSION['status_staff_csv_load'];}?></span>
</form>
</body>
</html>

<!-- for more : https://www.codexworld.com/import-csv-file-data-into-mysql-database-php/ -->