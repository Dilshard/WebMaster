<?php
include("validate_student.php");

$sql = "SELECT * FROM Staff ORDER BY `Staff`.`area` ASC";
$results = mysqli_query($conn, $sql);


if(isset($_POST['btnreq'])){
    $staffEmail = $_POST['staffemail'];
    $iitid = $_SESSION['iitid'];
    $proposal = $_SESSION['iitid'].".pdf";
    $status = "requested";
 
    
    $sql = "INSERT INTO `supervisor` (`staffemail`, `iitid`, `proposal`, `status`) VALUES ('$staffEmail', $iitid, '$proposal', '$status');";

    if(mysqli_query($conn, $sql)){
        $_SESSION['req_status'] =  "Request has been forwarded!";
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
            <?php include("student-nav.php") ?>
        </div>
        <div class="row">
            <h1 class="display-4 pb-3">Find a Supervisor</h1>
          <div class="col-md-8 offset-md-2 my-4 p-4">
            <?php
            if(isset($_SESSION['req_status'])){
                echo '
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Request has been forwarded!</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                ';
            }
            unset($_SESSION['req_status']);
            ?>
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">Staff ID</th>
                  <th scope="col">Supervisor Name</th>
                  <th scope="col">Specialized Area</th>
                  <th scope="col">Available Slots</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
              <?php
                if(mysqli_num_rows($results) > 0){
                    while($row = mysqli_fetch_assoc($results)){
                        echo "<tr>";
                            echo "<td>".$row['staffid']."</td>";
                            echo "<td>".$row['staffname']."</td>";
                            echo "<td>".$row['area']."</td>";
                            echo "<td>".$row['slots']."</td>";

                            $sql_requested = "SELECT * FROM supervisor WHERE staffemail = '$row[staffemail]' AND iitid = $_SESSION[iitid]";
                            $results_requested = mysqli_query($conn, $sql_requested);

                            if(mysqli_num_rows($results_requested) == 1){
                                echo '<td><button class="btn btn-secondary" disabled>Requested</button></td>';
                            }

                            elseif($row['slots'] <= 0){
                                echo '<td><button class="btn btn-secondary" disabled>Full</button></td>';
                            }else{
                                echo '<td>
                                <form method="post" onsubmit="return confirm(\'Do you really want to request?\');"> <input name="staffemail" type="text" value="'.$row['staffemail'].'" hidden> <input name="btnreq" type="submit" class="btn btn-success" value="Request">  </form>
                                </td>';
                            }
                            
                        echo "</tr>";
                    }
                }
                ?>
                
              </tbody>
            </table>
        </div>
        

        <hr>
        <div class="row">
            <div class="col-md-4 offset-md-2 my-4 p-4">
              <h1 class="display-6 pb-3">Requested list</h1>
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">Staff Email</th>
                  <th scope="col">Status</th>
                </tr>
              </thead>
              <tbody>
              <?php
                $sql_sup = "SELECT * FROM supervisor";
                $results_sup = mysqli_query($conn, $sql_sup);

                if(mysqli_num_rows($results_sup) > 0){
                    while($row = mysqli_fetch_assoc($results_sup)){
                        echo "<tr>";
                            echo "<td>".$row['staffemail']."</td>";
                            if($row['status'] == "requested"){
                              echo '<td>Pending</td>';
                            }else{
                              echo "<td>".$row['status']."</td>";
                            }
                        echo "</tr>";
                    }
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

<?php
require_once 'vendor/autoload.php';

if(isset($_POST['btnsub'])){
    
}
?>