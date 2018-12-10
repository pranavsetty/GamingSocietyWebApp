<?php
$stylePath = "../../style/";
$styleFileName = ".css";
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




<div id="content">


  <a class="back-link" href="<?php echo url_for('../public/staff/dashboard.php?tab=game'); ?>">&laquo; Back to List</a>


  <div class="subject edit">
    <h1>Edit Game</h1>

    <form action="<?php echo url_for('/staff/pages/edit.php?id=' . h(u($gameID))); ?>" method="post">
      <dl>
        <dt>Cost</dt>
        <dd><input type="text" name="cost" value="<?php echo h($game['cost']); ?>" /></dd>
          <?php if(isset($errors['cost'])) { echo $errors['cost']; } ?>
      </dl>
        <dl>
            <dt>Type</dt>
            <dd><input type="text" name="type" value="<?php echo h($game['type']); ?>" /></dd>
            <?php if(isset($errors['type'])) { echo $errors['type']; } ?>
        </dl>
        <dl>
            <dt>Platform</dt>
            <dd><input type="text" name="platform" value="<?php echo h($game['platform']); ?>" /></dd>
            <?php if(isset($errors['platform'])) { echo $errors['platform']; } ?>
        </dl>
        <dl>
            <dt>Age Limit</dt>
            <dd><input type="text" name="age_limit" value="<?php echo h($game['ageLimit']); ?>" /></dd>
            <?php if(isset($errors['ageLimit'])) { echo $errors['ageLimit']; } ?>
        </dl>
        <dl>
            <dt>Name</dt>
            <dd><input type="text" name="name" value="<?php echo h($game['name']); ?>" /></dd>
            <?php if(isset($errors['name'])) { echo $errors['name']; } ?>
        </dl>
        <dl>
            <dt>Currently Available</dt>
            <dd><input type="text" name="is_currently_available" value="<?php echo h($game['isCurrentlyAvailable']); ?>" /></dd>
            <?php if(isset($errors['isCurrentlyAvailable'])) { echo $errors['isCurrentlyAvailable']; } ?>
        </dl>
        <dl>
            <dt>Release Year</dt>

            <dd><input type="text" name="releaseYear" value="<?php echo h($game['releaseYear']); ?>" /></dd>
            <?php if(isset($errors['releaseYear'])) { echo $errors['releaseYear']; } ?>

        </dl>
        <dl>
            <dt>Image Link</dt>
            <dd><input type="text" name="image_link" value="<?php echo h($game['imageLink']); ?>" /></dd>
            <?php if(isset($errors['imageLink'])) { echo $errors['imageLink']; } ?>
        </dl>
        <dl>
            <dt>Game Description</dt>
            <dd><input type="text" name="game_description" value="<?php echo h($game['gameDescription']); ?>" /></dd>
            <?php if(isset($errors['gameDescription'])) { echo $errors['gameDescription']; } ?>
        </dl>

      <div id="operations">
        <input type="submit" value="Edit Game" />
      </div>
    </form>

  </div>

</div>

