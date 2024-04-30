<?php
include("validate_student.php");

if(isset($_SESSION['iitid'])){
  $sql = "SELECT * FROM Student WHERE iitid = $_SESSION[iitid]";
  $results = mysqli_query($conn, $sql);
  if(mysqli_num_rows($results) == 1){
    while($row = mysqli_fetch_assoc($results)){
      $_SESSION['student_email'] = $row['email'];
      $_SESSION['uowno'] = $row['uowno'];
      $_SESSION['studentname'] = $row['studentname'];
      $_SESSION['projtitle'] = $row['projtitle'];
      $_SESSION['stream'] = $row['stream'];
      $_SESSION['shortdes'] = $row['shortdes'];
    }
  }else{
    echo "Student registration has been duplicated!";
  }
}

$sql_schedule = "SELECT * FROM schedule WHERE iitid = $_SESSION[iitid]";
  $results = mysqli_query($conn, $sql_schedule);
  if(mysqli_num_rows($results) > 0){
    $_SESSION['sc_status'] = 1;
    while($row = mysqli_fetch_assoc($results)){
      if($row['role'] == "Chair"){
        $_SESSION['chair'] = $row['staffemail'];
        $_SESSION['date'] = $row['meeting_date'];
        $_SESSION['hall'] = $row['hall'];
        $_SESSION['link'] = $row['link'];
      }elseif($row['role'] == "Examiner1"){
        $_SESSION['Examiner1'] = $row['staffemail'];
      }
      elseif($row['role'] == "Examiner2"){
        $_SESSION['Examiner2'] = $row['staffemail'];
      }
      elseif($row['role'] == "Supervisor"){
        $_SESSION['Supervisor'] = $row['staffemail'];
      }
    }
  }else{
    $_SESSION['sc_status'] = 0;
  }

?>
<!DOCTYPE html>
<html lang="en">
<?php include("head.php"); ?>
<body>
    <div class="container-fluid">
        <div class="row">
            <?php include("student-nav.php") ?>
        </div>
        <div class="row mt-4">
          <div class="col-md-8 offset-md-2">
            <div class="card">
              <div class="card-header">
                Student Details
              </div>
              <div class="card-body">
                <h5 class="card-title"><?php if(isset($_SESSION['studentname'])){echo $_SESSION['studentname'];}?> | <?php if(isset($_SESSION['uowno'])){echo $_SESSION['uowno'];}?></h5>
                <p class="card-text">Project title : <?php if(isset($_SESSION['projtitle'])){echo $_SESSION['projtitle'];}else{ echo "N/A"; }?> </p>
                <p class="card-text"><?php if(isset($_SESSION['shortdes'])){echo $_SESSION['shortdes'];}else{ echo "N/A"; }?> </p>
              </div>
            </div>
          </div>
        </div>
        <?php
        if($_SESSION['sc_status'] == 1){
        ?>
        <div class="row mt-4">
          <div class="col-md-8 offset-md-2">
            <div class="card text-bg-warning">
              <div class="card-header">
                VIVA Schedule
              </div>
              <div class="card-body">
                <h5 class="card-title">25/04/2-24 | 4LA | 2:30PM</h5>
                <div class="d-inline p-2 text-bg-light">Supervisor: <?php if(isset($_SESSION['Supervisor'])){echo $_SESSION['Supervisor'];}else{ echo 'Not Updated'; }?></div>
                <div class="d-inline p-2 text-bg-secondary">Examiner 1 : <?php if(isset($_SESSION['Examiner1'])){echo $_SESSION['Examiner1'];}else{ echo 'Not Updated'; }?></div>
                <div class="d-inline p-2 text-bg-success">Examiner 2 : <?php if(isset($_SESSION['Examiner2'])){echo $_SESSION['Examiner2'];}else{ echo 'Not Updated'; }?></div>
                <div class="d-inline p-2 text-bg-danger">Chair : <?php if(isset($_SESSION['chair'])){echo $_SESSION['chair'];}else{ echo 'Not Updated'; }?></div> <br>
                <a href="<?php if(isset($_SESSION['link'])){echo $_SESSION['link'];}else{ echo '#'; }?>" class="btn btn-primary mt-3">Meeting link</a>
              </div>
            </div>
          </div>
        </div>
       
        <div class="row mt-4">
          <div class="col-md-8 offset-md-2">
            <div class="card">
              <div class="card-header">
                Instruction
              </div>
              <div class="card-body">
                <h5 class="card-title">Before Attending VIVA</h5>
                <p class="card-text">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Consectetur, recusandae odio sapiente ipsam rem harum dolores, expedita, soluta nemo corrupti a corporis officiis beatae.</p>
              </div>
            </div>
          </div>
        </div>
        <?php
        }
        ?>
          
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"></script>
</body>
</html>