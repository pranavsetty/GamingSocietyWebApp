<?php
require_once('/projects/teamomega.github.io/private/initialize.php');

$gameID = $_GET['gameID'];


if(is_post_request()){
  $subject = [];
  $subject['gameID'] = $gameID;
  $subject['cost'] = $_POST['cost'] ?? '';
  $subject['type'] = $_POST['type'] ?? '';
  $subject['platform'] = $_POST['platform'] ?? '';
  $subject['age_limit'] = $_POST['age_limit'] ?? '';
  $subject['name'] = $_POST['name'] ?? '';
  $subject['is_currently_available'] = $_POST['is_currently_available'] ?? '';
  $subject['release_year'] = $_POST['release_year'] ?? '';
  $subject['image_link'] = $_POST['image_link'] ?? '';

  $result = update_game_data($gameID);

} else{
  $subject = find_game_id($gameID);
}
?>


<?php $page_title = 'Edit Game'; ?>


<div id="content">

  <a class="back-link" href="<?php echo url_for('/staff/subjects/index.php'); ?>">&laquo; Back to List</a>

  <div class="subject edit">
    <h1>Edit Subject</h1>

    <form action="<?php echo url_for('/staff/subjects/edit.php?id=' . h(u($id))); ?>" method="post">
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
            <dd><input type="text" name="age_limit" value="<?php echo h($subject['age_limit']); ?>" /></dd>
        </dl>
        <dl>
            <dt>Name</dt>
            <dd><input type="text" name="bame" value="<?php echo h($subject['name']); ?>" /></dd>
        </dl>
        <dl>
            <dt>Currently Available</dt>
            <dd><input type="text" name="is_currently_available" value="<?php echo h($subject['is_currently_available']); ?>" /></dd>
        </dl>
        <dl>
            <dt>Release Year</dt>
            <dd><input type="text" name="releaseYear" value="<?php echo h($subject['release_year']); ?>" /></dd>
        </dl>
        <dl>
            <dt>Image Link</dt>
            <dd><input type="text" name="image_link" value="<?php echo h($subject['image_link']); ?>" /></dd>
        </dl>

      <div id="operations">
        <input type="submit" value="Edit Game" />
      </div>
    </form>

  </div>

</div>
?>
