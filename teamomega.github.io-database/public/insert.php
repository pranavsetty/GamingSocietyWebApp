<?php
require_once(PROJECT . '/private/initialize.php');

if(is_post_request()){


  $cost = $_POST['cost'] ?? '';
  $type = $_POST['type'] ?? '';
  $platform = $_POST['platform'] ?? '';
  $age_limit = $_POST['age_limit'] ?? '';
  $name = $_POST['name'] ?? '';
  $is_currently_available = $_POST['is_currently_available'] ?? '';
  $release_year = $_POST['release_year'] ?? '';
  $image_link = $_POST['image_link'] ?? '';

  $result = insert_game_data($cost, $type, $platform, $age_limit, $name, $is_currently_available, $release_year, $image_link);

}
// href="<?php echo url_for('/staff/subjects/index.php'); "
 ?>

 <?php $page_title = 'Add New Game'; ?>

 <div id="content">
   <div class="page new">
    <h1>Create Page</h1>
    <dl>
            <dt>Cost</dt>
            <dd><input type="text" name="cost" value="<?php echo h($cost); ?>" /></dd>
          </dl>
          <dl>
                  <dt> Type </dt>
                  <dd><input type="text" name="type" value="<?php echo h($type); ?>" /></dd>
                </dl>
                <dl>
          <dt> Platform </dt>
          <dd><input type="text" name="platform" value="<?php echo h($platform); ?>" /></dd>
        </dl>
        <dl>
        <dt>Age Limit</dt>
        <dd><input type="text" name="ageLimit" value="<?php echo h($age_limit); ?>" /></dd>
      </dl>
      <dl>
        <dt>Name</dt>
        <dd><input type="text" name="name" value="<?php echo h($name); ?>" /></dd>
      </dl>
      <dl>
        <dt>Currently Available</dt>
        <dd><input type="text" name="isCurrentlyAvailable" value="<?php echo h($is_currently_available); ?>" /></dd>
      </dl>
      <dl>
        <dt> Release Year</dt>
        <dd><input type="text" name="releaseYear" value="<?php echo h($release_year); ?>" /></dd>
      </dl>
      <dl>
        <dt>Image Link</dt>
        <dd><input type="text" name="imageLink" value="<?php echo h($image_link); ?>" /></dd>
      </dl>
