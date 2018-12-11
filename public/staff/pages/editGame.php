<?php
$stylePath = "../../style/";
$styleFileName = "add.css";
require_once('../../../private/initialize.php');



if(!isset($_GET['id'])) {
    redirect_to(url_for('../gameTab.php'));
}
$gameID = $_GET['id'];

if(is_post_request()){
  $game = [];
  $game['gameID'] = $gameID;

  $game['cost'] = $_POST['cost'] ;
  $game['type'] = $_POST['type'] ;
  $game['platform'] = $_POST['platform'] ;
  $game['ageLimit'] = $_POST['age_limit'] ;
  $game['name'] = $_POST['name'] ;
  $game['isCurrentlyAvailable'] = $_POST['is_currently_available'] ;
  $game['releaseYear'] = $_POST['releaseYear'] ;
  $game['imageLink'] = $_POST['image_link'] ;
  $game['gameDescription'] = $_POST['game_description'];
  $result = update_game_data($game);

  if($result === true) {
      redirect_to(url_for('../public/staff/dashboard.php?tab=game'));
  }else{
      $errors = $result;
     // var_dump($errors);
  }

} else{
  $game = find_game_id($gameID);
}
    $game_set = find_game_data();
    $game_count = mysqli_num_rows($game_set);
    mysqli_free_result($game_set);
?>

<!DOCTYPE html>
<html lang="en">

<?php include(PRIVATE_PATH . '/shared/head.php'); ?>

<body>
<?php include(PRIVATE_PATH . '/shared/navigationStaff.php'); ?>

<div class="container mb-5">

    <form class="form" action="<?php echo url_for('/staff/pages/editGame.php?id=' . h(u($gameID))); ?>" method="post">
        <div class="row d-flex justify-content-center">
            <h1 class="mb-5 mt-3 text-uppercase">Edit Game</h1>
        </div>
        <div class="row">
            <div class="col-6 form-group">
                <label for="name">Game title</label>
                <input type="text" id="name" name="name" class="form-control mb-2" value="<?php echo h($game['name']); ?>">
                <?php if(isset($errors['name'])) { echo $errors['name']; } ?>
            </div>
            <div class="col-6 form-group">
                <label for="releaseYear">Release Year</label>
                <input type="number" id="releaseYear" name="releaseYear" min="1900" max="<?php echo date("Y");?>" value="<?php echo h($game['releaseYear']); ?>" class="form-control mb-2">
                <?php if(isset($errors['releaseYear'])) { echo $errors['releaseYear']; } ?>
            </div>
        </div>
        <div class="row">
            <div class="col-6 form-group">
                <label for="type">Type</label>
                <input type="text" name="type" id="type" class="form-control mb-2" value="<?php echo h($game['type']); ?>">
                <?php if(isset($errors['type'])) { echo $errors['type']; } ?>
            </div>
            <div class="col-6 form-group">
                <label for="platform">Platform</label>
                <input type="text" name="platform" id="platform" class="form-control mb-2" value="<?php echo h($game['platform']); ?>">
                <?php if(isset($errors['platform'])) { echo $errors['platform']; } ?>
            </div>

        </div>
        <div class="row">
            <div class="col-6 form-group">
                <label for="cost">Value</label>
                <input type="text" name="cost" id = "cost" class="form-control mb-2" value="<?php echo h($game['cost']); ?>">
                <?php if(isset($errors['cost'])) { echo $errors['cost']; } ?>
            </div>
            <div class="col-6 form-group">
                <label for="imageLink">Image Link</label>
                <input type="text" name="imageLink" id="imageLink" class="form-control mb-2" value="<?php echo h($game['imageLink']); ?>">
                <?php if(isset($errors['imageLink'])) { echo $errors['imageLink']; } ?>
            </div>
        </div>
        <div class="row">
            <div class="col-6 form-group">
                <label for="desc">Description</label>
                <input type="text" min="0" max="120" name="desc" id="desc" class="form-control mb-2" value="<?php echo h($game['gameDescription']); ?>">
                <?php if(isset($errors['gameDescription'])) { echo $errors['gameDescription']; } ?>
            </div>
            <div class="col-6 form-group">
                <label for="ageLimit">Age restriction</label>
                <input type="number" min="0" max="120" name="ageLimit" id="ageLimit" class="form-control mb-2" value="<?php echo h($game['ageLimit']); ?>">
                <?php if(isset($errors['ageLimit'])) { echo $errors['ageLimit']; } ?>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-6 d-flex justify-content-center">
                <button class="mt-5 btn btn-lg btn-login" type="submit" name="sumbit">Submit Changes</button>
            </div>
        </div>

</div>

<?php include(PRIVATE_PATH . '/shared/footer.php'); ?>

</body>
</html>
