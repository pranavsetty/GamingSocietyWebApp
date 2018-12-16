<nav class="navbar navbar-expand-lg navbar-dark">

    <a class="navbar-brand" href="#">
        <img src="<?php echo urlFor('/images/game.png');?>" width="110" height="55" alt="">
    </a>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
            <a class="<?php checkActive("Home")?>" href="<?php echo urlFor('/index.php');?>">Home</a>
            </li>
            <li class="nav-item">
                <a class="<?php checkActive("About")?>" href="<?php echo urlFor('/about.php');?>">About</a>
            </li>
        </ul>
        <ul class="navbar-nav">
            <li class="nav-item">
                <ul class="navbar-nav">
                    <?php checkLoggingIn(); ?>
                </ul>
            </li>

        </ul>
        
    </div>
</nav>
