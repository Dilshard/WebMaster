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
            <div class="col-md-12">
                    <h1 class="display-3 pb-3">Staff Supervisor PP</h1>
                    <h5 class="pb-3">Fernando | 12345 | HarmonyCare: Enhancing Mental Health Support</h5>
            </div>
                
            <div class="col-md-6 my-4 p-4 offset-md-3">

            <form class="row g-3">
                
              <div class="col-md-6">
                <label class="form-label">Problem statement, aims & objectives (<a href="#">Criteria</a>)</label> 
                <input type="number" class="form-control">
              </div>
              <div class="col-md-6">
                <label class="form-label">List of challenges (including technical and other), timeline and references (<a href="#">Criteria</a>)</label>
                <input type="number" class="form-control">
              </div>
              <div class="col-6">
              <label class="form-label">Review of similar applications or similar research (<a href="#">Criteria</a>)</label>
                <input type="number" class="form-control" id="fullName">
              </div>
              <div class="col-md-6">
                <label class="form-label">Supervisor Feedback</label>
                <textarea class="form-control"></textarea>
              </div>
              <div class="col-md-6">
                <label class="form-label">Tools (equipment, software, etc.) and technical skills (<a href="#">Criteria</a>)</label>
                <input type="number" class="form-control">
              </div>
              <div class="col-md-6">
                <label class="form-label">If student is an resit student (Below 40) What needs to be improved</label>
                <textarea class="form-control"></textarea>
              </div>
              <div class="col-md-6">
                <label class="form-label">Initial list of requirements and on-going methods for project requirement elicitation (<a href="#">Criteria</a>)</label>
                <input type="number" class="form-control">
              </div>
              <div class="col-md-6">
                <label class="form-label">Total</label>
                <input type="number" class="form-control" disabled>
              </div>
              
              <div class="col-12">
                <button type="submit" class="btn btn-success">Submit</button>
                <button type="reset" class="btn btn-warning">Clear</button>
              </div>
            </form>

            </div>
            <!-- </div> -->


          
          
      </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"></script>
</body>
</html>