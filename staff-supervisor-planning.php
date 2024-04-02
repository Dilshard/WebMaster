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
                    <h5 class="pb-3">Fernando | 12345 | HarmonyCare: Enhancing Mental Health Support</h5>
              </div>
            </div>
                
            <div class="col-md-8 my-4 p-4 offset-md-3">
              <form class="row g-3">
                  
                <div class="col-md-8">
                  <label class="form-label">Planning, consultation, and engagement (<a href="#">Criteria</a>)</label> 
                  <input type="number" class="form-control" placeholder = "Out of 100">
                </div>
                
                <div class="col-8 mt-5">
                  <button type="submit" class="btn btn-success">Submit</button>
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