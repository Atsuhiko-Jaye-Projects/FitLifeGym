<?php
header("Content-Type: application/json");

include_once "../../config/core.php";
include_once "../../config/database.php";
include_once "../../objects/exercise_log.php";

// DB connection
$database = new Database();
$db = $database->getConnection();

// Object
$exercise_log = new ExerciseLog($db);

// Get JSON input
$data = json_decode(file_get_contents("php://input"), true);

// Validate input
if (
    !isset($data['exercise_id']) ||
    !isset($data['workplan_id']) ||
    !isset($data['workplan']) ||
    !isset($data['duration']) ||
    !isset($data['sets']) ||
    !isset($data['day']) ||
    !isset($data['status']) ||
    !isset($data['progress'])
) {
    echo json_encode([
        "success" => false,
        "message" => "Missing required fields"
    ]);
    exit;
}

$exercise_log->exercise_id = $data['exercise_id'];
$exercise_log->workplan_id = $data['workplan_id'];
$exercise_log->workout = $data['workplan']; // from JS: "workplan"
$exercise_log->duration = $data['duration'];
$exercise_log->sets = $data['sets']; // NOT sets_per_exercise
$exercise_log->day = $data['day'];
$exercise_log->status = $data['status'];
$exercise_log->progress = $data['progress'];
$exercise_log->created_at = date("Y-m-d H:i:s");

// Create
if ($exercise_log->createExerciseLog()) {
    echo json_encode([
        "success" => true,
        "message" => "Workout plan created successfully"
    ]);
} else {
    echo json_encode([
        "success" => false,
        "message" => "Failed to create workout plan"
    ]);
}
?>