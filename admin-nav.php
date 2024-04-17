<div class="col-md-12 nav-space">
    <nav class="navbar navbar-expand-lg bg-body-tertiary" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="admin.php">WebMaster</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="admin.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="admin-student.php">Student</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="admin-staff.php">Staff</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="admin-schedule-marking.php">Schedule Marking</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logs.php">Logs</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="staff-schedules.php">| Schedule</a>
                </li>
                <!-- <li class="nav-item">
                    <a class="nav-link" href="admin-student_complain">Student complains</a>
                </li> -->
            </ul>
            <span class="navbar-text px-2">
                <a class="nav-link" href="staff_reset_password.php">Reset password :  <?php if(isset($_SESSION['email'])){echo $_SESSION['email'];}?></a>
            </span>
            <span class="navbar-text">
                <a class="btn btn-danger" href="logout.php">Sign out</a>
            </span>
            </div>
        </div>
    </nav>
</div>