<?php
include("con.php");

session_start();

if(isset($_POST['staff_upload'])){

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
                $staffemail = $line[0];
                $staffname = $line[1];
                $contact = $line[2];
                $password = $line[3];
                $role = $line[4];
                $ftpt = $line[5];
                $area = $line[6];
                
                // Check whether member already exists in the database with the same email
                $prevQuery = "SELECT staffid FROM Staff WHERE staffemail = '".$line[0]."'";
                $prevResult = $conn->query($prevQuery);
                
                if($prevResult->num_rows > 0){
                    // Update member data in the database
                    $conn->query("UPDATE Staff SET staffname = '".$staffname."', contact = '".$contact."', password = '".$password."', ftpt = '".$ftpt."', area = '".$area."' WHERE staffemail = '".$staffemail."'");
                }else{
                    // Insert member data in the database
                    $conn->query("INSERT INTO `Staff` (`staffemail`, `staffname`, `contact`, `password`, `role`, `ftpt`, `area`,`pass_attempt`) VALUES ('$staffemail','$staffname', $contact,'$password','$role','$ftpt','$area',0);");
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
    <input type="submit" class="btn btn-primary" name="staff_upload" value="IMPORT">
    <span><?php if(isset($_SESSION['status_staff_csv_load'])){echo $_SESSION['status_staff_csv_load'];}?></span>
</form>
</body>
</html>

<!-- for more : https://www.codexworld.com/import-csv-file-data-into-mysql-database-php/ -->