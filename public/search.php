<?php
$loggingIn = false;
$active = "Home";
$styleFileName = "index.css";
require_once('../private/initialize.php');

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <?php include(PRIVATE_PATH . '/head.php'); ?>

    <title>Search results</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />


</head>
<?php include(PRIVATE_PATH . '/navigation.php'); ?>
<div class = "row">

    <?php

            while ($result = mysqli_fetch_array($gameSet)) {?>
                <?php $gameID = $result['gameID']?>
                <div class="card  text-white bg-dark mb-3" style="width: 18rem;">
                    <img class="card-img-top" src="<?php echo($result['imageLink']); ?>" alt="Card image cap">
                    <div class="card-body">
                        <h2 class="card-title"><?php echo($result['name']); ?></h2>
                        <p class="card-text">Released on <?php echo($result['releaseYear']); ?>.
                        </p>
                        <p> Current Availability : <?php echo($result['isCurrentlyAvailable']); ?></p>


                            <a href = "<?php echo url_for('gameInfo.php?id=' . h(u($result['gameID'])));?>"
                               class = "btn btn-primary" > More Info</a>
                        </div>
                </div>

            <?php
    }



    ?>

</div>





</body>
</html>
