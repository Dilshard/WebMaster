
<div class="col-md-12 nav-space">
    <nav class="navbar navbar-expand-lg " style="background-color: #123459;" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="staff.php">WebMaster</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="staff-schedules.php">Schedules</a>
                </li>
                <!-- <li class="nav-item">
                    <a class="nav-link" href="#">Students supervising</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Meeting</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Requests</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Profile</a>
                </li> -->
                
            </ul>
            <span class="navbar-text px-2">
                <a class="nav-link" href="#"><?php if(isset($_SESSION['email'])){echo $_SESSION['email'];}?></a>
            </span>
            <span class="navbar-text">
                <a class="btn btn-danger" href="logout.php">Sign out</a>
            </span>
            </div>
        </div>
    </nav>
</div>