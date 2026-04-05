<?php $page_title = "index"; ?>
<?php include 'layout/header.php'; ?>

<!-- HERO -->
<section class="hero-section text-center">
    <div class="container">
        <h1 class="fw-bold">
            <i class="bi bi-heart-pulse"></i> FitLife Gym
        </h1>
        <p class="mt-3">
            Track your fitness, monitor BMI, and achieve your goals.
        </p>

        <a href="signin.php" class="btn btn-light me-2 mt-3">
            <i class="bi bi-speedometer2"></i> Get Started
        </a>

    </div>
</section>

<!-- FEATURES -->
<section class="py-5">
    <div class="container text-center">
        <h3 class="mb-5">Features</h3>

        <div class="row g-4">

            <div class="col-md-4">
                <div class="feature-box">
                    <i class="bi bi-heart-pulse fs-1 text-danger"></i>
                    <h5 class="mt-3">BMI Tracking</h5>
                    <p class="text-muted">Monitor your health status easily.</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="feature-box">
                    <i class="bi bi-fire fs-1 text-warning"></i>
                    <h5 class="mt-3">Workout Plans</h5>
                    <p class="text-muted">Structured plans for all levels.</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="feature-box">
                    <i class="bi bi-graph-up-arrow fs-1 text-success"></i>
                    <h5 class="mt-3">Progress Tracking</h5>
                    <p class="text-muted">Track your improvements over time.</p>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- ABOUT -->
<section class="py-5 bg-light">
    <div class="container about-section">
        <div class="row align-items-center">

            <div class="col-md-6">
                <h3>About FitLife</h3>
                <p class="text-muted">
                    FitLife Gym is a wellness tracking system designed to help users manage their health,
                    monitor BMI, and follow structured workout plans efficiently.
                </p>
            </div>

            <div class="col-md-6 text-center">
                <i class="bi bi-activity fs-1 text-primary"></i>
            </div>

        </div>
    </div>
</section>

<!-- TEAM -->
<section class="py-5">
    <div class="container text-center">
        <h3 class="mb-5">Our Team</h3>

        <div class="row g-4">

            <div class="col-md-3">
                <div class="card team-card p-3">
                    <i class="bi bi-person-circle fs-1 text-primary"></i>
                    <h6 class="mt-2">Alex</h6>
                    <small class="text-muted">Developer</small>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card team-card p-3">
                    <i class="bi bi-person-circle fs-1 text-success"></i>
                    <h6 class="mt-2">John</h6>
                    <small class="text-muted">UI Designer</small>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card team-card p-3">
                    <i class="bi bi-person-circle fs-1 text-warning"></i>
                    <h6 class="mt-2">Maria</h6>
                    <small class="text-muted">Researcher</small>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card team-card p-3">
                    <i class="bi bi-person-circle fs-1 text-danger"></i>
                    <h6 class="mt-2">Chris</h6>
                    <small class="text-muted">Tester</small>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- CTA -->
<section class="cta-section text-white pt-5 pb-4">
    <div class="container">

        <!-- TOP CTA -->
        <div class="text-center mb-5">
            <h2 class="fw-bold">Start Your Fitness Journey Today</h2>
            <p class="text-light">Track your progress, stay motivated, and achieve your goals.</p>

            <a href="pages/home.php" class="btn btn-light mt-2 px-4">
                <i class="bi bi-arrow-right-circle me-2"></i> Get Started
            </a>
        </div>

        <!-- FOOTER CONTENT -->
        <div class="row text-start">

            <!-- ABOUT -->
            <div class="col-md-4 mb-3">
                <h5><i class="bi bi-heart-pulse me-2"></i>FitLife</h5>
                <p class="small text-light">
                    A personal wellness tracker designed to help you monitor your BMI,
                    track workouts, and improve your overall health.
                </p>
            </div>

            <!-- QUICK LINKS -->
            <div class="col-md-4 mb-3">
                <h6>Quick Links</h6>
                <ul class="list-unstyled small">
                    <li><a href="#" class="text-light text-decoration-none">Dashboard</a></li>
                    <li><a href="#" class="text-light text-decoration-none">Workout Plans</a></li>
                    <li><a href="#" class="text-light text-decoration-none">Progress</a></li>
                    <li><a href="#" class="text-light text-decoration-none">Profile</a></li>
                </ul>
            </div>

            <!-- CONTACT / SOCIAL -->
            <div class="col-md-4 mb-3">
                <h6>Connect</h6>
                <div class="d-flex gap-3 fs-5">
                    <a href="#" class="text-light"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="text-light"><i class="bi bi-twitter"></i></a>
                    <a href="#" class="text-light"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="text-light"><i class="bi bi-envelope"></i></a>
                </div>
            </div>

        </div>

        <!-- BOTTOM -->
        <hr class="border-light">

        <div class="text-center small">
            © <?php echo date("Y"); ?> FitLife Gym. All rights reserved.
        </div>

    </div>
</section>

<?php include 'layout/footer.php'; ?>