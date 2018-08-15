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

     if (!empty($_POST['content'])) {

        $user->addPerso($_POST['tuto'],$_SESSION['user_id']);

    } 

?>

<form action="">
    <input type="text" placeholder="your content here" name="tuto">
    <input type="submit" name="content">
</form>