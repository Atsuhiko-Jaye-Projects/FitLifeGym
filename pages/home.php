<?php include '../layout/header.php'; ?>
<?php include '../layout/sidebar.php'; ?>

<div class="col-md-9 col-lg-10 p-4">

    <div class="hero mb-4 text-white">
        <h1>Welcome Back!</h1>
        <p>Your personal fitness hub — track, train & transform.</p>
    </div>

    <div class="row g-3">

        <div class="col-md-6">
            <a href="dashboard.php" class="nav-card d-block">
                <h5>📊 Dashboard</h5>
                <small>View your fitness stats</small>
            </a>
        </div>

        <div class="col-md-6">
            <a href="workout_plans.php" class="nav-card d-block">
                <h5>💪 Workout Plans</h5>
                <small>Choose your plan</small>
            </a>
        </div>

        <div class="col-md-6">
            <a href="progress_tracker.php" class="nav-card d-block">
                <h5>📈 Progress</h5>
                <small>Track BMI & history</small>
            </a>
        </div>

        <div class="col-md-6    ">
            <a href="settings.php" class="nav-card d-block">
                <h5>👤 Profile</h5>
                <small>Manage your account</small>
            </a>
        </div>

    </div>

</div>

<?php include '../layout/footer.php'; ?>