<!DOCTYPE html>
<html lang="en">
<?php include("head.php"); ?>
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
                  <th scope="col">Report</th>
                  <th scope="col">Planning</th>
                  <th scope="col">VIVA</th>
                  <th scope="col">Meeting</th>
                  <th scope="col">Date</th>
                  <th scope="col">Time</th>
                  <th scope="col">Hall</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <th scope="row">1</th>
                  <td>Fernando | 12345</td>
                  <td>Supervisor</td>
                  <td><button type="submit" class="btn btn-success">Mark</button></td>
                  <td><button type="submit" class="btn btn-success">Mark</button></td>
                  <td>-</td>
                  <td><button type="submit" class="btn btn-success">Mark</button></td>
                  <td>-</td>
                  <td>Link</td>
                  <td>12/09/2023</td>
                  <td>9:30am</td>
                  <td>GP 4LC</td>
                </tr>

                <tr>
                  <th scope="row">2</th>
                  <td>Silva | 54321</td>
                  <td>Examiner 1</td>
                  <td>-</td>
                  <td>-</td>
                  <td><button type="submit" class="btn btn-success">Mark</button></td>
                  <td>-</td>
                  <td><button type="submit" class="btn btn-success">Mark</button></td>                  
                  <td>Link</td>
                  <td>12/09/2023</td>
                  <td>9:30am</td>
                  <td>GP 4LC</td>
                </tr>

                <tr>
                  <th scope="row">3</th>
                  <td>Ahamed | 12433</td>
                  <td>Examiner 2</td>
                  <td>-</td>
                  <td>-</td>
                  <td><button type="submit" class="btn btn-success">Mark</button></td>
                  <td>-</td>
                  <td><button type="submit" class="btn btn-success">Mark</button></td>                  
                  <td>Link</td>
                  <td>12/09/2023</td>
                  <td>9:30am</td>
                  <td>GP 4LC</td>
                </tr>

                <tr>
                  <th scope="row">3</th>
                  <td>Peter | 534433</td>
                  <td>Chair</td>
                  <td>-</td>
                  <td>-</td>               
                  <td>-</td>               
                  <td>-</td>
                  <td><button type="submit" class="btn btn-success">Mark</button></td>                  
                  <td>Link</td>
                  <td>12/09/2023</td>
                  <td>9:30am</td>
                  <td>GP 4LC</td>
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