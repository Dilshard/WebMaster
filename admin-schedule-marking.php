<!DOCTYPE html>
<html lang="en">
<?php include("head.php"); ?>
<?php
  session_start();
  include("validate.php");

  if(isset($_POST['btnsub'])){
    $time = $_POST['time'];
    $date = $_POST['date'];
    $hall = $_POST['hall'];
    $mlink = $_POST['mlink'];
    $role = $_POST['role'];
    $iitid = $_POST['iitid'];
    $staffemail = $_POST['staffemail'];

    $sql = "INSERT INTO `schedule` (`meeting_time`, `meeting_date`, `hall`, `link`, `role`, `iitid`, `staffemail`) VALUES ('$time', '$date', '$hall', '$mlink', '$role', '$iitid', '$staffemail');";

    if(mysqli_query($conn, $sql)){
      header('Location: admin-schedule-manage.php');
    }else{
      echo "Error!".mysqli_error($conn);
    }
  }

//---- Bulk schedule CSV upload ----

if(isset($_POST['schedule_bulk_upload'])){

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
              $time = $line[0];
              $date = $line[1];
              $hall = $line[2];
              $mlink = $line[3];
              $role = $line[4];
              $iitid = $line[5];
              $staffemail = $line[6];
              
              // Check whether schedule already exists in the database with the same iitid
              $prevQuery = "SELECT iitid FROM schedule WHERE iitid = '".$line[5]."' AND role = '".$line[4]."' AND staffemail = '".$line[6]."'";
              $prevResult = $conn->query($prevQuery);
              
              if($prevResult->num_rows == 1){
                  // Update schedule data in the database
                  $conn->query("UPDATE schedule SET meeting_time = '".$time."',meeting_date = '".$date."',hall = '".$hall."',link = '".$mlink."'  WHERE iitid = '".$iitid."' AND role = '".$role."' AND staffemail = '".$staffemail."'");
              }else{
                  // Insert schedule data in the database
                  $conn->query("INSERT INTO `schedule` (`meeting_time`, `meeting_date`, `hall`, `link`, `role`, `iitid`, `staffemail`) VALUES ('$time', '$date', '$hall', '$mlink', '$role', '$iitid', '$staffemail');");
              }
          }
          
          // Close opened CSV file
          fclose($csvFile);
          
          $qstring = '?status=succ';
          $_SESSION['status_schedule_csv_load'] = "Success!";
      }else{
          $qstring = '?status=err';
          $_SESSION['status_schedule_csv_load'] = "Error!";
      }
  }else{
      $qstring = '?status=invalid_file';
      $_SESSION['status_schedule_csv_load'] = "Invalid file type!";
  }
}

 //---- END ----
?>
<body>
    <div class="container-fluid">
        <div class="row">
            <?php include("admin-nav.php") ?>
        </div>
        <div class="row">
          <div class="col-md-6 my-4 p-4">
            <h1 class="display-4 pb-3">Schedule Marking</h1>

            <form method="POST" class="row g-3">
              <div class="col-md-6">
                <label class="form-label">Student ID [IIT]</label>
                <!-- <input name="iitid" type="studentID" class="form-control"> -->
                <select name="iitid" id="inputState" class="form-select">
                  <?php
                    $staffEmail = "SELECT iitid,studentname FROM Student";
                    $staffEmailList = mysqli_query($conn, $staffEmail);
                    if(mysqli_num_rows($staffEmailList) > 0){
                      while($emailRow = mysqli_fetch_assoc($staffEmailList)){
                        echo '<option value="'.$emailRow['iitid'].'">'.$emailRow['iitid'].'-'.$emailRow['studentname'].'</option>';
                      }
                    }else{
                        echo '<option value="None">No student registered!</option>';
                    }
                  ?>
                </select>
              </div>
              <div class="col-md-6">
                <label class="form-label">Meeting link</label>
                <input name="mlink" type="url" class="form-control">
              </div>
              <div class="col-6">
                <label for="fullName" class="form-label">Staff email</label>
                <select name="staffemail" id="inputState" class="form-select">
                  <!-- <option value="Supervisor" selected>Select</option> -->
                  <?php
                    $staffEmail = "SELECT staffemail,staffname FROM Staff";
                    $staffEmailList = mysqli_query($conn, $staffEmail);
                    if(mysqli_num_rows($staffEmailList) > 0){
                      while($emailRow = mysqli_fetch_assoc($staffEmailList)){
                        echo '<option value="'.$emailRow['staffemail'].'">'.$emailRow['staffemail'].'</option>';
                      }
                    }
                    else{
                      echo '<option value="None">No staff registered!</option>';
                    }
                  ?>
                </select>
              </div>
              <div class="col-md-6">
                <label class="form-label">Date</label>
                <input name="date" type="date" class="form-control">
              </div>
              <div class="col-md-6">
                <label class="form-label">Role</label>
                <select name="role" id="inputState" class="form-select">
                  <option value="Supervisor" selected>Supervisor</option>
                  <option value="Examiner1">Examiner 1</option>
                  <option value="Examiner2">Examiner 2</option>
                  <option value="Chair">Chair</option>
                </select>
              </div>
            
              <div class="col-md-6">
                <label class="form-label">Time</label>
                <input name="time" type="time" class="form-control">
              </div>

              <div class="col-md-6">
                <label class="form-label">Hall (Venue)</label>
                <input name="hall" type="text" class="form-control">
              </div>
             
              <div class="col-md-6 mt-5">
                <button name="btnsub" type="submit" class="btn btn-success">Register</button>
                <button type="reset" class="btn btn-warning">Clear</button>
                <a class="btn btn-secondary" href="admin-schedule-manage.php">View</a>
              </div>
            </form>

            </div>

          <div class="col-md-6 my-4 p-4">
            <h1 class="display-3 pb-3">Bulk upload</h1>
              <form method="post" enctype="multipart/form-data">
                <div class="mb-3">
                  <label for="formFile" class="form-label">Upload from CSV File <a href="Images/schedules.csv" download>Download the template</a> [delete sample record]</label>
                  <input class="form-control" type="file" name="file" id="formFile">
                  <a class="nav-link" href="#">Download template</a>
                </div>
                <div class="col-12">
                  <button type="submit" name="schedule_bulk_upload" class="btn btn-success">Upload</button>
                  <button type="reset" class="btn btn-warning">Clear</button>
                  <a class="btn btn-secondary" href="admin-schedule-manage.php">View</a>
                  <span><?php if(isset($_SESSION['status_schedule_csv_load'])){echo $_SESSION['status_schedule_csv_load'];} unset($_SESSION['status_schedule_csv_load']);?></span>
                </div>
              </form>
            </div>
          
      </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"></script>
</body>
</html>