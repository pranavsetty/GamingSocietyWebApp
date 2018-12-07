<?php
$loggingIn = false;
$active = "Home";
$styleFileName = "index.css";
require_once('../private/initialize.php');

$gameID = $_GET['id'];
$gameEntry = find_game_id($gameID)


?>

<div id = "gameContent">
    <a class="back-link" href="<?php echo url_for('index.php'); ?>">&laquo; Back </a>

    <div class="container">
        <div class="card col-md-6">
            <img class="card-img" src="<?php echo h($gameEntry['imageLink']); ?>" alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title">
                    <?php echo h($gameEntry['name']); ?>
                </h5>
                <p class="card-text"> Age Limit:
                    <?php echo h($gameEntry['ageLimit']); ?>
                </p>
                <p class="card-text"> Cost:
                    <?php echo h($gameEntry['cost']); ?>
                </p>
                <ul class="list-group ">
                    <li class="list-group-item">Platform:
                        <?php echo h($gameEntry['platform']); ?>
                    </li>
                    <li class="list-group-item">Year of Release:
                        <?php echo h($gameEntry['releaseYear']); ?>
                    </li>
                </ul>
            </div>
        </div>
    </div>


</div>
