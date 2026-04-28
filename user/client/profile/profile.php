<?php 
include_once '../../../config/core.php'; 
include_once '../../../config/database.php'; 
include_once '../../../objects/bmi_record.php';
include_once '../../../objects/user.php'; 
include_once '../../../objects/workout_plan.php'; 
include_once '../../../objects/exercise_activity.php'; 
include_once '../../../objects/exercise_log.php'; 
include_once '../../../objects/bmi_record_history.php'; 

$database = new Database();
$db = $database->getConnection();

$BMI_record = new BMIRecord($db);
$user = new User($db);
$workout_plan = new WorkoutPlan($db);
$exercise_activity = new ExerciseActivity($db);
$exercise_log = new ExerciseLog($db);
$BMIRecordHistory = new BMIRecordHistory($db);

if (isset($_SESSION['user_id'])) {

    $BMI_record->client_id = $_SESSION['user_id'];

    $show_plan_button = null;

    if ($BMI_record->checkBmiRecord()) {

        if ($BMI_record->status == "No Plan") {
            $category = $BMI_record->bmi_classification;
            $BMI_value = $BMI_record->bmi;
        } else {
            $show_plan_button = false;
            $category = $BMI_record->bmi_classification;
            $BMI_value = $BMI_record->bmi;
        }
    }
}

// get current workout plan and display it.
$workout_plan->client_id = $_SESSION['user_id'];
$workout_plan->getActiveWorkoutPlan();

$exercise_log->workplan_id = $workout_plan->workout_plan_id;

$exercise_log_stmt = $exercise_log->getBestRecordCurrentPlan();
$exercise_log_num = $exercise_log_stmt->rowCount();

$workout_plan->client_id = $_SESSION['user_id'];
$hasPlan = $workout_plan->getActiveWorkoutPlan();

$user->id = $_SESSION['user_id'];
$user->getProfileDetails();

// get user_Bmi History
$BMIRecordHistory->client_id = $_SESSION['user_id'];

$BRH_stmt = $BMIRecordHistory->getBmiHistory();
$BRH_num = $BRH_stmt->rowCount();


echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';

if ($_POST) {

    if ($_POST['action'] == "record_bmi") {

        $BMIRecordHistory->client_id = $_POST['user_id'];
        $BMIRecordHistory->height = $_POST['height'];
        $BMIRecordHistory->weight = $_POST['weight'];
        $BMIRecordHistory->bmi = $_POST['bmi'];
        $BMIRecordHistory->bmi_classification = $_POST['bmi_classification'];

        if ($BMIRecordHistory->CreateBMIHistory()) {

            $BMI_record->client_id = $_SESSION['user_id'];
            $BMI_record->height = $_POST['height'];
            $BMI_record->weight = $_POST['weight'];
            $BMI_record->BMI = $_POST['bmi'];
            $BMI_record->bmi_classification = $_POST['bmi_classification'];
            
            $BMI_record->UpdateBmiRecord();
            echo '<script>
                setTimeout(() => {
                    Swal.fire({
                        icon: "success",
                        title: "BMI Updated Successfully!",
                        text: "Your latest BMI record has been updated and saved.",
                        confirmButtonText: "OK"
                    });
                }, 500);
            </script>';

        } else {

            echo '<script>
                setTimeout(() => {
                    Swal.fire({
                        icon: "error",
                        title: "Sorry Something Went Wrong",
                        text: "Your BMI record could not be updated at this time.",
                        confirmButtonText: "OK"
                    });
                }, 500);
            </script>';

        }
    }
}

$require_login = true;
include_once "../../../login_checker.php";

$page_title = "index";
include '../layout/header.php';
?>

<div class="col-md-9 col-lg-10 p-4">

    <!-- HERO -->
    <div class="bg-dark text-white p-4 rounded mb-4 d-flex align-items-center justify-content-between">

        <div class="d-flex align-items-center">

            <div class="me-3">
                <?php 
                    $raw_image = $user->profile_image;
                    $image_path = (!empty($raw_image))
                        ? "{$base_url}user/client/uploads/{$_SESSION['user_id']}/{$raw_image}"
                        : "../../../assets/images/logo.png";
                ?>
                <img src="<?php echo $image_path; ?>" 
                    class="rounded-circle"
                    style="width: 80px; height: 80px; object-fit: cover;">
            </div>

            <div>
                <h2 class="mb-1">Welcome Back <?php echo $user->firstname; ?>!</h2>
                <p class="mb-0">Your personal fitness hub — track, train & transform.</p>
            </div>

        </div>

        <div>
            <button type="button" class="btn btn-outline-light" data-bs-toggle="modal" data-bs-target="#editProfileModal">
                <span class="bi bi-pencil"></span>
            </button>
        </div>

    </div>

    <div class="row g-4">

        <!-- LEFT BMI -->
        <div class="col-md-6">
            <div class="card shadow h-100 border-0" style="background: linear-gradient(135deg, #1e1e2f, #2f2f4a);">
                <div class="card-body text-white">

                    <h6 class="text-uppercase text-secondary mb-2">Health Metric</h6>

                    <h5 class="d-flex align-items-center mb-3">
                        <i class="bi bi-heart-pulse-fill me-2 text-danger fs-5"></i>
                        Your BMI
                    </h5>
                    <?php
                    if (!$hasPlan) {
                            echo '
                                <!-- SMALL EDIT BMI BUTTON -->
                                <button class="btn btn-sm btn-outline-light ms-auto"
                                    data-bs-toggle="modal"
                                    data-bs-target="#bmiModal"
                                    title="Edit BMI">
                                    <i class="bi bi-pencil"></i>
                                </button>
                            ';
                        }
                    ?>
                    <h1 class="display-3 fw-bold mb-2">
                        <?php echo $BMI_value ?? '—'; ?>
                    </h1>

                    <div class="d-flex align-items-center gap-2 mb-3">

                        <!-- Category -->
                        <span class="badge bg-primary px-2 py-2">
                            <i class="bi bi-activity me-1"></i> Category
                        </span>

                        <!-- BMI Status -->
                        <span class="badge bg-success px-3 py-2">
                            <i class="bi bi-check-circle me-1"></i>
                            <?php echo $category ?? 'No data'; ?>
                        </span>

                        <!-- Push button to far right -->
                        <div class="ms-auto">
                            <button type="button" class="btn btn-sm btn-outline-secondary"
                                data-bs-toggle="modal" data-bs-target="#bmiHistoryModal">
                                <i class="bi bi-clock-history me-1"></i>
                                History
                            </button>
                        </div>

                    </div>

                    <hr class="border-secondary">

                    <!-- PLAN / EDIT SECTION -->
                    <?php if ($show_plan_button): ?>

                        <a href="create_plan.php" class="btn btn-primary w-100 mt-2">
                            <i class="bi bi-plus-circle me-1"></i>
                            Get Workout Plan
                        </a>

                    <?php else: ?>

                        <div class="mt-3">
                            <small class="text-secondary d-block mb-2">
                                <i class="bi bi-lightning-charge me-1"></i>
                                Your Plan
                            </small>

                            <div class="d-flex flex-wrap gap-2 align-items-center">

                                <span class="badge bg-success px-3 py-2">
                                    <i class="bi bi-fire me-1"></i>
                                    <?php echo $workout_plan->workout_plan; ?>
                                </span>

                                <span class="badge bg-info px-3 py-2">
                                    <i class="bi bi-person-badge me-1"></i>
                                    <?php echo $workout_plan->level; ?>
                                </span>

                                <span class="badge bg-warning text-dark px-3 py-2">
                                    <i class="bi bi-hourglass-split me-1"></i>
                                    <?php echo $workout_plan->duration; ?>
                                </span>

                                <span class="badge bg-secondary px-3 py-2">
                                    <i class="bi bi-calendar-week me-1"></i>
                                    <?php echo $workout_plan->day_per_week; ?> days/week
                                </span>

                                <!-- VIEW PLAN BUTTON (RESTORED) -->
                                <button class="btn btn-sm btn-outline-light"
                                    data-bs-toggle="modal"
                                    data-bs-target="#workoutPlanModal">
                                    <i class="bi bi-eye"></i> View Plan
                                </button>



                            </div>
                        </div>

                    <?php endif; ?>

                </div>
            </div>
        </div>

        <!-- RIGHT SIDE -->
        <div class="col-md-6">

            <!-- WORKOUT PLAN CARD -->
            <div class="card shadow mb-3 border-0 text-white"
                style="background: linear-gradient(135deg, #1e1e2f, #2a2a3d);">

                <div class="card-body">

                    <h6 class="text-uppercase text-secondary mb-2">
                        <i class="bi bi-lightning-charge-fill text-warning me-1"></i>
                        Fitness Status
                    </h6>

                    <h5 class="card-title d-flex align-items-center mb-3">
                        <i class="bi bi-journal-text me-2 text-info"></i>
                        Workout Plan
                    </h5>

                    <?php if ($hasPlan): ?>

                        <div class="mb-3">

                            <div class="d-flex align-items-center mb-2">
                                <i class="bi bi-fire text-warning me-2"></i>
                                <span class="fw-bold">
                                    <?php echo $workout_plan->workout_plan; ?>
                                </span>
                            </div>

                            <div class="d-flex flex-wrap gap-2">

                                <span class="badge bg-info px-3 py-2">
                                    <?php echo $workout_plan->level; ?>
                                </span>

                                <span class="badge bg-success px-3 py-2">
                                    <?php echo $workout_plan->status; ?>
                                </span>

                                <span class="badge bg-warning text-dark px-3 py-2">
                                    <?php echo $workout_plan->duration; ?> mins
                                </span>

                                <span class="badge bg-secondary px-3 py-2">
                                    <?php echo $workout_plan->day_per_week; ?> days/week
                                </span>

                            </div>

                        </div>

                    <?php else: ?>

                        <div class="text-center py-3">
                            <i class="bi bi-emoji-frown fs-1 text-muted mb-2"></i>
                            <p class="mb-1 text-secondary text-white">No active workout plan</p>
                            <small class="text-white">Start a program to track your fitness progress</small>
                        </div>

                    <?php endif; ?>

                </div>
            </div>

            <!-- ACTIVITY LOG CARD (NEW PLACE) -->
            <div class="card shadow border-0 text-white"
                style="background: linear-gradient(135deg, #1e1e2f, #2a2a3d);">

                <div class="card-body">

                    <h6 class="text-uppercase text-secondary mb-2">
                        <i class="bi bi-clock-history text-info me-1"></i>
                        Activity Log
                    </h6>

                    <h5 class="card-title mb-3">
                        <i class="bi bi-activity text-warning me-2"></i>
                        Recent Activity
                    </h5>

                    <ul class="list-unstyled mb-3">

                        <li class="d-flex justify-content-between mb-2">
                            <span><i class="bi bi-lightning-charge-fill text-danger me-2"></i>Chest Workout</span>
                            <small class="text-muted">Yesterday</small>
                        </li>

                        <li class="d-flex justify-content-between mb-2">
                            <span><i class="bi bi-heart-pulse-fill text-success me-2"></i>Cardio</span>
                            <small class="text-muted">2 days ago</small>
                        </li>

                        <li class="d-flex justify-content-between mb-2">
                            <span><i class="bi bi-bullseye text-warning me-2"></i>Leg Day</span>
                            <small class="text-muted">4 days ago</small>
                        </li>

                    </ul>

                    <a href="#" class="btn btn-outline-light btn-sm w-100"
                        data-bs-toggle="modal"
                        data-bs-target="#activityModal">
                        <i class="bi bi-list-ul me-1"></i> View Full Activity
                    </a>

                </div>
            </div>

        </div>
    </div>
</div>

<?php
include_once "../gen_modal/bmi_history_modal.php";
include_once "../gen_modal/add_bmi_modal.php";
include_once "../gen_modal/cancellation_plan_modal.php"; 
include_once "../gen_modal/edit_profile_modal.php";
include_once "../gen_modal/exercise_log_modal.php";
include_once "../gen_modal/workout_plan_modal.php";


include_once "../layout/footer.php"; 
?>