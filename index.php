<!DOCTYPE html>
<html lang="en">

<?php include("head.php"); ?>

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
                    <li class="nav-item">
                    <a class="nav-link" href="admin-login.php">Admin</a>
                    </li>
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
                            <form action="student.php">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                                    <input type="email" class="form-control" id="exampleInputEmail1"
                                        aria-describedby="emailHelp">
                                    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="exampleInputPassword1">
                                </div>
                                <div class="mb-3 form-check">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
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
                    Main heading
                </h1>
                <p class="text-light mt-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto mollitia
                    vitae rem, commodi neque excepturi enim id dolores soluta! Voluptates magni qui, corporis sed esse
                    vitae at possimus non provident dolore quia modi deleniti! Numquam sapiente cupiditate asperiores
                    odio doloribus assumenda consectetur error, reiciendis necessitatibus molestias iusto. Consequatur
                    aspernatur possimus laudantium nobis cum voluptates cupiditate soluta porro ipsum quidem modi,
                    necessitatibus vero dolores explicabo saepe expedita harum. Omnis illum aliquid expedita est. Culpa
                    accusantium quidem, eum nostrum optio odit doloribus expedita sit illo, ducimus alias consequuntur
                    doloremque sint? Sed velit voluptatum, similique odio nisi minima ratione praesentium dignissimos
                    ad, vitae cumque deleniti et possimus. Reiciendis, molestias sint! Veniam quam eum fugit eius ipsa!
                    Ullam labore fugit quidem. Vitae, deleniti maiores! Beatae consequatur ullam possimus earum delectus
                    sint, repudiandae dolorem. Inventore officiis excepturi iure! Inventore minima, hic, amet in saepe
                    aperiam officia distinctio sunt, voluptatum placeat consequuntur repellendus optio necessitatibus
                    veritatis!</p>
            </div>
    </div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>