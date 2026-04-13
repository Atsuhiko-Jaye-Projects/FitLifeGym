<div class="col-md-3 col-lg-2 sidebar p-3">

    <h4 class="mb-4 fw-bold text-white">
        <i class="bi bi-heart-pulse-fill me-2 text-danger"></i> FitLife
    </h4>


    <nav class="nav flex-column">
        <a href="<?php echo $base_url; ?>user/client/index.php" class="nav-link">
            <i class="bi bi-house-door me-2"></i> Home
        </a>


<?php
    if ($_SESSION['first_time_logged_in'] != 1) {
        echo "<a href='{$base_url}user/client/dashboard/dashboard.php' class='nav-link'>
            <i class='bi bi-speedometer2 me-2'></i> Dashboard
        </a>

        <a href='../pages/progress_tracker.php' class='nav-link'>
            <i class='bi bi-graph-up-arrow me-2'></i> Progress
        </a>";
    }else{
        // show the other side options
    }
?>
        <a href="../pages/settings.php" class="nav-link">
            <i class="bi bi-person-circle me-2"></i> Profile
        </a>
        <a href="<?php echo $base_url; ?>logout.php" class="nav-link">
            <i class="bi bi-box-arrow-left"></i> Logout
        </a>
    </nav>
</div>