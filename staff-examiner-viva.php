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
  $difficulty = $_POST['difficulty'];
  $exisskill = $_POST['exisskill'];
  $newskill = $_POST['newskill'];
  $proimp = $_POST['proimp'];
  $understand = $_POST['understand'];
  $addedval = $_POST['addedval'];
  $overallcom = $_POST['overallcom'];
  $tot_viva = ($difficulty + $exisskill + $newskill + $proimp + $understand)/5;
 
  $sql = "UPDATE `examiner_mark` SET `staffemail` = '$staffEmail',`examiner_count` = $exCount, `difficulty` = $difficulty,`exisskill` = $exisskill,`newskill` = $newskill,`proimp` = $proimp,`understand` = $understand,`addedval` = '$addedval',`overallcom` = '$overallcom',`total_viva` = $tot_viva  WHERE `examiner_mark`.`iitid` = $iitId";

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
                    <h1 class="display-3 pb-3">Staff Examiner VIVA</h1>
                    <h5 class="pb-3"><?php if(isset($_SESSION['student_proj'])){echo $_SESSION['student_proj'];}?></h5>
            </div>
                
            <div class="col-md-6 my-4 p-4 offset-md-3">

            <form method="POST" class="row g-3">
                
              <div class="col-md-6">
                <label class="form-label">Difficulty (<a href="#">Criteria</a>)</label> 
                <input name="difficulty" type="number" class="form-control" placeholder = "Out of 100">
              </div>
              <div class="col-md-6">
                <label class="form-label">Understanding (<a href="#">Criteria</a>)</label>
                <input name="understand" type="number" class="form-control" placeholder = "Out of 100">
              </div>
              <div class="col-md-6">
              <label class="form-label">Development of existing skills  (<a href="#">Criteria</a>)</label>
                <input name="exisskill" type="number" class="form-control" placeholder = "Out of 100">
              </div>
              <div class="col-md-6">
                <label class="form-label">Added Value. </label>
                <textarea name="addedval" class="form-control"></textarea>
              </div>
              <div class="col-md-6">
                <label class="form-label">Development of new skills. (<a href="#">Criteria</a>)</label>
                <input name="newskill" type="number" class="form-control" placeholder = "Out of 100">
              </div>
              <div class="col-md-6">
                <label class="form-label">Over all comment</label>
                <textarea name="overallcom" class="form-control"></textarea>
              </div>
              <div class="col-md-6">
                <label class="form-label">Product/Implementation/Application/Research (Criteria)(<a href="#">Criteria</a>)</label>
                <input name="proimp" type="number" class="form-control" placeholder = "Out of 100">
              </div>
              <div class="col-md-6"></div>
              <div class="col-md-6">
                <label class="form-label">Total</label>
                <input type="number" class="form-control" disabled>
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