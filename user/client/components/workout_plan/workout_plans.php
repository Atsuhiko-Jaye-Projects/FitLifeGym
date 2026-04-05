<?php 
include_once '../../../../config/core.php'; 

// Require login BEFORE output
$require_login = true;
include_once "../../../../login_checker.php";

// Page setup
$page_title = "workout plans";

// Load header AFTER login check
include_once '../../layout/header.php'; 
?>

<div class="col-md-9 col-lg-10 p-4">

    <div class="hero mb-4 text-white">
        <h1>Welcome Back!</h1>
        <p>Your personal fitness hub — track, train & transform.</p>
    </div>

    <div class="row g-3">

        <div class="col-md-6">
            <a href="#" class="nav-card d-block p-3" data-bs-toggle="modal" data-bs-target="#beginnerModal">
                <h5><i class="bi bi-bar-chart-line me-2"></i> Beginner Plan</h5>
                <small>Start your fitness journey with guided workouts.</small>
            </a>
        </div>

        <div class="col-md-6">
            <a href="#" class="nav-card d-block p-3" data-bs-toggle="modal" data-bs-target="#intermidiateModal">
                <h5><i class="bi bi-lightning-charge me-2"></i> Intermediate Plans</h5>
                <small>Boost strength and endurance with structured workout programs.</small>
            </a>
        </div>

        <div class="col-md-6">
            <a href="#" class="nav-card d-block p-3" data-bs-toggle="modal" data-bs-target="#advanceModal">
                <h5><i class="bi bi-graph-up-arrow me-2"></i> Advanced Plans</h5>
                <small>Push your limits with high-intensity and performance tracking.</small>
            </a>
        </div>

        <div class="col-md-6">
            <a href="#" class="nav-card d-block p-3" data-bs-toggle="modal" data-bs-target="#customModal">
                <h5><i class="bi bi-sliders me-2"></i> Custom Plans</h5>
                <small>Create and personalize workouts tailored to your goals.</small>
            </a>
        </div>

    </div>


</div>

<?php 
include_once "workout_plans_modal/beginner_plan_modal.php"; 
include_once "workout_plans_modal/advance_plan_modal.php"; 
include_once "workout_plans_modal/custom_plan_modal.php"; 
include_once "workout_plans_modal/intermidiate_plan_modal.php"; 
?>

<?php include '../../../../layout/footer.php'; ?>