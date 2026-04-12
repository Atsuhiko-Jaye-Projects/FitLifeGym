<?php 
include_once '../../config/core.php'; 
include_once '../../config/database.php'; 
include_once '../../objects/bmi_record.php';
include_once '../../objects/user.php'; 

$database = new Database();
$db = $database->getConnection();

$BMI_record = new BMIRecord($db);
$user = new User($db);


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
    if (isset($_POST['action']) && $_POST['action'] === "record_bmi") {

        // Assign BMI values safely
        $BMI_record->client_id = $_SESSION['user_id'];
        $BMI_record->weight = $_POST['weight'] ?? 0;
        $BMI_record->height = $_POST['height'] ?? 0;
        $BMI_record->bmi = $_POST['bmi'] ?? 0;
        $BMI_record->bmi_classification = $_POST['bmi_classification'] ?? 'Unknown';

        if ($BMI_record->createBMIRecord()) {

            // Update user's first_time_logged_in
            $user->id = $_SESSION['user_id'];
            $user->updateFLI();  // make sure this updates DB

            // Update session
            $_SESSION['first_time_logged_in'] = 0;

            // Show SweetAlert and optionally redirect
            echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
            echo '<script>
                Swal.fire({
                    icon: "success",
                    title: "BMI Recorded!",
                    text: "Your BMI has been successfully saved.",
                    confirmButtonText: "OK"
                }).then(() => {
                    // Optional: redirect after alert
                    window.location.href = "index.php";
                });
            </script>';
        } else {
            // Optional: alert if save fails
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
//include the modal
include "gen_modal/add_bmi_modal.php";


// show the greetings
}else{
?>

<div class="col-md-9 col-lg-10 p-4">

    <!-- Hero -->
    <div class="hero mb-4 text-white">
        <h1>Welcome Back <?php echo $_SESSION['firstname']; ?>! 👋</h1>
        <p>Your personal fitness hub — track, train & transform.</p>
    </div>

    <!-- BMI Card -->
    <div class="card shadow-sm border-0">

        <div class="card-body">

            <?php if ($BMI_record->status === "No Plan"): ?>

                <!-- CTA CARD -->
                <div class="text-center py-4">
                    <h4 class="mb-2">🚀 Start Your Fitness Plan</h4>
                    <p class="text-muted">
                        You don’t have a BMI plan yet. Create one and begin tracking your progress.
                    </p>

                <a href="<?php echo $base_url; ?>user/client/components/workout_plan/workout_plans.php"class="btn btn-primary px-4">
                        Create Plan
                    </a>
                </div>

            <?php else: ?>

                <!-- BMI DISPLAY -->
                <h5 class="mb-3">📊 Your BMI Overview</h5>

                <div class="row text-center">

                    <div class="col-md-4">
                        <h6 class="text-muted">BMI</h6>
                        <h2><?php echo $BMI_record->bmi ?? '--'; ?></h2>
                    </div>

                    <div class="col-md-4">
                        <h6 class="text-muted">Status</h6>
                        <h5 class="text-success">
                            <?php echo $BMI_record->status ?? '--'; ?>
                        </h5>
                    </div>

                    <div class="col-md-4">
                        <h6 class="text-muted">Classification</h6>
                        <h5>
                            <?php echo $BMI_record->bmi_classification ?? '--'; ?>
                        </h5>
                    </div>

                </div>

            <?php endif; ?>

        </div>

    </div>

</div>
<?php
}
include 'layout/footer.php'; 
?>