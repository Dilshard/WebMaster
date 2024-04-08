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

  if(isset($_SESSION['email'])){
    $staffEmail = $_SESSION['email'];
  }else{
    header("Location: index.php", true, 301);
    exit();
  }

  $sql = "SELECT * FROM schedule WHERE staffemail = '$staffEmail'";

  $results = mysqli_query($conn, $sql);
?>
<body>
    <div class="container-fluid">
        <div class="row">
            <?php include("staff-nav.php") ?>
        </div>
        <div class="row">
          <div class="col-md-12 my-4 p-4">
            <h1 class="display-4 pb-3">Schedules</h1>

            <table class="table">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Student Name / ID</th>
                  <th scope="col">Role</th>
                  <th scope="col">Proposal</th>
                  <th scope="col">PSPD</th>
                  <th scope="col">Planning</th>
                  <th scope="col">Report</th>
                  <th scope="col">VIVA</th>
                  <th scope="col">Link</th>
                  <th scope="col">Date</th>
                  <th scope="col">Time</th>
                  <th scope="col">Hall</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  if(mysqli_num_rows($results) > 0){
                    while($row = mysqli_fetch_assoc($results)){
                      echo "<tr>";  
                      echo "<td>".$row['schid']."</td>";
                      echo "<td>".$row['iitid']."</td>";
                      echo "<td>".$row['role']."</td>";
                      if($row['role']=="Supervisor"){
                        echo '<td><a href="staff-supervisor-pp.php?iidit='.$row['iitid'].'staffEmail='.$staffEmail.'" class="btn btn-success">Mark</a></td>';
                      }else{
                        echo '<td>-</td>';
                      }
                      if($row['role']=="Supervisor"){
                        echo '<td><a href="staff-supervisor-psdp.php?iidit='.$row['iitid'].'&staffEmail='.$staffEmail.'" class="btn btn-success">Mark</a></td>';
                      }else{
                        echo '<td>-</td>';
                      }
                      if($row['role']=="Supervisor"){
                        echo '<td><a href="staff-supervisor-planning.php?iidit='.$row['iitid'].'&staffEmail='.$staffEmail.'" class="btn btn-success">Mark</a></td>';
                      }else{
                        echo '<td>-</td>';
                      }
                      if($row['role']=="Examiner1"){
                        echo '<td><a href="staff-examiner-report.php?iidit='.$row['iitid'].'&staffEmail='.$staffEmail.'&ex=1" class="btn btn-success">Mark</a></td>';
                      }elseif($row['role']=="Examiner2"){
                        echo '<td><a href="staff-examiner-report.php?iidit='.$row['iitid'].'&staffEmail='.$staffEmail.'&ex=2" class="btn btn-success">Mark</a></td>';
                      }else{
                        echo '<td>-</td>';
                      }
                      if($row['role']=="Examiner1"){
                        echo '<td><a href="staff-examiner-viva.php?iidit='.$row['iitid'].'&staffEmail='.$staffEmail.'&ex=1" class="btn btn-success">Mark</a></td>';
                      }elseif($row['role']=="Examiner2"){
                        echo '<td><a href="staff-examiner-viva.php?iidit='.$row['iitid'].'&staffEmail='.$staffEmail.'&ex=2" class="btn btn-success">Mark</a></td>';
                      }elseif($row['role']=="Chair"){
                        echo '<td><a href="staff-chair.php?iidit='.$row['iitid'].'staffEmail='.$staffEmail.'" class="btn btn-success">Mark</a></td>';
                      }else{
                        echo '<td>-</td>';
                      }
                      
                      echo "<td>".$row['link']."</td>";
                      echo "<td>".$row['meeting_date']."</td>";
                      echo "<td>".$row['meeting_time']."</td>";
                      echo "<td>".$row['hall']."</td>";
                      echo "</tr>";  
                    }
                  }else{
                      echo "<td colspan=12>No schedules yet!</td>";
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