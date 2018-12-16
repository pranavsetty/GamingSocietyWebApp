<?php
$active = "staff login";
$stylePath = "../style/";
$styleFileName = "dashboard.css";
require_once('../../private/initialize.php');

require_login();
$staffName = getStaffDataByEmail($_SESSION['username']);
$isAdmin = isAdmin($_SESSION['username']);
?>

<!DOCTYPE html>
<html lang="en">

<?php include(PRIVATE_PATH . '/shared/head.php'); ?>


<body>
    <div class="container-fluid">
      <div class="row">
        <nav class="col-md-3 d-md-block sidebar col-lg-2 position-fixed">
          <div class="sidebar-sticky">
              <div class="headline border-bottom">
                  <?php echo $staffName['firstname']?><br><?php echo $staffName['surname']?>
                  <h7><br><?php if ($isAdmin) echo 'admin'; else echo 'staff'; ?></h7>
                  <br><a href="<?php echo urlFor('/staff/logout.php'); ?>"" class="btn btn-sidebar mb-3"><i class="fas fa-unlock-alt"></i> Logout</a>
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

            include('tabs/' . $tab . 'Tab.php'); ?>

        </div>
      </div>
    </div>


    <?php include(PRIVATE_PATH . '/shared/footer.php'); ?>

</body>
</html>
