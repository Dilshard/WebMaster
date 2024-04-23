<?php
  session_start();
  include("validate.php");

  $sql = "SELECT * FROM Staff";

  $sqlStaffCount = "SELECT staffid FROM Staff";
  $resultStaff = mysqli_query($conn, $sqlStaffCount);
  $totalStaffCount = mysqli_num_rows($resultStaff);

  $sqlStudentCount = "SELECT iitid FROM Student";
  $resultStudent = mysqli_query($conn, $sqlStudentCount);
  $totalStudentCount = mysqli_num_rows($resultStudent);

  $sqlSchCount = "SELECT schid FROM schedule";
  $resultSch = mysqli_query($conn, $sqlSchCount);
  $totalScheduleCount = mysqli_num_rows($resultSch);

?>
<!DOCTYPE html>
<html lang="en">
<?php include("head.php"); 
if(isset($_SESSION['token'])){
?>
<body>
    <div class="container-fluid">
        <div class="row">
            <?php include("admin-nav.php") ?>
        </div>
        <div class="row">
          <div class="col-md-4 p-4">
            <div class="card" style="width: 100%;">
              <div class="card-body bg-danger text-light">
                <h5 class="card-title">Total Staffs</h5>
                <h6 class="card-subtitle mb-2 text-body-secondary"><span class="text-light">2024</span></h6>
                <p class="card-text display-1 fw-bold"><?php if(isset($totalStaffCount)){ echo $totalStaffCount;} ?></p>
                <a href="#" class="card-link text-light">List</a>
                <a href="#" class="card-link text-light">Projects</a>
              </div>
            </div>
          </div>
          <div class="col-md-4 p-4">
          <div class="card" style="width: 100%;">
              <div class="card-body bg-primary text-light">
                <h5 class="card-title">Total Student</h5>
                <h6 class="card-subtitle mb-2 text-body-secondary"><span class="text-light">2024</span></h6>
                <p class="card-text display-1 fw-bold"><?php if(isset($totalStudentCount)){ echo $totalStudentCount;} ?></p>
                <a href="#" class="card-link text-light">List</a>
                <a href="#" class="card-link text-light">Projects</a>
              </div>
            </div>
          </div>
          <div class="col-md-4 p-4">
          <div class="card" style="width: 100%;">
              <div class="card-body bg-warning text-dark">
                <h5 class="card-title">Total schedules</h5>
                <h6 class="card-subtitle mb-2 text-body-secondary"><span class="text-light">2024</span></h6>
                <p class="card-text display-1 fw-bold"><?php if(isset($totalScheduleCount)){ echo $totalScheduleCount;} ?></p>
                <a href="#" class="card-link text-light">List</a>
                <a href="#" class="card-link text-light">Projects</a>
              </div>
            </div>
          </div>
        </div>
    </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"></script>
</body>

<?php
}else{
  header("Location: 404.php", true, 301);
  exit();
}
?>
</html>