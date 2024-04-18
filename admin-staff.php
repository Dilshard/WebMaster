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

  $staffEmail = "by ".$_SESSION['email'];

  include 'con.php';

  if(isset($_POST['btnsub'])){
    $email = $_POST['stemail'];
    $stpass = generatePass();
    $ftpt = $_POST['ftpt'];
    $stname = $_POST['stname'];
    $stspecial = $_POST['stspecial'];
    $stcontact = $_POST['stcontact'];
    $strole = $_POST['strole'];

    //email
    $_SESSION['mail-username'] = $email;
    $_SESSION['mail-pass'] = $stpass;
    $_SESSION['mail-name'] = $stname;

    $sql = "INSERT INTO `Staff` (`staffemail`, `password`, `staffname`, `contact`, `ftpt`, `area`, `role`, `pass_attempt`) VALUES ('$email', '$stpass', '$stname', '$stcontact', '$ftpt', '$stspecial', '$strole', 0);";

    if(mysqli_query($conn, $sql)){
      email();
      header('Location: admin-staff-manage.php');
    }else{
      echo "Error!".mysqli_error($conn);
    }

     // ---- update log ------
    $log_details = strval($email.", ".$stpass.", ".$ftpt.", ".$stname.", ".$stspecial.", ".$stcontact.", ".$strole);

    $sql_log = "INSERT INTO `logs` (`table_name`, `login_email`, `log`, `time`,`student_id`) VALUES ('Admin - inserted Staff', '$staffEmail', '$log_details',now(),'$email');";
    mysqli_query($conn, $sql_log);

    
  }


  //---- Bulk student CSV upload ----
  if(isset($_POST['staff_upload'])){
    $_SESSION['count_email'] = 0;

    // Allowed mime types
    $csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
    
    // Validate whether selected file is a CSV file
    if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $csvMimes)){
        
        // If the file is uploaded
        if(is_uploaded_file($_FILES['file']['tmp_name'])){
            
            // Open uploaded CSV file with read-only mode
            $csvFile = fopen($_FILES['file']['tmp_name'], 'r');
            
            // Skip the first line
            fgetcsv($csvFile);
            /*
            while (($row = fgetcsv($csvFile)) !== FALSE) {
                $firstName = $row[0];
                $lastName = $row[1];
                $email = $row[2];
                $password = $row[3];

                sendMail($firstName, $lastName, $email, $password);
            }
            */
            // Parse data from CSV file line by line

            $data = [];
            
            while(($line = fgetcsv($csvFile)) !== FALSE){
                // Get row data
                $staffemail = $line[0];
                $staffname = $line[1];
                $contact = $line[2];
                $password = generatePass();
                $role = $line[4];
                $ftpt = $line[5];
                $area = $line[6];

                $_SESSION['mail-username'] = $staffemail;
                $_SESSION['mail-pass'] = $password;
                $_SESSION['mail-name'] = $staffname;
                
                // Check whether member already exists in the database with the same email
                $prevQuery = "SELECT staffid FROM Staff WHERE staffemail = '".$line[0]."'";
                $prevResult = $conn->query($prevQuery);
                
                if($prevResult->num_rows > 0){
                    // Update member data in the database
                    $conn->query("UPDATE Staff SET staffname = '".$staffname."', contact = '".$contact."', password = '".$password."', ftpt = '".$ftpt."', area = '".$area."' WHERE staffemail = '".$staffemail."'");
                }else{
                    // Insert member data in the database
                    $conn->query("INSERT INTO `Staff` (`staffemail`, `staffname`, `contact`, `password`, `role`, `ftpt`, `area`,`pass_attempt`) VALUES ('$staffemail','$staffname', $contact,'$password','$role','$ftpt','$area',0);");
                    array_push($data,"$staffname,$staffemail,$password");
                    
                    // ---- update log ------
                    $log_details = strval($staffemail.", ".$staffname.", ".$contact.", ".$password.", ".$role.", ".$ftpt.", ".$area);

                    $sql_log = "INSERT INTO `logs` (`table_name`, `login_email`, `log`, `time`,`student_id`) VALUES ('Admin - inserted Staff', '$staffemail', '$log_details',now(),'$_SESSION[email]');";
                    mysqli_query($conn, $sql_log);
                }
            }
            fclose($csvFile);
            $_SESSION['export_data_csv'] = $data;
            
            $qstring = '?status=succ';
            $_SESSION['status_staff_csv_load'] = "Success!";
           
        }else{
            $qstring = '?status=err';
            $_SESSION['status_staff_csv_load'] = "Error!";
        }
    }else{
        $qstring = '?status=invalid_file';
        $_SESSION['status_staff_csv_load'] = "Invalid file type!";
    }
    
}
//---- END ----

function export_csv($data){
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="details.csv"');
    print_r($data);
    

    $fp = fopen('php://output', 'wb');
    foreach ( $data as $line ) {
        $val = explode(",", $line);
        fputcsv($fp, $val);
    }
    fclose($fp);
}

function email(){

  require("mail-script.php"); 
    date_default_timezone_set('Asia/Colombo');
    $date = date('m/d/Y h:i:s a', time());

    if(empty($_SESSION["mail-username"])){
      $_SESSION["mail-username"] = "N/A";
    }

    if(empty($_SESSION["mail-pass"])){
      $_SESSION["mail-pass"] = "N/A";
    }

    if(empty($_SESSION["mail-name"])){
      $_SESSION["mail-name"] = "N/A";
    }

    $email_id = $_SESSION["mail-username"];
    $subject = "FYP System Credentials";
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
                        <table class="container" role="presentation" border="0" cellpadding="0" cellspacing="0"
                            style="width: 100%;">
                            <tbody>
                                <tr>
                                    <td align="center"
                                        style="line-height: 24px; font-size: 16px; margin: 0; padding: 0 16px;">
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
                                                        <table class="s-10 w-full" role="presentation" border="0"
                                                            cellpadding="0" cellspacing="0" style="width: 100%;"
                                                            width="100%">
                                                            <tbody>
                                                                <tr>
                                                                    <td style="line-height: 40px; font-size: 40px; width: 100%; height: 40px; margin: 0;"
                                                                        align="left" width="100%" height="40">
                                                                        &#160;
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <table class="ax-center" role="presentation" align="center"
                                                            border="0" cellpadding="0" cellspacing="0"
                                                            style="margin: 0 auto;">
                                                            <tbody>
                                                                <tr>
                                                                    <td style="line-height: 24px; font-size: 16px; margin: 0;"
                                                                        align="left">
                                                                        <img class="w-24"
                                                                            src="https://lh3.googleusercontent.com/u/0/drive-viewer/AKGpihZRWyArIhIsX62CJNxrlEKXC1bUWP04SNeVWKEtUyejacEaUxdoxTnEK-pZvysM-THtvFhMKrpOWDHyeKpMbCS5qq9h4FTUdc8=w2880-h1558"
                                                                            style="height: auto; line-height: 100%; outline: none; text-decoration: none; display: block; width: 196px; border-style: none; border-width: 0;"
                                                                            width="96">
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <table class="s-10 w-full" role="presentation" border="0"
                                                            cellpadding="0" cellspacing="0" style="width: 100%;"
                                                            width="100%">
                                                            <tbody>
                                                                <tr>
                                                                    <td style="line-height: 40px; font-size: 40px; width: 100%; height: 40px; margin: 0;"
                                                                        align="left" width="100%" height="40">
                                                                        &#160;
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <table class="card p-6 p-lg-10 space-y-4" role="presentation"
                                                            border="0" cellpadding="0" cellspacing="0"
                                                            style="border-radius: 6px; border-collapse: separate !important; width: 100%; overflow: hidden; border: 1px solid #e2e8f0;"
                                                            bgcolor="#ffffff">
                                                            <tbody>
                                                                <tr>
                                                                    <td style="line-height: 24px; font-size: 16px; width: 100%; margin: 0; padding: 40px;"
                                                                        align="left" bgcolor="#ffffff">
                                                                        <h1 class="h3 fw-700"
                                                                            style="padding-top: 0; padding-bottom: 0; font-weight: 700 !important; vertical-align: baseline; font-size: 28px; line-height: 33.6px; margin: 0;"
                                                                            align="left">
                                                                            Hi, '.$_SESSION['mail-name'].'. <br>
                                                                        </h1>
                                                                        <span style="color: gray;">Please find your credentials to login into FYP Management System.</span> <br>
                                                                        <table class="s-4 w-full" role="presentation"
                                                                            border="0" cellpadding="0" cellspacing="0"
                                                                            style="width: 100%;" width="100%">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td style="line-height: 16px; font-size: 16px; width: 100%; height: 16px; margin: 0;"
                                                                                        align="left" width="100%"
                                                                                        height="16">
                                                                                        &#160;
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                        <p class=""
                                                                            style="line-height: 24px; font-size: 16px; width: 100%; margin: 0;"
                                                                            align="left">
                                                                            User name : '.$_SESSION["mail-username"].' <br> 
                                                                            Password : '.$_SESSION["mail-pass"].' <br> 
                                                                            <i style="color: gray; font-size: 12px;">Reset your password at your first login</i>
                                                                        </p>
                                                                        <table class="s-4 w-full" role="presentation"
                                                                            border="0" cellpadding="0" cellspacing="0"
                                                                            style="width: 100%;" width="100%">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td style="line-height: 16px; font-size: 16px; width: 100%; height: 16px; margin: 0;"
                                                                                        align="left" width="100%"
                                                                                        height="16">
                                                                                        &#160;
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                        <table class="btn btn-primary p-3 fw-700"
                                                                            role="presentation" border="0" cellpadding="0"
                                                                            cellspacing="0"
                                                                            style="border-radius: 6px; border-collapse: separate !important; font-weight: 700 !important;">
                                                                            <tbody>
                                                                            <tr>
                                                                                <td style="line-height: 24px; font-size: 16px; border-radius: 6px; font-weight: 700 !important; margin: 0;"
                                                                                    align="center" bgcolor="#0d6efd">
                                                                                    <a href="http://webmaster.com"
                                                                                        style="color: #ffffff; font-size: 16px; font-family: Helvetica, Arial, sans-serif; text-decoration: none; border-radius: 6px; line-height: 20px; display: block; font-weight: 700 !important; white-space: nowrap; background-color: #c41b18; padding: 12px; border: 1px solid #741211;">Visit
                                                                                        WebMaster</a>
                                                                                    <!-- change this -->
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                              <td style="padding-top: 10px">
                                                                                  <i style="color: gray; ">Happy Marking!</i>
                                                                              </td>
                                                                            </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <table class="s-10 w-full" role="presentation" border="0"
                                                            cellpadding="0" cellspacing="0" style="width: 100%;"
                                                            width="100%">
                                                            <tbody>
                                                                <tr>
                                                                    <td style="line-height: 40px; font-size: 40px; width: 100%; height: 40px; margin: 0;"
                                                                        align="left" width="100%" height="40">
                                                                        &#160;
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <table class="ax-center" role="presentation" align="center"
                                                            border="0" cellpadding="0" cellspacing="0"
                                                            style="margin: 0 auto;">
                                                            <tbody>
                                                                <tr>
                                                                    <td style="line-height: 24px; font-size: 26px; margin: 0;"
                                                                        align="left">
                                                                        Web Master
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <table class="s-6 w-full" role="presentation" border="0"
                                                            cellpadding="0" cellspacing="0" style="width: 100%;"
                                                            width="100%">
                                                            <tbody>
                                                                <tr>
                                                                    <td style="line-height: 24px; font-size: 24px; width: 100%; height: 24px; margin: 0;"
                                                                        align="left" width="100%" height="24">
                                                                        &#160;
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <div class="text-muted text-center" style="color: #718096;"
                                                            align="center">
                                                            IIT School of Computing. <br>
                                                            10, Trelawney Pl, Colombo 04<br>
                                                            fp2022viva@iit.ac.lk <br>
                                                        </div>
                                                        <table class="s-6 w-full" role="presentation" border="0"
                                                            cellpadding="0" cellspacing="0" style="width: 100%;"
                                                            width="100%">
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

function generatePass($length = 8) {
  $characters = '0123456789ABCDEFGHJKMNOPQRSTUVWXYZ&@#';
  $charactersLength = strlen($characters);
  $randomString = '';
  for ($i = 0; $i < $length; $i++) {
      $randomString .= $characters[random_int(0, $charactersLength - 1)];
  }
  return $randomString;
}



?>
<body>
    <div class="container-fluid">
        <div class="row">
            <?php include("admin-nav.php") ?>
        </div>
        <div class="row">
          <div class="col-md-6 my-4 p-4">
            <h1 class="display-4 pb-3">Registration - Staff</h1>

            <form method="POST" class="row g-3">
              <div class="col-md-6">
                <label class="form-label">Email</label>
                <input name="stemail" type="email" class="form-control">
              </div>
              <div class="col-md-6">
                <label class="form-label">Password</label>
                <input name="stpass" type="password" class="form-control">
              </div>
              <div class="col-md-6">
                <label class="form-label">FT / PT</label>
                <select name="ftpt" id="inputState" class="form-select">
                  <option value="ft" selected>Full-time</option>
                  <option value="pt">Part-time</option>
                </select>
              </div>
              <div class="col-md-6">
                <label class="form-label">Staff Name</label>
                <input name="stname" type="text" class="form-control">
              </div>
              <div class="col-6">
                <label for="fullName" class="form-label">Specialised area</label>
                <input name="stspecial" type="text" class="form-control" id="fullName">
              </div>
              <div class="col-md-6">
                <label class="form-label">Contact No</label>
                <input name="stcontact" type="number" class="form-control">
              </div>
              
              <div class="col-md-6">
                <label class="form-label">Role</label>
                <select name="strole" id="inputState" class="form-select">
                  <option selected value="staff">Staff</option>
                  <option value="admin">Admin</option>
                </select>
              </div>
             
              <div class="col-12">
                <button name="btnsub" type="submit" class="btn btn-success">Register</button>
                <button type="reset" class="btn btn-warning">Clear</button>
                <a class="btn btn-secondary" href="admin-staff-manage.php">View</a>
              </div>
            </form>
            </div>

          <div class="col-md-6 my-4 p-4">
            <h1 class="display-3 pb-3">Bulk upload</h1>
              <form method="post" enctype="multipart/form-data">
                <div class="mb-3">
                  <label for="formFile" class="form-label">Upload from CSV File <a href="Images/staff_list.csv" download>Download the template</a>[delete sample record]</label>
                  <input class="form-control" type="file" name="file" id="formFile">
                </div>
                <div class="col-12">
                  <button type="submit" name="staff_upload" class="btn btn-success">Upload</button>
                  <button type="reset" class="btn btn-warning">Clear</button>
                  <a href="mail-export-csv.php" class="btn btn-secondary">Download CSV</a>
                  <span><?php if(isset($_SESSION['status_staff_csv_load'])){echo $_SESSION['status_staff_csv_load'];} unset($_SESSION['status_staff_csv_load']);?></span>
                </div>
              </form>
          </div>
          
      </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous">
  </script>
</body>
</html>