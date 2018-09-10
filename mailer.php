<?php

include_once "config/database.php";
include_once "objects/user.php";
     
    // get database connection
    $database = new Database();
    $db = $database->getConnection();
    $user = new User($db);

    use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

$mail = new PHPMailer(true);         

$userexist = $user->Testmail();


if(isset($_POST['send'])){
    if(!$userexist){


try {
    //Server settings
    $mail->SMTPDebug = 2;                               
    $mail->isSMTP();                                     
    $mail->Host = 'smtp.gmail.com';  
    $mail->SMTPAuth = true;                               
    $mail->Username = 'herijaona3@gmail.com';               
    $mail->Password = 'Herijaona30';                           
    $mail->SMTPSecure = 'tls';                            
    $mail->Port = 587;                                 

    //Recipients
    // $rec = $_POST['rec'];

    $mail->setFrom('herijaona3@gmail.com', 'Mailer');
    $mail->addAddress(($_POST['rec']), 'Joe User');   

    //Content
    $mail->isHTML(true);                                
    $mail->Subject = 'This is a test mail';

    $user->addChef();

    $iv = $_SESSION['users_id'];
    $user->addId($_SESSION['users_id']);

    $stmt = $db->query('SELECT id FROM users WHERE email=\'' . $_POST['rec'] . '\' ORDER BY id DESC LIMIT 1');
    $use = $stmt->fetch();

    // $p_hash = password_hash($use['0'], PASSWORD_BCRYPT);

    

    $mail->Body    = '<a href="'.$_SERVER['SERVER_NAME'].'/index.php?id='.$use['0'].'">Cliquez ici</a>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';

    
    } catch (Exception $e) {
    echo '-------Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
}

}else{
    echo 'user deja existe';
}

}


$stmt = $db->prepare("SELECT id FROM users WHERE id=?");
$stmt->bindParam(1, $_GET['id']);
$stmt->execute();
$usn = $stmt->fetch();


if(isset($_GET['id']) AND isset($_GET['idphoto'])){
    if($usn['id']   ==  $_GET['id']){
        echo 'reussite';

        $idusn = $usn['id'];
        $idph = $_GET['idphoto'];

        $sql = "INSERT INTO chefdeservice (id_users,id_prime) VALUES ('".$idusn."','".$idph."')";
        $db->prepare($sql)->execute();

        // $sql = 'UPDATE users SET access_lavel="1" WHERE id=\'' . $_GET['id'] . '\';';
        // $stmt = $conn->prepare($sql);
        // $stmt->execute();

    }else{
        echo 'echoue';
    }



}

?>

