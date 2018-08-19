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
        
        $user->addTable($iduser,$db); 
    } 
   
  $obj =  $user->getCompany();


  

  

?>

<script  type="text/javascript" src="test.php"></script>

<form action="index.html" method="post">
    <input type="text" placeholder="your content here" name="tuto">
    <input type="submit" name="content">
</form>

<div class="container">
    <div class="row">
        <?php foreach($obj as $t ){  ?>
        <div class="col-3 mt-2 mb-2">
            <div class="border p-3">
                <?php  echo $t['photo'];  ?>
            </div>
        </div>
        <?php }  ?>
    </div>
</div>


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


