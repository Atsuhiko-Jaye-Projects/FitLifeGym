<?php
header('Content-Type: application/json');
include_once "../../config/core.php";
include_once "../../config/database.php";
include_once "../../objects/workout_plan.php";
include_once "../../objects/user.php";


$database = new Database();
$db = $database->getConnection();

$workoutPlan = new WorkoutPlan($db);
$user = new User($db);

$workoutPlan->client_id = $_SESSION['user_id'];
$workoutPlan->workout_plan_id = $_POST['workout_plan_id'];

$user->id = $_SESSION['user_id'];

if($workoutPlan->cancelWorkoutPlan()){
    $user->UpdateExistingPlan();
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