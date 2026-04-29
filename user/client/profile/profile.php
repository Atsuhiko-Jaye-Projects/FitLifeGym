<?php 
include_once '../../../config/core.php'; 
include_once '../../../config/database.php'; 
include_once '../../../objects/bmi_record.php';
include_once '../../../objects/user.php'; 
include_once '../../../objects/workout_plan.php'; 
include_once '../../../objects/exercise_activity.php'; 
include_once '../../../objects/exercise_log.php'; 

$database = new Database();
$db = $database->getConnection();

$BMI_record = new BMIRecord($db);
$user = new User($db);
$workout_plan = new WorkoutPlan($db);
$exercise_activity = new ExerciseActivity($db);
$exercise_log = new ExerciseLog($db);


if (isset($_SESSION['user_id'])) {

    $BMI_record->client_id = $_SESSION['user_id'];

    $show_plan_button = null;

    if ( $BMI_record->checkBmiRecord()) {

        if ($BMI_record->status == "No Plan") {
            // show the current bmi record
            
            $category = $BMI_record->bmi_classification;
            $BMI_value = $BMI_record->bmi;
        }else{
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




// get the user details
$user->id = $_SESSION['user_id'];
$user->getProfileDetails();

if ($_POST) {
    $user->id = $_SESSION['user_id'];
    $user->firstname = $_POST['firstname'];
    $user->lastname = $_POST['lastname'];
    $user->contact_no = $_POST['contact_number'];
    $user->email_address = $_POST['email_address'];

    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];
    $currentPassword = $_POST['current_password'];

    $storedPassword = $user->password;

    
    // var_dump($user->EmailAlreadyTakenById());
    // die();
    // ✅ Email check
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";

    if ($user->EmailAlreadyTakenById()) {

        echo "<script>
            setTimeout(function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Email address is already taken!'
                });
            }, 100);
        </script>";

    }

    elseif ($user->ContactAlreadyTakenById()) {

        echo "<script>
            setTimeout(function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Contact No is already taken'
                });
            }, 100);
        </script>";

    }

    elseif (!empty($newPassword)) {

        if ($newPassword != $confirmPassword) {

            echo "<script>
                setTimeout(function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Passwords do not match!'
                    });
                }, 100);
            </script>";

        }
        elseif (empty($currentPassword)) {

            echo "<script>
                setTimeout(function() {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Required',
                        text: 'Please enter your current password'
                    });
                }, 100);
            </script>";

        }
        elseif (!password_verify($currentPassword, $storedPassword)) {

            echo "<script>
                setTimeout(function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Current password is incorrect!'
                    });
                }, 100);
            </script>";

        }
        else {

            $user->password = $newPassword;

            if ($user->UpdateUserProfile()) {

                echo "<script>
                    setTimeout(function() {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Profile updated successfully!'
                        });
                    }, 100);
                </script>";

            } else {

                echo "<script>
                    setTimeout(function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Failed to update profile'
                        });
                    }, 100);
                </script>";

            }
        }

    }

    else {

        $user->password = null;

        if ($user->UpdateUserProfile()) {

            echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
            <script>
                setTimeout(function() {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'Profile updated successfully!',
                        allowOutsideClick: false
                    })
                }, 100);
            </script>";
        } else {

            echo "<script>
                setTimeout(function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Failed to update profile'
                    });
                }, 100);
            </script>";

        }
    }
}

$require_login = true;
include_once "../../../login_checker.php";

$page_title = "index";
include '../layout/header.php';
?>

<div class="col-md-9 col-lg-10 p-4">

    <!-- HERO (keep as is or light/dark, your choice) -->
    <div class="bg-dark text-white p-4 rounded mb-4 d-flex align-items-center justify-content-between">
        
        <!-- Left side: Profile + Welcome -->
        <div class="d-flex align-items-center">
            
            <!-- Profile Picture -->
            <div class="me-3">
                <img src="../../../assets/images/logo.png" 
                    alt="Profile Picture" 
                    class="rounded-circle"
                    style="width: 80px; height: 80px; object-fit: cover;">
            </div>

            <!-- Welcome Text -->
            <div>
                <h2 class="mb-1">Welcome Back <?php echo $_SESSION['firstname']; ?>!</h2>
                <p class="mb-0">Your personal fitness hub — track, train & transform.</p>
            </div>
            
        </div>

        <!-- Right side: Edit Button -->
        <div>
            <button type="button" class="btn btn-outline-light" data-bs-toggle="modal" data-bs-target="#editProfileModal">
                <span class="bi bi-pencil"></span>
            </button>
        </div>

    </div>

    <div class="row g-4">

        <!-- LEFT: BMI SUMMARY -->
        <div class="col-md-6">
            <div class="card shadow h-100 border-0" style="background: linear-gradient(135deg, #1e1e2f, #2f2f4a);">
                <div class="card-body text-white">

                    <!-- Title -->
                    <h6 class="text-uppercase text-secondary mb-2">Health Metric</h6>
                    <h5 class="d-flex align-items-center mb-3">
                        <i class="bi bi-heart-pulse-fill me-2 text-danger fs-5"></i>
                        Your BMI
                    </h5>

                    <!-- BMI Value (brighter) -->
                    <h1 class="display-3 fw-bold mb-2 text-white">
                        <?php echo $BMI_value ?? '—'; ?>
                    </h1>

                    <!-- Category -->
                    <div class="d-flex align-items-center gap-2 mb-3">
                        <span class="badge bg-primary px-2 py-2">
                            <i class="bi bi-activity me-1"></i> Category
                        </span>

                        <span class="badge bg-success px-3 py-2">
                            <i class="bi bi-check-circle me-1"></i>
                            <?php echo $category ?? 'No data'; ?>
                        </span>
                    </div>

                    <hr class="border-secondary">

                    <!-- Plan -->
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

                            <div class="d-flex flex-wrap gap-2">

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

                            </div>
                        </div>

                    <?php endif; ?>

                </div>
            </div>
        </div>

        <!-- RIGHT -->
        <div class="col-md-6">

        <!-- WORKOUT PLAN -->
        <div class="card shadow mb-4 border-0 text-white"
            style="background: linear-gradient(135deg, #1e1e2f, #2a2a3d);">

            <div class="card-body">

                <!-- Header -->
                <h6 class="text-uppercase text-secondary mb-2">
                    <i class="bi bi-lightning-charge-fill text-warning me-1"></i>
                    Fitness Status
                </h6>

                <h5 class="card-title d-flex align-items-center mb-3">
                    <i class="bi bi-journal-text me-2 text-info"></i>
                    Workout Plan
                </h5>

                <?php if (!$show_plan_button): ?>

                    <!-- ACTIVE STATUS -->
                    <div class="mb-3">

                        <div class="d-flex align-items-center mb-2">
                            <i class="bi bi-check-circle-fill text-success me-2"></i>
                            <span class="badge bg-success px-3 py-2">
                                Active Plan
                            </span>
                        </div>

                        <div class="d-flex align-items-center">
                            <i class="bi bi-graph-up-arrow text-info me-2"></i>
                            <span class="badge bg-primary px-3 py-2">
                                In Progress
                            </span>
                        </div>

                    </div>

                    <a href="#" class="btn btn-outline-light btn-sm" data-bs-toggle="modal" data-bs-target="#workoutPlanModal">
                        <i class="bi bi-eye me-1"></i> View Plan
                    </a>

                <?php else: ?>

                    <!-- NO PLAN STATE -->
                    <div class="text-center py-3">

                        <i class="bi bi-emoji-frown fs-1 text-muted mb-2"></i>

                        <p class="mb-3 text-secondary">
                            No workout plan yet.
                        </p>

                        <a href="create_plan.php" class="btn btn-primary w-100">
                            <i class="bi bi-plus-circle me-1"></i>
                            Create Your Plan
                        </a>

                    </div>

                <?php endif; ?>

            </div>
        </div>

        <div class="card shadow border-0 text-white"
            style="background: linear-gradient(135deg, #1e1e2f, #2a2a3d);">

            <div class="card-body">

                <!-- Header -->
                <h6 class="text-uppercase text-secondary mb-2">
                    <i class="bi bi-clock-history me-1 text-info"></i>
                    Activity Log
                </h6>

                <h5 class="card-title mb-3">
                    <i class="bi bi-activity me-2 text-warning"></i>
                    Recent Activity
                </h5>

                <!-- Activity List -->
                <ul class="list-unstyled mb-3">

                    <li class="d-flex align-items-center mb-2">
                        <i class="bi bi-lightning-charge-fill text-danger me-2"></i>
                        <span>Chest Workout</span>
                        <small class="text-muted ms-auto">Yesterday</small>
                    </li>

                    <li class="d-flex align-items-center mb-2">
                        <i class="bi bi-heart-pulse-fill text-success me-2"></i>
                        <span>Cardio Session</span>
                        <small class="text-muted ms-auto">2 days ago</small>
                    </li>

                    <li class="d-flex align-items-center mb-2">
                        <i class="bi bi-bullseye text-warning me-2"></i>
                        <span>Leg Day</span>
                        <small class="text-muted ms-auto">4 days ago</small>
                    </li>

                </ul>

                <!-- Button -->
                <a href="#" class="btn btn-outline-light btn-sm" data-bs-toggle="modal" data-bs-target="#activityModal">
                    <i class="bi bi-list-ul me-1"></i> View All Activity
                </a>

            </div>
        </div>

        </div>

    </div>
</div>


<?php 
include_once "../gen_modal/edit_profile_modal.php";
include_once "../gen_modal/exercise_log_modal.php";
include_once "../gen_modal/workout_plan_modal.php";
include_once "../layout/footer.php"; 
?>



