<?php
$loggingIn = false;
$active = "Home";
$styleFileName = "index.css";
require_once('../private/initialize.php');
?>

<!DOCTYPE html>
<html lang="en">
<?php include(PRIVATE_PATH . '/shared/head.php'); ?>


<body>

<?php include(PRIVATE_PATH . '/shared/navigation.php'); ?>

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


<div class="container">

    <div class="row mb-5">
        <div class="col d-flex justify-content-center">
            <h1>Our Games</h1>
        </div>
    </div>

    <div class="row mb-5">
        <div class="col">
            <div class="search" id="search">
                <form class="search-bar" method="GET" action="#search">
                    <input class="search_input" type="text" name="search" placeholder="Search..."/>
                <button class="search-button" type="submit">
                    <i class="fas fa-search"></i>
                </button>
                </form>
            </div>
        </div>
    </div>


<!-- Start of Cards section - Games -->
    <?php
    $gameSet = find_game_data();
    if(isset($_GET['search']) && $_GET['search'] != ""){
    $gameSet = search_games($_GET['search']);} ?>

    <div class= "row">
        <?php
        while ($game = mysqli_fetch_assoc($gameSet)) { ?>

            <div class="col-lg-3 col-md-3 col-sm-4 mb-5">
                <a class="card" href="<?php echo url_for('gameDetails.php?id=' . h(u($game['gameID'])));?>">
                    <img class="card-img-top" src="<?php echo($game['imageLink']); ?>" alt="Card image">
                    <div class="card-body">
                        <h2 class="card-title"><?php echo($game['name']); ?></h2>
                        Released: <?php echo($game['releaseYear']); ?><br>
                        Age restriction: <?php echo($game['ageLimit']); ?><br>
                    </div>
                    <?php
                        $status = 'available';
                        if (!isCurrentlyAvailable($game['gameID'])) $status = 'unavailable';
                        echo '<div class="card-footer ' . $status . '">' . $status . '</div>'; ?>
                </a>
            </div>

        <?php } ?>

        <?php
        mysqli_free_result($gameSet);
        ?>

    </div>

<!-- End of Cards section - Games -->

</div>

<?php include(PRIVATE_PATH . '/shared/footer.php'); ?>


</body>
</html>
