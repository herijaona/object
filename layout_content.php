<?php


    include_once "config/database.php";
    include_once "objects/user.php";
     
    // get database connection
    $database = new Database();
    $db = $database->getConnection();

    $user = new User($db);

    $app = $user->UserDetails($_SESSION['users_id']); 

    echo  $_SESSION['users_id'];
     echo $app->firstname;
     echo $app->id;
     $iduser = $app->id;

     if (!empty($_POST['content'])) {
        
        $user->addTable($iduser,$db); 
    } 
   
  $obj =  $user->getCompany();
    // print_r($obj);


 $top = $user->getOnecompany($_SESSION['users_id']);

// $user->testo();


  if( isset($_POST['delete'])){
    if( isset( $_POST['id'] ) && is_numeric( $_POST['id'] ) && $_POST['id'] > 0 && isset( $_POST['photo'] )  )
    {
        $user->deleteRow();
    }

}

if (isset($_GET['id'])) 
{
    $b =  $user->getRow();
    foreach($b as $t ){  
         echo "----".$t['photo'];
    }
}
else 
{
	echo 'Il faut renseigner un nom et un prénom !';
}
?>

<script  type="text/javascript" src="test.php"></script>

<form action="index.html" method="post">
    <input type="text" placeholder="your content here" name="tuto">
    <input type="submit" name="content">
</form>

<div class="container">
    <div class="row">
    <?php while ($donnees =  $top->fetch())  {  ?>
    <div class="col-3 mt-2 mb-2">
        <div class="border p-3">
            <span class="poire"><?php  echo $donnees['photo'];  ?></span>
            <form action="index.html" method="post">
                <input type="hidden" name="delete" value="yes" />
                <input type="hidden" name="photo" value="<?php echo $donnees['photo'] ?>" />
                <input type="hidden" name="id" value="<?php echo $donnees['id'] ?>" />
                <input type="submit" class="button" name="delete" value="DELETE NEWS" />
            </form>
            <div class=" row"><input class="mt-2" type="text"><button>send</button></div>
        </div>
    </div>
    <?php } ?>
    </div>
</div>




<!-- affiche all company -->
<!-- <div class="container">
    <div class="row">
        <?php foreach($obj as $t ){  ?>
        <div class="col-3 mt-2 mb-2">
            <div class="border p-3">
                <span class="poire"><?php  echo $t['photo'];  ?></span>
                <form action="index.html" method="post">
                    <input type="hidden" name="delete" value="yes" />
                    <input type="hidden" name="photo" value="<?php echo $t['photo'] ?>" />
                    <input type="hidden" name="id" value="<?php echo $t['id'] ?>" />
                    <input type="submit" class="button" name="delete" value="DELETE NEWS" />
                </form>
                <a href="http://localhost/phpcrn/index.html?<?php ?>">More</a>
            </div>
        </div>
        <?php }  ?>
    </div>
</div> -->


<!-- <h3>Add input :</h3>
<div class="input_fields_wrap">
    <button class="add_field_button">Add More Fields</button>
    <form action="index.html" method="post">
    <div><input type="text" name="mytext[]" value=""></div>
    <input type="submit"value="ok">
    </form>
</div> -->

<!-- <script>
    $(document).ready(function() {
    var max_fields      = 10; 
    var wrapper         = $(".input_fields_wrap");
    var add_button      = $(".add_field_button"); 
    
    var x = 0; 
    $(add_button).click(function(e){ 
        e.preventDefault();
        if(x < max_fields){ 
            x++; 
            $(wrapper).append('<div><input type="text" name="mytext[]"/><a href="#" class="remove_field">Remove</a></div>'); //add input box
        }
    });
    
    $(wrapper).on("click",".remove_field", function(e){ 
        e.preventDefault(); $(this).parent('div').remove(); x--;
    });
});
</script> -->


