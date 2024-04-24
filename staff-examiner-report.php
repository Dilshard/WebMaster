<?php
session_start();
include("validate.php");

$iitId = $_GET['iidit'];
$staffEmail = $_GET['staffEmail'];
$exCount = $_GET['ex'];

// ----- examiner pre-entered data load -----
$sql_ex_load = "SELECT * FROM examiner_mark WHERE iitid = $iitId AND examiner_count = $exCount";
$results_ex_load = mysqli_query($conn, $sql_ex_load);
if(mysqli_num_rows($results_ex_load) == 1){
  while($row_load = mysqli_fetch_assoc($results_ex_load)){
    $_SESSION['aim'] = $row_load['aim'];
    $_SESSION['stak'] = $row_load['stakehold'];
    $_SESSION['elicit'] = $row_load['elicitation'];
    $_SESSION['listofreq'] = $row_load['reqlist'];
    $_SESSION['reqana'] = $row_load['reqana'];
    $_SESSION['reqana'] = $row_load['reqana'];
    $_SESSION['reff'] = $row_load['ref'];
    $_SESSION['proto'] = $row_load['protodemo'];
    $_SESSION['exfeed'] = $row_load['genfeed'];
    $_SESSION['below40'] = $row_load['below40'];
    $_SESSION['tot_report'] = $row_load['tot_report'];
   
  }
}
// ----- END -----

$sql_student = "SELECT * FROM Student WHERE iitid = $iitId";
$results = mysqli_query($conn, $sql_student);
if(mysqli_num_rows($results) > 0){
  while($row = mysqli_fetch_assoc($results)){
    $_SESSION['student_proj'] = $row['studentname']."(".$row['iitid'].") - ".$row['projtitle'];
  }
}

if(isset($_POST['btnsub'])){
  $aims = $_POST['aims'];
  $req = $_POST['req'];
  $stak = $_POST['stak'];
  $reff = $_POST['reff'];
  $elicit = $_POST['elicit'];
  $proto = $_POST['proto'];
  $listofreq = $_POST['listofreq'];
  $exfeed = $_POST['exfeed'];
  $below40 = $_POST['below40'];
  $tot_report = ($aims + $req + $stak + $reff + $elicit + $proto + $listofreq)/7;
  $_SESSION["total_report_mk"] = round($tot_report,2);
 
  $sql = "UPDATE `examiner_mark` SET `staffemail` = '$staffEmail', `aim` = $aims,`stakehold` = $stak,`elicitation` = $elicit,`reqlist` = $listofreq,`reqana` = $req,`ref` = $reff,`protodemo` = $proto,`genfeed` = '$exfeed',`below40` = '$below40',`tot_report` = $tot_report  WHERE `examiner_mark`.`iitid` = $iitId AND `examiner_mark`.`examiner_count` = $exCount";

  if(mysqli_query($conn, $sql)){
    email();
    $_SESSION['ex_status'] = "Success!";
    // echo "Success!";
  }else{
    echo "Error!".mysqli_error($conn);
  }

  // ---- update log ------
  $log_details = strval($aims.", ".$req.", ".$stak.", ".$reff.", ".$elicit.", ".$proto.", ".$listofreq.", ".$exfeed.", ".$below40.", ".$tot_report);

  $sql_log = "INSERT INTO `logs` (`table_name`, `login_email`, `log`, `time`,`student_id`) VALUES ('Examiner-report', '$staffEmail', '$log_details',now(),'$iitId');";
  mysqli_query($conn, $sql_log);

  
}

function email(){

  require("mail-script.php"); 
    date_default_timezone_set('Asia/Colombo');
    $date = date('m/d/Y h:i:s a', time());

    if(empty($_SESSION["total_report_mk"])){
      $_SESSION["total_report_mk"] = 0;
    }
    
    $email_id = $_GET['staffEmail']; //Change This!
    $subject = "Final Project Marking Receipt (".$_GET['iidit'].")";
    $body = '
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
    <html>

    <head>
      <!-- Compiled with Bootstrap Email version: 1.3.1 -->
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
      <meta http-equiv="x-ua-compatible" content="ie=edge">
      <meta name="x-apple-disable-message-reformatting">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="format-detection" content="telephone=no, date=no, address=no, email=no">
      <style type="text/css">
        body,
        table,
        td {
          font-family: Helvetica, Arial, sans-serif !important
        }

        .ExternalClass {
          width: 100%
        }

        .ExternalClass,
        .ExternalClass p,
        .ExternalClass span,
        .ExternalClass font,
        .ExternalClass td,
        .ExternalClass div {
          line-height: 150%
        }

        a {
          text-decoration: none
        }

        * {
          color: inherit
        }

        a[x-apple-data-detectors],
        u+#body a,
        #MessageViewBody a {
          color: inherit;
          text-decoration: none;
          font-size: inherit;
          font-family: inherit;
          font-weight: inherit;
          line-height: inherit
        }

        img {
          -ms-interpolation-mode: bicubic
        }

        table:not([class^=s-]) {
          font-family: Helvetica, Arial, sans-serif;
          mso-table-lspace: 0pt;
          mso-table-rspace: 0pt;
          border-spacing: 0px;
          border-collapse: collapse
        }

        table:not([class^=s-]) td {
          border-spacing: 0px;
          border-collapse: collapse
        }

        @media screen and (max-width: 600px) {

          .w-full,
          .w-full>tbody>tr>td {
            width: 100% !important
          }

          .w-24,
          .w-24>tbody>tr>td {
            width: 96px !important
          }

          .w-40,
          .w-40>tbody>tr>td {
            width: 160px !important
          }

          .p-lg-10:not(table),
          .p-lg-10:not(.btn)>tbody>tr>td,
          .p-lg-10.btn td a {
            padding: 0 !important
          }

          .p-3:not(table),
          .p-3:not(.btn)>tbody>tr>td,
          .p-3.btn td a {
            padding: 12px !important
          }

          .p-6:not(table),
          .p-6:not(.btn)>tbody>tr>td,
          .p-6.btn td a {
            padding: 24px !important
          }

          *[class*=s-lg-]>tbody>tr>td {
            font-size: 0 !important;
            line-height: 0 !important;
            height: 0 !important
          }

          .s-4>tbody>tr>td {
            font-size: 16px !important;
            line-height: 16px !important;
            height: 16px !important
          }

          .s-6>tbody>tr>td {
            font-size: 24px !important;
            line-height: 24px !important;
            height: 24px !important
          }

          .s-10>tbody>tr>td {
            font-size: 40px !important;
            line-height: 40px !important;
            height: 40px !important
          }
        }
      </style>
    </head>

    <body class="bg-light"
      style="outline: 0; width: 100%; min-width: 100%; height: 100%; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; font-family: Helvetica, Arial, sans-serif; line-height: 24px; font-weight: normal; font-size: 16px; -moz-box-sizing: border-box; -webkit-box-sizing: border-box; box-sizing: border-box; color: #000000; margin: 0; padding: 0; border-width: 0;"
      bgcolor="#f7fafc">
      <table class="bg-light body" valign="top" role="presentation" border="0" cellpadding="0" cellspacing="0"
        style="outline: 0; width: 100%; min-width: 100%; height: 100%; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; font-family: Helvetica, Arial, sans-serif; line-height: 24px; font-weight: normal; font-size: 16px; -moz-box-sizing: border-box; -webkit-box-sizing: border-box; box-sizing: border-box; color: #000000; margin: 0; padding: 0; border-width: 0;"
        bgcolor="#f7fafc">
        <tbody>
          <tr>
            <td valign="top" style="line-height: 24px; font-size: 16px; margin: 0;" align="left" bgcolor="#f7fafc">
              <table class="container" role="presentation" border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
                <tbody>
                  <tr>
                    <td align="center" style="line-height: 24px; font-size: 16px; margin: 0; padding: 0 16px;">
                      <!--[if (gte mso 9)|(IE)]>
                          <table align="center" role="presentation">
                            <tbody>
                              <tr>
                                <td width="600">
                        <![endif]-->
                      <table align="center" role="presentation" border="0" cellpadding="0" cellspacing="0"
                        style="width: 100%; max-width: 600px; margin: 0 auto;">
                        <tbody>
                          <tr>
                            <td style="line-height: 24px; font-size: 16px; margin: 0;" align="left">
                              <table class="s-10 w-full" role="presentation" border="0" cellpadding="0" cellspacing="0"
                                style="width: 100%;" width="100%">
                                <tbody>
                                  <tr>
                                    <td style="line-height: 40px; font-size: 40px; width: 100%; height: 40px; margin: 0;"
                                      align="left" width="100%" height="40">
                                      &#160;
                                    </td>
                                  </tr>
                                </tbody>
                              </table>
                              <table class="ax-center" role="presentation" align="center" border="0" cellpadding="0"
                                cellspacing="0" style="margin: 0 auto;">
                                <tbody>
                                  <tr>
                                    <td style="line-height: 24px; font-size: 16px; margin: 0;" align="left">
                                      <img class="w-24"
                                        src="https://lh3.googleusercontent.com/u/0/drive-viewer/AKGpihZRWyArIhIsX62CJNxrlEKXC1bUWP04SNeVWKEtUyejacEaUxdoxTnEK-pZvysM-THtvFhMKrpOWDHyeKpMbCS5qq9h4FTUdc8=w2880-h1558"
                                        style="height: auto; line-height: 100%; outline: none; text-decoration: none; display: block; width: 196px; border-style: none; border-width: 0;"
                                        width="96">
                                    </td>
                                  </tr>
                                </tbody>
                              </table>
                              <table class="s-10 w-full" role="presentation" border="0" cellpadding="0" cellspacing="0"
                                style="width: 100%;" width="100%">
                                <tbody>
                                  <tr>
                                    <td style="line-height: 40px; font-size: 40px; width: 100%; height: 40px; margin: 0;"
                                      align="left" width="100%" height="40">
                                      &#160;
                                    </td>
                                  </tr>
                                </tbody>
                              </table>
                              <table class="card p-6 p-lg-10 space-y-4" role="presentation" border="0" cellpadding="0"
                                cellspacing="0"
                                style="border-radius: 6px; border-collapse: separate !important; width: 100%; overflow: hidden; border: 1px solid #e2e8f0;"
                                bgcolor="#ffffff">
                                <tbody>
                                  <tr>
                                    <td style="line-height: 24px; font-size: 16px; width: 100%; margin: 0; padding: 40px;"
                                      align="left" bgcolor="#ffffff">
                                      <h1 class="h3 fw-700"
                                        style="padding-top: 0; padding-bottom: 0; font-weight: 700 !important; vertical-align: baseline; font-size: 28px; line-height: 33.6px; margin: 0;"
                                        align="left">
                                        Summary
                                      </h1>
                                      <table class="s-4 w-full" role="presentation" border="0" cellpadding="0"
                                        cellspacing="0" style="width: 100%;" width="100%">
                                        <tbody>
                                          <tr>
                                            <td
                                              style="line-height: 16px; font-size: 16px; width: 100%; height: 16px; margin: 0;"
                                              align="left" width="100%" height="16">
                                              &#160;
                                            </td>
                                          </tr>
                                        </tbody>
                                      </table>
                                      <p class="" style="line-height: 24px; font-size: 16px; width: 100%; margin: 0;"
                                        align="left">
                                        User Account : '.$_GET['staffEmail'].' <br>
                                        Student ID : '.$_GET['iidit'].' <br>
                                        Marked : Report <br>
                                        Role : Examiner '.$_GET['ex'].' <br>
                                        Date & Time : '.$date.' <br>
                                        Total Report Marks : '.$_SESSION["total_report_mk"].' 
                                      </p>
                                      <table class="s-4 w-full" role="presentation" border="0" cellpadding="0"
                                        cellspacing="0" style="width: 100%;" width="100%">
                                        <tbody>
                                          <tr>
                                            <td
                                              style="line-height: 16px; font-size: 16px; width: 100%; height: 16px; margin: 0;"
                                              align="left" width="100%" height="16">
                                              &#160;
                                            </td>
                                          </tr>
                                        </tbody>
                                      </table>
                                      <table class="btn btn-primary p-3 fw-700" role="presentation" border="0"
                                        cellpadding="0" cellspacing="0"
                                        style="border-radius: 6px; border-collapse: separate !important; font-weight: 700 !important;">
                                        <tbody>
                                          <tr>
                                            <td
                                              style="line-height: 24px; font-size: 16px; border-radius: 6px; font-weight: 700 !important; margin: 0;"
                                              align="center" bgcolor="#0d6efd">
                                              <a href="http://fpv.iit.ac.lk/WebMaster"
                                                style="color: #ffffff; font-size: 16px; font-family: Helvetica, Arial, sans-serif; text-decoration: none; border-radius: 6px; line-height: 20px; display: block; font-weight: 700 !important; white-space: nowrap; background-color: #c41b18; padding: 12px; border: 1px solid #741211;">Visit
                                                WebMaster</a>
                                            </td>
                                          </tr>
                                        </tbody>
                                      </table>
                                    </td>
                                  </tr>
                                </tbody>
                              </table>
                              <table class="s-10 w-full" role="presentation" border="0" cellpadding="0" cellspacing="0"
                                style="width: 100%;" width="100%">
                                <tbody>
                                  <tr>
                                    <td style="line-height: 40px; font-size: 40px; width: 100%; height: 40px; margin: 0;"
                                      align="left" width="100%" height="40">
                                      &#160;
                                    </td>
                                  </tr>
                                </tbody>
                              </table>
                              <table class="ax-center" role="presentation" align="center" border="0" cellpadding="0"
                                cellspacing="0" style="margin: 0 auto;">
                                <tbody>
                                  <tr>
                                    <td style="line-height: 24px; font-size: 26px; margin: 0;" align="left">
                                      Web Master
                                    </td>
                                  </tr>
                                </tbody>
                              </table>
                              <table class="s-6 w-full" role="presentation" border="0" cellpadding="0" cellspacing="0"
                                style="width: 100%;" width="100%">
                                <tbody>
                                  <tr>
                                    <td style="line-height: 24px; font-size: 24px; width: 100%; height: 24px; margin: 0;"
                                      align="left" width="100%" height="24">
                                      &#160;
                                    </td>
                                  </tr>
                                </tbody>
                              </table>
                              <div class="text-muted text-center" style="color: #718096;" align="center">
                                IIT School of Computing. <br>
                                10, Trelawney Pl, Colombo 04<br>
                                fypsystem@iit.ac.lk <br>
                              </div>
                              <table class="s-6 w-full" role="presentation" border="0" cellpadding="0" cellspacing="0"
                                style="width: 100%;" width="100%">
                                <tbody>
                                  <tr>
                                    <td style="line-height: 24px; font-size: 24px; width: 100%; height: 24px; margin: 0;"
                                      align="left" width="100%" height="24">
                                      &#160;
                                    </td>
                                  </tr>
                                </tbody>
                              </table>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                      <!--[if (gte mso 9)|(IE)]>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                        <![endif]-->
                    </td>
                  </tr>
                </tbody>
              </table>
            </td>
          </tr>
        </tbody>
      </table>
    </body>

    </html>
    ';

    if(empty($email_id) || empty($subject) || empty($body)){
         $response = "All fields are required";
    }else{
        $response = sendMail($email_id, $subject, $body);
    }

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
                    <h1 class="display-3 pb-3">Staff Examiner Report</h1>
                    <h5 class="pb-3"><?php if(isset($_SESSION['student_proj'])){echo $_SESSION['student_proj'];}?></h5>
            </div>
                
            <div class="col-md-6 my-4 p-4 offset-md-3">

            <form method="POST" class="row g-3">
                
              <div class="col-md-6">
                <label class="form-label">Aims and objectives (<a href="#">Criteria</a>)</label> 
                <input name="aims" type="number" class="form-control" placeholder = "Out of 100" value="<?php if(isset($_SESSION['aim'])){echo $_SESSION['aim'];} unset($_SESSION['aim']);?>">
              </div>
              <div class="col-md-6">
                <label class="form-label">Requirements analysis and modelling (<a href="#">Criteria</a>)</label>
                <input name="req" type="number" class="form-control" placeholder = "Out of 100" value="<?php if(isset($_SESSION['reqana'])){echo $_SESSION['reqana'];} unset($_SESSION['reqana']);?>">
              </div>
              <div class="col-md-6">
              <label class="form-label">Stakeholders (<a href="#">Criteria</a>)</label>
                <input name="stak" type="number" class="form-control" placeholder = "Out of 100" value="<?php if(isset($_SESSION['stak'])){echo $_SESSION['stak'];} unset($_SESSION['stak']);?>">
              </div>
              <div class="col-md-6">
                <label class="form-label">References & Bibliography</label>
                <input name="reff" type="number" class="form-control" placeholder = "Out of 100" value="<?php if(isset($_SESSION['reff'])){echo $_SESSION['reff'];} unset($_SESSION['reff']);?>">
              </div>
              <div class="col-md-6">
                <label class="form-label">Elicitation of requirements (<a href="#">Criteria</a>)</label>
                <input name="elicit" type="number" class="form-control" placeholder = "Out of 100" value="<?php if(isset($_SESSION['elicit'])){echo $_SESSION['elicit'];} unset($_SESSION['elicit']);?>">
              </div>
              <div class="col-md-6">
                <label class="form-label">Prototype & Demo Video: Evidence of engagement with realising the design</label>
                <input name="proto" type="number" class="form-control" placeholder = "Out of 100" value="<?php if(isset($_SESSION['proto'])){echo $_SESSION['proto'];} unset($_SESSION['proto']);?>">
              </div>
              <div class="col-md-6">
                <label class="form-label">List of requirements (<a href="#">Criteria</a>)</label>
                <input name="listofreq" type="number" class="form-control" placeholder = "Out of 100" value="<?php if(isset($_SESSION['listofreq'])){echo $_SESSION['listofreq'];} unset($_SESSION['listofreq']);?>">
              </div>
              <div class="col-md-6"> </div>
              <div class="col-md-6">
                <label class="form-label">Examiner Feedback</label>
                <textarea name="exfeed" class="form-control"><?php if(isset($_SESSION['exfeed'])){echo $_SESSION['exfeed'];} unset($_SESSION['exfeed']);?></textarea>
              </div>
              <div class="col-md-6">
                <label class="form-label">If student is an resit student (Below 40) What needs to be improved</label>
                <textarea name="below40" class="form-control"><?php if(isset($_SESSION['below40'])){echo $_SESSION['below40'];} unset($_SESSION['below40']);?></textarea>
              </div>
              <div class="col-md-6">
                <label class="form-label">Total</label>
                <input name="tot_report" type="number" class="form-control" value="<?php if(isset($_SESSION['tot_report'])){echo $_SESSION['tot_report'];} unset($_SESSION['tot_report']);?>">
              </div>
              
              <div class="col-12">
                <input type="submit" name="btnsub" class="btn btn-success" value="Submit" onclick="f1()">
                <button type="reset" class="btn btn-warning">Clear</button>
                <span id="status"><?php if(isset($_SESSION['ex_status'])){echo $_SESSION['ex_status'];} unset($_SESSION['ex_status']);  ?></span>
              </div>
            </form>

            </div>
      </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"></script>

  <script>
    $button = document.getElementsByName("btnsub")[0];

    function f1(){
    if($button.value == "Submit"){
      $button.value = "Loading...";
    }else{
      $button.value = "Submit";
    }
    }
  </script>
</body>
</html>