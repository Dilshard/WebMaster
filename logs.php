<?php
session_start();
if($_SESSION['email']==""){
  header("Location: 404.php", true, 301);
  exit();
}

include 'con.php';

  $sql = "SELECT * FROM logs";

  $results = mysqli_query($conn, $sql);


?>
<!DOCTYPE html>
<html lang="en">
<?php include("head.php"); ?>
<body>
  
    <div class="container-fluid">
        <div class="row">
            <?php include("admin-nav.php") ?>
        </div>
        <div class="row">
          <div class="col-md-12 my-4 p-4">
            <h1 class="display-4 pb-3">Logs</h1>

            <table class="table">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Table Name</th>
                  <th scope="col">User</th>
                  <th scope="col">Student ID</th>
                  <th scope="col">Time</th>
                  <th scope="col">log data</th>
                </tr>
              </thead>
              <tbody>
              <?php
                if(mysqli_num_rows($results) > 0){
                  $data = [];
                  array_push($data,"ID, Table Name, Login Email, Effected Account, Log Date Time, Log Details");
                  while($row = mysqli_fetch_assoc($results)){
                    array_push($data,"$row[id],$row[table_name],$row[login_email],$row[student_id],$row[time],$row[log]");
                    echo "<tr>";
                      echo "<th scope='row'>".$row['id']."</th>";
                      echo "<td>".$row['table_name']."</td>";
                      echo "<td>".$row['login_email']."</td>";
                      echo "<td>".$row['student_id']."</td>";
                      echo "<td>".$row['time']."</td>";
                      echo "<td id='shortText_log'>".$row['log']."</td>";
                    echo "</tr>";
                  }
                  $_SESSION['export_data_csv'] = $data;
                }
                ?>
                <tr>
                  <td colspan="3"><a href="mail-export-csv.php" class="btn btn-success">Download CSV</a></td>
                </tr>
              </tbody>
            </table>
          </div>
      </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"></script>
</body>
</html>