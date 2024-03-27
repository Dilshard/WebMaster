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
                  <th scope="col">Meeting</th>
                  <th scope="col">Date</th>
                  <th scope="col">Time</th>
                  <th scope="col">Hall</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <th scope="row">1</th>
                  <td>dilshard.a@iit.ac.lk</td>
                  <td>Fernando | 12345</td>
                  <td>Supervisor</td>
                  <td>link</td>
                  <td>13/04/2024</td>
                  <td>9:30am</td>
                  <td>GP 4LC</td>
                  <td>
                    <button type="submit" class="btn btn-warning">Edit</button>
                    <button type="reset" class="btn btn-danger">Delete</button>
                  </td>
                </tr>
                <tr>
                  <th scope="row">1</th>
                  <td>dilshard.a@iit.ac.lk</td>
                  <td>John | 54321</td>
                  <td>Examiner 1</td>
                  <td>link</td>
                  <td>25/04/2024</td>
                  <td>10:30am</td>
                  <td>GP 2LB</td>
                  <td>
                    <button type="submit" class="btn btn-warning">Edit</button>
                    <button type="reset" class="btn btn-danger">Delete</button>
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