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
            <img class="d-block w-100" src="images/carousel/supermarioimg.jpg" alt="First slide">
        </div>
        <div class="carousel-item">
            <img class="d-block w-100" src="images/carousel/codimg.png" alt="Second slide">
        </div>
        <div class="carousel-item">
            <img class="d-block w-100" src="images/carousel/fortniteimg.jpg" alt="Third slide">
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

<div class="text-center"><h1> Top Selling Games</h1></div>

<div class="container">
    <div class="cardcontainer">
        <!--TODO: add search functionality here-->
        <div class="card text-white bg-danger mb-3" style="max-width: 18rem;">
            <div class="card-header">GTA 5</div>
            <div class="card-body">
                <h5 class="card-title"> USER ABC <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></h5>
                <p class="card-text">If you hadn’t had a chance to play it yet at all though, and your computer can handle it, the PC version does definitely feel like the definitive version.</p>
            </div>
        </div>
        <div class="card text-white bg-danger mb-3" style="max-width: 18rem;">
            <div class="card-header">GTA 5</div>
            <div class="card-body">
                <h5 class="card-title"> USER DEF <i class="fas fa-star"></i></i><i class="fas fa-star"></i><i class="fas fa-star"></i></h5>
                <p class="card-text">If you hadn’t had a chance to play it yet at all though, and your computer can handle it, the PC version does definitely feel like the definitive version.</p>
            </div>
        </div>
        <div class="card text-white bg-danger mb-3" style="max-width: 18rem;">
            <div class="card-header">GTA 5</div>
            <div class="card-body">
                <h5 class="card-title"> USER GHI </i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></h5>
                <p class="card-text">If you hadn’t had a chance to play it yet at all though, and your computer can handle it, the PC version does definitely feel like the definitive version.</p>
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
                <td><img src="<?php echo($subject['imageLink']); ?>"></td>


            </tr>
        <?php } ?>
    </table>

    <?php
    mysqli_free_result($gameSet);
    ?>

</div>


<!-- Start of Cards section - Games -->
<div class = "row">
        <?php
        $gameSet = find_game_data();
        ?>

        <?php
        while ($subject = mysqli_fetch_assoc($gameSet)) { ?>


            <div class="card  text-white bg-dark mb-3" style="width: 18rem;">
                <img class="card-img-top" src="<?php echo($subject['imageLink']); ?>" alt="Card image cap">
                <div class="card-body">
                    <h2 class="card-title"><?php echo($subject['name']); ?></h2>
                    <p class="card-text">Released on <?php echo($subject['releaseYear']); ?>.
                        </p>
                    <p> Current Availability : <?php echo($subject['isCurrentlyAvailable']); ?></p>
                    <a href="#" class="btn btn-primary">More info</a>
                </div>
            </div>

        <?php } ?>

        <?php
        mysqli_free_result($gameSet);
        ?>

    </div>

<!-- End of Cards section - Games -->



<?php include(PRIVATE_PATH . '/footer.php'); ?>


</body>
</html>
