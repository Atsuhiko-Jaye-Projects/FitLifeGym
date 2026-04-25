<?php 
include_once '../../config/core.php'; 
include_once '../../config/database.php'; 
include_once '../../objects/bmi_record.php';
include_once '../../objects/user.php'; 
include_once '../../objects/workout_plan.php'; 
include_once '../../objects/exercise_activity.php'; 

$database = new Database();
$db = $database->getConnection();

$BMI_record = new BMIRecord($db);
$user = new User($db);
$workout_plan = new WorkoutPlan($db);
$exercise_activity = new ExerciseActivity($db);


if (isset($_SESSION['user_id'])) {

    $BMI_record->client_id = $_SESSION['user_id'];
    
    if ($BMI_record->checkBmiRecord()) {
        $show_plan_button = true;
        $category = $BMI_record->bmi_classification;
    }else{
        $show_plan_button = false;
        $category = $BMI_record->bmi_classification;
    }
}

if ($_POST) {
    if (isset($_POST['action']) && $_POST['action'] === "record_bmi") {

        $BMI_record->client_id = $_SESSION['user_id'];
        $BMI_record->weight = $_POST['weight'] ?? 0;
        $BMI_record->height = $_POST['height'] ?? 0;
        $BMI_record->bmi = $_POST['bmi'] ?? 0;
        $BMI_record->bmi_classification = $_POST['bmi_classification'] ?? 'Unknown';

        if ($BMI_record->createBMIRecord()) {

            $user->id = $_SESSION['user_id'];
            $user->updateFLI();

            $_SESSION['first_time_logged_in'] = 0;

            echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
            echo '<script>
                Swal.fire({
                    icon: "success",
                    title: "BMI Recorded!",
                    text: "Your BMI has been successfully saved.",
                    confirmButtonText: "OK"
                }).then(() => {
                    window.location.href = "index.php";
                });
            </script>';
        } else {

            echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
            echo '<script>
                Swal.fire({
                    icon: "error",
                    title: "Oops!",
                    text: "Failed to save your BMI. Please try again.",
                    confirmButtonText: "OK"
                });
            </script>';
        }
    }
}

$require_login = true;
include_once "../../login_checker.php";

$page_title = "index";
include 'layout/header.php'; 


if ($_SESSION['first_time_logged_in'] == 1) {
?>

<div class="col-md-9 col-lg-10">
    <div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
        <div class="hero text-white p-4 rounded-4 shadow d-flex flex-column justify-content-center text-center"
             style="background: linear-gradient(135deg, #1e3c72, #2a5298);
                    aspect-ratio: 1 / 1;
                    max-width: 500px;
                    width: 100%;">

            <h1 class="fw-bold">
                Welcome <?php echo $_SESSION['firstname']; ?>! 👋
            </h1>

            <p class="fs-5 mb-2">
                Start to take new shape — track progress, train smarter, transform your life.
            </p>

            <button class="btn fw-semibold px-4 py-2 rounded-pill shadow-sm btn-warning text-dark" data-bs-toggle="modal" data-bs-target="#bmiModal">
                <i class="bi bi-plus-circle me-2"> Add Your BMI</i>
            </button>
        </div>
    </div>
</div>

<?php 
include "gen_modal/add_bmi_modal.php";

}else{
?>

<div class="col-md-9 col-lg-10 p-4">

    <div class="hero mb-4 text-white">
        <h1>Welcome Back <?php echo $_SESSION['firstname']; ?>! 👋</h1>
        <p>Your personal fitness hub — track, train & transform.</p>
    </div>

    <div class="card shadow-sm border-0 bg-dark text-light">

        <div class="card-body">

            <?php if ($_SESSION['existing_plan'] == 0): ?>

                <div class="text-center py-4">
                    <h4 class="mb-2">🚀 Start Your Fitness Plan</h4>
                    <p class="text-secondary">
                        You don’t have a BMI plan yet. Create one and begin tracking your progress.
                    </p>

                    <a href="<?php echo $base_url; ?>user/client/components/workout_plan/workout_plans.php" 
                    class="btn btn-primary px-4">
                        Create Plan
                    </a>
                </div>

            <?php 
            else: 
                $workout_plan->client_id = $_SESSION['user_id'];
                $hasPlan = $workout_plan->getActiveWorkoutPlan();
            ?>

            <h5 class="mb-3 text-light">
                📊 Work Plan: 
                <span class="badge bg-primary">
                    <?php echo $workout_plan->workout_plan ?? 'No Workout Plan'; ?>
                    <?php 

                        $activity_stmt = null;
                        $activity_num = 0;

                        if ($hasPlan && $workout_plan->status === "Active") {
                            $exercise_activity->workout_plan_id = $workout_plan->workout_plan_id;
                            $activity_stmt = $exercise_activity->readExercise();

                            if ($activity_stmt) {
                                $activity_num = $activity_stmt->rowCount();
                            }
                        }

                    ?>
                </span>
            </h5>

            <div class="row text-center">

                <div class="col-md-4">
                    <div class="p-3 rounded shadow-sm bg-dark text-light border border-secondary">
                        <h6 class="text-secondary mb-2">BMI</h6>
                        <h2 class="fw-bold">
                            <?php echo $BMI_record->bmi ?? '22.5'; ?>
                        </h2>
                        <small class="text-secondary">Body Mass Index</small>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="p-3 rounded shadow-sm bg-dark text-light border border-secondary">
                        <h6 class="text-secondary mb-2">Status</h6>
                        <h5 class="fw-bold">
                            <span class="badge bg-success px-3 py-2">
                                <?php echo $workout_plan->status ?? 'Active'; ?>
                            </span>
                        </h5>
                        <small class="text-secondary">Keep pushing forward 💪</small>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="p-3 rounded shadow-sm bg-dark text-light border border-secondary">
                        <h6 class="text-secondary mb-2">Classification</h6>
                        <h5 class="fw-bold">
                            <?php echo $BMI_record->bmi_classification ?? 'Normal'; ?>
                        </h5>
                        <small class="text-secondary">Health Category</small>
                    </div>
                </div>

            </div>

            <!-- WORKOUT EXERCISES -->
            <div class="mt-4">

                <?php
                // ✅ FIX ONLY HERE (prevent null crash)
                $rows = [];

                if ($activity_stmt) {
                    $rows = $activity_stmt->fetchAll(PDO::FETCH_ASSOC);
                }

                $hasActiveWorkout = false;

                if (!empty($rows)) {
                    foreach ($rows as $r) {
                        if (isset($r['log_status']) && $r['log_status'] === 'In progress') {
                            $hasActiveWorkout = true;
                            break;
                        }
                    }
                }
                ?>

                <?php
                echo "<div class='row g-3'>";

                $hasData = false;

                foreach ($rows as $row) {

                    $hasData = true;

                    echo "<div class='col-md-4'>";
                    echo "<div class='p-3 rounded shadow-sm bg-dark text-light border border-secondary h-100 position-relative overflow-hidden'>";

                    echo "<div style='height:80px; background:linear-gradient(135deg,#0d6efd,#6610f2); border-radius:8px; margin-bottom:10px;'></div>";

                    $youtubeQuery = urlencode($row['name']);
                    echo "<a href='https://www.youtube.com/results?search_query={$youtubeQuery}' target='_blank' class='btn btn-primary btn-sm float-end'>
                            <i class='bi bi-youtube'></i>
                        </a>";

                    echo "<h6 class='fw-bold mb-1'>{$row['name']}</h6>";

                    echo "<div class='small text-light mb-2'>";
                    echo "<div>🏋️ Sets: <strong>{$row['set_per_exercise']}</strong></div>";
                    echo "<div>⏱ Duration: <strong>{$row['duration']} mins</strong></div>";
                    echo "<div>⏱ Cycle: <strong>{$row['cycle']} cycle</strong></div>";
                    echo "</div>";

                    $progress = $row['progress'] ?? 0;

                    echo "<div class='progress mt-2' style='height:6px; border-radius:10px;'>
                            <div class='progress-bar bg-success' style='width: {$progress}%'></div>
                        </div>";

                    $status = $row['log_status'] ?? 'Start';

                    $badgeClass = match($status) {
                        'In progress' => 'bg-warning',
                        'finished' => 'bg-success',
                        'Start' => 'bg-secondary',
                        default => 'bg-secondary'
                    };

                    echo "<span class='badge {$badgeClass} mt-2'>" . ucfirst($status) . "</span><br>";

                    echo "</div></div>";
                }

                echo "</div>";

                if (!$hasData) {
                    echo "<div class='col-12 text-center py-5'>
                            <div class='p-4 rounded bg-dark border border-secondary'>
                                <h5 class='text-warning mb-2'>🏋️ Rest Day Activated</h5>
                                <p class='text-secondary mb-0'>No exercises scheduled for today.</p>
                            </div>
                        </div>";
                }
                ?>

            </div>

            <?php endif; ?>

        </div>
    </div>
</div>

<?php
}
include 'layout/footer.php'; 
?>