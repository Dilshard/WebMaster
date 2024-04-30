<?php
  session_start();
  include("validate.php");

  $sql = "SELECT * FROM schedule";

  $results = mysqli_query($conn, $sql);

  // ----- Delete -----
  if(isset($_POST['btndel'])){
    $id = $_POST['id'];

    $sqldel = "DELETE FROM schedule WHERE schid = $id";

    if(mysqli_query($conn, $sqldel)){
      header('Location: admin-schedule-manage.php');
    }else{
      echo "Error!".mysqli_error($conn);
    }
  }

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
            <h1 class="display-4 pb-3">Manage Schedule</h1>

            <table class="table">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Staff email</th>
                  <th scope="col">Student Name / ID</th>
                  <th scope="col">Role</th>
                  <th scope="col">Meeting Link</th>
                  <th scope="col">Date</th>
                  <th scope="col">Time</th>
                  <th scope="col">Hall</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
              <?php
                if(mysqli_num_rows($results) > 0){
                  $data = [];
                  array_push($data,"Schedule ID, Staff Email, IIT ID, Staff Role, Meeting Link, Meeting Date, Meeting Time, Hall");
                  while($row = mysqli_fetch_assoc($results)){
                    array_push($data,"$row[schid],$row[staffemail],$row[iitid],$row[role],$row[link],$row[meeting_date],$row[meeting_time],$row[hall]");
                    echo "<tr>";
                      echo "<th scope='row'>".$row['schid']."</th>";
                      echo "<td>".$row['staffemail']."</td>";
                      echo "<td>".$row['iitid']."</td>";
                      echo "<td>".$row['role']."</td>";
                      echo "<td>".$row['link']."</td>";
                      echo "<td>".$row['meeting_date']."</td>";
                      echo "<td>".$row['meeting_time']."</td>";
                      echo "<td>".$row['hall']."</td>";
                      echo '
                      <td>
                      <form method="post" onsubmit="return confirm(\'Do you really want to delete?\');"> <input name="id" type="text" value="'.$row['schid'].'" hidden> <input name="btndel" type="submit" class="btn btn-danger" value="D">  </form>
                      <form method="post" action="admin_schedule_edit.php"> <input name="id" type="text" value="'.$row['schid'].'" hidden> <input name="btnedit" type="submit" class="btn btn-warning" value="E">  </form>
                      </td>';
                    echo "</tr>";
                  }
                  $_SESSION['export_data_csv'] = $data;
                }
                ?>
                <tr>
                  <td colspan=4>
                    <a href="admin-schedule-marking.php" class="btn btn-success">Add +</a>
                    <a href="mail-export-csv.php" class="btn btn-success">Download CSV</a>
                  </td>
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

