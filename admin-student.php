<!DOCTYPE html>
<html lang="en">
<?php include("head.php"); ?>
<?php
  session_start();
  //--- admin check ----
  if(empty($_SESSION['security'])){
    header("Location: 404.php", true, 301);
    exit();
  }

  if($_SESSION['email']==""){
    header("Location: 404.php", true, 301);
    exit();
  }
  


  include 'con.php';

  if(isset($_POST['btnsubmit'])){

    $iitid = $_POST['iitid'];
    $email = $_POST['email'];
    $password = $_POST['pass'];
    $uowno = $_POST['uow'];
    $studentname = $_POST['name'];
    $projtitle = $_POST['projtitle'];
    $stream = $_POST['stream'];
    $resarea = $_POST['resarea'];
    $shortdes = $_POST['shortdes'];
    
    $sql = "INSERT INTO `Student` (`iitid`, `email`, `pass`, `uowno`, `studentname`, `projtitle`, `stream`, `resarea`, `shortdes`, `final_viva_mark`, `final_report_mark`, `final_project_mark`, `final_module_mark`) VALUES ('$iitid', '$email', '$password', '$uowno', '$studentname', '$projtitle', '$stream', '$resarea', '$shortdes', 0, 0, 0, 0);";

    if(mysqli_query($conn, $sql)){

      //Update examiner marks table with this student
      $sql_update_examiner = "INSERT INTO `examiner_mark` (`iitid`,`examiner_count`) VALUES ($iitid,1),($iitid,2);";
      if(mysqli_query($conn, $sql_update_examiner)){
        echo "Examiner table has been updated!";
      }else{
        echo "Error!".mysqli_error($conn);
      }

      //Update supervisor marks table with this student
      $sql_update_supervisor = "INSERT INTO `sup_mark_pp_pspd` (`iitid`) VALUES ($iitid);";
      if(mysqli_query($conn, $sql_update_supervisor)){
        echo "Supervisor table has been updated!";
      }else{
        echo "Error!".mysqli_error($conn);
      }

      //Update chair table with this student
      $sql_update_chair = "INSERT INTO `chair` (`iitid`) VALUES ($iitid);";
      if(mysqli_query($conn, $sql_update_chair)){
        echo "Chair table has been updated!";
      }else{
        echo "Error!".mysqli_error($conn);
      }

      //Redirect to the list of students page
      header('Location: admin-student-manage.php');
    }else{
      echo "Error!".mysqli_error($conn);
    }
    
  }

  //---- Bulk student CSV upload ----
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
                    $conn->query("INSERT INTO `Student` (`iitid`, `email`, `pass`, `uowno`, `studentname`, `projtitle`, `stream`, `resarea`, `shortdes`,`final_viva_mark`, `final_report_mark`, `final_project_mark`, `final_module_mark`) VALUES ('$iitid', '$email', '$password', '$uowno', '$studentname', '$projtitle', '$stream', '$resarea', '$shortdes',0, 0, 0, 0);");
                    $conn->query("INSERT INTO `examiner_mark` (`iitid`,`examiner_count`) VALUES ($iitid,1),($iitid,2);");
                    $conn->query("INSERT INTO `sup_mark_pp_pspd` (`iitid`) VALUES ($iitid);");
                    $conn->query("INSERT INTO `chair` (`iitid`) VALUES ($iitid);");
                }
            }
            
            // Close opened CSV file
            fclose($csvFile);
            
            $qstring = '?status=succ';
            $_SESSION['status_student_csv_load'] = "Success!";
        }else{
            $qstring = '?status=err';
            $_SESSION['status_student_csv_load'] = "Error!";
        }
    }else{
        $qstring = '?status=invalid_file';
        $_SESSION['status_student_csv_load'] = "Invalid file type!";
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
            <h1 class="display-3 pb-3">Registration</h1>

            <form method="POST" class="row g-3">
              <div class="col-md-6">
                <label class="form-label">Student IIT ID</label>
                <input name="iitid" type="number" class="form-control">
              </div>
              <div class="col-md-6">
                <label class="form-label">Student UoW No</label>
                <input name="uow" type="text" class="form-control">
              </div>

              <div class="col-md-6">
                <label class="form-label">Student Email</label>
                <input name="email" type="email" class="form-control">
              </div>

              <div class="col-md-6">
                <label class="form-label">Password</label>
                <input name="pass" type="password" class="form-control">
              </div>
            
              <div class="col-6">
                <label for="fullName" class="form-label">Student Name</label>
                <input name="name" type="text" class="form-control" id="fullName" >
              </div>

              <div class="col-6">
                <label for="fullName" class="form-label">Project Title</label>
                <input name="projtitle" type="text" class="form-control" id="fullName" >
              </div>

              <div class="col-md-6">
                <label class="form-label">Stream</label>
                <select name="stream" id="inputState" class="form-select">
                  <option value="CS" selected>CS</option>
                  <option value="SE">SE</option>
                </select>
              </div>
              
              <div class="col-6">
                <label for="Research area" class="form-label">Research Area</label>
                <input name="resarea" type="text" class="form-control" id="fullName" >
              </div>

              <div class="col-6">
                <label for="shortdes area" class="form-label">Short Description</label>
                <textarea name="shortdes" class="form-control"  placeholder="Short Description of the project"></textarea>
              </div>
                        
              <div class="col-12">
                <button name="btnsubmit" type="submit" class="btn btn-success">Register</button>
                <button type="reset" class="btn btn-warning">Clear</button>
                <a href="admin-student-manage.php" class="btn btn-secondary">View</a>
              </div>
            </form>
            </div>

          <div class="col-md-6 my-4 p-4">
            <h1 class="display-3 pb-3">Bulk upload</h1>

            <form method="post" enctype="multipart/form-data">
              <div class="mb-3">
                <label for="formFile" class="form-label">Upload from CSV File <a href="Images/student_list.csv" download>Download the template</a>[delete sample record]</label>
                <input class="form-control" type="file" name="file" id="formFile">
              </div>
              <div class="col-12">
                <button type="submit" name="student_upload" class="btn btn-success">Upload</button>
                <button type="reset" class="btn btn-warning">Clear</button>
                <a href="admin-student-manage.php" class="btn btn-secondary">View</a>
                <span><?php if(isset($_SESSION['status_student_csv_load'])){echo $_SESSION['status_student_csv_load'];} unset($_SESSION['status_student_csv_load']);?></span>
              </div>
            </form>

            </div>
            
          
      </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"></script>
</body>
</html>