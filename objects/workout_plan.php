<?php

class WorkOutPlan{

    private $conn;
    private $table_name = "workout_plans";

    public $id;
    public $workout_plan_id;
    public $workout_plan;
    public $client_id;
    public $level;
    public $duration;
    public $day_per_week;
    public $current_bmi;
    public $created_at;
    public $modified_at;


    public function __construct($db){
        $this->conn = $db;
    }

    function generateStrictId() {
        $letters = strtoupper(substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 3));
        $numbers = str_pad(rand(0, 999), 3, "0", STR_PAD_LEFT);
        $time = date("His");

        return "WORKOUT_" . $letters . $numbers . "_" . $time;
    }

    function createPlan(){
        $query = "INSERT INTO
                    " . $this->table_name . "
                    SET
                    workout_plan_id=:workout_plan_id,
                    workout_plan=:workout_plan,
                    level = :level,
                    client_id=:client_id,
                    duration=:duration,
                    day_per_week=:day_per_week,
                    current_bmi=:current_bmi,
                    created_at=:created_at";

        $stmt = $this->conn->prepare($query);

        $this->created_at = date("Y-m-d H:i:s");

        $stmt->bindParam(":workout_plan_id", $this->workout_plan_id);
        $stmt->bindParam(":workout_plan", $this->workout_plan);
        $stmt->bindParam(":level", $this->level);
        $stmt->bindParam(":client_id", $this->client_id);
        $stmt->bindParam(":duration", $this->duration);
        $stmt->bindParam(":day_per_week", $this->day_per_week);
        $stmt->bindParam(":current_bmi", $this->current_bmi);
        $stmt->bindParam(":created_at", $this->created_at);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    function getWorkoutPlanPreset($bmiCategory, $fitnessLevel) {

        $plans = [

            "Normal" => [
                "Beginner" => [
                    "goal" => "Maintain fitness and improve overall health",
                    "days_per_week" => 3,
                    "session_duration" => 45,
                    "focus" => "Light strength training + cardio + mobility",
                    "intensity" => "Low"
                ],
                "Intermediate" => [
                    "goal" => "Improve strength and conditioning",
                    "days_per_week" => 4,
                    "session_duration" => 60,
                    "focus" => "Upper/Lower split + cardio",
                    "intensity" => "Moderate"
                ],
                "Advanced" => [
                    "goal" => "Enhance performance and body composition",
                    "days_per_week" => 5,
                    "session_duration" => 75,
                    "focus" => "Push/Pull/Legs + HIIT",
                    "intensity" => "High"
                ]
            ],

            "Underweight" => [
                "Beginner" => [
                    "goal" => "Healthy weight gain and muscle building",
                    "days_per_week" => 3,
                    "session_duration" => 45,
                    "focus" => "Full body compound exercises",
                    "intensity" => "Low"
                ],
                "Intermediate" => [
                    "goal" => "Muscle growth and strength gain",
                    "days_per_week" => 4,
                    "session_duration" => 60,
                    "focus" => "Progressive overload strength training",
                    "intensity" => "Moderate"
                ],
                "Advanced" => [
                    "goal" => "Lean bulk and hypertrophy",
                    "days_per_week" => 5,
                    "session_duration" => 75,
                    "focus" => "Split training (Push/Pull/Legs)",
                    "intensity" => "High"
                ]
            ],

            "Overweight" => [
                "Beginner" => [
                    "goal" => "Fat loss and habit building",
                    "days_per_week" => 3,
                    "session_duration" => 40,
                    "focus" => "Walking + light full-body workouts",
                    "intensity" => "Low"
                ],
                "Intermediate" => [
                    "goal" => "Fat loss and improved endurance",
                    "days_per_week" => 4,
                    "session_duration" => 60,
                    "focus" => "Cardio + circuit training",
                    "intensity" => "Moderate"
                ],
                "Advanced" => [
                    "goal" => "Fat loss and high performance conditioning",
                    "days_per_week" => 5,
                    "session_duration" => 75,
                    "focus" => "HIIT + strength training split",
                    "intensity" => "High"
                ]
            ],

            "Obese" => [
                "Beginner" => [
                    "goal" => "Safe fat loss and mobility improvement",
                    "days_per_week" => 3,
                    "session_duration" => 30,
                    "focus" => "Low-impact walking + mobility exercises",
                    "intensity" => "Very Low"
                ],
                "Intermediate" => [
                    "goal" => "Fat loss and endurance building",
                    "days_per_week" => 4,
                    "session_duration" => 45,
                    "focus" => "Low-impact cardio + bodyweight training",
                    "intensity" => "Low-Moderate"
                ],
                "Advanced" => [
                    "goal" => "Fat loss and functional strength",
                    "days_per_week" => 5,
                    "session_duration" => 60,
                    "focus" => "Modified HIIT + strength training",
                    "intensity" => "Moderate"
                ]
            ]

        ];
        return $plans[$bmiCategory][$fitnessLevel] ?? null;
    }

    function getWorkouPlan(){
        //$api_key = "84d8ea7676msh76a4e10a3644b32p189eaajsn270733f271d7";
        $api_key = "107f302fd6mshf0a1b2d2cd102c9p1b84b8jsn8754d48f6207";
        //$api_key = "4bebdd4178mshb8f77b0636e7cf3p102494jsnad50919c43f5";
        //$api_key = "737704916dmsh0cecf15cc44fed6p149448jsn50a8a1f1b68e";

        $cacheFile = 'workout_cache.json';
        $cacheTime = 3600; // 1 hour

        // ✅ CHECK CACHE FIRST
        if (file_exists($cacheFile) && (time() - filemtime($cacheFile)) < $cacheTime) {
            $response = file_get_contents($cacheFile);
            $err = null;
            $status = 200;
        } else {

            $curl = curl_init();

            curl_setopt_array($curl, [
                CURLOPT_URL => "https://ai-workout-planner-exercise-fitness-nutrition-guide.p.rapidapi.com/generateWorkoutPlan?noqueue=1",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_POST => true,
                CURLOPT_POSTFIELDS => json_encode([
                    'goal' => 'Cardio',
                    'fitness_level' => 'Beginner',
                    'preferences' => ['Weight training', 'Cardio'],
                    'health_conditions' => ['None'],
                    'schedule' => [
                        'days_per_week' => 3,
                        'session_duration' => 30
                    ],
                    'plan_duration_weeks' => 4,
                    'lang' => 'en'
                ]),
                CURLOPT_HTTPHEADER => [
                    "Content-Type: application/json",
                    "x-rapidapi-host: ai-workout-planner-exercise-fitness-nutrition-guide.p.rapidapi.com",
                    "x-rapidapi-key: " . $api_key
                ],
            ]);

            $response = curl_exec($curl);
            $err = curl_error($curl);
            $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

            curl_close($curl);

            // ✅ SAVE CACHE IF SUCCESS
            if (!$err && $status === 200) {
                file_put_contents($cacheFile, $response);
            }
        }

        // ✅ DECODE RESPONSE
        $data = json_decode($response, true);
    }



}
