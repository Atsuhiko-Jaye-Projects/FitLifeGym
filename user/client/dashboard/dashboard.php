<?php 
include_once "../../../config/core.php";
include_once "../../../config/database.php";
include_once "../../../objects/workout_plan.php";
include_once "../../../objects/exercise_activity.php";
$database = new Database();
$db = $database->getConnection();

$workout_plan = new WorkoutPlan($db);

$exercice_activity = new ExerciseActivity($db);


$workout_plan->client_id = $_SESSION['user_id'];
$workout_plan->getActiveWorkoutPlan();


$exercice_activity->workout_plan_id = $workout_plan->workout_plan_id;
$exercice_stmt = $exercice_activity->getExercise();


$require_login = true;
include_once "../../../login_checker.php";

$page_title = "Dashboard";
include_once '../layout/header.php'; 
?>


<div class="col-md-9 col-lg-10 p-4">
    <div class="hero mb-4 text-white">
        <h1>Welcome Back <?php echo $_SESSION['firstname']; ?>! </h1>
        <p>Your personal fitness hub — track, train & transform.</p>
    </div>
    <div class="row g-3 ">
        <!-- LEFT (Tall Box) -->
    <div class="col-md-6">
        <div class="box h-100 p-3 d-flex flex-column bg-dark text-white rounded shadow">
            
            <!-- Header -->
            <div class="d-flex align-items-center mb-3 border-bottom border-secondary pb-2">
                <i class="bi bi-calendar-week me-2 text-info"></i>
                <h5 class="mb-0 text-white">Workout Plan</h5>
            </div>

            <!-- Plan ID -->
            <div class="mb-3">
                <span class="badge bg-info text-dark">
                    Plan ID: <?php echo $workout_plan->workout_plan_id; ?>
                </span>
            </div>

                    <div class="flex-grow-1 overflow-auto">

                        <div class="accordion accordion-flush" id="workoutAccordion">
                            <?php 
                            $currentDay = null;
                            $dayIndex = 0;

                            while ($row = $exercice_stmt->fetch(PDO::FETCH_ASSOC)) {

                                if ($currentDay !== $row['day']) {
                                    if ($currentDay !== null) {
                                        echo "</div></div></div>";
                                    }

                                    $dayIndex++;
                                    $currentDay = $row['day'];

                                    echo "
                                    <div class='accordion-item bg-dark border-secondary mb-2 rounded text-white'>
                                        <h2 class='accordion-header'>
                                            <button class='accordion-button collapsed bg-dark text-white shadow-none' type='button' data-bs-toggle='collapse' data-bs-target='#day{$dayIndex}'>
                                                <i class='bi bi-calendar-day me-2 text-warning'></i>
                                                <span class='text-white'>{$currentDay}</span>
                                            </button>
                                        </h2>

                                        <div id='day{$dayIndex}' class='accordion-collapse collapse' data-bs-parent='#workoutAccordion'>
                                            <div class='accordion-body text-white'>";
                                }

                                echo "
                                <div class='p-2 mb-2 rounded bg-secondary bg-opacity-25 text-white'>
                                    <div class='fw-bold text-white'>
                                        <i class='bi bi-check-circle-fill text-success me-2'></i>
                                        {$row['name']}
                                    </div>

                                    <div class='small text-light d-flex flex-wrap gap-3 mt-1'>
                                        <span><i class='bi bi-clock me-1'></i> {$row['duration']}</span>
                                        <span><i class='bi bi-arrow-repeat me-1'></i> {$row['cycle']}</span>
                                        <span><i class='bi bi-layers me-1'></i> {$row['set_per_exercise']} sets</span>
                                    </div>
                                </div>";
                            }

                            if ($currentDay !== null) {
                                echo "</div></div></div>";
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- RIGHT (2 stacked boxes) -->
            <div class="col-md-6 d-flex flex-column">
                <div class="box flex-fill mb-3 p-3">
                    <div class="d-flex align-items-center mb-3 border-bottom border-secondary pb-2">
                        <i class="bi bi-calendar-week me-2 text-info"></i>
                        <h5 class="mb-0 text-white">Snapshot Progress</h5>
                    </div>
                </div>
                <div class="box flex-fill p-3"></div>
            </div>
        </div>

</div>

<?php include '../layout/footer.php'; ?>