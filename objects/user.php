<?php
// 'user' object
class User{
 
    // database connection and table name
    private $conn;
    private $table_name = "users";
 
    // object properties
    public $id;
    public $firstname;
    public $lastname;
    public $email;
    public $contact_number;
    public $address;
    public $password;
    public $access_level;
    public $access_code;
    public $status;
    public $created;
    public $modified;
 
    // constructor
    public function __construct($db){
        $this->conn = $db;
    }
    // check if given email exist in the database
function emailExists(){
 
    // query to check if email exists
    $query = "SELECT id, firstname, lastname, access_level, password, status
            FROM " . $this->table_name . "
            WHERE email = ?
            LIMIT 0,1";
 
    // prepare the query
    $stmt = $this->conn->prepare( $query );
 
    // sanitize
    $this->email=htmlspecialchars(strip_tags($this->email));
 
    // bind given email value
    $stmt->bindParam(1, $this->email);
 
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
        $this->access_level = $row['access_level'];
        $this->password = $row['password'];
        $this->status = $row['status'];
 
        // return true because email exists in the database
        return true;
    }
 
    // return false if email does not exist in the database
    return false;
}

public function UserDetails($id)
{
    try {
        $query = $this->conn->prepare("SELECT id, firstname, lastname, email FROM users WHERE id=:id");
        $query->bindParam("id", $id, PDO::PARAM_STR);
        $query->execute();
        if ($query->rowCount() > 0) {
            return $query->fetch(PDO::FETCH_OBJ);
        }
    } catch (PDOException $e) {
        exit($e->getMessage());
    }
}

public function addPerso($tuto,$t){
    try {
        $query = $this->conn->prepare("INSERT INTO users(id, tuto)
        SELECT $t
        FROM users LEFT JOIN permis AS userS ON user.id = userS.users_id");
        $query->bindParam("tuto", $tuto, PDO::PARAM_STR);
        $query->execute();
        return $db->lastInsertId();
    } catch (PDOException $e) {
        exit($e->getMessage());
    }
}

public function addTable($iduser){
    try {
        $stmt =  $this->conn->prepare("SELECT id FROM users WHERE id='".$iduser."'"); 
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 
        $tuto = $_POST['tuto'];
        $sql = "INSERT INTO prime(users_id,photo) VALUES ('".$iduser."','".$tuto."')";
        // use exec() because no results are returned
    
        $this->conn->exec($sql);
    
        echo "Connected successfully"; 
        }
    catch(PDOException $e)
        {
        echo "Connection failed: " . $e->getMessage();
        }
        $this->conn = null;
}

}