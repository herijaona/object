<?php


    include_once "config/database.php";
    include_once "objects/user.php";
     
    // get database connection
    $database = new Database();
    $db = $database->getConnection();

    $user = new User($db);

    $app = $user->UserDetails($_SESSION['user_id']); 

     echo $app->firstname;
     echo $app->id;
      $iduser = $app->id;

     if (!empty($_POST['content'])) {

        try {
            $conn = new PDO("mysql:host=localhost;dbname=php_cs", 'root', 'root');
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
            $stmt = $conn->prepare("SELECT id FROM users WHERE id='".$iduser."'"); 
            $stmt->execute();
            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 
            $tuto = $_POST['tuto'];
            $sql = "INSERT INTO prime(users_id,photo) VALUES ('".$iduser."','".$tuto."')";
            // use exec() because no results are returned
        
            $conn->exec($sql);
        
            echo "Connected successfully"; 
            }
        catch(PDOException $e)
            {
            echo "Connection failed: " . $e->getMessage();
            }
        $conn = null;

    } 

?>

<form action="index.php" method="post">
    <input type="text" placeholder="your content here" name="tuto">
    <input type="submit" name="content">
</form>