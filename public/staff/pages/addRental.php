<?php
$loggingIn = true;
$active = "staff login";
$styleFileName = "login.css";
require_once('../../../private/initialize.php');


if(is_post_request()) {

  $rental = [];
  $rental['MemberID'] = $_POST['MemberID'] ?? '';
  $rental['GameID'] = $_POST['GameID'] ?? '';
  //$member['Period'] = $_POST['Period'] ?? '';

  $result = insert_rental($rental);
  if($result === true) {
    //$new_id = mysqli_insert_id($db); Not sure what this is for
    echo '<script language = "javascript">';
    echo 'window.location.href = "../dashboard.php";';
    echo 'alert ("You have successfully added a new Rental");';
    echo '</script>';
  }
  else {
    echo '<script language = "javascript">';
    echo 'window.location.href = "addRental.php";';
    echo 'alert ("Error: Could not add new Rental");';
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

      <form class="form-signin" action="addRental.php" method="post">
        <h1 class="mb-4 mt-3 text-uppercase" align = "center">Add Rental</h1>
        <div class = 'form-group'>
          <label for="MemberID">Member ID</label>
          <input type="text" name="MemberID" id = "MemberID" class="form-control mb-2" placeholder="Member ID" required autofocus>
        </div>

        <div class = 'form-group'>
          <label for="GameID">Game ID</label>
          <input type="text" name="GameID" id = "GameID"class="form-control mb-2" placeholder="Game ID" required autofocus>
        </div>


        <button class="mt-3 btn btn-lg btn-login btn-block" type="submit" name ="Add member">Add rental</button>

      </form>
    </div>

    <?php include(PRIVATE_PATH . '/footer.php'); ?>

</body>
</html>
