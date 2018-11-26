<?php
require_once('/projects/teamomega.github.io/private/initialize.php');

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
