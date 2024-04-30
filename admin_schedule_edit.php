<?php

session_start();
include("validate.php");

if(isset($_POST['id'])){
    $_SESSION['id'] = $_POST['id'];
    $schedule_id = $_SESSION['id'];
}else{
    $schedule_id = $_SESSION['id'];
}

$sql = "SELECT * FROM schedule WHERE schid = $schedule_id";

$results = mysqli_query($conn, $sql);

if(mysqli_num_rows($results) > 0){
    while($row = mysqli_fetch_assoc($results)){
        $_SESSION['meeting_time'] = $row['meeting_time'];
        $_SESSION['meeting_date'] = $row['meeting_date'];
        $_SESSION['hall'] = $row['hall'];
        $_SESSION['link'] = $row['link'];
        $_SESSION['role'] = $row['role'];
        $_SESSION['status'] = $row['status'];
        $_SESSION['iitid'] = $row['iitid'];
        $_SESSION['staffemail'] = $row['staffemail'];
    }
}

$sql_student = "SELECT iitid,studentname FROM Student WHERE iitid = $_SESSION[iitid]";

$results = mysqli_query($conn, $sql_student);

if(mysqli_num_rows($results) == 1){
    while($row = mysqli_fetch_assoc($results)){
        $_SESSION['selected_student'] = $row['iitid'];
        $_SESSION['selected_student'] .=" - ".$row['studentname'];
        $_SESSION['edited_student_id'] = $row['iitid'];
    }
}


// ------ Edit ------
if(isset($_POST['btnsub'])){
    $time = $_POST['time'];
    $date = $_POST['date'];
    $hall = $_POST['hall'];
    $mlink = $_POST['mlink'];
    $role = $_POST['role'];
    $status = 0;
    $iitid = $_SESSION['edited_student_id'];
    $staffemail = $_POST['staffemail'];
   
    $sql_update = "UPDATE schedule SET `meeting_time`= '$time', `meeting_date`= '$date', `hall`= '$hall', `link`= '$mlink', `role`= '$role', `status`= 0, `iitid`= $iitid, `staffemail`='$staffemail' WHERE schid = $schedule_id";
  
    if(mysqli_query($conn, $sql_update)){
      header("Location: admin-schedule-manage.php", true, 301);
      exit();
    }else{
      echo "Error!".mysqli_error($conn);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<?php include("head.php"); ?>
<body>
    <div class="container-fluid">
        <div class="row">
            <?php include("admin-nav.php") ?>
        </div>
        <div class="row">
          <div class="col-md-6 my-4 p-4 offset-md-2">
            <h1 class="display-4 pb-3">Edit schedule</h1>

            <form method="POST" class="row g-3">
              <div class="col-md-6">
                <label class="form-label">Student ID [IIT]</label>
                <!-- <input name="iitid" type="studentID" class="form-control"> -->
                <select name="iitid" id="inputState" class="form-select">
                  <?php
                    $staffEmail = "SELECT iitid,studentname FROM Student";
                    $staffEmailList = mysqli_query($conn, $staffEmail);
                    if(mysqli_num_rows($staffEmailList) > 0){
                        if(isset($_SESSION['selected_student'])){
                            echo '<option value="'.$_SESSION['selected_student'].'" selected>'.$_SESSION['selected_student'].'</option>';
                        }
                      while($emailRow = mysqli_fetch_assoc($staffEmailList)){
                        echo '<option value="'.$emailRow['iitid'].'">'.$emailRow['iitid'].' - '.$emailRow['studentname'].'</option>';
                      }
                    }else{
                        echo '<option value="None">No student registered!</option>';
                    }
                  ?>
                </select>
                
              </div>
              <div class="col-md-6">
                <label class="form-label">Meeting link</label>
                <input name="mlink" type="url" class="form-control" value="<?php if(isset($_SESSION['link'])){echo $_SESSION['link'];}?>">
              </div>
              <div class="col-6">
                <label for="fullName" class="form-label">Staff email</label>
                <select name="staffemail" id="inputState" class="form-select">
                  <!-- <option value="Supervisor" selected>Select</option> -->
                  <?php
                    $staffEmail = "SELECT staffemail,staffname FROM Staff";
                    $staffEmailList = mysqli_query($conn, $staffEmail);
                    if(mysqli_num_rows($staffEmailList) > 0){
                        if(isset($_SESSION['staffemail'])){
                            echo '<option value="'.$_SESSION['staffemail'].'" selected>'.$_SESSION['staffemail'].'</option>';
                        }
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
                <input name="date" type="date" class="form-control" value="<?php if(isset($_SESSION['meeting_date'])){echo $_SESSION['meeting_date'];}?>">
              </div>
              <div class="col-md-6">
                <label class="form-label">Role</label>
                <select name="role" id="inputState" class="form-select">
                    <?php
                    if($_SESSION['role'] == "Supervisor"){
                        echo '
                        <option value="Supervisor" selected>Supervisor</option>
                        <option value="Examiner1">Examiner 1</option>
                        <option value="Examiner2">Examiner 2</option>
                        <option value="Chair">Chair</option>
                        ';
                    }elseif($_SESSION['role'] == "Examiner1"){
                        echo '
                        <option value="Supervisor">Supervisor</option>
                        <option value="Examiner1" selected>Examiner 1</option>
                        <option value="Examiner2">Examiner 2</option>
                        <option value="Chair">Chair</option>
                        ';
                    }elseif($_SESSION['role'] == "Examiner2"){
                        echo '
                        <option value="Supervisor">Supervisor</option>
                        <option value="Examiner1">Examiner 1</option>
                        <option value="Examiner2" selected>Examiner 2</option>
                        <option value="Chair">Chair</option>
                        ';
                    }elseif($_SESSION['role'] == "Chair"){
                        echo '
                        <option value="Supervisor">Supervisor</option>
                        <option value="Examiner1">Examiner 1</option>
                        <option value="Examiner2">Examiner 2</option>
                        <option value="Chair" selected>Chair</option>
                        ';
                    }
                    ?>
                  
                </select>
              </div>
            
              <div class="col-md-6">
                <label class="form-label">Time</label>
                <input name="time" type="time" class="form-control" value="<?php if(isset($_SESSION['meeting_time'])){echo $_SESSION['meeting_time'];}?>">
              </div>

              <div class="col-md-6">
                <label class="form-label">Hall (Venue)</label>
                <input name="hall" type="text" class="form-control" value="<?php if(isset($_SESSION['hall'])){echo $_SESSION['hall'];}?>">
              </div>
             
              <div class="col-md-12 mt-5">
                <button name="btnsub" type="submit" class="btn btn-success">Update</button>
                <button type="reset" class="btn btn-warning">Clear</button>
                <a class="btn btn-secondary" href="admin-schedule-manage.php">View</a>
              </div>
            </form>

            </div>

          
          
      </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"></script>
</body>
</html>