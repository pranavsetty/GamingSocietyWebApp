<?php
session_start();
$active = "staff login";
$stylePath = "../style/";
$styleFileName = "dashboard.css";
require_once('../../private/initialize.php');

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
    } else {
        echo '<script language = "javascript">';
        echo 'window.location.href = "../staff-login.php";';
        echo 'alert ("Incorrect email or password");';
        echo '</script>';
    }
}
$staffName = getStaffData($_SESSION['username']);
$isAdmin = isAdmin($_SESSION['username']);
?>

<!DOCTYPE html>
<html lang="en">

<?php include(PRIVATE_PATH . '/head.php'); ?>


<body>
    <div class="container-fluid">
      <div class="row">
        <nav class="col-md-3 d-md-block sidebar col-lg-2 position-fixed">
          <div class="sidebar-sticky">
              <div class="headline border-bottom">
                  <?php echo $staffName['firstname']?><br><?php echo $staffName['surname']?>
                  <h7><br><?php if ($isAdmin) echo 'admin'; else echo 'staff'; ?></h7>
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
                <li class="nav-item nav-item-sidebar">
                    <a class="nav-link" href="?tab=game">Games</a>
                </li>
                <?php if($isAdmin) echo
                '<li class="nav-item nav-item-sidebar">
                    <a class="nav-link" href="?tab=admin">Admin</a>
                </li>' ?>

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
