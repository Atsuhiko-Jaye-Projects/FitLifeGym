<?php $page_title = "Learn More"; ?>
<?php include 'layout/header.php'; ?>

<style>
body {
    background-color: #0f172a;
    color: #e2e8f0;
}

/* HERO */
.learn-hero {
    background: linear-gradient(135deg, #1e293b, #0f172a);
    padding: 90px 0;
    text-align: center;
}

.learn-hero h1 {
    font-size: 2.8rem;
}

.learn-hero p {
    color: #94a3b8;
}

/* SECTIONS */
.section-box {
    background: #1e293b;
    border-radius: 15px;
    padding: 40px;
    margin-bottom: 25px;
}

/* ICON BOX */
.icon-box {
    font-size: 2.5rem;
    color: #22c55e;
    margin-bottom: 15px;
}

/* LIST */
ul li {
    margin-bottom: 8px;
    color: #cbd5e1;
}

/* CTA */
.cta {
    background: linear-gradient(135deg, #22c55e, #15803d);
    border-radius: 15px;
    padding: 40px;
    text-align: center;
    margin-top: 40px;
}
</style>

<!-- HERO -->
<section class="learn-hero">
    <div class="container">
        <h1 class="fw-bold">
            <i class="bi bi-info-circle text-success"></i> Learn More About FitLife
        </h1>
        <p class="mt-3">
            Understand how FitLife helps you track your health, improve fitness, and reach your goals.
        </p>
    </div>
</section>

<!-- ABOUT -->
<section class="py-5">
    <div class="container">

        <div class="section-box">
            <div class="icon-box text-center">
                <i class="bi bi-heart-pulse"></i>
            </div>

            <h3 class="text-center mb-3">About FitLife</h3>

            <p class="text-center text-light">
                FitLife Gym is a wellness tracking system designed to help users manage their health,
                monitor BMI, and follow structured workout plans efficiently.
            </p>
        </div>

        <!-- FEATURES -->
        <div class="section-box">
            <h4 class="mb-4 text-center">What FitLife Offers</h4>

            <ul>
                <li><i class="bi bi-check-circle text-success me-2"></i> BMI calculation and health status tracking</li>
                <li><i class="bi bi-check-circle text-success me-2"></i> Personalized workout plans</li>
                <li><i class="bi bi-check-circle text-success me-2"></i> Progress monitoring over time</li>
                <li><i class="bi bi-check-circle text-success me-2"></i> Simple and user-friendly dashboard</li>
                <li><i class="bi bi-check-circle text-success me-2"></i> Goal-based fitness tracking system</li>
            </ul>
        </div>

        <!-- WHY IT EXISTS -->
        <div class="section-box">
            <h4 class="text-center mb-3">Why FitLife Exists</h4>

            <p class="text-center text-light">
                Many people struggle to track their fitness progress consistently.
                FitLife was created to simplify health monitoring by combining BMI tracking,
                workout planning, and progress visualization into one easy system.
            </p>
        </div>

        <!-- BENEFITS -->
        <div class="section-box">
            <h4 class="text-center mb-3">Benefits</h4>

            <ul>
                <li><i class="bi bi-lightning-charge text-warning me-2"></i> Stay motivated with visible progress</li>
                <li><i class="bi bi-graph-up text-success me-2"></i> Track improvements over time</li>
                <li><i class="bi bi-shield-check text-info me-2"></i> Build healthier lifestyle habits</li>
                <li><i class="bi bi-calendar-check text-primary me-2"></i> Follow structured fitness routines</li>
            </ul>
        </div>

        <!-- CTA -->
        <div class="cta text-white">
            <h3 class="fw-bold">Ready to Start?</h3>
            <p class="mb-3">Join FitLife and take control of your fitness journey today.</p>

            <a href="signin.php" class="btn btn-light px-4">
                <i class="bi bi-arrow-right-circle me-2"></i> Get Started
            </a>
        </div>

    </div>
</section>

<?php include 'layout/footer.php'; ?>