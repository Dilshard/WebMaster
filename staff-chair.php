<?php
session_start();
if($_SESSION['email']==""){
  header("Location: 404.php", true, 301);
  exit();
}
include 'con.php';
$iitId = $_GET['iitid'];
$staffEmail = $_GET['staffEmail'];

// Student name project title update
$sql_student = "SELECT * FROM Student WHERE iitid = $iitId";
$results_st = mysqli_query($conn, $sql_student);
if(mysqli_num_rows($results_st) > 0){
  while($row = mysqli_fetch_assoc($results_st)){
    $_SESSION['student_proj'] = $row['studentname']."(".$row['iitid'].") - ".$row['projtitle'];
  }
}

// Supervisor table data retrieve
$sql_supervisor = "SELECT * FROM sup_mark_pp_pspd WHERE iitid = $iitId";
$results_sup = mysqli_query($conn, $sql_supervisor);
if(mysqli_num_rows($results_sup) > 0){
  while($row = mysqli_fetch_assoc($results_sup)){
    $_SESSION[$iitId.'tot_pp'] = $row['tot_pp'];
    $_SESSION[$iitId.'tot_pspd'] = $row['tot_pspd'];
    $_SESSION[$iitId.'planning'] = $row['planning'];
    $_SESSION[$iitId.'supfeed_pspd'] = $row['supfeed_pspd'];
  }
}

// Examiner 1 table data retrieve
$sql_ex1 = "SELECT * FROM examiner_mark WHERE iitid = $iitId AND examiner_count = 1";
$results_ex1 = mysqli_query($conn, $sql_ex1);
if(mysqli_num_rows($results_ex1) > 0){
  while($row = mysqli_fetch_assoc($results_ex1)){
    $_SESSION[$iitId.'tot_report'] = $row['tot_report'];
    $_SESSION[$iitId.'total_viva'] = $row['total_viva'];
    
    $_SESSION[$iitId.'difficulty'] = $row['difficulty'];
    $_SESSION[$iitId.'exisskill'] = $row['exisskill'];
    $_SESSION[$iitId.'newskill'] = $row['newskill'];
    $_SESSION[$iitId.'proimp'] = $row['proimp'];
    $_SESSION[$iitId.'understand'] = $row['understand'];
    $_SESSION[$iitId.'addedval'] = $row['addedval'];
    $_SESSION[$iitId.'overallcom'] = $row['overallcom'];
  }
}

// Examiner 2 table data retrieve
$sql_ex2 = "SELECT * FROM examiner_mark WHERE iitid = $iitId AND examiner_count = 2";
$results_ex2 = mysqli_query($conn, $sql_ex2);
if(mysqli_num_rows($results_ex2) > 0){
  while($row = mysqli_fetch_assoc($results_ex2)){
    $_SESSION[$iitId.'tot_report_ex2'] = $row['tot_report'];
    $_SESSION[$iitId.'total_viva_ex2'] = $row['total_viva'];
    
    $_SESSION[$iitId.'difficulty_ex2'] = $row['difficulty'];
    $_SESSION[$iitId.'exisskill_ex2'] = $row['exisskill'];
    $_SESSION[$iitId.'newskill_ex2'] = $row['newskill'];
    $_SESSION[$iitId.'proimp_ex2'] = $row['proimp'];
    $_SESSION[$iitId.'understand_ex2'] = $row['understand'];
    $_SESSION[$iitId.'addedval_ex2'] = $row['addedval'];
    $_SESSION[$iitId.'overallcom_ex2'] = $row['overallcom'];
  }
}

//Chair table update
if(isset($_POST['btnsub'])){
  $ex1_rep_mk = $_POST['ex1_rep_mk'];
  $ex1_viva_mk = $_POST['ex1_viva_mk'];
  $ex1_difficult = $_POST['ex1_difficult'];
  $ex1_understand = $_POST['ex1_understand'];
  $ex1_exiskill = $_POST['ex1_exiskill'];
  $ex1_newskill = $_POST['ex1_newskill'];
  $ex1_proimpl = $_POST['ex1_proimpl'];
  $ex1_addedval = $_POST['ex1_addedval'];
  $ex1_overall = $_POST['ex1_overall'];

  $ex2_rep_mk = $_POST['ex2_rep_mk'];
  $ex2_viva_mk = $_POST['ex2_viva_mk'];
  $ex2_difficult = $_POST['ex2_difficult'];
  $ex2_understand = $_POST['ex2_understand'];
  $ex2_exiskill = $_POST['ex2_exiskill'];
  $ex2_newskill = $_POST['ex2_newskill'];
  $ex2_proimpl = $_POST['ex2_proimpl'];
  $ex2_addedval = $_POST['ex2_addedval'];
  $ex2_overall = $_POST['ex2_overall'];

  $simindex = $_POST['simindex'];
  $similaritycon = $_POST['similaritycon'];
  $thirdmk = $_POST['thirdmk'];
  $final_mk_chair = $_POST['final_mk_chair'];
  $chair_feed = $_POST['chair_feed'];
  $final_viva_mk_update = $_POST['final_viva_mk_update'];
  $final_report_mk_update = $_POST['final_report_mk_update'];
  $final_project_mk_update = $_POST['final_project_mk_update'];
  $final_module_mk_update = $_POST['final_module_mk_update'];

  $sql_chair = "UPDATE `chair` SET 
  `simindex`= $simindex, 
  `simcon` = '$similaritycon', 
  `thirdmark` = '$thirdmk', 
  `finalmk` = $final_mk_chair, 
  `chfeed` = '$chair_feed', 

  `ex1_report_total` = $ex1_rep_mk, 
  `ex1_viva_total` = $ex1_viva_mk, 
  `ex1_difficulty` = $ex1_difficult, 
  `ex1_exisskill` = $ex1_exiskill, 
  `ex1_newskill` = $ex1_newskill , 
  `ex1_proimp` = $ex1_proimpl, 
  `ex1_understand` = $ex1_understand, 
  `ex1_addedval` = '$ex1_addedval', 
  `ex1_overallcom` = '$ex1_overall', 
  
  `ex2_report_total` = $ex2_rep_mk, 
  `ex2_viva_total` = $ex2_viva_mk, 
  `ex2_difficulty` = $ex2_difficult, 
  `ex2_exisskill` = $ex2_exiskill, 
  `ex2_newskill` = $ex2_newskill, 
  `ex2_proimp` = $ex2_proimpl, 
  `ex2_understand` = $ex2_understand, 
  `ex2_addedval` = '$ex2_addedval', 
  `ex2_overallcom` = '$ex2_overall', 
  `staffemail` = '$staffEmail'
  
  WHERE `iitid` = $iitId;";

  if(mysqli_query($conn, $sql_chair)){
    header('Location: staff-schedules.php');
  }else{
    echo "Error!".mysqli_error($conn);
  }

  // ----- student table update ----
  $sql_chair = "UPDATE `Student` SET 
  `final_viva_mark`= $final_viva_mk_update, 
  `final_report_mark` = $final_report_mk_update, 
  `final_project_mark` = $final_project_mk_update, 
  `final_module_mark` = $final_module_mk_update
  
  WHERE `iitid` = $iitId;";

  if(mysqli_query($conn, $sql_chair)){
    header('Location: staff-schedules.php');
  }else{
    echo "Error!".mysqli_error($conn);
  }

     // ---- update log ------
     $log_details = strval($ex1_rep_mk.", ".$ex1_viva_mk.", ".$ex1_difficult.", ".$ex1_understand.", ".$ex1_exiskill.", ".$ex1_newskill.", ".$ex1_proimpl.", ".$ex1_addedval.", ".$ex1_overall.", ".$ex2_rep_mk.", ".$ex2_viva_mk.", ".$ex2_difficult.", ".$ex2_understand.", ".$ex2_exiskill.", ".$ex2_newskill.", ".$ex2_proimpl.", ".$ex2_addedval.", ".$ex2_overall.", ".$simindex.", ".$similaritycon.", ".$thirdmk.", ".$final_mk_chair.", ".$chair_feed.", ".$final_viva_mk_update.", ".$final_report_mk_update.", ".$final_project_mk_update.", ".$final_module_mk_update);

     $sql_log = "INSERT INTO `logs` (`table_name`, `login_email`, `log`, `time`,`student_id`) VALUES ('Chair', '$staffEmail', '$log_details',now(),$iitId);";
     mysqli_query($conn, $sql_log);
}

?>
<!DOCTYPE html>
<html lang="en">
<?php include("head.php"); ?>
<head>
<style>
  #rep_avg,
  #rep_dif,
  #viva_avg,
  #viva_dif {
    background-color: #facfb3;
    padding: 3px 4px;
    border-radius : 5px;
    font-size : 20px
  }
</style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <?php include("staff-nav.php") ?>
        </div>
            <div class="row">
            <div class="col-md-12">
                    <h1 class="display-3 pb-3">Staff Chair</h1>
                    <h5 class="pb-3"><?php if(isset($_SESSION['student_proj'])){echo $_SESSION['student_proj'];}?></h5>
            </div>
                
            <div class="col-md-10 my-4 p-4 offset-md-1">

            <form method="POST" class="row g-3" onsubmit="return confirm('Do you really want to submit the form? \nNote: Data cannot be corrected after submitting!');">
                
              <div class="col-md-6">
                <label class="form-label display-5">Supervisor</label> <br>
                <label class="form-label">Proposal : <span id="pp"><?php if(isset($_SESSION[$iitId.'tot_pp'])){echo $_SESSION[$iitId.'tot_pp'];}else{echo 'Not marked!';}?></span></label> <br>
                <label class="form-label">PSDP : <span id="psdp"><?php if(isset($_SESSION[$iitId.'tot_pspd'])){echo $_SESSION[$iitId.'tot_pspd'];}else{echo 'Not marked!';}?></span></label> <br>
                <label class="form-label">Planning : <span id="planning"><?php if(isset($_SESSION[$iitId.'planning'])){echo $_SESSION[$iitId.'planning'];}else{echo 'Not marked!';}?></span></label> <br> 
              </div>
              <div class="col-md-6">
                <label class="form-label display-5">Supervisor Feedback</label> <br>
                <label class="form-label"><?php if(isset($_SESSION[$iitId.'supfeed_pspd'])){echo $_SESSION[$iitId.'supfeed_pspd'];}else{echo 'Not Updated!';}?></label> <br>
              </div>

              <hr>

              <!-- Examiner 1 -->

              <div class="col-md-6 p-4" style="background-color:#bcbcd7">
                <div class="col-md-12">
                  <label class="form-label display-5">Examiner 1 <a class="refresh" href="#">&#8635;</a></label> <br>
                </div>
                
                <div class="row mt-3">
                  <div class="col-md-3">
                    <label class="form-label">Report </label>
                    <input name="ex1_rep_mk" value="<?php if(isset($_SESSION[$iitId.'tot_report'])){echo $_SESSION[$iitId.'tot_report'];}else{echo -1;}?>" type="number" class="form-control">
                  </div>
                  <div class="col-md-3">
                    <label class="form-label">VIVA </label>
                    <input name="ex1_viva_mk" value="<?php if(isset($_SESSION[$iitId.'total_viva'])){echo $_SESSION[$iitId.'total_viva'];}else{echo -1;}?>" type="number" class="form-control">
                  </div>
                </div>

                <div class="row mt-3">
                  <div class="col-md-6">
                    <label class="form-label">Difficulty</label>
                    <input name="ex1_difficult" value="<?php if(isset($_SESSION[$iitId.'difficulty'])){echo $_SESSION[$iitId.'difficulty'];}else{echo -1;}?>" type="number" class="form-control">
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">Understanding</label>
                    <input name="ex1_understand" value="<?php if(isset($_SESSION[$iitId.'understand'])){echo $_SESSION[$iitId.'understand'];}else{echo -1;}?>" type="number" class="form-control">
                  </div>
                </div>

                <div class="row mt-3">
                  <div class="col-md-6">
                    <label class="form-label">Development of existing skills</label>
                    <input name="ex1_exiskill" value="<?php if(isset($_SESSION[$iitId.'exisskill'])){echo $_SESSION[$iitId.'exisskill'];}else{echo -1;}?>" type="number" class="form-control">
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">Development of new skills</label>
                    <input name="ex1_newskill" value="<?php if(isset($_SESSION[$iitId.'newskill'])){echo $_SESSION[$iitId.'newskill'];}else{echo -1;}?>" type="number" class="form-control">
                  </div>
                </div>

                <div class="row mt-3">
                  <div class="col-md-12">
                    <label class="form-label">Product/Implementation/Application/Research</label>
                    <input name="ex1_proimpl" value="<?php if(isset($_SESSION[$iitId.'proimp'])){echo $_SESSION[$iitId.'proimp'];}else{echo -1;}?>" type="number" class="form-control">
                  </div>
                </div>

                <div class="row mt-3">
                  <div class="col-md-6">
                    <label class="form-label">Added Value</label>
                    <textarea name="ex1_addedval" class="form-control" rows="4"><?php if(isset($_SESSION[$iitId.'addedval'])){echo $_SESSION[$iitId.'addedval'];}else{echo "Not updated!";}?></textarea>
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">Over all comment</label>
                    <textarea name="ex1_overall" class="form-control" rows="4"><?php if(isset($_SESSION[$iitId.'overallcom'])){echo $_SESSION[$iitId.'overallcom'];}else{echo "Not updated!";}?></textarea>
                  </div>
                </div>
                
              </div>

              <!-- Examiner 2 -->

              <div class="col-md-6 p-4" style="background-color:#d7bcc1">
              <div class="col-md-12">
                  <label class="form-label display-5">Examiner 2 <a class="refresh" href="#">&#8635;</a></label> <br>
                </div>
                
                <div class="row mt-3">
                  <div class="col-md-3">
                    <label class="form-label">Report </label>
                    <input name="ex2_rep_mk" value="<?php if(isset($_SESSION[$iitId.'tot_report_ex2'])){echo $_SESSION[$iitId.'tot_report_ex2'];}else{echo -1;}?>" type="number" class="form-control">
                  </div>
                  <div class="col-md-3">
                    <label class="form-label">VIVA </label>
                    <input name="ex2_viva_mk" value="<?php if(isset($_SESSION[$iitId.'total_viva_ex2'])){echo $_SESSION[$iitId.'total_viva_ex2'];}else{echo -1;}?>" type="number" class="form-control">
                  </div>
                </div>

                <div class="row mt-3">
                  <div class="col-md-6">
                    <label class="form-label">Difficulty</label>
                    <input name="ex2_difficult" value="<?php if(isset($_SESSION[$iitId.'difficulty_ex2'])){echo $_SESSION[$iitId.'difficulty_ex2'];}else{echo -1;}?>" type="number" class="form-control">
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">Understanding</label>
                    <input name="ex2_understand" value="<?php if(isset($_SESSION[$iitId.'understand_ex2'])){echo $_SESSION[$iitId.'understand_ex2'];}else{echo -1;}?>" type="number" class="form-control">
                  </div>
                </div>

                <div class="row mt-3">
                  <div class="col-md-6">
                    <label class="form-label">Development of existing skills</label>
                    <input name="ex2_exiskill" value="<?php if(isset($_SESSION[$iitId.'exisskill_ex2'])){echo $_SESSION[$iitId.'exisskill_ex2'];}else{echo -1;}?>" type="number" class="form-control">
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">Development of new skills</label>
                    <input name="ex2_newskill" value="<?php if(isset($_SESSION[$iitId.'newskill_ex2'])){echo $_SESSION[$iitId.'newskill_ex2'];}else{echo -1;}?>" type="number" class="form-control">
                  </div>
                </div>

                <div class="row mt-3">
                  <div class="col-md-12">
                    <label class="form-label">Product/Implementation/Application/Research</label>
                    <input name="ex2_proimpl" value="<?php if(isset($_SESSION[$iitId.'proimp_ex2'])){echo $_SESSION[$iitId.'proimp_ex2'];}else{echo -1;}?>" type="number" class="form-control">
                  </div>
                </div>

                <div class="row mt-3">
                  <div class="col-md-6">
                    <label class="form-label">Added Value</label>
                    <textarea name="ex2_addedval" class="form-control" rows="4"><?php if(isset($_SESSION[$iitId.'addedval_ex2'])){echo $_SESSION[$iitId.'addedval_ex2'];}else{echo "Not updated!";}?></textarea>
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">Over all comment</label>
                    <textarea name="ex2_overall" class="form-control" rows="4"><?php if(isset($_SESSION[$iitId.'overallcom_ex2'])){echo $_SESSION[$iitId.'overallcom_ex2'];}else{echo "Not updated!";}?></textarea>
                  </div>
                </div>
              </div>

              <hr>

              <div class="col-md-6 p-4">
                <div class="row mt-4">
                  <div class="col-md-12">
                    <label class="form-label">Similarity Index Generated by Turnitin </label>
                    <input name="simindex" value="0" type="number" class="form-control">
                  </div>
                  <div class="col-md-12 mt-4">
                    <label class="form-check-label">Is the similarity index at concerning amount?</label> <br>                    
                  </div>
                  <!-- <div class="col-md-12">
                    Yes <input name="similaritycon" class="form-check-input" type="radio" value="Yes">
                    No <input name="similaritycon" class="form-check-input" type="radio" value="No">
                  </div> -->
                  <div class="col-md-12">
                    <select name="similaritycon" id="inputState" class="form-select">
                      <option selected value="No">No</option>
                      <option value="Yes">Yes</option>
                    </select>
                  </div>

                  
                </div>

                <div class="row mt-3">
                  <div class="col-md-12">
                    <label class="form-label">Third Marking required?</label>
                  </div>
                  <div class="col-md-12 mt-4">
                    <!-- Yes <input name="thirdmk" class="form-check-input" type="radio" value="Yes">
                    No <input name="thirdmk" class="form-check-input" type="radio" value="No"> -->
                    <select name="thirdmk" id="inputState" class="form-select">
                      <option selected value="No">No</option>
                      <option value="Yes">Yes</option>
                    </select>
                  </div>
                </div>

                <div class="row mt-3">
                  <div class="col-md-12 mt-4">
                    <label class="form-label">Final Marks by chair</label>
                    <input name="final_mk_chair" type="text" class="form-control" value="">
                  </div>
                  <div class="col-md-12 mt-4">
                    <label class="form-label">Report Average : <span id="rep_avg"></span> Difference : <span id="rep_dif"></span></label> <br>
                    <label class="form-label">VIVA Average : <span id="viva_avg"></span> Difference : <span id="viva_dif"></span></label>
                    <h6 class="form-label">Negotiate between both examiners if difference >= 5</h6>
                    
                  </div>
                  <div class="col-md-12 mt-4">
                    <label class="form-label">Chair Feedback</label>
                    <textarea name="chair_feed" class="form-control" rows="4"></textarea>
                  </div>
                </div>
              </div>

              <div class="col-md-6 p-4" style="background-color:#e1e1e1">                        
                <div class="row mt-3">
                  <div class="col-md-4">
                    <label class="form-label">Final VIVA Marks : </label>
                  </div>
                  <div class="col-md-8">
                    <input name="final_viva_mk_update" type="text" class="form-control">
                  </div>
                  <div class="col-md-12">
                    <label class="form-label">Average (Difficulty + Understanding + Existing skill + New skills + Implementation/App/ Research)</label>
                  </div>
                </div>

                

                <div class="row mt-3">
                  <div class="col-md-4">
                    <label class="form-label">Final Report Marks : </label>
                  </div>
                  <div class="col-md-8">
                    <input name="final_report_mk_update" type="text" class="form-control">
                  </div>
                  <div class="col-md-12">
                    <label class="form-label">Average (Examiner1 + Examiner 2 Report marks)</label>
                  </div>
                </div>

                
                <div class="row mt-3">
                  <div class="col-md-4">
                    <label class="form-label">Final Project :  </label>
                  </div>
                  <div class="col-md-8">
                    <input name="final_project_mk_update" type="text" class="form-control">
                  </div>
                  <div class="col-md-12">
                    <label class="form-label">Report 70% + VIVA 30%</label>
                  </div>
                </div>

                
                <div class="row mt-3">
                  <div class="col-md-4">
                    <label class="form-label"><b>Final Module Marks :  </b></label>
                  </div>
                  <div class="col-md-8">
                    <input name="final_module_mk_update" type="text" class="form-control">
                  </div>
                  <div class="col-md-12">
                    <label class="form-label">PP 5% + PSDP 25% + Final Project 70%</label>
                  </div>
                </div>
                
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
  <script>
    // <label class="form-label">Report Average : <span id="rep_avg"></span><span id="rep_dif"></span></label> <br>
    // <label class="form-label">VIVA Average : <span id="viva_avg"></span> Difference : <span id="viva_dif"></span></label>

    function report_viva_avg(){
      let ex1_rep = document.getElementsByName("ex1_rep_mk")[0].value;
      let ex2_rep = document.getElementsByName("ex2_rep_mk")[0].value;

      let ex1_viva = document.getElementsByName("ex1_viva_mk")[0].value;
      let ex2_viva = document.getElementsByName("ex2_viva_mk")[0].value;

      let pp = parseFloat(document.getElementById("pp").innerHTML);
      let psdp = parseFloat(document.getElementById("psdp").innerHTML);

      let avg_rep = (parseFloat(ex1_rep) + parseFloat(ex2_rep)) / 2 ;
      let difference_rep = ex1_rep - ex2_rep;

      let avg_viva = (parseFloat(ex1_viva) + parseFloat(ex2_viva)) / 2 ;
      let difference_viva = ex2_viva - ex1_viva;

      document.getElementById("rep_avg").innerHTML = avg_rep;
      document.getElementById("rep_dif").innerHTML = difference_rep;

      document.getElementById("viva_avg").innerHTML = avg_viva;
      document.getElementById("viva_dif").innerHTML = difference_viva;

      if(difference_viva > 0){
        if(difference_viva > 5){
          document.getElementById("viva_dif").style.backgroundColor = "red";
          document.getElementById("viva_dif").style.color = "white";
        }else{
          document.getElementById("viva_dif").style.backgroundColor = "green";
          document.getElementById("viva_dif").style.color = "white";
        }
      }else{
        if(difference_viva < -5){
          document.getElementById("viva_dif").style.backgroundColor = "red";
          document.getElementById("viva_dif").style.color = "white";
        }else{
          document.getElementById("viva_dif").style.backgroundColor = "green";
          document.getElementById("viva_dif").style.color = "white";
        }
      }
      let difficulty = (parseFloat(document.getElementsByName("ex1_difficult")[0].value) + parseFloat(document.getElementsByName("ex2_difficult")[0].value))/2;
      let understand = (parseFloat(document.getElementsByName("ex1_understand")[0].value) + parseFloat(document.getElementsByName("ex2_understand")[0].value))/2;
      let existingSkill = (parseFloat(document.getElementsByName("ex1_exiskill")[0].value) + parseFloat(document.getElementsByName("ex2_exiskill")[0].value))/2;
      let newSkill = (parseFloat(document.getElementsByName("ex1_newskill")[0].value) + parseFloat(document.getElementsByName("ex2_newskill")[0].value))/2;
      let productImplement = (parseFloat(document.getElementsByName("ex1_proimpl")[0].value) + parseFloat(document.getElementsByName("ex2_proimpl")[0].value))/2;
      let planning = parseFloat(document.getElementById("planning").innerHTML);
      
      document.getElementsByName("final_viva_mk_update")[0].value = ((difficulty + understand + existingSkill + newSkill + productImplement + planning)/6).toFixed(2);
      document.getElementsByName("final_mk_chair")[0].value = ((difficulty + understand + existingSkill + newSkill + productImplement + planning)/6).toFixed(2);
      
      document.getElementsByName("final_report_mk_update")[0].value = (avg_rep).toFixed(2);
      document.getElementsByName("final_project_mk_update")[0].value = ((avg_rep*0.7) + (avg_viva*0.3)).toFixed(2);
      let final_proj_mk = (avg_rep*0.7) + (avg_viva*0.3);
      document.getElementsByName("final_module_mk_update")[0].value = ((pp*0.05)+(psdp*0.25)+(final_proj_mk*0.7)).toFixed(2);
    }

    report_viva_avg();
   
    // function validate(form) {
    //   if(!valid) {
    //       alert('Please correct the errors in the form!');
    //       return false;
    //   }
    //   else {
    //       return confirm('Do you really want to submit the form?');
    //   }
    // }
    
  </script>
</body>
</html>