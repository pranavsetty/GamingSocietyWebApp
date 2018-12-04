<?php
$loggingIn = true;
$active = "staff login";
$styleFileName = "login.css";
require_once('../../../private/initialize.php');


if(is_post_request()) {
    $game = [];
    $game['cost'] = $_POST['cost'] ?? '';
    $game['type'] = $_POST['type'] ?? '';
    $game['platform'] = $_POST['platform'] ?? '';
    $game['ageLimit'] = $_POST['ageLimit'] ?? '';
    $game['name'] = $_POST['name'] ?? '';
    $game['isCurrentlyAvailable'] = $_POST['isCurrentlyAvailable'] ?? '';
    $game['releaseYear'] = $_POST['releaseYear'] ?? '';
    $game['imageLink'] = $_POST['imageLink'] ?? '';
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

<?php include(PRIVATE_PATH . '/head.php'); ?>

<body>
<?php include(PRIVATE_PATH . '/navigation.php'); ?>


<div class="container">

    <form class="form-signin" action="addGame.php" method="post">

        <h1 class="mb-4 mt-3 text-uppercase" align = "center">Add Game</h1>
        <div class = 'form-group'>
            <label for="cost">Cost</label>
            <input type="text" name="cost" id = "cost" class="form-control mb-2" placeholder="Cost" required autofocus>
        </div>

        <div class = 'form-group'>
            <label for="type">Type</label>
            <input type="text" name="type" id = "type"class="form-control mb-2" placeholder="Type" required autofocus>
        </div>

        <div class = 'form-group'>
            <label for="platform">Platform</label>
            <input type="text" name="platform" id = "platform" class="form-control mb-2" placeholder="Platform" required>
        </div>

        <div class = 'form-group'>
            <label for="name">Name</label>
            <input type="name" name="name" id = "DoB" class="form-control mb-2" placeholder="Name" required>
        </div>

        <div class = 'form-group'>
            <label for="isCurrentlyAvailable">Currently Available</label>
            <input type="text" name="isCurrentlyAvailable" id = "isCurrentlyAvailable" class="form-control mb-2" placeholder="Currently Available" required>
        </div>

        <div class = 'form-group'>
            <label for="releaseYear">Release Year</label>
            <input type="releaseYear" name="releaseYear" id = "releaseYear" class="form-control mb-2" placeholder="Release Year" required>
        </div>

        <div class = 'form-group'>
            <label for="imageLink">Image Link</label>
            <input type="text" name="imageLink" id = "imageLink" class="form-control mb-2" placeholder="Image Link" required>
        </div>

        <button class="mt-3 btn btn-lg btn-login btn-block" type="submit" name ="Add Game">Add Game</button>

    </form>
</div>

<?php include(PRIVATE_PATH . '/footer.php'); ?>

</body>
</html>