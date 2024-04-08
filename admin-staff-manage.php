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

  $sql = "SELECT * FROM Staff";
  $results = mysqli_query($conn, $sql);
  
?>
<body>
    <div class="container-fluid">
        <div class="row">
            <?php include("admin-nav.php") ?>
        </div>
        <div class="row">
          <div class="col-md-12 my-4 p-4">
            <h1 class="display-4 pb-3">Manage Staffs</h1>

            <table class="table">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Staff email</th>
                  <th scope="col">Password</th>
                  <th scope="col">Name</th>
                  <th scope="col">Contact</th>
                  <th scope="col">FT/FT</th>
                  <th scope="col">Area of interest</th>
                  <th scope="col">Role</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                if(mysqli_num_rows($results) > 0){
                  while($row = mysqli_fetch_assoc($results)){
                    echo "<tr>";
                      echo "<td>".$row['staffid']."</td>";
                      echo "<td>".$row['staffemail']."</td>";
                      echo "<td>".$row['password']."</td>";
                      echo "<td>".$row['staffname']."</td>";
                      echo "<td>".$row['contact']."</td>";
                      echo "<td>".$row['ftpt']."</td>";
                      echo "<td>".$row['area']."</td>";
                      echo "<td>".$row['role']."</td>";
                      echo '
                      <td>
                        <button type="submit" class="btn btn-warning">Edit</button>
                        <button type="reset" class="btn btn-danger">Delete</button>
                      </td>
                      ';
                    echo "</tr>";
                  }
                }else{
                  echo "<tr>";
                    echo "<td>No records found!</td>";
                  echo "</tr>";
                }

                ?>
              </tbody>
            </table>
          </div>
      </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"></script>
</body>
</html>