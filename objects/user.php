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
        $query = "SELECT id, firstname, lastname, password, access_level
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
            // return true because email exists in the database
            return true;
        }
        // return false if email does not exist in the database
        return false;
    }
}



?>