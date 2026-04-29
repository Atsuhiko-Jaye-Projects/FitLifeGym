<?php
class User{
    
    private $conn;
    private $table_name = "users";

    public $id;
    public $firstname;
    public $lastname;
    public $email_address;
    public $password;
    public $created_at;
    public $contact_no;
    public $modified_at;
    public $access_level;
    public $existing_plan;
    public $first_time_logged_in;
    public $profile_image;

    public function __construct($db){
        $this->conn = $db;
    }

    function createUser(){

        $query = "INSERT  INTO 
                    " . $this->table_name . "
                    SET
                    firstname = :firstname,
                    lastname=:lastname,
                    email_address = :email_address,
                    password = :password,
                    contact_no = :contact_no,
                    access_level = 'Client',
                    created_at = :created_at";
        
        $stmt = $this->conn->prepare($query);

        $this->firstname=htmlspecialchars(strip_tags($this->firstname));
        $this->lastname=htmlspecialchars(strip_tags($this->lastname));
        $this->email_address=htmlspecialchars(strip_tags($this->email_address));
        $this->password=htmlspecialchars(strip_tags($this->password));
        $this->contact_no=htmlspecialchars(strip_tags($this->contact_no));
        $this->created_at = date("Y-m-d H-i:s");

        $password_hash = password_hash($this->password, PASSWORD_BCRYPT);
        $stmt->bindParam(":firstname", $this->firstname);
        $stmt->bindParam(":lastname", $this->lastname);
        $stmt->bindParam(":email_address", $this->email_address);
        $stmt->bindParam(":password", $password_hash);
        $stmt->bindParam(":contact_no", $this->contact_no);
        $stmt->bindParam(":created_at", $this->created_at);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    function EmailAlreadyTaken() {

        $query = "SELECT id 
                FROM " . $this->table_name . " 
                WHERE email_address = :email_address 
                LIMIT 1";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":email_address", $this->email_address);

        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return true; // already exists
        }
        return false; // available
    }

    function ContactAlreadyTaken() {

        $query = "SELECT id 
                FROM " . $this->table_name . " 
                WHERE email_address = :email_address 
                LIMIT 1";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":email_address", $this->email_address);

        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return true; // already exists
        }
        return false; // available
    }

    // check if given email exist in the database
    function emailExists(){
        // query to check if email exists
        $query = "SELECT id, firstname, lastname, password, access_level, first_time_logged_in, existing_plan
                FROM " . $this->table_name . "
                WHERE email_address = ?
                LIMIT 0,1";
        // prepare the query
        $stmt = $this->conn->prepare( $query );
        // sanitize
        $this->email_address=htmlspecialchars(strip_tags($this->email_address));
        // bind given email value
        $stmt->bindParam(1, $this->email_address);
        // execute the query
        $stmt->execute();
        // get number of rows
        $num = $stmt->rowCount();
        // if email exists, assign values to object properties for easy access and use for php sessions
        if($num>0){
            // get record details / values
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            // assign values to object properties
            $this->id = $row['id'];

            $this->firstname = $row['firstname'];
            $this->lastname = $row['lastname'];
            $this->password = $row['password'];
            $this->access_level = $row['access_level'];
            $this->first_time_logged_in = $row['first_time_logged_in'];
            $this->existing_plan = $row['existing_plan'];
            // return true because email exists in the database
            return true;
        }
        // return false if email does not exist in the database
        return false;
    }

    function updateFLI(){
        $query = "UPDATE 
                    " . $this->table_name . "
                  SET
                    first_time_logged_in = 0
                  WHERE
                    id = :id";
        
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":id", $this->id);
        $stmt->execute();
    }

    function UpdatePlanStatus(){

        $query = "UPDATE " . $this->table_name . "
                  SET
                  existing_plan = '1'
                  WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":id", $this->id);
        
        $stmt->execute();
    }

    function getProfileDetails(){

        $query = "SELECT *
                  FROM 
                    " . $this->table_name ." 
                    WHERE id = :id
                    LIMIT 0,1";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":id", $this->id);

        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->firstname = $row['firstname'];
        $this->lastname = $row['lastname'];
        $this->email_address = $row['email_address'];
        $this->password = $row['password'];
        $this->contact_no = $row['contact_no'];
        $this->profile_image = $row['profile_image'];
    }

    function UpdateUserProfile(){

        $query = "UPDATE " . $this->table_name . "
                SET
                firstname = :firstname,
                lastname = :lastname,
                email_address = :email_address,
                contact_no = :contact_no,
                modified_at = :modified_at,
                profile_image = :profile_image";

        // Only include password if it's not empty
        if (!empty($this->password)) {
            $query .= ", password = :password";
        }

        $query .= " WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        $this->modified_at = date("Y-m-d H:i:s");

        $stmt->bindParam(":id", $this->id);
        $stmt->bindParam(":firstname", $this->firstname);
        $stmt->bindParam(":lastname", $this->lastname);
        $stmt->bindParam(":email_address", $this->email_address);
        $stmt->bindParam(":contact_no", $this->contact_no);
        $stmt->bindParam(":modified_at", $this->modified_at);
        $stmt->bindParam(":profile_image", $this->profile_image);

        // password only if provided
        if (!empty($this->password)) {
            $hashedPassword = password_hash($this->password, PASSWORD_DEFAULT);
            $stmt->bindParam(":password", $hashedPassword);
        }

        return $stmt->execute();
    }

    function EmailAlreadyTakenById() {

        $query = "SELECT id 
                FROM " . $this->table_name . " 
                WHERE email_address = :email_address 
                AND id != :id
                LIMIT 1";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":email_address", $this->email_address);
        $stmt->bindParam(":id", $this->id);

        $stmt->execute();

        return $stmt->rowCount() > 0;
    }

    function ContactAlreadyTakenById() {

        $query = "SELECT id 
                FROM " . $this->table_name . " 
                WHERE contact_no = :contact_no 
                AND id != :id
                LIMIT 1";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":contact_no", $this->contact_no);
        $stmt->bindParam(":id", $this->id);

        $stmt->execute();

        return $stmt->rowCount() > 0;
    }

    function uploadImage() {
        if (!isset($_FILES['image']) || $_FILES['image']['error'] !== 0) {
            return ["status" => false, "message" => "No file uploaded or upload error."];
        }

        $file = $_FILES['image'];

        // Allowed types
        $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];

        $fileName = $file['name'];
        $fileTmp = $file['tmp_name'];
        $fileSize = $file['size'];
        $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        // Validate type
        if (!in_array($fileExt, $allowedTypes)) {
            return ["status" => false, "message" => "Invalid file type."];
        }

        // Validate size (2MB max)
        if ($fileSize > 2 * 1024 * 1024) {
            return ["status" => false, "message" => "File too large (max 2MB)."];
        }

        // Target directory
        $targetDir = "../uploads/{$this->id}/";

        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        // Unique filename
        $newFileName = uniqid("IMG_", true) . "." . $fileExt;
        $targetPath = $targetDir . $newFileName;

        // Move file
        if (move_uploaded_file($fileTmp, $targetPath)) {
            return [
                "status" => true,
                "file_path" => $targetPath,
                "file_name" => $newFileName
            ];
        } else {
            return ["status" => false, "message" => "Upload failed."];
        }
    }

    function UpdateExistingPlan(){

        $query = "UPDATE 
                    " . $this->table_name . "
                SET
                    existing_plan = '0',
                    modified_at = :modified_at
                WHERE    
                    id = :id";

        $stmt = $this->conn->prepare($query);

        $this->modified_at = date("Y-m-d H:i:s");

        $stmt->bindParam(":id", $this->id);
        $stmt->bindParam(":modified_at", $this->modified_at);

        if($stmt->execute()){
            return $stmt->rowCount() > 0; // true if updated
        }

        return false;
    }
}



?>