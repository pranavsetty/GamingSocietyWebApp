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
            <img class="w-100 img-fluid center-block" src="images/carousel/supermarioimg.jpg" alt="First slide">
        </div>
        <div class="carousel-item">
            <img class="w-100 img-fluid center-block" src="images/carousel/codimg.png" alt="Second slide">
        </div>
        <div class="carousel-item">
            <img class="w-100 img-fluid center-block" src="images/carousel/fortniteimg.png" alt="Third slide">
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

<!--<div class="text-center"><h1> Top Selling Games</h1></div>-->
<!---->
<!--<div class="container">-->
<!--    <div class="cardcontainer">-->
<!--        <div class="card text-white bg-danger mb-3" style="max-width: 18rem;">-->
<!--            <div class="card-header">GTA 5</div>-->
<!--            <div class="card-body">-->
<!--                <h5 class="card-title"> USER ABC <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></h5>-->
<!--                <p class="card-text">If you hadn’t had a chance to play it yet at all though, and your computer can handle it, the PC version does definitely feel like the definitive version.</p>-->
<!--            </div>-->
<!--        </div>-->
<!--        <div class="card text-white bg-danger mb-3" style="max-width: 18rem;">-->
<!--            <div class="card-header">GTA 5</div>-->
<!--            <div class="card-body">-->
<!--                <h5 class="card-title"> USER DEF <i class="fas fa-star"></i></i><i class="fas fa-star"></i><i class="fas fa-star"></i></h5>-->
<!--                <p class="card-text">If you hadn’t had a chance to play it yet at all though, and your computer can handle it, the PC version does definitely feel like the definitive version.</p>-->
<!--            </div>-->
<!--        </div>-->
<!--        <div class="card text-white bg-danger mb-3" style="max-width: 18rem;">-->
<!--            <div class="card-header">GTA 5</div>-->
<!--            <div class="card-body">-->
<!--                <h5 class="card-title"> USER GHI </i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></h5>-->
<!--                <p class="card-text">If you hadn’t had a chance to play it yet at all though, and your computer can handle it, the PC version does definitely feel like the definitive version.</p>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->


<!-- End of review section -->

<div class="container">

    <div class="row mb-5">
        <div class="col d-flex justify-content-center">
            <h1>Our Games</h1>
        </div>
    </div>

    <div class="row mb-5">
        <div class="col">
            <div class="search">
                <form class="search-bar" action="search.php" method="GET">
                    <input class="search_input" type="text" name="query" placeholder="Search..."/>
                <button class="search-button" type="submit">
                    <i class="fas fa-search"></i>
                </button>
                </form>
            </div>

        </div>
    </div>



<!-- End of review section -->


<form  method="GET">
    <input type="text" name="query" />
    <input type="submit" value="Search" />
</form>
    <?php
    if(isset($_GET['query']) && $_GET['query'] != ""){
        $gameSet = search_games($_GET['query']);?>
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


    <?php } ?>






</div>

<?php include(PRIVATE_PATH . '/footer.php'); ?>


</body>
</html>
