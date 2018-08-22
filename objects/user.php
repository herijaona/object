<?php
// 'user' object
class User{

    public $attribut = 'Voici un attribut';
 
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

public function getCompany(){
    global $db;
    $q = $db->query('SELECT * FROM prime');
    $u = $q->execute();
    $resultado = $q->fetchAll();
    return $resultado;
}

public function getid(){
    global $db;
    $q = $db->query('SELECT * FROM prime WHERE email = ?');
    $q->bindParam(1, $_POST['tuto']);
    $u = $q->execute();
    $resultado = $q->fetchAll();
    return $resultado ;
}

public function val_in_arr(){
    global $db;
    $getone = new User($db);
    $res = $getone->getid();
    foreach($res as $arr_val){
      $v =  $arr_val['photo'];
     $pieces = explode(" ",  $v);
    echo $p = $pieces['0'];
    }
    return false;
  }
public function error(){
    return $this->attribut;
}

public function addTable($iduser){
    global $db;
    $getone = new User($db);
    
    $err = $getone->error();

    $em =$_POST['tuto'];
    $q = $db->prepare('SELECT * FROM prime WHERE photo = ?');
    // compare si un champ existe deja
    // return photo = nom du photo
    $q->bindParam(1, $em, PDO::PARAM_INT);
    $q->execute();
    $resultado = $q->fetchAll();

    if($resultado){
        echo $err ;
    }elseif($em == null){
        echo 'tsisy';
    }else{
        try {
            $tuto = $_POST['tuto'];
            $sql = "INSERT INTO prime(users_id,photo) VALUES ('".$iduser."','".$tuto."')";
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
public function deleteRow(){
    global $db;
    $id = $_POST['id'];
    $photo = $_POST['photo'];
    $stmt = $db->prepare( "DELETE FROM prime WHERE id =:id AND photo =:photo" );
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':photo', $photo);
    $stmt->execute();
}

public function getRow(){
    global $db;
    $q = $db->query('SELECT * FROM prime WHERE id=34');
    $u = $q->execute();
    $resultado = $q->fetchAll();
    return $resultado;
}

}