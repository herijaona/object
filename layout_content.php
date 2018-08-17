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
        $user->addTable($iduser); 
    } 

?>

<script  type="text/javascript" src="test.php"></script>

<form action="index.html" method="post">
    <input type="text" placeholder="your content here" name="tuto">
    <input type="submit" name="content">
</form>




<h3>Add input :</h3>

<h2><a href="#" id="addScnt" class="add">Add Another Input Box</a></h2>

<div id="p_scents">
    <p>
        <label for="p_scnts"><input type="text" id="p_scnt" size="20" name="p_scnt" value="" placeholder="Input Value" /></label>
    </p>
</div>

<div class="testo">
test
</div>


<script>
    
    $(document).ready(function() { 
        var i = 1;
        $('.add').click(function(){
            $('.testo').append('<p name="' + i + '" id="cool">testtddsd <a class="delete">delete</a></p>');
            i++;
        });   
        $(".testo").find("#cool").find(".delete").click(function(){
            alert('ok');
        }); 
    });


</script>