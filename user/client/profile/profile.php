<?php 
include_once '../../../config/core.php'; 
include_once '../../../config/database.php'; 
include_once '../../../objects/bmi_record.php';
include_once '../../../objects/user.php'; 
include_once '../../../objects/workout_plan.php'; 
include_once '../../../objects/exercise_activity.php'; 

$database = new Database();
$db = $database->getConnection();

$BMI_record = new BMIRecord($db);
$user = new User($db);
$workout_plan = new WorkoutPlan($db);
$exercise_activity = new ExerciseActivity($db);


if (isset($_SESSION['user_id'])) {

    $BMI_record->client_id = $_SESSION['user_id'];
    $BMI_record->checkBmiRecord();

    if ($BMI_record->status == "No Plan") {
        // show the current bmi record
        $show_plan_button = true;
        $category = $BMI_record->bmi_classification;
        $BMI_value = $BMI_record->bmi;
    }else{
        $show_plan_button = false;
        $category = $BMI_record->bmi_classification;
        $BMI_value = $BMI_record->bmi;
    }
}


$require_login = true;
include_once "../../../login_checker.php";

$page_title = "index";
include '../layout/header.php';
?>

<div class="col-md-9 col-lg-10 p-4">

    <!-- HERO (keep as is or light/dark, your choice) -->
    <div class="bg-dark text-white p-4 rounded mb-4">
        <h2>Welcome Back <?php echo $_SESSION['firstname']; ?>!</h2>
        <p class="mb-0">Your personal fitness hub — track, train & transform.</p>
    </div>

    <div class="row g-4">

        <!-- LEFT: BMI SUMMARY -->
        <div class="col-md-6">
            <div class="card bg-dark text-white shadow h-100 border-0">
                <div class="card-body">
                    <h5 class="card-title">Your BMI</h5>

                    <h1 class="display-4 fw-bold">
                        <?php echo $BMI_value ?? '—'; ?>
                    </h1>

                    <p class="text-light">
                        Category: <strong><?php echo $category ?? 'No data'; ?></strong>
                    </p>

                    <?php if ($show_plan_button): ?>
                        <a href="create_plan.php" class="btn btn-primary mt-2">
                            Get Workout Plan
                        </a>
                    <?php else: ?>
                        <span class="badge bg-success mt-2">
                            Workout Plan Active
                        </span>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- RIGHT -->
        <div class="col-md-6">

            <!-- WORKOUT PLAN -->
            <div class="card bg-dark text-white shadow mb-4 border-0">
                <div class="card-body">
                    <h5 class="card-title">Workout Plan</h5>

                    <?php if (!$show_plan_button): ?>
                        <p class="mb-1"><strong>Plan:</strong> Active Plan</p>
                        <p class="mb-2"><strong>Status:</strong> In Progress</p>

                        <a href="view_plan.php" class="btn btn-outline-light btn-sm">
                            View Plan
                        </a>
                    <?php else: ?>
                        <p>No workout plan yet.</p>
                        <a href="create_plan.php" class="btn btn-primary btn-sm">
                            Create Plan
                        </a>
                    <?php endif; ?>
                </div>
            </div>

            <!-- ACTIVITY -->
            <div class="card bg-dark text-white shadow border-0">
                <div class="card-body">
                    <h5 class="card-title">Recent Activity</h5>

                    <ul class="list-unstyled mb-2">
                        <li>🏋️ Chest Workout - Yesterday</li>
                        <li>🏃 Cardio - 2 days ago</li>
                        <li>💪 Leg Day - 4 days ago</li>
                    </ul>

                    <a href="activity.php" class="btn btn-outline-light btn-sm">
                        View All Activity
                    </a>
                </div>
            </div>

        </div>

    </div>
</div>