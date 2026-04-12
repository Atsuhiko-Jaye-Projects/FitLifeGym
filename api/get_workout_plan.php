<?php
include_once "../config/core.php";
header('Content-Type: application/json');

//$api_key = "84d8ea7676msh76a4e10a3644b32p189eaajsn270733f271d7";
//$api_key = "107f302fd6mshf0a1b2d2cd102c9p1b84b8jsn8754d48f6207";
$api_key = "4bebdd4178mshb8f77b0636e7cf3p102494jsnad50919c43f5";
//$api_key = "737704916dmsh0cecf15cc44fed6p149448jsn50a8a1f1b68e";

// 📥 Get JSON input from frontend
$input = json_decode(file_get_contents("php://input"), true);

// ❌ Validate input
$raw = file_get_contents("php://input");
$input = json_decode($raw, true);

if (!$input) {
    echo json_encode([
        "success" => false,
        "message" => "Invalid input",
        "debug_raw" => $raw
    ]);
    exit;
}

// 🧠 Build request payload for API
$postData = [
    "goal" => $input["goal"] ?? "Cardio",
    "fitness_level" => $input["fitness_level"] ?? "Beginner",
    "preferences" => $input["preferences"] ?? [],
    "health_conditions" => $input["health_conditions"] ?? ["None"],
    "schedule" => [
        "days_per_week" => $input["schedule"]["days_per_week"] ?? 3,
        "session_duration" => $input["schedule"]["session_duration"] ?? 30
    ],
    "plan_duration_weeks" => $input["plan_duration_weeks"] ?? 4,
    "lang" => $input["lang"] ?? "en"
];

$fitnessLevel = $input['fitness_level'] ?? 'beginner';
$bmiCategory = $input['bmi_category'] ?? 'normal';

// 📦 CACHE SETTINGS
$userId = $_SESSION['user_id'];

$dir = "cached/workout_plans/$userId/";

// ✅ Create folder if it doesn't exist
if (!is_dir($dir)) {
    mkdir($dir, 0777, true);
}

// ✅ Cache file path (MISSING BEFORE)
$cacheFile = $dir . "{$fitnessLevel}_{$bmiCategory}_workout_plan.json";

$cacheTime = 84000; // 1 hour

// 🔥 Use cache if available
if (file_exists($cacheFile) && (time() - filemtime($cacheFile)) < $cacheTime) {

    echo file_get_contents($cacheFile);
    exit;
}

// 🌐 Call RapidAPI
$curl = curl_init();

curl_setopt_array($curl, [
    CURLOPT_URL => "https://ai-workout-planner-exercise-fitness-nutrition-guide.p.rapidapi.com/generateWorkoutPlan?noqueue=1",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => json_encode($postData),
    CURLOPT_HTTPHEADER => [
        "Content-Type: application/json",
        "x-rapidapi-host: ai-workout-planner-exercise-fitness-nutrition-guide.p.rapidapi.com",
        "x-rapidapi-key: " . $api_key
    ],
]);

$response = curl_exec($curl);
$error = curl_error($curl);
$httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

curl_close($curl);

// ❌ Handle cURL error
if ($error) {
    echo json_encode([
        "success" => false,
        "message" => $error
    ]);
    exit;
}

// ❌ Handle API failure
if ($httpCode !== 200) {
    echo json_encode([
        "success" => false,
        "message" => "API request failed",
        "status" => $httpCode
    ]);
    exit;
}

// 💾 Save cache
file_put_contents($cacheFile, $response);

// 📤 Return API response to frontend
echo $response;
?>