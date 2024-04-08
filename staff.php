<?php
session_start();
if($_SESSION['email']==""){
  header("Location: 404.php", true, 301);
  exit();
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
          <div class="col-md-4 p-4">
            <div class="card" style="width: 100%;">
              <div class="card-body bg-danger text-light">
                <h5 class="card-title">September Intake</h5>
                <h6 class="card-subtitle mb-2 text-body-secondary"><span class="text-light">2023</span></h6>
                <p class="card-text display-1 fw-bold">523</p>
                <a href="#" class="card-link text-light">List</a>
                <a href="#" class="card-link text-light">Projects</a>
              </div>
            </div>
          </div>
          <div class="col-md-4 p-4">
          <div class="card" style="width: 100%;">
              <div class="card-body bg-primary text-light">
                <h5 class="card-title">Students without supervisor</h5>
                <h6 class="card-subtitle mb-2 text-body-secondary"><span class="text-light">2023</span></h6>
                <p class="card-text display-1 fw-bold">21</p>
                <a href="#" class="card-link text-light">List</a>
                <a href="#" class="card-link text-light">Projects</a>
              </div>
            </div>
          </div>
          <div class="col-md-4 p-4">
          <div class="card" style="width: 100%;">
              <div class="card-body bg-warning text-dark">
                <h5 class="card-title">Project completion rate</h5>
                <h6 class="card-subtitle mb-2 text-body-secondary"><span class="text-light">2023</span></h6>
                <p class="card-text display-1 fw-bold">33%</p>
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
</html>