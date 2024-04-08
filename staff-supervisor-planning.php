<?php
session_start();
if($_SESSION['email']==""){
  header("Location: 404.php", true, 301);
  exit();
}
include 'con.php';

$iitId = $_GET['iidit'];
$staffEmail = $_GET['staffEmail'];

$sql_student = "SELECT * FROM Student WHERE iitid = $iitId";
$results = mysqli_query($conn, $sql_student);
if(mysqli_num_rows($results) > 0){
  while($row = mysqli_fetch_assoc($results)){
    $_SESSION['student_proj'] = $row['studentname']."(".$row['iitid'].") - ".$row['projtitle'];
  }
}

if(isset($_POST['btnsub'])){
  $plan = $_POST['planning'];
 
  $sql = "UPDATE `sup_mark_pp_pspd` SET `planning` = '$plan', `staffemail` = '$staffEmail' WHERE `sup_mark_pp_pspd`.`iitid` = $iitId";

  if(mysqli_query($conn, $sql)){
    $_SESSION['status'] = "Updated!";
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
                    <h1 class="display-3 pb-3">Staff Supervisor Planning</h1>
                    <h5 class="pb-3"><?php if(isset($_SESSION['student_proj'])){echo $_SESSION['student_proj'];}?></h5>
              </div>
            </div>
                
            <div class="col-md-8 my-4 p-4 offset-md-3">
              <form class="row g-3" method="POST">
                  
                <div class="col-md-8">
                  <label class="form-label">Planning, consultation, and engagement (<a href="#">Criteria</a>)</label> 
                  <input name="planning" type="number" class="form-control" placeholder = "Out of 100">
                </div>
                
                <div class="col-8 mt-5">
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
</body>
</html>