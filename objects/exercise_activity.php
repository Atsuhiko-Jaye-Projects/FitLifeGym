<?php

class ExerciseActivity{

    private $conn;
    private $table_name = "exercise_activities";

    public $id;
    public $workout_plan_id;
    public $name;
    public $client_id;
    public $duration;
    public $units;
    public $cycle;
    public $set_per_exercise;
    public $day;
    public $created_at;
    public $modified_at;


    public function __construct($db){
        $this->conn = $db;
    }

    function createExerciseAct(){

        $query = "INSERT INTO " . $this->table_name . " 
                SET
                    workout_plan_id = :workout_plan_id,
                    name = :name,
                    client_id = :client_id,
                    duration = :duration,
                    units = :unit,
                    cycle = :cycle,
                    set_per_exercise = :set_per_exercise,
                    day = :day,
                    created_at = :created_at";

        $stmt = $this->conn->prepare($query);

        // Bind values
        $stmt->bindParam(':workout_plan_id', $this->workout_plan_id);
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':client_id', $this->client_id);
        $stmt->bindParam(':duration', $this->duration);
        $stmt->bindParam(':unit', $this->unit);
        $stmt->bindParam(':cycle', $this->cycle);
        $stmt->bindParam(':set_per_exercise', $this->set_per_exercise);
        $stmt->bindParam(':day', $this->day);

        // Example timestamp
        $created_at = date('Y-m-d H:i:s');
        $stmt->bindParam(':created_at', $created_at);

        // Execute
        if($stmt->execute()){
            return true;
        }

        return false;
    }
}

?>