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
    $aims = $_POST['aims'];
    $req = $_POST['req'];
    $stak = $_POST['stak'];
    $reff = $_POST['reff'];
    $elicit = $_POST['elicit'];
    $proto = $_POST['proto'];
    $listofreq = $_POST['listofreq'];
    $supfeed = $_POST['supfeed'];
    $below40 = $_POST['below40'];
    $total_pspd = ($aims + $req + $stak + $reff + $elicit + $proto + $listofreq)/7;
   
    $sql = "UPDATE `sup_mark_pp_pspd` SET `staffemail` = '$staffEmail', `aim` = $aims,`stakehold` = $stak,`elicitation` = $elicit,`reqlist_pspd` = $listofreq,`reqana` = $req,`ref` = $reff,`protodemo` = $proto,`supfeed_pspd` = '$supfeed',`below40_pspd` = '$below40',`tot_pspd` = $total_pspd  WHERE `sup_mark_pp_pspd`.`iitid` = $iitId";

    if(mysqli_query($conn, $sql)){
      $_SESSION['status'] = "Success!";
    }else{
      echo "Error!".mysqli_error($conn);
    }

    // ---- update log ------
    $log_details = strval($aims.", ".$req.", ".$stak.", ".$reff.", ".$elicit.", ".$proto.", ".$listofreq.", ".$supfeed.", ".$below40.", ".$total_pspd);

    $sql_log = "INSERT INTO `logs` (`table_name`, `login_email`, `log`, `time`,`student_id`) VALUES ('Supervisor-PP', '$staffEmail', '$log_details',now(),$iitId);";
    mysqli_query($conn, $sql_log);
  }

  $sql_student = "SELECT * FROM Student WHERE iitid = $iitId";
  $results = mysqli_query($conn, $sql_student);
  if(mysqli_num_rows($results) > 0){
    while($row = mysqli_fetch_assoc($results)){
      $_SESSION['student_proj'] = $row['studentname']."(".$row['iitid'].") - ".$row['projtitle'];
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
                    <h1 class="display-3 pb-3">Staff Supervisor PSDP</h1>
                    <h5 class="pb-3"><?php if(isset($_SESSION['student_proj'])){echo $_SESSION['student_proj'];}?></h5>
            </div>
                
            <div class="col-md-6 my-4 p-4 offset-md-3">

            <form method="POST" class="row g-3">
                
              <div class="col-md-6">
                <label class="form-label">Aims and objectives (<a href="#">Criteria</a>)</label> 
                <input name="aims" type="number" class="form-control" onkeyup="ttl()" placeholder="out of 100">
              </div>
              <div class="col-md-6">
                <label class="form-label">Requirements analysis and modelling (<a href="#">Criteria</a>)</label>
                <input name="req" type="number" class="form-control" onkeyup="ttl()" placeholder="out of 100">
              </div>
              <div class="col-md-6">
              <label class="form-label">Stakeholders (<a href="#">Criteria</a>)</label>
                <input name="stak" type="number" class="form-control" onkeyup="ttl()" placeholder="out of 100">
              </div>
              <div class="col-md-6">
                <label class="form-label">References & Bibliography</label>
                <input name="reff" type="number" class="form-control" onkeyup="ttl()" placeholder="out of 100">
              </div>
              <div class="col-md-6">
                <label class="form-label">Elicitation of requirements (<a href="#">Criteria</a>)</label>
                <input name="elicit" type="number" class="form-control" onkeyup="ttl()" placeholder="out of 100">
              </div>
              <div class="col-md-6">
                <label class="form-label">Prototype & Demo Video: Evidence of engagement with realising the design</label>
                <input name="proto" type="number" class="form-control" onkeyup="ttl()" placeholder="out of 100">
              </div>
              <div class="col-md-6">
                <label class="form-label">List of requirements (<a href="#">Criteria</a>)</label>
                <input name="listofreq" type="number" class="form-control" onkeyup="ttl()" placeholder="out of 100">
              </div>
              <div class="col-md-6"> </div>
              <div class="col-md-6">
                <label class="form-label">Supervisor Feedback</label>
                <textarea name="supfeed" class="form-control" ></textarea>
              </div>
              <div class="col-md-6">
                <label class="form-label">If student is an resit student (Below 40) What needs to be improved</label>
                <textarea name="below40" class="form-control"></textarea>
              </div>
              <div class="col-md-12">
                
                <input name="total_pp" id="total_pp" type="number" class="form-control" placeholder="Please fill all criteria for average marks" disabled>
                
              </div>
              
              <div class="col-12">
                <button name="btnsub" type="submit" class="btn btn-success">Submit</button>
                <button type="reset" class="btn btn-warning">Clear</button>
                <span id="status"><?php if(isset($_SESSION['status'])){echo $_SESSION['status'];} unset($_SESSION['status']);  ?></span>
              </div>
            </form>

            </div>
      </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"></script>

    <script>
      

      function ttl(){
        $aim = parseInt(document.getElementsByName("aims")[0].value);
        $req = parseInt(document.getElementsByName("req")[0].value);
        $stak = parseInt(document.getElementsByName("stak")[0].value);
        $reff = parseInt(document.getElementsByName("reff")[0].value);
        $elicit = parseInt(document.getElementsByName("elicit")[0].value);
        $proto = parseInt(document.getElementsByName("proto")[0].value);
        $listofreq = parseInt(document.getElementsByName("listofreq")[0].value);
        

        //$total = (parseInt($aim)*0.14285714285) + (parseInt($req)*0.14285714285) + (parseInt($stak)*0.14285714285) + (parseInt($reff)*0.14285714285) + (parseInt($elicit)*0.14285714285) + (parseInt($proto)*0.14285714285) + (parseInt($listofreq)*0.14285714285);
        
        $total = eval($aim+$req+$stak+$reff+$elicit+$proto+$listofreq)/7;
        
        document.getElementById("total_pp").value = $total.toFixed(2);
      }

     
    </script>
</body>
</html>