<?php
$loggingIn = false;
$active = "Home";
$styleFileName = "index.css";
require_once('../private/initialize.php');
 ?>

<!DOCTYPE html>
<html lang="en">
<?php include(PRIVATE_PATH . '/head.php'); ?>


<body>

<?php include(PRIVATE_PATH . '/navigation.php'); ?>

<!-- Start of Carousel -->

<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img class="d-block w-100 center-block" src="images/carousel/supermarioimg.jpg" alt="First slide">
        </div>
        <div class="carousel-item">
            <img class="d-block w-100 center-block" src="images/carousel/codimg.png" alt="Second slide">
        </div>
        <div class="carousel-item">
            <img class="d-block w-100 center-block" src="images/carousel/fortniteimg.jpg" alt="Third slide">
        </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>


<!-- End of Carousel -->

<!-- Start of review section -->

<div class="text-center"><h1> Reviews</h1></div>

<div class = "container">
<div class = "cardcontainer">
<!--TODO: add search functionality here-->
<div class="card border-primary mb-3" style="max-width: 18rem;">
    <div class="card-header">Header</div>
    <div class="card-body text-primary">
        <h5 class="card-title">Primary card title</h5>
        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
    </div>
</div>
<div class="card border-secondary mb-3" style="max-width: 18rem;">
    <div class="card-header">Header</div>
    <div class="card-body text-secondary">
        <h5 class="card-title">Secondary card title</h5>
        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
    </div>
</div>
<div class="card border-success mb-3" style="max-width: 18rem;">
    <div class="card-header">Header</div>
    <div class="card-body text-success">
        <h5 class="card-title">Success card title</h5>
        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
    </div>
</div>
</div>
</div>

<!-- End of review section -->

<?php
$subjectSets = find_game_data();
?>

<?php include(PRIVATE_PATH . '/footer.php'); ?>

<div id="content">


    <table class="list">
        <tr>
            <th>GameID</th>
            <th>Cost</th>
            <th>Type</th>
            <th>AgeLimit</th>
            <th>Name</th>
            <th>CurrentlyAvailable</th>
            <th>ReleaseYear</th>
            <th>ImageLink</th>
            <!--        <th>&nbsp;</th>-->
            <!--        <th>&nbsp;</th>-->
            <!--        <th>&nbsp;</th>-->
            <!--        <th>&nbsp;</th>-->
            <!--        <th>&nbsp;</th>-->
            <!--        <th>&nbsp;</th>-->
            <!--        <th>&nbsp;</th>-->
        </tr>

        <?php
        $gameSet = find_game_data();
        ?>
        <?php
        while ($subject = mysqli_fetch_assoc($gameSet)) { ?>
            <tr>
                <td><?php echo($subject['gameID']); ?></td>
                <td><?php echo($subject['cost']); ?></td>
                <td><?php echo($subject['type']); ?></td>
                <td><?php echo($subject['ageLimit']); ?></td>
                <td><?php echo($subject['name']); ?></td>
                <td><?php echo($subject['isCurrentlyAvailable']); ?></td>
                <td><?php echo($subject['releaseYear']); ?></td>
                <td><?php echo($subject['imageLink']); ?></td>


            </tr>
        <?php } ?>
    </table>

    <?php
    mysqli_free_result($gameSet);
    ?>

</div>




    <?php include(PRIVATE_PATH . '/footer.php'); ?>


</body>
</html>
