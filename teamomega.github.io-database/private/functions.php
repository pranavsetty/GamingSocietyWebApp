<?php

function checkActive($navItem) {
    $className = "nav-item";
    global $active;
  if ($active == $navItem) {
    $className = $className . " active";
  }
  echo $className;
}

function prompt(){
    echo '<script language = "javascript">';
    echo 'alert ("Incorrect email or password");';
    echo '</script>';
}


function checkLoggingIn() {
    global $loggingIn;
    if ($loggingIn) {
        echo '<a href="index.php" class="btn btn-light"><i class="fas fa-angle-double-left"></i> Main Page</a>';
    } else {
        echo '<a href="staff-login.php" class="btn btn-light"><i class="fas fa-unlock-alt"></i> Staff Login</a>';   
    }
}
 

function redirect_to($location) {
  header("Location: " . $location);
  exit;
}

function is_post_request() {
  return $_SERVER['REQUEST_METHOD'] == 'POST';
}

function display_errors($errors=array()) {
  $output = '';
  if(!empty($errors)) {
    $output .= "<div class=\"errors\">";
    $output .= "Please fix the following errors:";
    $output .= "<ul>";
    foreach($errors as $error) {
      $output .= "<li>" . h($error) . "</li>";
    }
    $output .= "</ul>";
    $output .= "</div>";
  }
  return $output;
}


?>