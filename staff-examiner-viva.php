<?php
session_start();
if($_SESSION['email']==""){
  header("Location: 404.php", true, 301);
  exit();
}

include 'con.php';

$iitId = $_GET['iidit'];
$staffEmail = $_GET['staffEmail'];
$exCount = $_GET['ex'];


// ----- examiner pre-entered data load -----
$sql_ex_load = "SELECT * FROM examiner_mark WHERE iitid = $iitId AND examiner_count = $exCount";
$results_ex_load = mysqli_query($conn, $sql_ex_load);
if(mysqli_num_rows($results_ex_load) > 0){
  while($row_load = mysqli_fetch_assoc($results_ex_load)){
    $_SESSION['difficulty'] = $row_load['difficulty'];
    $_SESSION['exisskill'] = $row_load['exisskill'];
    $_SESSION['newskill'] = $row_load['newskill'];
    $_SESSION['proimp'] = $row_load['proimp'];
    $_SESSION['understand'] = $row_load['understand'];
    $_SESSION['addedval'] = $row_load['addedval'];
    $_SESSION['overallcom'] = $row_load['overallcom'];
    $_SESSION['total_viva'] = $row_load['total_viva'];
  }
}
// ----- END -----

$sql_student = "SELECT * FROM Student WHERE iitid = $iitId";
$results = mysqli_query($conn, $sql_student);
if(mysqli_num_rows($results) > 0){
  while($row = mysqli_fetch_assoc($results)){
    $_SESSION['student_proj'] = $row['studentname']."(".$row['iitid'].") - ".$row['projtitle'];
  }
}

if(isset($_POST['btnsub'])){
  $difficulty = $_POST['difficulty'];
  $exisskill = $_POST['exisskill'];
  $newskill = $_POST['newskill'];
  $proimp = $_POST['proimp'];
  $understand = $_POST['understand'];
  $addedval = $_POST['addedval'];
  $overallcom = $_POST['overallcom'];
  $tot_viva = ($difficulty + $exisskill + $newskill + $proimp + $understand)/5;
 
  $sql = "UPDATE `examiner_mark` SET `staffemail` = '$staffEmail',`examiner_count` = $exCount, `difficulty` = $difficulty,`exisskill` = $exisskill,`newskill` = $newskill,`proimp` = $proimp,`understand` = $understand,`addedval` = '$addedval',`overallcom` = '$overallcom',`total_viva` = $tot_viva  WHERE `examiner_mark`.`iitid` = $iitId AND `examiner_count` = $exCount";

  if(mysqli_query($conn, $sql)){
    $_SESSION['ex_status'] = "Success!";
  }else{
    echo "Error!".mysqli_error($conn);
  }

   // ---- update log ------
   $log_details = strval($difficulty.", ".$exisskill.", ".$newskill.", ".$proimp.", ".$understand.", ".$addedval.", ".$overallcom.", ".$tot_viva);

   $sql_log = "INSERT INTO `logs` (`table_name`, `login_email`, `log`, `time`,`student_id`) VALUES ('Examiner-viva', '$staffEmail', '$log_details',now(),$iitId);";
   mysqli_query($conn, $sql_log);
}


?>
<!DOCTYPE html>
<html lang="en">
<?php include("head.php"); ?>
<body>
    <div class="container-fluid">
        <div class="row">
            <?php include("staff-nav.php") ?>
        </div>
            <div class="row">
            <div class="col-md-12">
                    <h1 class="display-3 pb-3">Staff Examiner VIVA</h1>
                    <h5 class="pb-3"><?php if(isset($_SESSION['student_proj'])){echo $_SESSION['student_proj'];}?></h5>
            </div>
                
            <div class="col-md-6 my-4 p-4 offset-md-3">

            <form method="POST" class="row g-3">
                
              <div class="col-md-6">
                <label class="form-label">Difficulty (<a href="#">Criteria</a>)</label> 
                <input name="difficulty" type="number" class="form-control" placeholder = "Out of 100" value="<?php if(isset($_SESSION['difficulty'])){echo $_SESSION['difficulty'];} unset($_SESSION['difficulty']);?>">
              </div>
              <div class="col-md-6">
                <label class="form-label">Understanding (<a href="#">Criteria</a>)</label>
                <input name="understand" type="number" class="form-control" placeholder = "Out of 100" value="<?php if(isset($_SESSION['understand'])){echo $_SESSION['understand'];} unset($_SESSION['understand']);?>">
              </div>
              <div class="col-md-6">
              <label class="form-label">Development of existing skills  (<a href="#">Criteria</a>)</label>
                <input name="exisskill" type="number" class="form-control" placeholder = "Out of 100" value="<?php if(isset($_SESSION['exisskill'])){echo $_SESSION['exisskill'];} unset($_SESSION['exisskill']);?>">
              </div>
              <div class="col-md-6">
                <label class="form-label">Added Value. </label>
                <textarea name="addedval" class="form-control"><?php if(isset($_SESSION['addedval'])){echo $_SESSION['addedval'];}?></textarea>
              </div>
              <div class="col-md-6">
                <label class="form-label">Development of new skills. (<a href="#">Criteria</a>)</label>
                <input name="newskill" type="number" class="form-control" placeholder = "Out of 100" value="<?php if(isset($_SESSION['newskill'])){echo $_SESSION['newskill'];} unset($_SESSION['newskill']);?>">
              </div>
              <div class="col-md-6">
                <label class="form-label">Over all comment</label>
                <textarea name="overallcom" class="form-control"><?php if(isset($_SESSION['overallcom'])){echo $_SESSION['overallcom'];}?></textarea>
              </div>
              <div class="col-md-6">
                <label class="form-label">Product/Implementation/Application/Research (Criteria)(<a href="#">Criteria</a>)</label>
                <input name="proimp" type="number" class="form-control" placeholder = "Out of 100" value="<?php if(isset($_SESSION['proimp'])){echo $_SESSION['proimp'];} unset($_SESSION['proimp']);?>">
              </div>
              <div class="col-md-6"></div>
              <div class="col-md-6">
                <label class="form-label">Total</label>
                <input type="number" class="form-control" disabled value="<?php if(isset($_SESSION['total_viva'])){echo $_SESSION['total_viva'];} unset($_SESSION['total_viva']);?>">
              </div>
              
              <div class="col-12">
                <button name="btnsub" type="submit" class="btn btn-success">Submit</button>
                <button type="reset" class="btn btn-warning">Clear</button>
                <span id="status"><?php if(isset($_SESSION['ex_status'])){echo $_SESSION['ex_status'];} unset($_SESSION['ex_status']); unset($_SESSION['ex_status']);?></span>
              </div>
            </form>

            </div>
      </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"></script>
</body>
</html>