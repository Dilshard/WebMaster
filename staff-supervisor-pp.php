<?php
session_start();
if($_SESSION['email']==""){
  header("Location: 404.php", true, 301);
  exit();
}

include 'con.php';

$iitId = $_GET['iidit'];
$staffEmail = $_GET['staffEmail'];

if(isset($_POST['btnsub'])){
  $probstate = $_POST['probstate'];
  $revsim = $_POST['revsim'];
  $tool = $_POST['tool'];
  $reqlist_pp = $_POST['reqlist_pp'];
  $challenge = $_POST['challenge'];
  $supfeed_pp = $_POST['supfeed_pp'];
  $below40_pp = $_POST['below40_pp'];  
  $total_pp = ($probstate + $revsim + $tool + $reqlist_pp + $challenge)/5;
 
  $sql = "UPDATE `sup_mark_pp_pspd` SET `staffemail` = '$staffEmail', `probstate` = $probstate,`revsim` = $revsim,`tool` = $tool,`reqlist_pp` = $reqlist_pp,`challenge` = $challenge,`supfeed_pp` = '$supfeed_pp',`below40_pp` = '$below40_pp',`tot_pp` = $total_pp  WHERE `sup_mark_pp_pspd`.`iitid` = $iitId";

  if(mysqli_query($conn, $sql)){
    $_SESSION['status'] = "Success!";
  }else{
    echo "Error!".mysqli_error($conn);
  }

  // ---- update log ------
  $log_details = strval($probstate.", ".$revsim.", ".$tool.", ".$reqlist_pp.", ".$challenge.", ".$supfeed_pp.", ".$below40_pp.", ".$total_pp);

  $sql_log = "INSERT INTO `logs` (`table_name`, `login_email`, `log`, `time`,`student_id`) VALUES ('Supervisor-PP', '$staffEmail', '$log_details',now(),$iitId);";
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
                    <h1 class="display-3 pb-3">Staff Supervisor PP</h1>
                    <h5 class="pb-3">Fernando | 12345 | HarmonyCare: Enhancing Mental Health Support</h5>
            </div>
                
            <div class="col-md-6 my-4 p-4 offset-md-3">

            <form method="POST" class="row g-3">
                
              <div class="col-md-6">
                <label class="form-label">Problem statement, aims & objectives (<a href="#">Criteria</a>)</label> 
                <input name="probstate" type="number" class="form-control">
              </div>
              <div class="col-md-6">
                <label class="form-label">List of challenges (including technical and other), timeline and references (<a href="#">Criteria</a>)</label>
                <input name="challenge" type="number" class="form-control">
              </div>
              <div class="col-6">
              <label class="form-label">Review of similar applications or similar research (<a href="#">Criteria</a>)</label>
                <input name="revsim" type="number" class="form-control" id="fullName">
              </div>
              <div class="col-md-6">
                <label class="form-label">Supervisor Feedback</label>
                <textarea name="supfeed_pp" class="form-control"></textarea>
              </div>
              <div class="col-md-6">
                <label class="form-label">Tools (equipment, software, etc.) and technical skills (<a href="#">Criteria</a>)</label>
                <input name="tool" type="number" class="form-control">
              </div>
              <div class="col-md-6">
                <label class="form-label">If student is an resit student (Below 40) What needs to be improved</label>
                <textarea name="below40_pp" class="form-control"></textarea>
              </div>
              <div class="col-md-6">
                <label class="form-label">Initial list of requirements and on-going methods for project requirement elicitation (<a href="#">Criteria</a>)</label>
                <input name="reqlist_pp" type="number" class="form-control">
              </div>
              <div class="col-md-6">
                <label class="form-label">Total</label>
                <input name="total_pp" type="number" class="form-control" disabled>
              </div>
              
              <div class="col-12">
                <button name="btnsub" type="submit" class="btn btn-success">Submit</button>
                <button type="reset" class="btn btn-warning">Clear</button>
              </div>
            </form>
            </div>
      </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"></script>
</body>
</html>