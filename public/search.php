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
<body>
<?php include(PRIVATE_PATH . '/navigation.php'); ?>
<div class = "row">
    <?php
    $query = $_GET['query'];
    $min_length = 3; ?>

    <?php
    if(strlen($query) >= $min_length) {
        $query = htmlspecialchars($query);
        $raw_results = mysqli_query($db, ("SELECT * FROM Game WHERE name LIKE '%" . $query . "%'"));
        if (mysqli_num_rows($raw_results) > 0) {

            while ($results = mysqli_fetch_array($raw_results)) { ?>
                <div class="card  text-white bg-dark mb-3" style="width: 18rem;">
                    <img class="card-img-top" src="<?php echo($results['imageLink']); ?>" alt="Card image cap">
                    <div class="card-body">
                        <h2 class="card-title"><?php echo($results['name']); ?></h2>
                        <p class="card-text">Released on <?php echo($results['releaseYear']); ?>.
                        </p>
                        <p> Current Availability : <?php echo($results['isCurrentlyAvailable']); ?></p>
                        <a href="#" class="btn btn-primary">More info</a>
                    </div>
                </div>
            <?php }

        } else {
            echo "No results";
        }
    }else {
        echo "Try a longer word";
    }



    ?>

</div>



</body>
</html>
