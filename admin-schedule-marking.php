<!DOCTYPE html>
<html lang="en">
<?php include("head.php"); ?>
<body>
    <div class="container-fluid">
        <div class="row">
            <?php include("admin-nav.php") ?>
        </div>
        <div class="row">
          <div class="col-md-6 my-4 p-4">
            <h1 class="display-4 pb-3">Schedule Marking</h1>

            <form class="row g-3">
              <div class="col-md-6">
                <label class="form-label">Student email [IIT]</label>
                <input type="email" class="form-control">
              </div>
              <div class="col-md-6">
                <label class="form-label">Meeting link</label>
                <input type="url" class="form-control">
              </div>
              <div class="col-6">
                <label for="fullName" class="form-label">Staff email</label>
                <input type="email" class="form-control" id="fullName">
              </div>
              <div class="col-md-6">
                <label class="form-label">Date</label>
                <input type="date" class="form-control">
              </div>
              <div class="col-md-6">
                <label class="form-label">Role</label>
                <select id="inputState" class="form-select">
                  <option selected>Supervisor</option>
                  <option>Examiner 1</option>
                  <option>Examiner 2</option>
                  <option>Chair</option>
                </select>
              </div>
            
              <div class="col-md-6">
                <label class="form-label">Time</label>
                <input type="time" class="form-control">
              </div>

              <div class="col-md-6 offset-md-6">
                <label class="form-label">Hall (Venue)</label>
                <input type="text" class="form-control">
              </div>
             
              <div class="col-6 offset-md-6">
                <button type="submit" class="btn btn-success">Register</button>
                <button type="reset" class="btn btn-warning">Clear</button>
              </div>
            </form>

            </div>
            <!-- </div> -->
          <!-- </div> -->

          <div class="col-md-6 my-4 p-4">
            <h1 class="display-3 pb-3">Bulk upload</h1>
              <div class="mb-3">
                <label for="formFile" class="form-label">Upload from CSV File</label>
                <input class="form-control" type="file" id="formFile">
                <a class="nav-link" href="#">Download template</a>
              </div>
              <div class="col-12">
                <button type="submit" class="btn btn-success">Upload</button>
                <button type="reset" class="btn btn-warning">Clear</button>
              </div>
            </div>
          
      </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"></script>
</body>
</html>