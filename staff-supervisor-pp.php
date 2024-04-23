<?php
session_start();
include("validate.php");

$iitId = $_GET['iidit'];
$staffEmail = $_GET['staffEmail'];

// ----- Supervisor pp pre-entered data load -----
$sql_sup_pp_load = "SELECT * FROM sup_mark_pp_pspd WHERE iitid = $iitId";
$results_sup_pp_load = mysqli_query($conn, $sql_sup_pp_load);
if(mysqli_num_rows($results_sup_pp_load) == 1){
  while($row_load = mysqli_fetch_assoc($results_sup_pp_load)){
    $_SESSION['probstate']= $row_load['probstate'];
    $_SESSION['revsim'] = $row_load['revsim'];
    $_SESSION['tool'] = $row_load['tool'];
    $_SESSION['reqlist_pp'] = $row_load['reqlist_pp'];
    $_SESSION['challenge'] = $row_load['challenge'];
    $_SESSION['supfeed_pp'] = $row_load['supfeed_pp'];
    $_SESSION['below40_pp'] = $row_load['below40_pp'];  
    $_SESSION['tot_pp'] = $row_load['tot_pp'];  
   
  }
}

if(isset($_POST['btnsub'])){
  $probstate = $_POST['probstate'];
  $revsim = $_POST['revsim'];
  $tool = $_POST['tool'];
  $reqlist_pp = $_POST['reqlist_pp'];
  $challenge = $_POST['challenge'];
  $supfeed_pp = $_POST['supfeed_pp'];
  $below40_pp = $_POST['below40_pp'];  
  $total_pp = ($probstate + $revsim + $tool + $reqlist_pp + $challenge)/5;
  $_SESSION['sup_total_pp'] = round((int)$total_pp,2); 
 
  $sql = "UPDATE `sup_mark_pp_pspd` SET `staffemail` = '$staffEmail', `probstate` = $probstate,`revsim` = $revsim,`tool` = $tool,`reqlist_pp` = $reqlist_pp,`challenge` = $challenge,`supfeed_pp` = '$supfeed_pp',`below40_pp` = '$below40_pp',`tot_pp` = $total_pp  WHERE `sup_mark_pp_pspd`.`iitid` = $iitId";

  if(mysqli_query($conn, $sql)){
    email();
    $_SESSION['status'] = "Success!";
  }else{
    echo "Error!".mysqli_error($conn);
  }

  // ---- update log ------
  $log_details = strval($probstate.", ".$revsim.", ".$tool.", ".$reqlist_pp.", ".$challenge.", ".$supfeed_pp.", ".$below40_pp.", ".$total_pp);

  $sql_log = "INSERT INTO `logs` (`table_name`, `login_email`, `log`, `time`,`student_id`) VALUES ('Supervisor-PP', '$staffEmail', '$log_details',now(),'$iitId');";
  mysqli_query($conn, $sql_log);

  
}

function email(){

  require("mail-script.php"); 
    date_default_timezone_set('Asia/Colombo');
    $date = date('m/d/Y h:i:s a', time());

    if(empty($_SESSION['sup_total_pp'])){
      $_SESSION["sup_total_pp"] = 0;
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
                                        Marked : Project Proposal <br>
                                        Role : Supervisor <br>
                                        Date & Time : '.$date.' <br>
                                        Total Report Marks : '.$_SESSION["sup_total_pp"].' 
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
                                              <a href="Webmaster.lk"
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
                                fp2022viva@iit.ac.lk <br>
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
                    <h1 class="display-3 pb-3">Staff Supervisor PP</h1>
                    <h5 class="pb-3"><?php if(isset($_SESSION['student_proj'])){echo $_SESSION['student_proj'];}?></h5>
            </div>
                
            <div class="col-md-6 my-4 p-4 offset-md-3">

            <form method="POST" class="row g-3">
                
              <div class="col-md-6">
                <label class="form-label">Problem statement, aims & objectives (<a href="#">Criteria</a>)</label> 
                <input name="probstate" type="number" class="form-control" value="<?php if(isset($_SESSION['probstate'])){echo $_SESSION['probstate'];} unset($_SESSION['probstate']);?>">
              </div>
              <div class="col-md-6">
                <label class="form-label">List of challenges (including technical and other), timeline and references (<a href="#">Criteria</a>)</label>
                <input name="challenge" type="number" class="form-control" value="<?php if(isset($_SESSION['challenge'])){echo $_SESSION['challenge'];} unset($_SESSION['challenge']);?>">
              </div>
              <div class="col-6">
              <label class="form-label">Review of similar applications or similar research (<a href="#">Criteria</a>)</label>
                <input name="revsim" type="number" class="form-control" id="fullName" value="<?php if(isset($_SESSION['revsim'])){echo $_SESSION['revsim'];} unset($_SESSION['revsim']);?>">
              </div>
              <div class="col-md-6">
                <label class="form-label">Supervisor Feedback</label>
                <textarea name="supfeed_pp" class="form-control"><?php if(isset($_SESSION['supfeed_pp'])){echo $_SESSION['supfeed_pp'];} unset($_SESSION['supfeed_pp']);?></textarea>
              </div>
              <div class="col-md-6">
                <label class="form-label">Tools (equipment, software, etc.) and technical skills (<a href="#">Criteria</a>)</label>
                <input name="tool" type="number" class="form-control" value="<?php if(isset($_SESSION['tool'])){echo $_SESSION['tool'];} unset($_SESSION['tool']);?>">
              </div>
              <div class="col-md-6">
                <label class="form-label">If student is an resit student (Below 40) What needs to be improved</label>
                <textarea name="below40_pp" class="form-control"><?php if(isset($_SESSION['below40_pp'])){echo $_SESSION['below40_pp'];} unset($_SESSION['below40_pp']);?></textarea>
              </div>
              <div class="col-md-6">
                <label class="form-label">Initial list of requirements and on-going methods for project requirement elicitation (<a href="#">Criteria</a>)</label>
                <input name="reqlist_pp" type="number" class="form-control" value="<?php if(isset($_SESSION['reqlist_pp'])){echo $_SESSION['reqlist_pp'];} unset($_SESSION['reqlist_pp']);?>">
              </div>
              <div class="col-md-6">
                <label class="form-label">Total</label>
                <input name="total_pp" type="number" class="form-control" value="<?php if(isset($_SESSION['tot_pp'])){echo $_SESSION['tot_pp'];} unset($_SESSION['tot_pp']);?>" disabled>
              </div>
              
              <div class="col-12">
                <button name="btnsub" type="submit" class="btn btn-success">Submit</button>
                <button type="reset" class="btn btn-warning">Clear</button>
                <span id="status"><?php if(isset($_SESSION['status'])){echo $_SESSION['status'];} unset($_SESSION['status']); unset($_SESSION['status']);?></span>
              </div>
            </form>
            </div>
      </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"></script>
</body>
</html>