<!DOCTYPE html>
<html lang="en">
<?php include("head.php"); ?>
<?php
  session_start();
  if($_SESSION['email']==""){
    header("Location: 404.php", true, 301);
    exit();
  }

  include 'con.php';

  if(isset($_POST['btnsub'])){
    $email = $_POST['stemail'];
    $stpass = $_POST['stpass'];
    $ftpt = $_POST['ftpt'];
    $stname = $_POST['stname'];
    $stspecial = $_POST['stspecial'];
    $stcontact = $_POST['stcontact'];
    $strole = $_POST['strole'];

    $sql = "INSERT INTO `Staff` (`staffemail`, `password`, `staffname`, `contact`, `ftpt`, `area`, `role`, `pass_attempt`) VALUES ('$email', '$stpass', '$stname', '$stcontact', '$ftpt', '$stspecial', '$strole', 0);";

    if(mysqli_query($conn, $sql)){
      header('Location: admin-staff-manage.php');
    }else{
      echo "Error!".mysqli_error($conn);
    }
  }

  // staff CSV upload
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

// End
?>
<body>
    <div class="container-fluid">
        <div class="row">
            <?php include("admin-nav.php") ?>
        </div>
        <div class="row">
          <div class="col-md-6 my-4 p-4">
            <h1 class="display-4 pb-3">Registration - Staff</h1>

            <form method="POST" class="row g-3">
              <div class="col-md-6">
                <label class="form-label">Email</label>
                <input name="stemail" type="email" class="form-control">
              </div>
              <div class="col-md-6">
                <label class="form-label">Password</label>
                <input name="stpass" type="password" class="form-control">
              </div>
              <div class="col-md-6">
                <label class="form-label">FT / PT</label>
                <select name="ftpt" id="inputState" class="form-select">
                  <option value="ft" selected>Full-time</option>
                  <option value="pt">Part-time</option>
                </select>
              </div>
              <div class="col-md-6">
                <label class="form-label">Staff Name</label>
                <input name="stname" type="text" class="form-control">
              </div>
              <div class="col-6">
                <label for="fullName" class="form-label">Specialised area</label>
                <input name="stspecial" type="text" class="form-control" id="fullName">
              </div>
              <div class="col-md-6">
                <label class="form-label">Contact No</label>
                <input name="stcontact" type="number" class="form-control">
              </div>
              
              <div class="col-md-6">
                <label class="form-label">Role</label>
                <select name="strole" id="inputState" class="form-select">
                  <option selected value="staff">Staff</option>
                  <option value="admin">Admin</option>
                </select>
              </div>
             
              <div class="col-12">
                <button name="btnsub" type="submit" class="btn btn-success">Register</button>
                <button type="reset" class="btn btn-warning">Clear</button>
                <a class="btn btn-secondary" href="admin-staff-manage.php">View</a>
              </div>
            </form>
            </div>

          <div class="col-md-6 my-4 p-4">
            <h1 class="display-3 pb-3">Bulk upload</h1>
              <form method="post" enctype="multipart/form-data">
                <div class="mb-3">
                  <label for="formFile" class="form-label">Upload from CSV File <a href="">Download the template</a></label>
                  <input class="form-control" type="file" name="file" id="formFile">
                </div>
                <div class="col-12">
                  <button type="submit" name="staff_upload" class="btn btn-success">Upload</button>
                  <button type="reset" class="btn btn-warning">Clear</button>
                  <span><?php if(isset($_SESSION['status_staff_csv_load'])){echo $_SESSION['status_staff_csv_load'];} unset($_SESSION['status_staff_csv_load']);?></span>
                </div>
              </form>
          </div>
          
      </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous">
  </script>
</body>
</html>