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
        echo '<a href="index.php" class="btn btn-navbar"><i class="fas fa-angle-double-left"></i> Main Page</a>';
    } else {
        echo '<a href="staff-login.php" class="btn btn-navbar"><i class="fas fa-unlock-alt"></i> Staff Login</a>';
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

//Might need this function but not yet
function calculateEndDate($startDate,$weeks){
  $period = (int) $weeks;
  return date("Y-m-d", strtotime('+' . $period . " week", strtotime($startDate)));
}

function isCurrentRental($rental){
    $currentDate = date('Y-m-d');
    $returnDate = $rental['returnDate'];
    if ($returnDate !== NULL) return false;
    else return true;
}

function isOverdue($rental){
    $currentDate = date('Y-m-d');
    $endDate = calculateEndDate($rental['startDate'], $rental['period']);
    return $currentDate > $endDate && $rental['returnDate'] === NULL;

}
function h($string="") {
    return htmlspecialchars($string);
}

function u($string="") {
    return urlencode($string);
}
function url_for($script_path) {
    // add the leading '/' if not present
    if($script_path[0] != '/') {
        $script_path = "/" . $script_path;
    }
    return WWW_ROOT . $script_path;
}



?>
