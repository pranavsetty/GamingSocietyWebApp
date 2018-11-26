<?php

function checkActive($navItem) {
    $className = "nav-item";
    global $active;
  if ($active == $navItem) {
    $className = $className . " active";
  }
  echo $className;
}
?>

<?php

function checkLoggingIn() {
    global $loggingIn;
    if ($loggingIn) {
        echo '<a href="index.php" class="btn btn-light"><i class="fas fa-angle-double-left"></i> Main Page</a>';
    } else {
        echo '<a href="staff-login.php" class="btn btn-light"><i class="fas fa-unlock-alt"></i> Staff Login</a>';   
    }
}
?>

<?php 

function redirect_to($location) {
  header("Location: " . $location);
  exit;
}
?>