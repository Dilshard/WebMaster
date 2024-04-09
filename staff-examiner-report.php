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

$sql_student = "SELECT * FROM Student WHERE iitid = $iitId";
$results = mysqli_query($conn, $sql_student);
if(mysqli_num_rows($results) > 0){
  while($row = mysqli_fetch_assoc($results)){
    $_SESSION['student_proj'] = $row['studentname']."(".$row['iitid'].") - ".$row['projtitle'];
  }
}

if(isset($_POST['btnsub'])){
  $aims = $_POST['aims'];
  $req = $_POST['req'];
  $stak = $_POST['stak'];
  $reff = $_POST['reff'];
  $elicit = $_POST['elicit'];
  $proto = $_POST['proto'];
  $listofreq = $_POST['listofreq'];
  $exfeed = $_POST['exfeed'];
  $below40 = $_POST['below40'];
  $tot_report = ($aims + $req + $stak + $reff + $elicit + $proto + $listofreq)/7;
 
  $sql = "UPDATE `examiner_mark` SET `staffemail` = '$staffEmail', `aim` = $aims,`stakehold` = $stak,`elicitation` = $elicit,`reqlist` = $listofreq,`reqana` = $req,`ref` = $reff,`protodemo` = $proto,`genfeed` = '$exfeed',`below40` = '$below40',`tot_report` = $tot_report  WHERE `examiner_mark`.`iitid` = $iitId AND `examiner_mark`.`examiner_count` = $exCount";

  if(mysqli_query($conn, $sql)){
    $_SESSION['ex_status'] = "Success!";
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
            <?php include("staff-nav.php") ?>
        </div>
            <div class="row">
            <div class="col-md-12">
                    <h1 class="display-3 pb-3">Staff Examiner Report</h1>
                    <h5 class="pb-3"><?php if(isset($_SESSION['student_proj'])){echo $_SESSION['student_proj'];}?></h5>
            </div>
                
            <div class="col-md-6 my-4 p-4 offset-md-3">

            <form method="POST" class="row g-3">
                
              <div class="col-md-6">
                <label class="form-label">Aims and objectives (<a href="#">Criteria</a>)</label> 
                <input name="aims" type="number" class="form-control" placeholder = "Out of 100">
              </div>
              <div class="col-md-6">
                <label class="form-label">Requirements analysis and modelling (<a href="#">Criteria</a>)</label>
                <input name="req" type="number" class="form-control" placeholder = "Out of 100">
              </div>
              <div class="col-md-6">
              <label class="form-label">Stakeholders (<a href="#">Criteria</a>)</label>
                <input name="stak" type="number" class="form-control" placeholder = "Out of 100">
              </div>
              <div class="col-md-6">
                <label class="form-label">References & Bibliography</label>
                <input name="reff" type="number" class="form-control" placeholder = "Out of 100">
              </div>
              <div class="col-md-6">
                <label class="form-label">Elicitation of requirements (<a href="#">Criteria</a>)</label>
                <input name="elicit" type="number" class="form-control" placeholder = "Out of 100">
              </div>
              <div class="col-md-6">
                <label class="form-label">Prototype & Demo Video: Evidence of engagement with realising the design</label>
                <input name="proto" type="number" class="form-control" placeholder = "Out of 100">
              </div>
              <div class="col-md-6">
                <label class="form-label">List of requirements (<a href="#">Criteria</a>)</label>
                <input name="listofreq" type="number" class="form-control" placeholder = "Out of 100">
              </div>
              <div class="col-md-6"> </div>
              <div class="col-md-6">
                <label class="form-label">Examiner Feedback</label>
                <textarea name="exfeed" class="form-control"></textarea>
              </div>
              <div class="col-md-6">
                <label class="form-label">If student is an resit student (Below 40) What needs to be improved</label>
                <textarea name="below40" class="form-control"></textarea>
              </div>
              <div class="col-md-6">
                <label class="form-label">Total</label>
                <input name="" type="number" class="form-control" disabled>
              </div>
              
              <div class="col-12">
                <button name="btnsub" type="submit" class="btn btn-success">Submit</button>
                <button type="reset" class="btn btn-warning">Clear</button>
                <span id="status"><?php if(isset($_SESSION['ex_status'])){echo $_SESSION['ex_status'];} unset($_SESSION['ex_status']);  ?></span>
              </div>
            </form>

            </div>
      </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"></script>
</body>
</html>