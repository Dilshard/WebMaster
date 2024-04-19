<!DOCTYPE html>
<html lang="en">
<?php 
include("con.php"); 
include("head.php");

session_start();

    if(isset($_POST["btnsubmit"])){
        $email = $_POST['email'];
        $pass = $_POST['pass'];
        
        $sql = "SELECT * FROM Staff WHERE staffemail = '$email' and password = '$pass'";

        $result = mysqli_query($conn,$sql);
        $count = mysqli_num_rows($result);

        if($count == 1){
            while($row = mysqli_fetch_assoc($result)){
                $role = $row['role'];
                $pass_attempt = $row['pass_attempt'];
            }
            $_SESSION['email'] = $email;
            $_SESSION['role'] = $role;

            if($pass_attempt == 0){
                header("Location: staff_reset_password.php", true, 301);
                exit();
            }elseif($role == "admin"){
                $_SESSION['key'] = generateRandomString();
                $_SESSION['security'] = $_SESSION['key'];
                header("Location: admin.php", true, 301);
                exit();
            }elseif($role == "staff"){
                header("Location: staff.php", true, 301);
                exit();
            }
        }
        else{
            $_SESSION['error_login'] = "Error: Please check your credentials";
        }
    }

    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
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
    <div class="row viewPortHeight">
        <div class="col-md-6  mt-4">
            <div class="card text-center">
                <div class="card-header">
                    <ul class="nav nav-tabs card-header-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="true" href="index.php">Staff</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="student-login.php">Student</a>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="admin-login.php">Admin</a>
                    </li> -->
                    </ul>
                </div>
            <div class="card-body">
                <!-- start -->
                <div class="row">
                    <div class="col-md-12">
                        <img src="Images/logo.png" class="logo card-img-top" alt="Logo">
                    </div>
                </div>
                <div class="row">
                <div class="left-login col-md-12 d-flex justify-content-center" style="text-align-last: left;">
                        <div class="col-md-8">
                            <form method="POST" onsubmit="submitForm()">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                                    <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                    
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Password</label>
                                    <input name="pass" type="password" class="form-control" id="exampleInputPassword1">
                                </div>
                                <!-- <div class="mb-3 form-check">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                                </div> -->
                                <button name="btnsubmit" type="submit" class="btn btn-primary">Submit</button>
                                <span><?php if(isset($_SESSION['error_login'])){echo $_SESSION['error_login'];}?></span>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- end -->
            </div>
        </div>
        

        </div>
        <div class="col-md-6 bg-danger p-5 text-center">
                <h1 class="display-3 text-light">
                    IIT School of Computing
                </h1>
                <p class="text-light mt-4">Welcome to the IIT School of Computing, an intellectual centre for ambitious minds interested in the Computing field — where you can learn, grow and reach your full potential!
                    IIT is more than just a school that provides a variety of computing programmes. We are committed to creating outstanding computing professionals for the future of the industry who can make an impact. We are widely regarded as one of the leading educational institutes in Sri Lanka, and our highly sought-after alumni are proof of our success. So I invite you to join us and shape a better future for the world through technology and computing.
                    Our focus on academic excellence and countless opportunities for extra-curricular activities and skills development has resulted in many of our graduates achieving success in their careers. Our alumni of over 5000 graduates has amazed and inspired us with their achievements at IIT and beyond.
                </p>
                <p class="text-light">
                    What makes us different is how we prepare you for your future career. The IIT student experience goes beyond the classroom. Our strong links with industry and the training and development that forms part of our courses, will equip you with the knowledge, skills and confidence required for successful and rewarding careers.
                    We offer you an exciting and vibrant university life through internships, mentoring programmes, extra-curricular activities, such as sports, clubs & societies, local / global competitions and so much more. We groom the independent minds of tomorrow. With IIT you will discover your own path to future success
                </p>
            </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>




</body>

</html>