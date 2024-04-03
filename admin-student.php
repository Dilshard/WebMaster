<!DOCTYPE html>
<html lang="en">
<?php include("head.php"); ?>
<?php

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
      $sql_update_examiner = "INSERT INTO `examiner_mark` (`iitid`) VALUES ('$iitid');";

      if(mysqli_query($conn, $sql_update_examiner)){
        echo "Done!";
      }else{
        echo "Error!".mysqli_error($conn);
      }

      header('Location: admin-student-manage.php');
    }else{
      echo "Error!".mysqli_error($conn);
    }


    

    
  }
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
              <div class="mb-3">
                <label for="formFile" class="form-label">Upload from CSV File</label>
                <input class="form-control" type="file" id="formFile">
              </div>
              <div class="col-12">
                <button type="submit" class="btn btn-success">Upload</button>
                <button type="reset" class="btn btn-warning">Clear</button>
                <a href="admin-student-manage.php" class="btn btn-secondary">View</a>
              </div>
            </div>
            
          
      </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"></script>
</body>
</html>