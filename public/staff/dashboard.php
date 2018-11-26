<?php 
$loggingIn = true;
$active = "staff login";
$styleFileName = "dashboard.css";
require_once('../../private/initialize.php')

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

    <link rel="stylesheet" href="../style/main.css">
    <link rel="stylesheet" href="<?php echo '../style/' . $styleFileName; ?>">


</head>

<body>
    <div class="container-fluid">
      <div class="row">
        <nav class="col-md-3 d-md-block sidebar col-lg-2">
          <div class="sidebar-sticky position-fixed">
              <div class="headline border-bottom">
                  James<br>Doe<br>
                  <h7><br>admin</h7>
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
                    <a class="nav-link" href="?tab=admin">Admin</a>
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
