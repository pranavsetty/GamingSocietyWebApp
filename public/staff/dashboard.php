<?php
session_start();
$active = "staff login";
$styleFileName = "dashboard.css";
// TODO: add a function to check if logged in person is an admin
$isAdmin = true;
require_once('../../private/initialize.php');
?>


<?php
// Handle form values sent by new.php

$inputUsername = $_POST['inputUsername'] ?? '';
$inputPassword = $_POST['inputPassword'] ?? '';
//echo $inputusername;
//echo $inputPassword;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (find_staff_by_email($inputUsername)["email"] == $inputUsername
        && get_staff_password_by_email($inputUsername)["password"] == $inputPassword) {
    $_SESSION['username'] = $inputUsername;
    $_SESSION['password'] = $inputPassword;
    session_write_close();
    }
    else{
        echo '<script language = "javascript">';
        echo 'window.location.href = "../staff-login.php";';
        echo 'alert ("Incorrect email or password");';
        echo '</script>';
   }
} else {
  redirect_to('../staff-login.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<?php //include(PRIVATE_PATH . '/head.php'); ?>
<head>
    <meta charset="UTF-8">
    <title>Team Omega</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
            crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
            integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
            integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
            crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
            crossorigin="anonymous"></script>
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lato|Roboto" rel="stylesheet">

<!--    TODO: make paths to files work from everywhere-->
    <link rel="stylesheet" href="../style/main.css">
    <link rel="stylesheet" href="<?php echo '../style/' . $styleFileName; ?>">


</head>

<body>
    <div class="container-fluid">
      <div class="row">
        <nav class="col-md-3 d-md-block sidebar col-lg-2 position-fixed">
          <div class="sidebar-sticky">
              <div class="headline border-bottom">
                  <?php echo $_SESSION['username']?><br>
                  <h7><br><?php if ($isAdmin) echo 'admin'; else echo 'staff'; ?></h7>
<!--                  TODO: ensure safe logout/login-->
                  <br><a href="../index.php" class="btn btn-sidebar mb-3"><i class="fas fa-unlock-alt"></i> Logout</a>
              </div>
            <ul class="nav flex-column">
              <li class="nav-item nav-item-sidebar">
                <a class="nav-link active" href="?tab=overview">Overview</a>
              </li>
              <li class="nav-item nav-item-sidebar">
                <a class="nav-link" href="?tab=rentals">Rentals</a>
              </li>
              <li class="nav-item nav-item-sidebar">
                <a class="nav-link" href="?tab=members">Members</a>
              </li>
                <?php if($isAdmin) echo
                '<li class="nav-item nav-item-sidebar">
                    <a class="nav-link" href="?tab=admin">Admin</a>
                </li>' ?>
                <li class="nav-item nav-item-sidebar">
                    <a class="nav-link" href="?tab=game">Games</a>
                </li>
            </ul>
          </div>
        </nav>

        <div class="main col-md-9 ml-sm-auto col-lg-10">
            <?php
            $tab = '';
            if(!isset($_GET['tab'])) {
                $tab = 'overview';
            } else {
                $tab = $_GET['tab'];
            }

            include($tab . 'Tab.php'); ?>

        </div>
      </div>
    </div>


    <?php include(PRIVATE_PATH . '/footer.php'); ?>

</body>
</html>
