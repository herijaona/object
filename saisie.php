<?php


include_once "config/database.php";
include_once "objects/user.php";
 
// get database connection
$database = new Database();
$db = $database->getConnection();
$user = new User($db);

$req = $user->getPrime($_SESSION['users_id']);
foreach($req as $n){
echo $n['id'];

?>
<a href="/object/index.html?id_prime=<?php echo $n['id']; ?>">volume id</a>
<?php

}

$pot = $user->getsociete($_SESSION['users_id']);
echo $pot['photo'];

if(isset($_POST['saisie'])){
    if(!empty($_POST['description']) AND !empty($_POST['temperature'])){
       $id_users = $_SESSION['users_id'];
       $description = $_POST['description'];
       $temperature = $_POST['temperature'];
       $id_prime = $_GET['id_prime'];
       $user->addsaisie($description,$temperature,$id_users,$id_prime); 
    }   
}

?>
<div>
    <form action="index.html?id_prime=<?php echo $_GET['id_prime'] ?>" method="post">
        <input type="text" placeholder="description" name="description">
        <input type="text" placeholder="temperature" name="temperature">
        <input type="submit" value="valider" name="saisie">
    </form>
</div>