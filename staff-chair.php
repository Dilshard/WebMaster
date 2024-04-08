<?php
session_start();
if($_SESSION['email']==""){
  header("Location: 404.php", true, 301);
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<?php include("head.php"); ?>
<body>
    <div class="container-fluid">
        <div class="row">
            <?php include("staff-nav.php") ?>
        </div>
            <div class="row">
            <div class="col-md-12">
                    <h1 class="display-3 pb-3">Staff Chair</h1>
                    <h5 class="pb-3">Fernando | 12345 | HarmonyCare: Enhancing Mental Health Support</h5>
            </div>
                
            <div class="col-md-10 my-4 p-4 offset-md-1">

            <form class="row g-3">
                
              <div class="col-md-6">
                <label class="form-label display-5">Supervisor</label> <br>
                <label class="form-label">Proposal : 81</label> <br>
                <label class="form-label">PSDP : 76</label> <br>
                <label class="form-label">Planning : 85</label> <br> 
              </div>
              <div class="col-md-6">
                <label class="form-label display-5">Supervisor Feedback</label> <br>
                <label class="form-label">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Dolores dignissimos saepe cupiditate!</label> <br>
              </div>

              <hr>

              <div class="col-md-6 p-4" style="background-color:#bcbcd7">
                <div class="col-md-12">
                  <label class="form-label display-5">Examiner 1 <a class="refresh" href="#">&#8635;</a></label> <br>
                </div>
                
                <div class="row mt-3">
                  <div class="col-md-3">
                    <label class="form-label">Report </label>
                    <input type="number" class="form-control">
                  </div>
                  <div class="col-md-3">
                    <label class="form-label">VIVA </label>
                    <input type="number" class="form-control">
                  </div>
                </div>

                <div class="row mt-3">
                  <div class="col-md-6">
                    <label class="form-label">Difficulty</label>
                    <input type="number" class="form-control">
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">Understanding</label>
                    <input type="number" class="form-control">
                  </div>
                </div>

                <div class="row mt-3">
                  <div class="col-md-6">
                    <label class="form-label">Development of existing skills</label>
                    <input type="number" class="form-control">
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">Development of new skills</label>
                    <input type="number" class="form-control">
                  </div>
                </div>

                <div class="row mt-3">
                  <div class="col-md-12">
                    <label class="form-label">Product/Implementation/Application/Research</label>
                    <input type="number" class="form-control">
                  </div>
                </div>

                <div class="row mt-3">
                  <div class="col-md-6">
                    <label class="form-label">Added Value</label>
                    <textarea class="form-control" rows="4"></textarea>
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">Over all comment</label>
                    <textarea class="form-control" rows="4"></textarea>
                  </div>
                </div>
                
              </div>

              <div class="col-md-6 p-4" style="background-color:#d7bcc1">
              <div class="col-md-12">
                  <label class="form-label display-5">Examiner 2 <a class="refresh" href="#">&#8635;</a></label> <br>
                </div>
                
                <div class="row mt-3">
                  <div class="col-md-3">
                    <label class="form-label">Report </label>
                    <input type="number" class="form-control">
                  </div>
                  <div class="col-md-3">
                    <label class="form-label">VIVA </label>
                    <input type="number" class="form-control">
                  </div>
                </div>

                <div class="row mt-3">
                  <div class="col-md-6">
                    <label class="form-label">Difficulty</label>
                    <input type="number" class="form-control">
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">Understanding</label>
                    <input type="number" class="form-control">
                  </div>
                </div>

                <div class="row mt-3">
                  <div class="col-md-6">
                    <label class="form-label">Development of existing skills</label>
                    <input type="number" class="form-control">
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">Development of new skills</label>
                    <input type="number" class="form-control">
                  </div>
                </div>

                <div class="row mt-3">
                  <div class="col-md-12">
                    <label class="form-label">Product/Implementation/Application/Research</label>
                    <input type="number" class="form-control">
                  </div>
                </div>

                <div class="row mt-3">
                  <div class="col-md-6">
                    <label class="form-label">Added Value</label>
                    <textarea class="form-control" rows="4"></textarea>
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">Over all comment</label>
                    <textarea class="form-control" rows="4"></textarea>
                  </div>
                </div>
              </div>

              <hr>

              <div class="col-md-6 p-4">
                <div class="row mt-4">
                  <div class="col-md-12">
                    <label class="form-label">Similarity Index Generated by Turnitin </label>
                    <input type="number" class="form-control">
                  </div>
                  <div class="col-md-12 mt-4">
                    <label class="form-check-label">Is the similarity index at concerning amount?</label> <br>                    
                  </div>
                  <div class="col-md-12">
                    Yes <input class="form-check-input" type="radio" name="similarity">
                    No <input class="form-check-input" type="radio" name="similarity">
                  </div>
                </div>

                <div class="row mt-3">
                  <div class="col-md-12">
                    <label class="form-label">Third Marking required?</label>
                  </div>
                  <div class="col-md-12 mt-4">
                    Yes <input class="form-check-input" type="radio" name="Third">
                    No <input class="form-check-input" type="radio" name="Third">
                  </div>
                </div>

                <div class="row mt-3">
                  <div class="col-md-12 mt-4">
                    <label class="form-label">Final Marks by chair</label>
                    <input type="number" class="form-control">
                  </div>
                  <div class="col-md-12 mt-4">
                    <label class="form-label">Report Average : 64.55</label> <br>
                    <label class="form-label">VIVA Average : 72 Difference : 2</label>
                    <h6 class="form-label">Negotiate between both examiners if difference >= 5</h6>
                    
                  </div>
                  <div class="col-md-12 mt-4">
                    <label class="form-label">Chair Feedback</label>
                    <textarea class="form-control" rows="4"></textarea>
                  </div>
                </div>
              </div>

              <div class="col-md-6 p-4" style="background-color:#e1e1e1">                        
                <div class="row mt-3">
                  <div class="col-md-4">
                    <label class="form-label">Final VIVA Marks : </label>
                  </div>
                  <div class="col-md-8">
                    <input type="number" class="form-control" disabled>
                  </div>
                  <div class="col-md-12">
                    <label class="form-label">Average (Difficulty + Understanding + Existing skill + New skills + Implementation/App/ Research)</label>
                  </div>
                </div>

                <div class="row mt-3">
                  <div class="col-md-4">
                    <label class="form-label">Final Report Marks : </label>
                  </div>
                  <div class="col-md-8">
                    <input type="number" class="form-control" disabled>
                  </div>
                  <div class="col-md-12">
                    <label class="form-label">Average (Examiner1 + Examiner 2 Report marks)</label>
                  </div>
                </div>

                <div class="row mt-3">
                  <div class="col-md-4">
                    <label class="form-label">Final Project :  </label>
                  </div>
                  <div class="col-md-8">
                    <input type="number" class="form-control" disabled>
                  </div>
                  <div class="col-md-12">
                    <label class="form-label">Report 70% + VIVA 30%</label>
                  </div>
                </div>

                <div class="row mt-3">
                  <div class="col-md-4">
                    <label class="form-label"><b>Final Module Marks :  </b></label>
                  </div>
                  <div class="col-md-8">
                    <input type="number" class="form-control" disabled>
                  </div>
                  <div class="col-md-12">
                    <label class="form-label">PP 5% + PSDP 25% + Final Project 70%</label>
                  </div>
                </div>

                

                
              </div>
              <div class="col-12">
                <button type="submit" class="btn btn-success">Submit</button>
                <button type="reset" class="btn btn-warning">Clear</button>
              </div>
            </form>

            </div>
      </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"></script>
</body>
</html>