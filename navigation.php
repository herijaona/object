<!-- navbar -->


<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarColor02">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Features</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Pricing</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">About</a>
        </li>
      </ul>
      <?php
            if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']==true && $_SESSION['access_level']=='Customer'){
                ?>
                <ul class="nav navbar-nav navbar-right">
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <?php echo $_SESSION['firstname']; ?>
                            <?php echo $_SESSION['firstname']; ?>
                        </a>
                    <li>
                        <a class="nav-link"  href="<?php echo $home_url; ?>logout.php">Logout</a>
                    </li>
                </ul>
                <?php
                }// if user was not logged in, show the "login" and "register" options
                else{
                    ?>
                    <ul class="nav navbar-nav navbar-right">
                        <li <?php echo $page_title=="Login" ? "class='active'" : ""; ?>>
                            <a href="<?php echo $home_url; ?>login">
                                <span class="glyphicon glyphicon-log-in"></span> Log In
                            </a>
                        </li>
                    
                        <li <?php echo $page_title=="Register" ? "class='active'" : ""; ?>>
                            <a href="<?php echo $home_url; ?>register">
                                <span class="glyphicon glyphicon-check"></span> Register
                            </a>
                        </li>
                    </ul>
                    <?php
                    }
            ?>
    </div>
  </nav>


