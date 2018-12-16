<?php
$loggingIn = false;
$styleFileName = "details.css";
require_once('../private/initialize.php');

$gameID = $_GET['id'];
$gameEntry = getGameByID($gameID)


?>
<!DOCTYPE html>
<html lang="en">

<?php include(PRIVATE_PATH . '/shared/head.php'); ?>

<body>
<?php include(PRIVATE_PATH . '/shared/navigation.php'); ?>

<div class="container">
    <div class="row d-flex justify-content-center mt-5 mb-5">
        <div class="col-10">
            <div class="card">
                <div class="card-body">
                    <div class="row pr-4">
                        <div class="col-5">
                            <img class="mb-4" src="<?php echo h($gameEntry['imageLink']); ?>" alt="Game image">
                        </div>
                        <div class="col-7 pl-5 d-flex align-items-end">
                            <h1 class="mb-4 text-uppercase"><?php echo h($gameEntry['name']); ?></h1>
                        </div>
                    </div>
                    <div class="row pl-3 pr-5 pt-3 pb-5">
                        <div class="col-5">
                            <ul class="pl-2 pr-2">
                                <li class="row">
                                    <div class="col-6">
                                        <b>Age Restriction:</b>
                                    </div>
                                    <div class="col-6 text-right">
                                        <?php echo h($gameEntry['ageLimit']); ?>
                                    </div>
                                </li>
                                <li class="row">
                                    <div class="col-6">
                                        <b>Value:</b>
                                    </div>
                                    <div class="col-6 text-right">
                                        <?php echo h($gameEntry['cost']); ?>
                                    </div>
                                </li>
                                <li class="row">
                                    <div class="col-6">
                                        <b>Platform:</b>
                                    </div>
                                    <div class="col-6 text-right">
                                        <?php echo h($gameEntry['platform']); ?>
                                    </div>
                                </li>
                                <li class="row">
                                    <div class="col-6">
                                        <b>Type:</b>
                                    </div>
                                    <div class="col-6 text-right">
                                        <?php echo h($gameEntry['type']); ?>
                                    </div>
                                </li>
                                <li class="row">
                                    <div class="col-6">
                                        <b>Release year:</b>
                                    </div>
                                    <div class="col-6 text-right">
                                        <?php echo h($gameEntry['releaseYear']); ?>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="col-7 pl-5">
                            <p class="text-justify">
                                <?php echo h($gameEntry['gameDescription']); ?>
                            </p>
                            <p class="float-right">
                                <a href="<?php echo makeLinksClickable(h($gameEntry['link']));?>">Read a review</a>
                            </p>
                        </div>
                </div>
                </div>
                <?php
                $status = 'available';
                if (!isCurrentlyAvailable($gameEntry['gameID'])) $status = 'unavailable';
                echo '<div class="card-footer ' . $status . '">' . $status . '</div>'; ?>
            </div>
        </div>
    </div>
</div>

<?php include(PRIVATE_PATH . '/shared/footer.php'); ?>

</body>
</html>
