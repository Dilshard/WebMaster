<!DOCTYPE html>
<html lang="en">
<?php include("head.php"); ?>
<?php
  session_start();
  //--- admin check ----
  if(empty($_SESSION['security'])){
    header("Location: 404.php", true, 301);
    exit();
  }
  if($_SESSION['email']==""){
    header("Location: 404.php", true, 301);
    exit();
  }
  include 'con.php';

  $sql = "SELECT * FROM Staff";
  $results = mysqli_query($conn, $sql);

  if(isset($_SESSION['email'])){
    $staffEmail = $_SESSION['email'];
  }else{
    $staffEmail =  "N/A";
  }

  $status = "Deleted staff from ";
  // ---- Delete ----
  if(isset($_POST['btndel'])){
    $staffEmailDeleted = $_POST['staff_email'];

    $sqldelchair = "DELETE FROM chair WHERE staffemail = '$staffEmailDeleted'";
    if(mysqli_query($conn, $sqldelchair)){
      $status .= "Chair ";
    }else{
      $status .= "Error!".mysqli_error($conn);
    }

    $sqldelexaminer = "DELETE FROM examiner_mark WHERE staffemail = '$staffEmailDeleted'";
    if(mysqli_query($conn, $sqldelexaminer)){
      $status .= "Examiner ";
    }else{
      $status .= "Error!".mysqli_error($conn);
    }

    $sqldelschedule = "DELETE FROM schedule WHERE staffemail = '$staffEmailDeleted'";
    if(mysqli_query($conn, $sqldelschedule)){
      $status .= "Schedule ";
    }else{
      $status .= "Error!".mysqli_error($conn);
    }

    $sqldelschedule = "DELETE FROM Staff WHERE staffemail = '$staffEmailDeleted'";
    if(mysqli_query($conn, $sqldelschedule)){
      $status .= "Staff ";
    }else{
      $status .= "Error!".mysqli_error($conn);
    }

    

    // ---- update log ------
    $log_details = $status;

    $sql_log = "INSERT INTO `logs` (`table_name`, `login_email`, `log`, `time`,`student_id`) VALUES ('By Admin', '$staffEmail', '$log_details',now(),'$staffEmailDeleted');";
    if(mysqli_query($conn, $sql_log)){
      $status .= "& Log updated!";
      header("Location: admin-staff-manage.php", true, 301);
      exit();
    }else{
      echo "Error!".mysqli_error($conn);
    }

    $_SESSION['del_status'] = $status;
  }
  
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
                      echo "<td style='color:white'>".$row['password']."</td>";
                      echo "<td>".$row['staffname']."</td>";
                      echo "<td>".$row['contact']."</td>";
                      echo "<td>".$row['ftpt']."</td>";
                      echo "<td>".$row['area']."</td>";
                      echo "<td>".$row['role']."</td>";
                      echo '
                      <td>
                        <form method="post" onsubmit="return confirm(\'Do you really want to delete this staff?\');"> <input name="staff_email" type="text" value="'.$row['staffemail'].'" hidden> <input name="btndel" type="submit" class="btn btn-danger" value="D">  </form>
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
              <?php if(isset($_SESSION['del_status'])){echo $_SESSION['del_status'];} unset($_SESSION['del_status']); ?>
            </table>
          </div>
      </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"></script>
</body>
</html>