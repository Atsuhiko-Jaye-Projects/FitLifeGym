<?php
class BMIRecordHistory{
    
    private $conn;
    private $table_name = "user_bmi_histories";

    public $id;
    public $client_id;
    public $weight;
    public $height;
    public $BMI;
    public $bmi_classification;
    public $workout_plan_id;
    public $recomended_weight;
    public $created_at;

    public function __construct($db){
        $this->conn = $db;
    }

    function CreateBMIHistory(){

        $query = "INSERT INTO " . $this->table_name . "
                SET client_id = :client_id,
                    weight = :weight,
                    height = :height,
                    bmi = :bmi,
                    bmi_classification = :bmi_classification,
                    created_at = :created_at";

        $stmt = $this->conn->prepare($query);

        // Set created_at timestamp
        $this->created_at = date("Y-m-d H:i:s");

        // Bind parameters
        $stmt->bindParam(":client_id", $this->client_id);
        $stmt->bindParam(":weight", $this->weight);
        $stmt->bindParam(":height", $this->height);
        $stmt->bindParam(":bmi", $this->bmi);
        $stmt->bindParam(":bmi_classification", $this->bmi_classification);
        $stmt->bindParam(":created_at", $this->created_at);

        // Execute query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    function getBmiHistory(){

        $query = "SELECT * 
                FROM " . $this->table_name . "
                WHERE client_id = :client_id
                ORDER BY created_at DESC";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":client_id", $this->client_id);

        $stmt->execute();

        return $stmt;
    }


}

?>