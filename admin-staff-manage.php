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
            <h1 class="display-4 pb-3">Manage Staffs</h1>

            <table class="table">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Staff email</th>
                  <th scope="col">Staff name</th>
                  <th scope="col">Contact</th>
                  <th scope="col">Area of interest</th>
                  <th scope="col">FT/FT</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <th scope="row">1</th>
                  <td>dilshard.a@iit.ac.lk</td>
                  <td>Dilshard Ahamed</td>
                  <td>077123343</td>
                  <td>Machine Learning</td>
                  <td>Full-time</td>
                  <td>
                    <button type="submit" class="btn btn-warning">Edit</button>
                    <button type="reset" class="btn btn-danger">Delete</button>
                  </td>
                </tr>

                <tr>
                  <th scope="row">2</th>
                  <td>test.a@iit.ac.lk</td>
                  <td>test Ahamed</td>
                  <td>077453455</td>
                  <td>Mobile / UIUX </td>
                  <td>Part-time</td>
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