<!DOCTYPE html>
<html lang="en">
<?php include("head.php"); ?>
<?php

  include 'con.php';

  $sql = "SELECT * FROM Student";

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
                  <th scope="col">IIT ID </th>
                  <th scope="col">Email</th>
                  <th scope="col">Pass</th>
                  <th scope="col">UoW</th>
                  <th scope="col">Name</th>
                  <th scope="col">Project Title</th>
                  <th scope="col">Stream</th>
                  <th scope="col">Research area</th>
                  <th scope="col">Short Description</th>
                  <th scope="col">VIVA mk</th>
                  <th scope="col">Report mk</th>
                  <th scope="col">Project mk</th>
                  <th scope="col">Module mk</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                if(mysqli_num_rows($results) > 0){
                  while($row = mysqli_fetch_assoc($results)){
                    echo "<tr>";
                      echo "<td>".$row['iitid']."</td>";
                      echo "<td>".$row['email']."</td>";
                      echo "<td>".$row['pass']."</td>";
                      echo "<td>".$row['uowno']."</td>";
                      echo "<td>".$row['studentname']."</td>";
                      echo "<td>".$row['projtitle']."</td>";
                      echo "<td>".$row['stream']."</td>";
                      echo "<td>".$row['resarea']."</td>";
                      echo "<td>".$row['shortdes']."</td>";
                      echo "<td>".$row['final_viva_mark']."</td>";
                      echo "<td>".$row['final_report_mark']."</td>";
                      echo "<td>".$row['final_project_mark']."</td>";
                      echo "<td>".$row['final_module_mark']."</td>";
                      echo '
                      <td>
                        <button type="submit" class="btn btn-warning"><i class="bi bi-pencil-square"></i></button>
                        <button type="reset" class="btn btn-danger"><i class="bi bi-trash"></i></button>
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