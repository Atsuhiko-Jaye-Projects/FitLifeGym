<?php 
include_once '../../../../config/core.php'; 
include_once '../../../../objects/user.php'; 
include_once '../../../../config/database.php'; 
include_once '../../../../objects/bmi_record.php';
include_once '../../../../objects/workout_plan.php';
include_once '../../../../objects/exercise_activity.php';

$database = new Database();
$db = $database->getConnection();

$BMI_record = new BMIRecord($db);
$user = new User($db);
$workout_plan = new WorkOutPlan($db);
$ExerciseAct = new ExerciseActivity($db);

// Require login BEFORE output
$require_login = true;
include_once "../../../../login_checker.php";

// Page setup
$page_title = "workout plans";

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

// Load header AFTER login check
include_once '../../layout/header.php'; 



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

if ($_POST) {

    $exercises = $_POST['exercises'];
    $session_duration = $_POST['session_duration'];

    $prefix = $workout_plan->generateStrictId();

    $workout_plan->workout_plan_id = $prefix;
    $workout_plan->workout_plan = $_POST['plan_name'];
    $workout_plan->client_id = $_SESSION['user_id'] ?? null;
    $workout_plan->duration = $_POST['session_duration'];
    $workout_plan->level = $_POST['plan_type'];
    $workout_plan->day_per_week = $_POST['day_per_week'] ?? null;
    $workout_plan->current_bmi = $_POST['bmi_value'] ?? null;

    // ❗ IMPORTANT: SAVE WORKOUT PLAN FIRST
    $workout_plan->createPlan();

    $allSaved = true;

    foreach ($exercises as $day) {

        $dayName = $day['day'] ?? null;

        if (!isset($day['items']) || !is_array($day['items']) || empty($dayName)) {
            continue;
        }

        foreach ($day['items'] as $ex) {

            $ExerciseAct->workout_plan_id = $prefix;
            $ExerciseAct->name = $ex['name'] ?? null;
            $ExerciseAct->client_id = $_SESSION['user_id'] ?? null;
            $ExerciseAct->duration = $ex['duration'] ?? 0;
            $ExerciseAct->set_per_exercise = $ex['repetitions'] ?? 0;
            $ExerciseAct->cycle = $ex['sets'] ?? 0;
            $ExerciseAct->day = $dayName;

            if (!$ExerciseAct->createExerciseAct()) {
                $allSaved = false;
            }
        }
    }

    echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';

    if ($allSaved) {
        echo '<script>
            Swal.fire({
                icon: "success",
                title: "Workout Created!",
                text: "Your workout plan and exercises were saved successfully.",
                confirmButtonText: "OK"
            });
        </script>';
        
        $user->id = $_SESSION['user_id'];
        $user->updatePlanStatus();

        $_SESSION['existing_plan'] = 1;

        header("LOCATION:{$home_url}user/client/index.php?action=created");
        exit;
    } else {
        echo '<script>
            Swal.fire({
                icon: "error",
                title: "Save Failed",
                text: "Some exercises could not be saved. Please try again.",
                confirmButtonText: "OK"
            });
        </script>';
    }
}


if ($_SESSION['existing_plan'] == 0) {
?>

<div class="col-md-9 col-lg-10 p-4">

    <!-- HERO -->
    <div class="hero mb-4 text-white p-4 rounded">
        <h1>Start Your Transformation 🚀</h1>
        <p class="mb-0">
            Consistency creates results — select your plan and begin your fitness journey today.
        </p>

        <span class="badge bg-light text-dark mt-2 p-2">
            <i class="bi bi-bar-chart-line me-1"></i>
            BMI Classification:
            <strong>
                <?php echo $BMI_record->bmi_classification ?? 'Not Available'; ?>
            </strong>
        </span>
    </div>

    <div class="row g-3">

        <!-- BEGINNER -->
        <div class="col-md-6">
            <div class="nav-card d-block p-4 h-100 text-white rounded shadow-sm">

                <h5 class="mb-2 text-white">
                    <i class="bi bi-bar-chart-line me-2"></i> Beginner Plan
                </h5>

                <small class="text-white-50">
                    Start your fitness journey with guided workouts designed to build confidence.
                </small>

                <div class="mt-3">
                    <button class="btn btn-sm btn-outline-light"
                            data-bs-toggle="modal"
                            data-bs-target="#beginnerModal"
                            onclick="loadWorkoutPlan('beginner', 'modalBody_beginner', 'hiddenInputs_beginner')">
                        View Plan
                    </button>
                </div>

            </div>
        </div>

        <!-- INTERMEDIATE -->
        <div class="col-md-6">
            <div class="nav-card d-block p-4 h-100 text-white rounded shadow-sm">

                <h5 class="mb-2 text-white">
                    <i class="bi bi-lightning-charge me-2"></i> Intermediate Plan
                </h5>

                <small class="text-white-50">
                    Build strength and endurance with structured training programs.
                </small>

                <div class="mt-3">
                    <button class="btn btn-sm btn-outline-light"
                            data-bs-toggle="modal"
                            data-bs-target="#intermidiateModal"
                            onclick="loadWorkoutPlan('intermediate', 'modalBody_intermediate', 'hiddenInputs_intermediate')">
                            
                        View Plan
                    </button>
                </div>

            </div>
        </div>

        <!-- ADVANCED -->
        <div class="col-md-6">
            <div class="nav-card d-block p-4 h-100 text-white rounded shadow-sm">

                <h5 class="mb-2 text-white">
                    <i class="bi bi-graph-up-arrow me-2"></i> Advanced Plans
                </h5>

                <small class="text-white-50">
                    Push your limits with high-intensity performance workouts.
                </small>

                <div class="mt-3">
                    <button class="btn btn-sm btn-outline-light"
                            data-bs-toggle="modal"
                            data-bs-target="#advanceModal"
                            onclick="loadWorkoutPlan('advanced', 'modalBody_advanced', 'hiddenInputs_advanced')">
                        View Plan
                    </button>
                </div>

            </div>
        </div>

        <!-- CUSTOM -->
        <div class="col-md-6">
            <div class="nav-card d-block p-4 h-100 text-white rounded shadow-sm">

                <h5 class="mb-2 text-white">
                    <i class="bi bi-sliders me-2"></i> Custom Plans
                </h5>

                <small class="text-white-50">
                    Create a personalized workout plan tailored to your goals.
                </small>

                <div class="mt-3">
                    <button class="btn btn-sm btn-outline-light"
                            data-bs-toggle="modal"
                            data-bs-target="#customModal"
                            onclick="loadWorkoutPlan('Custom', 'modalBody')">
                        Create Plan
                    </button>
                </div>

            </div>
        </div>

    </div>

</div>

<?php 
include_once "workout_plans_modal/beginner_plan_modal.php"; 
include_once "workout_plans_modal/advance_plan_modal.php"; 
include_once "workout_plans_modal/custom_plan_modal.php"; 
include_once "workout_plans_modal/intermidiate_plan_modal.php"; 
}else{
    header("LOCATION:{$home_url}user/client/index.php?action=plan_existed");
}
?>

<?php include '../../../../layout/footer.php'; ?>

<script>

const fitnessLevel = "<?= $fitnessLevel ?>";
const BMICategory = "<?= $bmiCategory ?>";

const PlanIntensity = "<?= $plan_intensity ?>";
const PlanFocus = "<?= $plan_focus ?>";
const PlanSessionDuration = "<?= $plan_duration ?>";
const PlanDayPerWeek = "<?= $plan_day_per_week ?>";

const PlanWeeks = 4;


function loadWorkoutPlan(level, modalBody, containerId) {

    console.log("FUNCTION CALLED", level, modalBody);

    document.getElementById(modalBody).innerHTML =
        "<p>⏳ Generating your workout plan...</p>";

    fetch("../../../../api/get_workout_plan.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({
            goal: PlanFocus,
            fitness_level: level,
            bmi_category: BMICategory,
            health_conditions: ["None"],
            schedule: {
                days_per_week: PlanDayPerWeek,
                session_duration: PlanSessionDuration
            },
            plan_duration_weeks: PlanWeeks,
            lang: "en"
        })
    })
    .then(res => res.json())
    .then(data => {

        console.log("API RESPONSE:", data);

        const plan = data.result; // keep your original logic

        let exercisesHTML = "";

        plan.exercises.forEach(day => {

            exercisesHTML += `
                <div class="mb-3">
                    <h5>📅 ${day.day}</h5>
            `;

            day.exercises.forEach(ex => {
                exercisesHTML += `
                    <div class="p-2 mb-2 border rounded">
                        <strong>${ex.name}</strong><br>
                        <small>
                            ⏱ ${ex.duration ?? 'Not Set'} |
                            🔁 ${ex.repetitions ?? 'Not Set'} |
                            📦 ${ex.sets ?? 'Not Set'} sets
                        </small>
                    </div>
                `;
            });

            exercisesHTML += `</div>`;
        });

        let container = document.getElementById(containerId);
        container.innerHTML = "";

        plan.exercises.forEach((day, i) => {
            day.exercises.forEach((ex, j) => {

                container.innerHTML += `
                    <input type="hidden" name="exercises[${i}][day]" value="${day.day}">
                    <input type="hidden" name="exercises[${i}][items][${j}][name]" value="${ex.name}">
                    <input type="hidden" name="exercises[${i}][items][${j}][duration]" value="${ex.duration}">
                    <input type="hidden" name="exercises[${i}][items][${j}][repetitions]" value="${ex.repetitions}">
                    <input type="hidden" name="exercises[${i}][items][${j}][sets]" value="${ex.sets}">
                `;
            });
        });

        document.getElementById("session_duration").value = plan.total_weeks;

        document.getElementById(modalBody).innerHTML = `
        <div class="container-fluid text-white">

            <div class="row">

                <div class="col-md-4 border-end">

                    <h4>💪 ${plan.goal}</h4>
                    <hr>

                    <p><strong>Level:</strong><br>${plan.fitness_level}</p>

                    <p><strong>Days per week:</strong><br>${plan.schedule.days_per_week}</p>

                    <p><strong>Session duration:</strong><br>${plan.schedule.session_duration} mins</p>

                    <p><strong>Total duration:</strong><br>${plan.total_weeks} weeks</p>

                    <hr>

                    <p><strong>Focus:</strong><br>${plan.goal || 'General fitness'}</p>

                    <button onclick="saveWorkoutPlan(window.currentPlan)"
                            class="btn btn-success w-100 mt-3">
                        💾 Save Plan
                    </button>

                </div>

                <div class="col-md-8" style="max-height: 500px; overflow-y: auto;">

                    <h5>🏋️ Workout Schedule</h5>
                    <hr>

                    ${plan.exercises.map(day => `
                        <div class="mb-3">

                            <h6 class="text-info">📅 ${day.day}</h6>

                            ${day.exercises.map(ex => `
                                <div class="p-2 mb-2 bg-dark rounded">

                                    <strong>${ex.name}</strong><br>

                                    <small>
                                        ⏱ ${ex.duration ?? 'Not Set'} |
                                        🔁 ${ex.repetitions ?? 'Not Set'} |
                                        📦 ${ex.sets ? ex.sets + ' sets' : 'Not Set'}
                                    </small>

                                </div>
                            `).join("")}

                        </div>
                    `).join("")}

                </div>

            </div>

        </div>
        `;
    })
    .catch(err => {
        console.log(err);

        /* FIX #4 */
        document.getElementById(modalBody).innerHTML =
            "<p class='text-danger'>❌ Failed to load workout plan</p>";
    });
}

</script>