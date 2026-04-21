<?php
header("Content-Type: application/json");

include_once "../../config/core.php";
include_once "../../config/database.php";
include_once "../../objects/exercise_log.php";

$database = new Database();
$db = $database->getConnection();

$exercise_log = new ExerciseLog($db);

$data = json_decode(file_get_contents("php://input"), true);

if (!$data) {
    echo json_encode([
        "success" => false,
        "message" => "Invalid JSON body"
    ]);
    exit;
}

if (
    !isset($data['exercise_id']) ||
    !isset($data['status']) ||
    !isset($data['progress']) ||
    !isset($data['personal_best'])
    
    
) {
    echo json_encode([
        "success" => false,
        "message" => "Missing required fields"
    ]);
    exit;
}

$exercise_log->exercise_id = $data['exercise_id'];
$exercise_log->status = $data['status'];
$exercise_log->progress = $data['progress'];
$exercise_log->modified_at = date("Y-m-d H:i:s");
$exercise_log->personal_best = $data['personal_best'];

if ($exercise_log->updateExerciseLog()) {
    echo json_encode([
        "success" => true,
        "message" => "Exercise log updated successfully",
        "data" => $data
    ]);
} else {
    echo json_encode([
        "success" => false,
        "message" => "Failed to update exercise log",
        "data" => $data
    ]);
}
?>