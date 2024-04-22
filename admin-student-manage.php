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
  if(isset($_SESSION['email'])){
    $staffEmail = $_SESSION['email'];
  }else{
    $staffEmail =  "N/A";
  }

  $sql = "SELECT * FROM Student";

  $results = mysqli_query($conn, $sql);

  $status = "Deleted from ";
    // ----- Delete -----
    if(isset($_POST['btndel'])){
      $iitid = $_POST['iitid'];
  
      $sqldelex = "DELETE FROM examiner_mark WHERE iitid = $iitid";
      if(mysqli_query($conn, $sqldelex)){
        $status .= "Examiner ";
      }else{
        $status .= "Error!".mysqli_error($conn);
      }

      $sqldelsup = "DELETE FROM sup_mark_pp_pspd WHERE iitid = $iitid";
      mysqli_query($conn, $sqldelsup);
      if(mysqli_query($conn, $sqldelsup)){
        $status .= "Supervisor ";
      }else{
        echo "Error!".mysqli_error($conn);
      }

      $sqldelch = "DELETE FROM chair WHERE iitid = $iitid";
      if(mysqli_query($conn, $sqldelch)){
        $status .= "Chair ";
      }else{
        echo "Error!".mysqli_error($conn);
      }

      $sqldelch = "DELETE FROM schedule WHERE iitid = $iitid";
      if(mysqli_query($conn, $sqldelch)){
        $status .= "Schedule ";
      }else{
        echo "Error!".mysqli_error($conn);
      }

      $sqldelst = "DELETE FROM Student WHERE iitid = $iitid";
      if(mysqli_query($conn, $sqldelst)){
        $status .= "Student ";
      }else{
        echo "Error!".mysqli_error($conn);
      }

      // ---- update log ------
      $log_details = "Deleted from examiner_mark, sup_mark_pp_pspd, chair, schedule, Student table";

      $sql_log = "INSERT INTO `logs` (`table_name`, `login_email`, `log`, `time`,`student_id`) VALUES ('By Admin', '$staffEmail', '$log_details',now(),'$iitid');";
      if(mysqli_query($conn, $sql_log)){
        $status .= "& Log updated!";
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
            <h1 class="display-4 pb-3">Manage Students</h1>

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
                <tr>
                <div class="alert alert-warning" role="alert">
                  <b>Deleting a student</b> from below button will delete from all 4 tables, including the marks entered!
                </div>              
                </tr>
              </thead>
              <tbody>
                <?php
                if(mysqli_num_rows($results) > 0){
                  $data = [];
                  array_push($data,"Student IIT ID,Email,Password,UoW No,Student Name,Project Title, Stream, Research Area, Short Desc, Final VIVA Marks,Final Report Marks, Final Project Marks, Final Module Marks");
                  while($row = mysqli_fetch_assoc($results)){
                    array_push($data,"$row[iitid],$row[email],$row[pass],$row[uowno],$row[studentname],$row[projtitle],$row[stream],$row[resarea],$row[shortdes],$row[final_viva_mark],$row[final_report_mark],$row[final_project_mark],$row[final_module_mark]");
                    echo "<tr>";
                      echo "<td>".$row['iitid']."</td>";
                      echo "<td>".$row['email']."</td>";
                      echo "<td>".$row['pass']."</td>";
                      echo "<td>".$row['uowno']."</td>";
                      echo "<td>".$row['studentname']."</td>";
                      echo "<td id='shortText'>".$row['projtitle']."</td>";
                      echo "<td>".$row['stream']."</td>";
                      echo "<td>".$row['resarea']."</td>";
                      echo "<td id='shortText'>".$row['shortdes']."</td>";
                      echo "<td>".$row['final_viva_mark']."</td>";
                      echo "<td>".$row['final_report_mark']."</td>";
                      echo "<td>".$row['final_project_mark']."</td>";
                      echo "<td>".$row['final_module_mark']."</td>";
                      echo '
                      <td>
                        <form method="post" onsubmit="return confirm(\'Do you really want to delete?\');"> <input name="iitid" type="text" value="'.$row['iitid'].'" hidden> <input name="btndel" type="submit" class="btn btn-danger" value="&#x2716;">  </form>
                      </td>
                      ';
                    echo "</tr>";
                    
                  }
                  $_SESSION['export_data_csv'] = $data;
                }else{
                  echo "<tr>";
                    echo "<td>No records found!</td>";
                  echo "</tr>";
                }

                ?>
                <tr>
                  <td colspan="4"><a href="mail-export-csv.php" class="btn btn-success">Download CSV</a></td>
                  
                </tr>
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