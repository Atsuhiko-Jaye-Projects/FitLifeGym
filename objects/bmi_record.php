<?php
class BMIRecord{
    
    private $conn;
    private $table_name = "bmi_records";

    public $id;
    public $client_id;
    public $weight;
    public $height;
    public $BMI;
    public $bmi_classification;
    public $recomended_weight;
    public $created_at;
    public $modified_at;

    public function __construct($db){
        $this->conn = $db;
    }

    public function createBMIRecord() {

        $query = "INSERT INTO " . $this->table_name . "
                SET client_id = :client_id,
                    weight = :weight,
                    height = :height,
                    bmi = :bmi,
                    bmi_classification = :bmi_classification,
                    status = 'No Plan',
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

    function checkBmiRecord() {
        $query = "SELECT * FROM " . $this->table_name . "
                WHERE client_id = :client_id
                LIMIT 1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":client_id", $this->client_id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $this->bmi = $row['BMI'] ?? null;
            $this->status = $row['status'] ?? null;
            $this->bmi_classification = $row['bmi_classification'] ?? null;
            return true;
        }

    }




}
?>