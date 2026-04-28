<?php
header('Content-Type: application/json');
include_once "../../config/core.php";
include_once "../../config/database.php";
include_once "../../objects/workout_plan.php";
include_once "../../objects/user.php";
include_once "../../objects/bmi_record.php";

$database = new Database();
$db = $database->getConnection();

$workoutPlan = new WorkoutPlan($db);
$user = new User($db);
$BMIRecord = new BMIRecord($db);

$workoutPlan->client_id = $_SESSION['user_id'];
$workoutPlan->workout_plan_id = $_POST['workout_plan_id'];
$BMIRecord->client_id = $_SESSION['user_id'];

$user->id = $_SESSION['user_id'];

if($workoutPlan->cancelWorkoutPlan()){
    $user->UpdateExistingPlan();
    $BMIRecord->client_id = $_SESSION['user_id'];
    $BMIRecord->UpdatePlanStatus();
    $_SESSION['existing_plan'] = 0;
    echo json_encode([
        "status" => "success",
        "message" => "Workout cancelled successfully"
    ]);
} else {
    echo json_encode([
        "status" => "error",
        "message" => "Unable to cancel workout"
    ]);
}