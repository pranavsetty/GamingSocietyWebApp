<?php
$loggingIn = false;
$styleFileName = "details.css";
require_once('../private/initialize.php');

$gameID = $_GET['id'];
$gameEntry = find_game_id($gameID)


?>
<!DOCTYPE html>
<html lang="en">

<?php include(PRIVATE_PATH . '/head.php'); ?>

<body>
<?php include(PRIVATE_PATH . '/navigation.php'); ?>

<div class="container">
    <div class="row d-flex justify-content-center mt-5 mb-5">
        <div class="col-10">
            <div class="card">
                <div class="card-body">
                    <h1 class="mb-4"><?php echo h($gameEntry['name']); ?></h1>
                    <div class="row">
                        <div class="col-8">
                            <p class="text-justify">
                                <?php echo h($gameEntry['gameDescription']); ?>
                            </p>
                        </div>
                        <div class="col-4">
                            <img src="<?php echo h($gameEntry['imageLink']); ?>" alt="Game image">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="row">
                                <div class="col-6">
                                    <b>Age Restriction:</b>
                                </div>
                                <div class="col-6">
                                    <?php echo h($gameEntry['ageLimit']); ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <b>Value:</b>
                                </div>
                                <div class="col-6">
                                    <?php echo h($gameEntry['cost']); ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <b>Platform:</b>
                                </div>
                                <div class="col-6">
                                    <?php echo h($gameEntry['platform']); ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <b>Type:</b>
                                </div>
                                <div class="col-6">
                                    <?php echo h($gameEntry['type']); ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <b>Release year:</b>
                                </div>
                                <div class="col-6">
                                    <?php echo h($gameEntry['releaseYear']); ?>
                                </div>
                            </div>
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

<?php include(PRIVATE_PATH . '/footer.php'); ?>

</body>
</html>
