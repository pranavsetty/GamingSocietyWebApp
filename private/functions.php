<?php
$active = "home";
$className = "nav-link";
function checkActive($navItem) {
  if ($active == $navItem) {
    $className =. " active";
  }
  echo $className;
}
?>

<?php
$login = false;
function checkLogin() {
    if (login == false) {
        echo "<a href=\"staff-login.php\" class=\"btn btn-light\"><i class=\"fas fa-unlock-alt\"></i> Staff Login</a>"
    } else {
        echo "<a href=\"index.php\" class=\"btn btn-light\"><i class=\"fas fa-angle-double-left\"></i> Main Page</a>"
    }
}
?>