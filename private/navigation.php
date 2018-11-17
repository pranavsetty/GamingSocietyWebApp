<nav class="navbar navbar-expand-lg navbar-dark bg-dark">

    <a class="navbar-brand" href="#">
        <img src="images/game.png" width="110" height="55" alt="">
    </a>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="<?php checkActive("Home")?>">
            <a class="nav-link" href="index.php">Home</a> 
            </li>
            <li class="<?php checkActive("About")?>">
                <a class="nav-link" href="#">About</a>  
            </li>
           <!-- <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Games
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="#">PC</a>
                    <a class="dropdown-item" href="#">XBox</a>
                    <a class="dropdown-item" href="#">PS4</a>
                    <a class="dropdown-item" href="#">Others</a>
                </div>
            </li> 
            -->
        </ul>

        <!-- <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
        -->

        <ul class="navbar-nav">
            <li class="nav-item">
                <ul class="navbar-nav">
         
                    <?php checkLoggingIn() ?>

                </ul>
            </li>

        </ul>
        
    </div>
</nav>
