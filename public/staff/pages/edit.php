<?php
$stylePath = "../../style/";
$styleFileName = "login.css";
require_once('../../../private/initialize.php');



if(!isset($_GET['id'])) {
    redirect_to(url_for('../gameTab.php'));
}
$gameID = $_GET['id'];
if(is_post_request()){
  $subject = [];
  $subject['gameID'] = $gameID;

  $subject['cost'] = $_POST['cost'] ;
  $subject['type'] = $_POST['type'] ;
  $subject['platform'] = $_POST['platform'] ;
  $subject['ageLimit'] = $_POST['age_limit'] ;
  $subject['name'] = $_POST['name'] ;
  $subject['isCurrentlyAvailable'] = $_POST['is_currently_available'] ;
  $subject['releaseYear'] = $_POST['releaseYear'] ;
  $subject['imageLink'] = $_POST['image_link'] ;
  $subject['gameDescription'] = $_POST['game_description'];
  $result = update_game_data($subject);

  redirect_to(url_for('../public/staff/dashboard.php?tab=game'));


} else{
  $subject = find_game_id($gameID);
}
?>




<div id="content">


  <a class="back-link" href="<?php echo url_for('../public/staff/dashboard.php?tab=game'); ?>">&laquo; Back to List</a>


  <div class="subject edit">
    <h1>Edit Game</h1>

    <form action="<?php echo url_for('/staff/pages/edit.php?id=' . h(u($gameID))); ?>" method="post">
      <dl>
        <dt>Cost</dt>
        <dd><input type="text" name="cost" value="<?php echo h($subject['cost']); ?>" /></dd>
      </dl>
        <dl>
            <dt>Type</dt>
            <dd><input type="text" name="type" value="<?php echo h($subject['type']); ?>" /></dd>
        </dl>
        <dl>
            <dt>Platform</dt>
            <dd><input type="text" name="platform" value="<?php echo h($subject['platform']); ?>" /></dd>
        </dl>
        <dl>
            <dt>Age Limit</dt>
            <dd><input type="text" name="age_limit" value="<?php echo h($subject['ageLimit']); ?>" /></dd>
        </dl>
        <dl>
            <dt>Name</dt>
            <dd><input type="text" name="name" value="<?php echo h($subject['name']); ?>" /></dd>
        </dl>
        <dl>
            <dt>Currently Available</dt>
            <dd><input type="text" name="is_currently_available" value="<?php echo h($subject['isCurrentlyAvailable']); ?>" /></dd>
        </dl>
        <dl>
            <dt>Release Year</dt>

            <dd><input type="text" name="releaseYear" value="<?php echo h($subject['releaseYear']); ?>" /></dd>

        </dl>
        <dl>
            <dt>Image Link</dt>
            <dd><input type="text" name="image_link" value="<?php echo h($subject['imageLink']); ?>" /></dd>
        </dl>
        <dl>
            <dt>Game Description</dt>
            <dd><input type="text" name="game_description" value="<?php echo h($subject['gameDescription']); ?>" /></dd>
        </dl>

      <div id="operations">
        <input type="submit" value="Edit Game" </input>
      </div>
    </form>

  </div>

</div>

