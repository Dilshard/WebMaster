<!DOCTYPE html>
<html lang="en">
<?php include("head.php"); ?>
<?php
  session_start();
  include("validate.php");

  if(isset($_SESSION['email'])){
    $staffEmail = $_SESSION['email'];
  }else{
    header("Location: index.php", true, 301);
    exit();
  }

  
  if(isset($_POST['btnaccept'])){
    $iitid = $_POST['iitid'];
    $staffEmail = $_POST['staffemail'];

    $sql_sup_accept = "UPDATE `supervisor` SET `status` = 'accepted' WHERE `supervisor`.`iitid` = $iitid AND `supervisor`.`staffemail` = '$staffEmail';";

    if(mysqli_query($conn, $sql_sup_accept)){
      $_SESSION['req_status'] = "Accepted";
    }else{
      echo "Error!".mysqli_error($conn);
    }

    $sql_sup_slot = "UPDATE Staff SET slots = (SELECT slots from Staff WHERE staffemail = '$staffEmail') - 1 WHERE staffemail = '$staffEmail';";
    mysqli_query($conn, $sql_sup_slot);

  }

  if(isset($_POST['btndelete'])){
    $iitid = $_POST['iitid'];
    $staffEmail = $_POST['staffemail'];

    $sql_sup_cancel = "DELETE FROM supervisor WHERE `supervisor`.`iitid` = $iitid AND `supervisor`.`staffemail` = '$staffEmail';";

    if(mysqli_query($conn, $sql_sup_cancel)){
      $_SESSION['req_status'] = "Deleted";
    }else{
      echo "Error!".mysqli_error($conn);
    }

    $sql_sup_slot = "UPDATE Staff SET slots = (SELECT slots from Staff WHERE staffemail = '$staffEmail') + 1 WHERE staffemail = '$staffEmail';";
    mysqli_query($conn, $sql_sup_slot);
  }

  $sql = "SELECT * FROM supervisor WHERE staffemail = '$_SESSION[email]'";

  $results = mysqli_query($conn, $sql);
?>
<body>
    <div class="container-fluid">
        <div class="row">
            <?php include("staff-nav.php") ?>
        </div>
        <div class="row">
          <div class="col-md-6 offset-md-3 my-4 p-4">
            <h1 class="display-4 pb-3">Requests</h1>
            <?php
            if(isset($_SESSION['req_status'])){
                echo '
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Request has been '.$_SESSION['req_status'].'</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                ';
            }
            unset($_SESSION['req_status']);
            ?>

            <table class="table">
              <thead>
                <tr>
                  <th scope="col">IIT ID</th>
                  <th scope="col">Proposal</th>
                  <th scope="col">Status</th>
                  <th scope="col">Actions</th>
                  
                </tr>
              </thead>
              <tbody>
                <?php
                  if(mysqli_num_rows($results) > 0){
                    while($row = mysqli_fetch_assoc($results)){
                      echo "<tr>";  
                        echo "<td>".$row['iitid']."</td>";
                        echo "<td><a href='PDFs/".$row['iitid'].".pdf' target='_blank'>".$row['iitid']."</a></td>";
                        echo "<td>".$row['status']."</td>";
                        if($row['status'] != 'accepted'){
                          echo '<td>
                            <form method="post" onsubmit="return confirm(\'Do you really want to accept the invitation?\');"> <input name="iitid" type="text" value="'.$row['iitid'].'" hidden> <input name="staffemail" type="text" value="'.$_SESSION['email'].'" hidden> <input name="btnaccept" type="submit" class="btn btn-success" value="Accept">  </form>
                          </td>';
                        }
                        echo '<td>
                        <form method="post" onsubmit="return confirm(\'Do you really want to cancel?\');"> <input name="iitid" type="text" value="'.$row['iitid'].'" hidden> <input name="staffemail" type="text" value="'.$_SESSION['email'].'" hidden> <input name="btndelete" type="submit" class="btn btn-danger" value="Cancel">  </form>
                        </td>';
                      echo "</tr>";  
                    }
                  }else{
                      echo "<td colspan=12>No schedules yet!</td>";
                  }
                ?>
              </tbody>
            </table>
          </div>

          <hr>

          <div class="row">
          <div class="col-md-6 offset-md-3 my-4 p-4">
            <h6 class="display-6 pb-3">Projects from related area</h6>
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">IIT ID</th>
                  <th scope="col">Student Email</th>
                  <th scope="col">Area</th>
                  <th scope="col">Short description</th>
                  
                </tr>
              </thead>
              <tbody>
                <?php
                  $sql_staff_area = "SELECT area from Staff WHERE staffemail='$_SESSION[email]'";
                  $results_st_area = mysqli_query($conn, $sql_staff_area);
                  if(mysqli_num_rows($results_st_area) == 1){
                    while($row = mysqli_fetch_assoc($results_st_area)){
                      $_SESSION['st_area'] = $row['area'];
                    }
                  }

                  $sql_student_area = "SELECT * FROM Student WHERE resarea LIKE '%$_SESSION[st_area]%'";
                  $results_student_area = mysqli_query($conn, $sql_student_area);

                  if(mysqli_num_rows($results_student_area) > 0){
                    while($row = mysqli_fetch_assoc($results_student_area)){
                      echo "<tr>";  
                        echo "<td>".$row['iitid']."</td>";
                        echo "<td>".$row['email']."</td>";
                        echo "<td>".$row['resarea']."</td>";
                        echo "<td id='shortText'>".$row['shortdes']."</td>";
                      echo "</tr>";  
                    }
                  }else{
                      echo "<td colspan=12>Related project proposals found!</td>";
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