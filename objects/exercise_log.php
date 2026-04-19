<?php
class ExerciseLog{

    private $conn;
    private $table_name = "training_logs";

    public $id;
    public $workplan_id;
    public $workout;
    public $sets;
    public $duration;
    public $status;
    public $created_at;
    public $modified_at;
    public $exercise_id;
    public $day;
    public $progress;
    

    public function __construct($db){
        $this->conn = $db;
    }

    function createExerciseLog(){

        $query = "INSERT INTO " . $this->table_name . "
                SET
                exercise_id = :exercise_id,
                workplan_id = :workplan_id,
                workout = :workout,
                sets = :sets,
                day = :day,
                duration = :duration,
                status = :status,
                created_at = :created_at,
                progress = :progress";
        
        $stmt = $this->conn->prepare($query);

        // Set timestamp
        $this->created_at = date("Y-m-d H:i:s");

        // Bind parameters
        $stmt->bindParam(":exercise_id", $this->exercise_id);
        $stmt->bindParam(":workplan_id", $this->workplan_id);
        $stmt->bindParam(":workout", $this->workout);
        $stmt->bindParam(":sets", $this->sets);
        $stmt->bindParam(":duration", $this->duration);
        $stmt->bindParam(":status", $this->status);
        $stmt->bindParam(":day", $this->day);
        $stmt->bindParam(":created_at", $this->created_at);
        $stmt->bindParam(":progress", $this->progress);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    function updateExerciseLog(){

        $query = "UPDATE " . $this->table_name . "
                SET
                status = :status,
                modified_at = :modified_at,
                progress = :progress
                WHERE
                exercise_id = :exercise_id";
        
        $stmt = $this->conn->prepare($query);

        // Set timestamp
        $this->modified_at = date("Y-m-d H:i:s");

        // Bind parameters
        $stmt->bindParam(":exercise_id", $this->exercise_id);
        $stmt->bindParam(":status", $this->status);
        $stmt->bindParam(":modified_at", $this->modified_at);
        $stmt->bindParam(":progress", $this->progress);

        if ($stmt->execute()) {
            return true;
        }

        return false;
        return $stmt;
    }

}
?>