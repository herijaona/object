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

public function create(){
 
    // to get time stamp for 'created' field
    $this->created=date('Y-m-d H:i:s');
 
    // insert query
    $query = "INSERT INTO
                " . $this->table_name . "
            SET
                firstname = :firstname,
                lastname = :lastname,
                email = :email,
                contact_number = :contact_number,
                address = :address,
                password = :password,
                access_level = :access_level,
                status = :status,
                created = :created";
 
    // prepare the query
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $this->firstname=htmlspecialchars(strip_tags($this->firstname));
    $this->lastname=htmlspecialchars(strip_tags($this->lastname));
    $this->email=htmlspecialchars(strip_tags($this->email));
    $this->contact_number=htmlspecialchars(strip_tags($this->contact_number));
    $this->address=htmlspecialchars(strip_tags($this->address));
    $this->password=htmlspecialchars(strip_tags($this->password));
    $this->access_level=htmlspecialchars(strip_tags($this->access_level));
    $this->status=htmlspecialchars(strip_tags($this->status));
 
    // bind the values
    $stmt->bindParam(':firstname', $this->firstname);
    $stmt->bindParam(':lastname', $this->lastname);
    $stmt->bindParam(':email', $this->email);
    $stmt->bindParam(':contact_number', $this->contact_number);
    $stmt->bindParam(':address', $this->address);
 
    // hash the password before saving to database
    $password_hash = password_hash($this->password, PASSWORD_BCRYPT);
    $stmt->bindParam(':password', $password_hash);
 
    $stmt->bindParam(':access_level', $this->access_level);
    $stmt->bindParam(':status', $this->status);
    $stmt->bindParam(':created', $this->created);
 
    // execute the query, also check if query was successful
    if($stmt->execute()){
        return true;
    }else{
        $this->showError($stmt);
        return false;
    }
 
}

public function showError($stmt){
    echo "<pre>";
        print_r($stmt->errorInfo());
    echo "</pre>";
}

public function getOnecompany($users_id){
    global $db;
    $q =  $db->prepare("SELECT e.lastname, u.photo,u.id,u.users_id 
                        FROM users AS e 
                        INNER JOIN prime AS u ON e.id = u.users_id 
                        WHERE users_id=:users_id");
    $q->bindParam("users_id", $users_id, PDO::PARAM_STR);
    $q->execute();
    // if ($q->rowCount() > 0) {
    //     $i =  $q->fetch();
    //     return $i;
    // }
        return $q;


}

// OR
// public function testo(){
//     global $db;
//     $q = $db->query('SELECT *
//     FROM users
//     INNER JOIN prime ON users.id = prime.users_id
//     WHERE users.lastname = \'herijaona\'');
//     while ($donnees = $q->fetch())
// {
//    echo $donnees['photo'] . '<br />';
// }

// }



}