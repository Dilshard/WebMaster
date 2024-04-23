<?php
session_start();
include("validate.php");
$iitId = $_GET['iitid'];
$staffEmail = $_GET['staffEmail'];

// Student name project title update
$sql_student = "SELECT * FROM Student WHERE iitid = $iitId";
$results_st = mysqli_query($conn, $sql_student);
if(mysqli_num_rows($results_st) > 0){
  while($row = mysqli_fetch_assoc($results_st)){
    $_SESSION['student_proj'] = $row['studentname']."(".$row['iitid'].") - ".$row['projtitle'];
  }
}

// Supervisor table data retrieve
$sql_supervisor = "SELECT * FROM sup_mark_pp_pspd WHERE iitid = $iitId";
$results_sup = mysqli_query($conn, $sql_supervisor);
if(mysqli_num_rows($results_sup) > 0){
  while($row = mysqli_fetch_assoc($results_sup)){
    $_SESSION[$iitId.'tot_pp'] = $row['tot_pp'];
    $_SESSION[$iitId.'tot_pspd'] = $row['tot_pspd'];
    $_SESSION[$iitId.'planning'] = $row['planning'];
    $_SESSION[$iitId.'supfeed_pspd'] = $row['supfeed_pspd'];
  }
}

// Examiner 1 table data retrieve
$sql_ex1 = "SELECT * FROM examiner_mark WHERE iitid = $iitId AND examiner_count = 1";
$results_ex1 = mysqli_query($conn, $sql_ex1);
if(mysqli_num_rows($results_ex1) > 0){
  while($row = mysqli_fetch_assoc($results_ex1)){
    $_SESSION[$iitId.'tot_report'] = $row['tot_report'];
    $_SESSION[$iitId.'total_viva'] = $row['total_viva'];
    
    $_SESSION[$iitId.'difficulty'] = $row['difficulty'];
    $_SESSION[$iitId.'exisskill'] = $row['exisskill'];
    $_SESSION[$iitId.'newskill'] = $row['newskill'];
    $_SESSION[$iitId.'proimp'] = $row['proimp'];
    $_SESSION[$iitId.'understand'] = $row['understand'];
    $_SESSION[$iitId.'addedval'] = $row['addedval'];
    $_SESSION[$iitId.'overallcom'] = $row['overallcom'];
  }
}

// Examiner 2 table data retrieve
$sql_ex2 = "SELECT * FROM examiner_mark WHERE iitid = $iitId AND examiner_count = 2";
$results_ex2 = mysqli_query($conn, $sql_ex2);
if(mysqli_num_rows($results_ex2) > 0){
  while($row = mysqli_fetch_assoc($results_ex2)){
    $_SESSION[$iitId.'tot_report_ex2'] = $row['tot_report'];
    $_SESSION[$iitId.'total_viva_ex2'] = $row['total_viva'];
    
    $_SESSION[$iitId.'difficulty_ex2'] = $row['difficulty'];
    $_SESSION[$iitId.'exisskill_ex2'] = $row['exisskill'];
    $_SESSION[$iitId.'newskill_ex2'] = $row['newskill'];
    $_SESSION[$iitId.'proimp_ex2'] = $row['proimp'];
    $_SESSION[$iitId.'understand_ex2'] = $row['understand'];
    $_SESSION[$iitId.'addedval_ex2'] = $row['addedval'];
    $_SESSION[$iitId.'overallcom_ex2'] = $row['overallcom'];
  }
}

//Chair table update
if(isset($_POST['btnsub'])){
  $ex1_rep_mk = $_POST['ex1_rep_mk'];
  $ex1_viva_mk = $_POST['ex1_viva_mk'];
  $ex1_difficult = $_POST['ex1_difficult'];
  $ex1_understand = $_POST['ex1_understand'];
  $ex1_exiskill = $_POST['ex1_exiskill'];
  $ex1_newskill = $_POST['ex1_newskill'];
  $ex1_proimpl = $_POST['ex1_proimpl'];
  $ex1_addedval = $_POST['ex1_addedval'];
  $ex1_overall = $_POST['ex1_overall'];

  $ex2_rep_mk = $_POST['ex2_rep_mk'];
  $ex2_viva_mk = $_POST['ex2_viva_mk'];
  $ex2_difficult = $_POST['ex2_difficult'];
  $ex2_understand = $_POST['ex2_understand'];
  $ex2_exiskill = $_POST['ex2_exiskill'];
  $ex2_newskill = $_POST['ex2_newskill'];
  $ex2_proimpl = $_POST['ex2_proimpl'];
  $ex2_addedval = $_POST['ex2_addedval'];
  $ex2_overall = $_POST['ex2_overall'];

  $simindex = $_POST['simindex'];
  $similaritycon = $_POST['similaritycon'];
  $thirdmk = $_POST['thirdmk'];
  $final_mk_chair = $_POST['final_mk_chair'];
  $chair_feed = $_POST['chair_feed'];
  $final_viva_mk_update = $_POST['final_viva_mk_update'];
  $final_report_mk_update = $_POST['final_report_mk_update'];
  $final_project_mk_update = $_POST['final_project_mk_update'];
  $final_module_mk_update = $_POST['final_module_mk_update'];

  // --- for email
  $_SESSION['final_viva_mail'] = $final_viva_mk_update;
  $_SESSION['final_report_mail'] = $final_report_mk_update;
  $_SESSION['final_proj_mail'] = $final_project_mk_update;
  $_SESSION['final_module_mail'] = $final_module_mk_update;
  $_SESSION['chair_feed_mail'] = $chair_feed;

  // $_SESSION['ex1_report_mail'] = $$ex1_rep_mk;
  // $_SESSION['ex1_viva_mail'] = $ex1_viva_mk;

  // $_SESSION['ex2_report_mail'] = $ex2_rep_mk;
  // $_SESSION['ex2_viva_mail'] = $ex2_viva_mk;
  //---

  $sql_chair = "UPDATE `chair` SET 
  `simindex`= $simindex, 
  `simcon` = '$similaritycon', 
  `thirdmark` = '$thirdmk', 
  `finalmk` = $final_mk_chair, 
  `chfeed` = '$chair_feed', 

  `ex1_report_total` = $ex1_rep_mk, 
  `ex1_viva_total` = $ex1_viva_mk, 
  `ex1_difficulty` = $ex1_difficult, 
  `ex1_exisskill` = $ex1_exiskill, 
  `ex1_newskill` = $ex1_newskill , 
  `ex1_proimp` = $ex1_proimpl, 
  `ex1_understand` = $ex1_understand, 
  `ex1_addedval` = '$ex1_addedval', 
  `ex1_overallcom` = '$ex1_overall', 
  
  `ex2_report_total` = $ex2_rep_mk, 
  `ex2_viva_total` = $ex2_viva_mk, 
  `ex2_difficulty` = $ex2_difficult, 
  `ex2_exisskill` = $ex2_exiskill, 
  `ex2_newskill` = $ex2_newskill, 
  `ex2_proimp` = $ex2_proimpl, 
  `ex2_understand` = $ex2_understand, 
  `ex2_addedval` = '$ex2_addedval', 
  `ex2_overallcom` = '$ex2_overall', 
  `staffemail` = '$staffEmail',

  `final_viva_mark` = '$final_viva_mk_update',
  `final_report_mark` = '$final_report_mk_update',
  `final_project_mark` = '$final_project_mk_update',
  `final_module_mark` = '$final_module_mk_update'
  
  WHERE `iitid` = $iitId;";

  if(mysqli_query($conn, $sql_chair)){
    header('Location: staff-schedules.php');
  }else{
    echo "Error!".mysqli_error($conn);
  }

  // ----- student table update ----
  $sql_chair = "UPDATE `Student` SET 
  `final_viva_mark`= $final_viva_mk_update, 
  `final_report_mark` = $final_report_mk_update, 
  `final_project_mark` = $final_project_mk_update, 
  `final_module_mark` = $final_module_mk_update
  
  WHERE `iitid` = $iitId;";

  if(mysqli_query($conn, $sql_chair)){
    email();
    header('Location: staff-schedules.php');
  }else{
    echo "Error!".mysqli_error($conn);
  }

     // ---- update log ------
     $log_details = strval($ex1_rep_mk.", ".$ex1_viva_mk.", ".$ex1_difficult.", ".$ex1_understand.", ".$ex1_exiskill.", ".$ex1_newskill.", ".$ex1_proimpl.", ".$ex1_addedval.", ".$ex1_overall.", ".$ex2_rep_mk.", ".$ex2_viva_mk.", ".$ex2_difficult.", ".$ex2_understand.", ".$ex2_exiskill.", ".$ex2_newskill.", ".$ex2_proimpl.", ".$ex2_addedval.", ".$ex2_overall.", ".$simindex.", ".$similaritycon.", ".$thirdmk.", ".$final_mk_chair.", ".$chair_feed.", ".$final_viva_mk_update.", ".$final_report_mk_update.", ".$final_project_mk_update.", ".$final_module_mk_update);

     $sql_log = "INSERT INTO `logs` (`table_name`, `login_email`, `log`, `time`,`student_id`) VALUES ('Chair', '$staffEmail', '$log_details',now(),'$iitId');";
     mysqli_query($conn, $sql_log);

     
}

function email(){

  require("mail-script.php"); 
    date_default_timezone_set('Asia/Colombo');
    $date = date('m/d/Y h:i:s a', time());

    if(empty($_SESSION['final_viva_mail'])){
      $_SESSION["final_viva_mail"] = 0;
    }

    if(empty($_SESSION['final_report_mail'])){
      $_SESSION["final_report_mail"] = 0;
    }

    if(empty($_SESSION['final_proj_mail'])){
      $_SESSION["final_proj_mail"] = 0;
    }

    if(empty($_SESSION['final_module_mail'])){
      $_SESSION["final_module_mail"] = 0;
    }

    if(empty($_SESSION['chair_feed_mail'])){
      $_SESSION["chair_feed_mail"] = "N/A";
    }

    //---

    // if(empty($_SESSION['tot_pp'])){
    //   $_SESSION["tot_pp"] = "N/A";
    // }

    // if(empty($_SESSION['tot_pspd'])){
    //   $_SESSION["tot_pspd"] = "N/A";
    // }

    // if(empty($_SESSION['planning'])){
    //   $_SESSION["planning"] = "N/A";
    // }

    // if(empty($_SESSION['ex1_report_mail'])){
    //   $_SESSION["aaaaaa"] = "N/A";
    // }

    // if(empty($_SESSION['ex2_report_mail'])){
    //   $_SESSION["aaaaaa"] = "N/A";
    // }

    // if(empty($_SESSION['ex1_viva_mail'])){
    //   $_SESSION["aaaaaa"] = "N/A";
    // }

    // if(empty($_SESSION['ex2_viva_mail'])){
    //   $_SESSION["aaaaaa"] = "N/A";
    // }

    
    $email_id = $_GET['staffEmail']; //Change This!
    $subject = "Final Project Marking Receipt (".$_GET['iitid'].") - Chair";
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
                                      <p class="" style="line-height: 28px; font-size: 16px; width: 100%; margin: 0;"
                                        align="left">
                                        User Account : '.$_GET['staffEmail'].' <br>
                                        Student ID : '.$_GET['iitid'].' <br>
                                        Marked : Final VIVA <br>
                                        Role : Chair <br>
                                        Date & Time : '.$date.' <br>
                                        Final VIVA Marks : '.$_SESSION['final_viva_mail'].'<br>
                                        Final Report Marks : '.$_SESSION['final_report_mail'].'<br>
                                        Final Project : '.$_SESSION['final_proj_mail'].'<br>
                                        <b>Final Module Marks : '.$_SESSION['final_module_mail'].'</b> <br>
                                        Chair feedback : <p><i>'.$_SESSION['chair_feed_mail'].'</i></p>
                                        <hr>
                                        Supervisor : PP('.$_SESSION[$_GET['iitid'].'tot_pp'].') & PSDP('.$_SESSION[$_GET['iitid'].'tot_pspd'].') & Report('.$_SESSION[$_GET['iitid'].'planning'].') <br>
                                        Examiner 1 : Report('.$_SESSION[$_GET['iitid'].'tot_report'].') & VIVA('.$_SESSION[$_GET['iitid'].'total_viva'].') <br>
                                        Examiner 2 : Report('.$_SESSION[$_GET['iitid'].'tot_report_ex2'].') & VIVA('.$_SESSION[$_GET['iitid'].'total_viva_ex2'].')
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
<head>
<style>
  #rep_avg,
  #rep_dif,
  #viva_avg,
  #viva_dif {
    background-color: #facfb3;
    padding: 3px 4px;
    border-radius : 5px;
    font-size : 20px
  }
</style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <?php include("staff-nav.php") ?>
        </div>
            <div class="row">
            <div class="col-md-12">
                    <h1 class="display-3 pb-3">Staff Chair</h1>
                    <h5 class="pb-3"><?php if(isset($_SESSION['student_proj'])){echo $_SESSION['student_proj'];}?></h5>
            </div>
                
            <div class="col-md-10 my-4 p-4 offset-md-1">

            <form method="POST" class="row g-3" onsubmit="return confirm('Do you really want to submit the form? \nNote: Data cannot be corrected after submitting!');">
                
              <div class="col-md-6">
                <label class="form-label display-5">Supervisor</label> <br>
                <label class="form-label">Proposal : <span id="pp"><?php if(isset($_SESSION[$iitId.'tot_pp'])){echo $_SESSION[$iitId.'tot_pp'];}else{echo 'Not marked!';}?></span></label> <br>
                <label class="form-label">PSDP : <span id="psdp"><?php if(isset($_SESSION[$iitId.'tot_pspd'])){echo $_SESSION[$iitId.'tot_pspd'];}else{echo 'Not marked!';}?></span></label> <br>
                <label class="form-label">Planning : <span id="planning"><?php if(isset($_SESSION[$iitId.'planning'])){echo $_SESSION[$iitId.'planning'];}else{echo 'Not marked!';}?></span></label> <br> 
              </div>
              <div class="col-md-6">
                <label class="form-label display-5">Supervisor Feedback</label> <br>
                <label class="form-label"><?php if(isset($_SESSION[$iitId.'supfeed_pspd'])){echo $_SESSION[$iitId.'supfeed_pspd'];}else{echo 'Not Updated!';}?></label> <br>
              </div>

              <hr>

              <!-- Examiner 1 -->

              <div class="col-md-6 p-4" style="background-color:#bcbcd7">
                <div class="col-md-12">
                  <label class="form-label display-5">Examiner 1 <a class="refresh" href="#">&#8635;</a></label> <br>
                </div>
                
                <div class="row mt-3">
                  <div class="col-md-3">
                    <label class="form-label">Report </label>
                    <input name="ex1_rep_mk" value="<?php if(isset($_SESSION[$iitId.'tot_report'])){echo $_SESSION[$iitId.'tot_report'];}else{echo -1;}?>" type="number" class="form-control" disabled>
                  </div>
                  <div class="col-md-3">
                    <label class="form-label">VIVA </label>
                    <input onkeyup="update_total_viva()" name="ex1_viva_mk" value="<?php if(isset($_SESSION[$iitId.'total_viva'])){echo $_SESSION[$iitId.'total_viva'];}else{echo -1;}?>" type="number" class="form-control green">
                  </div>
                </div>

                <div class="row mt-3">
                  <div class="col-md-6">
                    <label class="form-label">Difficulty</label>
                    <input name="ex1_difficult" value="<?php if(isset($_SESSION[$iitId.'difficulty'])){echo $_SESSION[$iitId.'difficulty'];}else{echo -1;}?>" type="number" class="form-control" disabled>
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">Understanding</label>
                    <input name="ex1_understand" value="<?php if(isset($_SESSION[$iitId.'understand'])){echo $_SESSION[$iitId.'understand'];}else{echo -1;}?>" type="number" class="form-control" disabled>
                  </div>
                </div>

                <div class="row mt-3">
                  <div class="col-md-6">
                    <label class="form-label">Development of existing skills</label>
                    <input name="ex1_exiskill" value="<?php if(isset($_SESSION[$iitId.'exisskill'])){echo $_SESSION[$iitId.'exisskill'];}else{echo -1;}?>" type="number" class="form-control" disabled>
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">Development of new skills</label>
                    <input name="ex1_newskill" value="<?php if(isset($_SESSION[$iitId.'newskill'])){echo $_SESSION[$iitId.'newskill'];}else{echo -1;}?>" type="number" class="form-control" disabled>
                  </div>
                </div>

                <div class="row mt-3">
                  <div class="col-md-12">
                    <label class="form-label">Product/Implementation/Application/Research</label>
                    <input name="ex1_proimpl" value="<?php if(isset($_SESSION[$iitId.'proimp'])){echo $_SESSION[$iitId.'proimp'];}else{echo -1;}?>" type="number" class="form-control" disabled>
                  </div>
                </div>

                <div class="row mt-3">
                  <div class="col-md-6">
                    <label class="form-label">Added Value</label>
                    <textarea name="ex1_addedval" class="form-control" rows="4" disabled><?php if(isset($_SESSION[$iitId.'addedval'])){echo $_SESSION[$iitId.'addedval'];}else{echo "Not updated!";}?></textarea>
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">Over all comment</label>
                    <textarea name="ex1_overall" class="form-control" rows="4" disabled><?php if(isset($_SESSION[$iitId.'overallcom'])){echo $_SESSION[$iitId.'overallcom'];}else{echo "Not updated!";}?></textarea>
                  </div>
                </div>
                
              </div>

              <!-- Examiner 2 -->

              <div class="col-md-6 p-4" style="background-color:#d7bcc1">
              <div class="col-md-12">
                  <label class="form-label display-5">Examiner 2 <a class="refresh" href="#">&#8635;</a></label> <br>
                </div>
                
                <div class="row mt-3">
                  <div class="col-md-3">
                    <label class="form-label">Report </label>
                    <input name="ex2_rep_mk" value="<?php if(isset($_SESSION[$iitId.'tot_report_ex2'])){echo $_SESSION[$iitId.'tot_report_ex2'];}else{echo -1;}?>" type="number" class="form-control" disabled>
                  </div>
                  <div class="col-md-3">
                    <label class="form-label">VIVA </label>
                    <input onkeyup="update_total_viva()" name="ex2_viva_mk" value="<?php if(isset($_SESSION[$iitId.'total_viva_ex2'])){echo $_SESSION[$iitId.'total_viva_ex2'];}else{echo -1;}?>" type="number" class="form-control green">
                  </div>
                </div>

                <div class="row mt-3">
                  <div class="col-md-6">
                    <label class="form-label">Difficulty</label>
                    <input name="ex2_difficult" value="<?php if(isset($_SESSION[$iitId.'difficulty_ex2'])){echo $_SESSION[$iitId.'difficulty_ex2'];}else{echo -1;}?>" type="number" class="form-control" disabled>
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">Understanding</label>
                    <input name="ex2_understand" value="<?php if(isset($_SESSION[$iitId.'understand_ex2'])){echo $_SESSION[$iitId.'understand_ex2'];}else{echo -1;}?>" type="number" class="form-control" disabled>
                  </div>
                </div>

                <div class="row mt-3">
                  <div class="col-md-6">
                    <label class="form-label">Development of existing skills</label>
                    <input name="ex2_exiskill" value="<?php if(isset($_SESSION[$iitId.'exisskill_ex2'])){echo $_SESSION[$iitId.'exisskill_ex2'];}else{echo -1;}?>" type="number" class="form-control" disabled>
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">Development of new skills</label>
                    <input name="ex2_newskill" value="<?php if(isset($_SESSION[$iitId.'newskill_ex2'])){echo $_SESSION[$iitId.'newskill_ex2'];}else{echo -1;}?>" type="number" class="form-control" disabled>
                  </div>
                </div>

                <div class="row mt-3">
                  <div class="col-md-12">
                    <label class="form-label">Product/Implementation/Application/Research</label>
                    <input name="ex2_proimpl" value="<?php if(isset($_SESSION[$iitId.'proimp_ex2'])){echo $_SESSION[$iitId.'proimp_ex2'];}else{echo -1;}?>" type="number" class="form-control" disabled>
                  </div>
                </div>

                <div class="row mt-3">
                  <div class="col-md-6">
                    <label class="form-label">Added Value</label>
                    <textarea name="ex2_addedval" class="form-control" rows="4" disabled><?php if(isset($_SESSION[$iitId.'addedval_ex2'])){echo $_SESSION[$iitId.'addedval_ex2'];}else{echo "Not updated!";}?></textarea>
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">Over all comment</label>
                    <textarea name="ex2_overall" class="form-control" rows="4" disabled><?php if(isset($_SESSION[$iitId.'overallcom_ex2'])){echo $_SESSION[$iitId.'overallcom_ex2'];}else{echo "Not updated!";}?></textarea>
                  </div>
                </div>
              </div>

              <hr>

              <div class="col-md-6 p-4">
                <div class="row mt-4">
                  <div class="col-md-12">
                    <label class="form-label">Similarity Index Generated by Turnitin </label>
                    <input name="simindex" value="0" type="number" class="form-control">
                  </div>
                  <div class="col-md-12 mt-4">
                    <label class="form-check-label">Is the similarity index at concerning amount?</label> <br>                    
                  </div>
                  <!-- <div class="col-md-12">
                    Yes <input name="similaritycon" class="form-check-input" type="radio" value="Yes">
                    No <input name="similaritycon" class="form-check-input" type="radio" value="No">
                  </div> -->
                  <div class="col-md-12">
                    <select name="similaritycon" id="inputState" class="form-select">
                      <option selected value="No">No</option>
                      <option value="Yes">Yes</option>
                    </select>
                  </div>

                  
                </div>

                <div class="row mt-3">
                  <div class="col-md-12">
                    <label class="form-label">Third Marking required?</label>
                  </div>
                  <div class="col-md-12 mt-4">
                    <!-- Yes <input name="thirdmk" class="form-check-input" type="radio" value="Yes">
                    No <input name="thirdmk" class="form-check-input" type="radio" value="No"> -->
                    <select name="thirdmk" id="inputState" class="form-select">
                      <option selected value="No">No</option>
                      <option value="Yes">Yes</option>
                    </select>
                  </div>
                </div>

                <div class="row mt-3">
                  <div class="col-md-12 mt-4">
                    <label class="form-label">Final VIVA Marks by chair (Without Planning)</label>
                    <input name="final_mk_chair" type="text" class="form-control" value="" disabled>
                  </div>
                  <div class="col-md-12 mt-4">
                    <label class="form-label">Report Average : <span id="rep_avg"></span> Difference : <span id="rep_dif"></span></label> <br>
                    <label class="form-label">VIVA Average : <span id="viva_avg"></span> Difference : <span id="viva_dif"></span></label>
                    <h6 class="form-label">Negotiate between both examiners if difference >= 5</h6>
                    
                  </div>
                  <div class="col-md-12 mt-4">
                    <label class="form-label">Chair Feedback</label>
                    <textarea name="chair_feed" class="form-control" rows="4"></textarea>
                  </div>
                </div>
              </div>

              <div class="col-md-6 p-4" style="background-color:#e1e1e1">                        
                <div class="row mt-3">
                  <div class="col-md-4">
                    <label class="form-label">Final VIVA Marks <br>(Including Planning): </label>
                  </div>
                  <div class="col-md-8">
                    <input name="final_viva_mk_update" type="text" class="form-control">
                  </div>
                  <div class="col-md-12">
                    <label class="form-label">Average (Difficulty + Understanding + Existing skill + New skills + Implementation/App/ Research + Planning and Consultation)</label>
                  </div>
                </div>

                

                <div class="row mt-3">
                  <div class="col-md-4">
                    <label class="form-label">Final Report Marks : </label>
                  </div>
                  <div class="col-md-8">
                    <input name="final_report_mk_update" type="text" class="form-control">
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
                    <input name="final_project_mk_update" type="text" class="form-control">
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
                    <input name="final_module_mk_update" type="text" class="form-control">
                  </div>
                  <div class="col-md-12">
                    <label class="form-label">PP 5% + PSDP 25% + Final Project 70%</label>
                  </div>
                </div>
                
              </div>
              <div class="col-12">
                <!-- <button name="btnsub" type="submit" class="btn btn-success">Submit</button> -->
                <input type="submit" name="btnsub" class="btn btn-success" value="Submit" onclick="f1()">
                <button type="reset" class="btn btn-warning">Clear</button>
              </div>
            </form>

            </div>
      </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"></script>
  <script>
    // <label class="form-label">Report Average : <span id="rep_avg"></span><span id="rep_dif"></span></label> <br>
    // <label class="form-label">VIVA Average : <span id="viva_avg"></span> Difference : <span id="viva_dif"></span></label>

    function report_viva_avg(){
      let ex1_rep = document.getElementsByName("ex1_rep_mk")[0].value;
      let ex2_rep = document.getElementsByName("ex2_rep_mk")[0].value;

      let ex1_viva = document.getElementsByName("ex1_viva_mk")[0].value;
      let ex2_viva = document.getElementsByName("ex2_viva_mk")[0].value;

      let pp = parseFloat(document.getElementById("pp").innerHTML);
      let psdp = parseFloat(document.getElementById("psdp").innerHTML);

      let avg_rep = (parseFloat(ex1_rep) + parseFloat(ex2_rep)) / 2 ;
      let difference_rep = ex1_rep - ex2_rep;

      let avg_viva = (parseFloat(ex1_viva) + parseFloat(ex2_viva)) / 2 ;
      let difference_viva = ex2_viva - ex1_viva;

      document.getElementById("rep_avg").innerHTML = avg_rep;
      document.getElementById("rep_dif").innerHTML = difference_rep;

      document.getElementById("viva_avg").innerHTML = avg_viva;
      document.getElementById("viva_dif").innerHTML = difference_viva;

      if(difference_viva > 0){
        if(difference_viva > 5){
          document.getElementById("viva_dif").style.backgroundColor = "red";
          document.getElementById("viva_dif").style.color = "white";
        }else{
          document.getElementById("viva_dif").style.backgroundColor = "green";
          document.getElementById("viva_dif").style.color = "white";
        }
      }else{
        if(difference_viva < -5){
          document.getElementById("viva_dif").style.backgroundColor = "red";
          document.getElementById("viva_dif").style.color = "white";
        }else{
          document.getElementById("viva_dif").style.backgroundColor = "green";
          document.getElementById("viva_dif").style.color = "white";
        }
      }
      let difficulty = (parseFloat(document.getElementsByName("ex1_difficult")[0].value) + parseFloat(document.getElementsByName("ex2_difficult")[0].value))/2;
      let understand = (parseFloat(document.getElementsByName("ex1_understand")[0].value) + parseFloat(document.getElementsByName("ex2_understand")[0].value))/2;
      let existingSkill = (parseFloat(document.getElementsByName("ex1_exiskill")[0].value) + parseFloat(document.getElementsByName("ex2_exiskill")[0].value))/2;
      let newSkill = (parseFloat(document.getElementsByName("ex1_newskill")[0].value) + parseFloat(document.getElementsByName("ex2_newskill")[0].value))/2;
      let productImplement = (parseFloat(document.getElementsByName("ex1_proimpl")[0].value) + parseFloat(document.getElementsByName("ex2_proimpl")[0].value))/2;
      let planning = parseFloat(document.getElementById("planning").innerHTML);
      
      document.getElementsByName("final_viva_mk_update")[0].value = ((difficulty + understand + existingSkill + newSkill + productImplement + planning)/6).toFixed(2);
      document.getElementsByName("final_mk_chair")[0].value = avg_viva;
      
      document.getElementsByName("final_report_mk_update")[0].value = (avg_rep).toFixed(2);
      document.getElementsByName("final_project_mk_update")[0].value = ((avg_rep*0.7) + (avg_viva*0.3)).toFixed(2);
      let final_proj_mk = (avg_rep*0.7) + (avg_viva*0.3);
      document.getElementsByName("final_module_mk_update")[0].value = ((pp*0.05)+(psdp*0.25)+(final_proj_mk*0.7)).toFixed(2);
    }

    report_viva_avg();

    function update_total_viva(){
      let ex1_viva = document.getElementsByName("ex1_viva_mk")[0].value;
      let ex2_viva = document.getElementsByName("ex2_viva_mk")[0].value;

      let difference_viva = ex2_viva - ex1_viva;
      document.getElementById("viva_dif").innerHTML = difference_viva;
      
      

      if(difference_viva > 0){
        if(difference_viva > 5){
          document.getElementById("viva_dif").style.backgroundColor = "red";
          document.getElementById("viva_dif").style.color = "white";
        }else{
          document.getElementById("viva_dif").style.backgroundColor = "green";
          document.getElementById("viva_dif").style.color = "white";
        }
      }else{
        if(difference_viva < -5){
          document.getElementById("viva_dif").style.backgroundColor = "red";
          document.getElementById("viva_dif").style.color = "white";
        }else{
          document.getElementById("viva_dif").style.backgroundColor = "green";
          document.getElementById("viva_dif").style.color = "white";
        }
      }
      
      let planning = parseFloat(document.getElementById("planning").innerHTML);

      let total_viva_without_plan = (parseFloat(ex1_viva) + parseFloat(ex2_viva)) / 2 ;
      let total_viva = (parseFloat(ex1_viva) + parseFloat(ex2_viva) + planning) / 3 ;
      document.getElementById("viva_avg").innerHTML = total_viva_without_plan;
      
      
      document.getElementsByName("final_viva_mk_update")[0].value = total_viva.toFixed(2);
      document.getElementsByName("final_mk_chair")[0].value = total_viva_without_plan.toFixed(2);
      total_viva = 0;
    }

   
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