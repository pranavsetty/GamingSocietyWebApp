<?php
$stylePath = "../../style/";
$styleFileName = "add.css";
require_once('../../../private/initialize.php');
require_login();

if(is_post_request()) {
    $game = [];
    $game['cost'] = $_POST['cost'] ?? '';
    $game['type'] = $_POST['type'] ?? '';
    $game['platform'] = $_POST['platform'] ?? '';
    $game['ageLimit'] = $_POST['ageLimit'] ?? '';
    $game['name'] = $_POST['name'] ?? '';
    $game['releaseYear'] = $_POST['releaseYear'] ?? '';
    $game['imageLink'] = $_POST['imageLink'] ?? '';
    $game['gameDescription'] = $_POST['desc'] ?? '';
    $result = insert_game_data($game);
    if($result === true) {
        //$new_id = mysqli_insert_id($db); Not sure what this is for
        echo '<script language = "javascript">';
        echo 'window.location.href = "../dashboard.php";';
        echo 'alert ("You have successfully added a new Game");';
        echo '</script>';
    }
    else {
        echo '<script language = "javascript">';
        echo 'alert ("Error: Could not add new Game");';
        echo '</script>';
    }

}
?>


<!DOCTYPE html>
<html lang="en">

<?php include(PRIVATE_PATH . '/shared/head.php'); ?>

<body>
<?php include(PRIVATE_PATH . '/shared/navigationStaff.php'); ?>

<div class="container mb-5">

    <form class="form" action="addGame.php" method="post">

        <div class="row d-flex justify-content-center">
            <h1 class="mb-5 mt-3 text-uppercase">Add Game</h1>
        </div>
        <div class="row">
            <div class="col-6 form-group">
                <label for="name">Game title</label>
                <input type="text" name="name" id = "name" class="form-control mb-2" placeholder="Title" required>
            </div>
            <div class="col-6 form-group">
                <label for="releaseYear">Release Year</label>
                <input type="number" min="1900" max="<?php echo date("Y");?>" name="releaseYear" id = "releaseYear" class="form-control mb-2" placeholder="Release Year" required>
            </div>
        </div>
        <div class="row">
            <div class="col-6 form-group">
                <label for="type">Type</label>
                <input type="text" name="type" id = "type" class="form-control mb-2" placeholder="Type" required autofocus>
            </div>
            <div class="col-6 form-group">
                <label for="platform">Platform</label>
                <input type="text" name="platform" id = "platform" class="form-control mb-2" placeholder="Platform" required>
            </div>

        </div>
        <div class="row">
            <div class="col-6 form-group">
                <label for="cost">Cost</label>
                <input type="text" name="cost" id = "cost" class="form-control mb-2" placeholder="Cost" required autofocus>
            </div>
            <div class="col-6 form-group">
                <label for="imageLink">Image Link</label>
                <input type="text" name="imageLink" id = "imageLink" class="form-control mb-2" placeholder="Image Link" required>
            </div>
        </div>
        <div class="row">
            <div class="col-6 form-group">
                <label for="desc">Description</label>
                <input type="text" name="desc" id="desc" class="form-control mb-2" placeholder="Game description" required>
            </div>
            <div class="col-6 form-group">
                <label for="ageLimit">Age Restriction</label>
                <input type="number" min="0" max="120" name="ageLimit" id="ageLimit" class="form-control mb-2" placeholder="Age restriction" required>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-6 d-flex justify-content-center">
                <button class="mt-5 btn btn-lg btn-login" type="submit" name ="Add Game">Add Game</button>
            </div>
        </div>
    </form>
</div>

<?php include(PRIVATE_PATH . '/shared/footer.php'); ?>

</body>
</html>