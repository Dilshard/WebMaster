<!DOCTYPE html>
<html lang="en">
<?php include("head.php"); ?>
<?php
  session_start();
  if($_SESSION['email']==""){
    header("Location: 404.php", true, 301);
    exit();
  }

  include 'con.php';

  if(isset($_POST['btnsub'])){
    $email = $_POST['stemail'];
    $stpass = $_POST['stpass'];
    $ftpt = $_POST['ftpt'];
    $stname = $_POST['stname'];
    $stspecial = $_POST['stspecial'];
    $stcontact = $_POST['stcontact'];
    $strole = $_POST['strole'];

    $sql = "INSERT INTO `Staff` (`staffemail`, `password`, `staffname`, `contact`, `ftpt`, `area`, `role`) VALUES ('$email', '$stpass', '$stname', '$stcontact', '$ftpt', '$stspecial', '$strole');";

    if(mysqli_query($conn, $sql)){
      header('Location: admin-staff-manage.php');
    }else{
      echo "Error!".mysqli_error($conn);
    }
  }
?>
<body>
    <div class="container-fluid">
        <div class="row">
            <?php include("admin-nav.php") ?>
        </div>
        <div class="row">
          <div class="col-md-6 my-4 p-4">
            <h1 class="display-4 pb-3">Registration - Staff</h1>

            <form method="POST" class="row g-3">
              <div class="col-md-6">
                <label class="form-label">Email</label>
                <input name="stemail" type="email" class="form-control">
              </div>
              <div class="col-md-6">
                <label class="form-label">Password</label>
                <input name="stpass" type="password" class="form-control">
              </div>
              <div class="col-md-6">
                <label class="form-label">FT / PT</label>
                <select name="ftpt" id="inputState" class="form-select">
                  <option value="ft" selected>Full-time</option>
                  <option value="pt">Part-time</option>
                </select>
              </div>
              <div class="col-md-6">
                <label class="form-label">Staff Name</label>
                <input name="stname" type="text" class="form-control">
              </div>
              <div class="col-6">
                <label for="fullName" class="form-label">Specialised area</label>
                <input name="stspecial" type="text" class="form-control" id="fullName">
              </div>
              <div class="col-md-6">
                <label class="form-label">Contact No</label>
                <input name="stcontact" type="number" class="form-control">
              </div>
              
              <div class="col-md-6">
                <label class="form-label">Role</label>
                <select name="strole" id="inputState" class="form-select">
                  <option selected value="staff">Staff</option>
                  <option value="admin">Admin</option>
                </select>
              </div>
             
              <div class="col-12">
                <button name="btnsub" type="submit" class="btn btn-success">Register</button>
                <button type="reset" class="btn btn-warning">Clear</button>
                <a class="btn btn-secondary" href="admin-staff-manage.php">View</a>
              </div>
            </form>
            </div>

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
      crossorigin="anonymous">
  </script>
</body>
</html>