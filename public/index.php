<?php
$loggingIn = false;
$active = "Home";
$styleFileName = "index.css";
require_once('../private/initialize.php');

$type = '';
$platform = '';
$sort = '';
$search = '';
if (isset($_GET['type'])) {
    $type = $_GET['type'];
}
if (isset($_GET['platform'])) {
    $platform = $_GET['platform'];
}
if (isset($_GET['sort'])) {
    $sort = $_GET['sort'];
}
if (isset($_GET['search'])) {
    $search = $_GET['search'];
}

$gameSet = find_game_data_filter($sort, $type, $platform, $search);
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

    <div class="row mb-7">
        <div class="col d-flex justify-content-center">
            <h1>Our Games</h1>
        </div>
    </div>

    <div class="row mb-7 pt-4">
        <div class="col">
            <form class="form-row" method="GET" action="#search">
                <div class="col-5">
                    <div class="search" id="search">
                        <div class="search-bar">
                            <?php echo '<input class="search_input" type="text" name="search"';
                            if($search != '') {
                                echo ' value="' . $search . '"';
                            } else {
                                echo ' placeholder="Search..."';
                            }
                            echo '/>'; ?>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="filter">
                        <select id="type" name="type">
                            <option value="">Type</option>
                            <?php $types = find_types();
                            while ($type = mysqli_fetch_assoc($types)) {
                                echo "<option value=" . $type['type'] . ">" . $type['type'] . "</option>";
                            }

                            ?>
                        </select>
                        <input type="submit" name="type" value="type" style="display:none"/>
                    </div>
                </div>
                <div class="col">
                    <div class="filter">
                        <select id="platform" name="platform">
                            <option value="">Platform</option>
                            <?php $platforms = find_platforms();
                            while ($platform = mysqli_fetch_assoc($platforms)) {
                                echo "<option value=" . $platform['platform'] . ">" . $platform['platform'] . "</option>";
                            }

                            ?>
                        </select>
                        <input type="submit" name="platform" value="platform" style="display:none"/>
                    </div>
                </div>
                <div class="col">
                    <div class="filter">
                        <select id="sort" name="sort">
                            <option value="">Sort By</option>
                            <option value="nameAZ">Name (A-Z)</option>
                            <option value="yearAsc">Release Date &uarr;</option>
                            <option value="yearDesc">Release Date &darr;</option>
                        </select>
                        <input type="submit" name="sort" value="sort" style="display:none"/>
                    </div>
                </div>
                <div class="align-right">
                    <button class="btn btn-filter" type="submit">Search</button>
                </div>
                <div class="clear-float"></div>
            </form>
        </div>

    </div>


    <!-- Start of Cards section - Games -->

    <div class="row">
        <?php
        while ($game = mysqli_fetch_assoc($gameSet)) { ?>

            <div class="col-lg-3 col-md-3 col-sm-4 mb-5">
                <a class="card" href="<?php echo url_for('gameDetails.php?id=' . h(u($game['gameID']))); ?>">
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
