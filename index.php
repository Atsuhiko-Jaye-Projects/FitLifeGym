<?php $page_title = "index"; ?>
<?php include 'layout/header.php'; ?>

<style>
/* GLOBAL DARK MODE */
body {
    background-color: #0f172a;
    color: #e2e8f0;
}

/* HERO */
.hero-section {
    background: linear-gradient(135deg, #1e293b, #0f172a);
    padding: 100px 0;
}

.hero-section h1 {
    font-size: 3rem;
}

.hero-section p {
    color: #94a3b8;
}

/* BUTTON */
.btn-light {
    background: #22c55e;
    color: #fff;
    border: none;
}
.btn-light:hover {
    background: #16a34a;
}

/* FEATURES */
.feature-box {
    background: rgba(255, 255, 255, 0.05);
    border-radius: 15px;
    padding: 25px;
    transition: 0.3s;
    backdrop-filter: blur(10px);
}
.feature-box:hover {
    transform: translateY(-8px);
    background: rgba(255, 255, 255, 0.08);
}

/* ABOUT */
.about-section {
    background: #1e293b;
    border-radius: 15px;
    padding: 40px;
}

/* TEAM */
.team-card {
    background: #1e293b;
    border: none;
    border-radius: 18px;
    padding: 30px 20px;
    transition: all 0.35s ease;
    text-align: center;
}

/* CENTER IMAGE PERFECTLY */
.team-img {
    width: 120px;
    height: 120px;
    object-fit: cover;
    border-radius: 50%;
    border: 3px solid #22c55e;
    display: block;
    margin: 0 auto 15px auto;
    transition: 0.3s;
}

/* TEXT COLORS */
.team-card h6 {
    font-size: 1.2rem;
    margin-top: 10px;
    color: #ffffff;
}

.team-card small {
    color: #cbd5e1;
}

/* HOVER EFFECT */
.team-card:hover {
    transform: translateY(-10px) scale(1.05);
    box-shadow: 0 15px 35px rgba(0,0,0,0.4);
}

.team-card:hover .team-img {
    transform: scale(1.08);
}

/* CTA */
.cta-section {
    background: linear-gradient(135deg, #22c55e, #15803d);
}

/* LINKS */
a {
    transition: 0.2s;
}
a:hover {
    opacity: 0.8;
}
</style>

<!-- HERO -->
<section class="hero-section text-center">
    <div class="container">
        <h1 class="fw-bold">
            <i class="bi bi-heart-pulse text-success"></i> FitLife Gym
        </h1>
        <p class="mt-3">
            Track your fitness, monitor BMI, and achieve your goals with precision.
        </p>

        <div class="mt-4">
            <a href="signin.php" class="btn btn-light px-4 me-2">
                <i class="bi bi-speedometer2"></i> Get Started
            </a>

            <a href="learn_more.php" class="btn btn-outline-light px-4">
                Learn More
            </a>
        </div>
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
<section class="py-5">
    <div class="container about-section">
        <div class="row align-items-center">

            <div class="col-md-6">
                <h3>About FitLife</h3>
                <p>
                    FitLife Gym is a wellness tracking system designed to help users manage their health,
                    monitor BMI, and follow structured workout plans efficiently.
                </p>
            </div>

            <div class="col-md-6 text-center">
                <i class="bi bi-activity fs-1 text-success"></i>
            </div>

        </div>
    </div>
</section>

<!-- TEAM -->
<section class="py-5">
    <div class="container text-center">
        <h3 class="mb-5">Our Team</h3>

        <div class="row g-4 justify-content-center">

            <div class="col-md-3">
                <div class="card team-card">
                    <img src="assets/images/ken.jpg" class="team-img">
                    <h6>John Kenneth</h6>
                    <small>Developer/QA Tester</small>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card team-card">
                    <img src="assets/images/mads.jpg" class="team-img">
                    <h6>Madysroll</h6>
                    <small>UI Designer/Researcher</small>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card team-card">
                    <img src="assets/images/ben.jpg" class="team-img">
                    <h6>Benedict</h6>
                    <small>UI Designer/Researcher</small>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card team-card">
                    <img src="assets/images/dana.jpg" class="team-img">
                    <h6>Dana</h6>
                    <small>Researcher/Project Manager</small>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card team-card">
                    <img src="assets/images/Alexis.jpg" class="team-img">
                    <h6>Alexis Jaye</h6>
                    <small>Developer/QA Tester</small>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="cta-section text-white pt-5 pb-4">
    <div class="container">

        <div class="text-center mb-5">
            <h2 class="fw-bold">Start Your Fitness Journey Today</h2>
            <p>Track your progress, stay motivated, and achieve your goals.</p>

            <a href="signup.php" class="btn btn-light mt-2 px-4">
                <i class="bi bi-arrow-right-circle me-2"></i> Get Started
            </a>
        </div>

        <div class="row text-start">

            <div class="col-md-4 mb-3">
                <h5><i class="bi bi-heart-pulse me-2"></i>FitLife</h5>
                <p class="small text-light">
                    A personal wellness tracker designed to help you monitor your BMI,
                    track workouts, and improve your overall health.
                </p>
            </div>

            <div class="col-md-4 mb-3">
                <h6>Quick Links</h6>
                <ul class="list-unstyled small">
                    <li><a href="#" class="text-light text-decoration-none">Dashboard</a></li>
                    <li><a href="#" class="text-light text-decoration-none">Workout Plans</a></li>
                    <li><a href="#" class="text-light text-decoration-none">Progress</a></li>
                    <li><a href="#" class="text-light text-decoration-none">Profile</a></li>
                </ul>
            </div>

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

        <hr class="border-light">

        <div class="text-center small">
            © <?php echo date("Y"); ?> FitLife Gym. All rights reserved.
        </div>

    </div>
</section>

<?php include 'layout/footer.php'; ?>