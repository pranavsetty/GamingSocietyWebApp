<?php
function checkActive($navItem) {
    $className = "nav-link";
    global $active;
  if ($active == $navItem) {
    $className = $className . " active";
  }
  echo $className;
}

function checkLoggingIn() {
    global $loggingIn;
    if ($loggingIn) {
        echo '<a href="' . urlFor('/index.php') . '" class="btn btn-navbar"><i class="fas fa-angle-double-left"></i> Main Page</a>';
    } else {
        echo '<a href="' . urlFor('/staffLogin.php') . '" class="btn btn-navbar"><i class="fas fa-unlock-alt"></i> Staff Login</a>';
    }
}

function redirectTo($location) {
  header("Location: " . $location);
  exit;
}

function isPostRequest() {
  return $_SERVER['REQUEST_METHOD'] == 'POST';
}

function displayLoginErrors($errors) {
  if ($errors != '') {
      echo '<p class="text-center">';
      echo 'Login failed. ' . $errors;
      echo '</p>';
  }
}

function calculateEndDate($startDate, $weeks){
  $period = (int) $weeks;
  return date("Y-m-d", strtotime('+' . $period . " week", strtotime($startDate)));
}

function isCurrentRental($rental){
    $isNull = false;
    foreach ($rental as $r){
        if ($r == NULL) $isNull = true;
    }return $isNull;
}

function isOverdue($rental){
    $currentDate = date('Y-m-d');
    $endDate = calculateEndDate($rental['startDate'], getPeriod());
    if ($currentDate > $endDate && ($rental['returnDate'] === NULL)){
      return true;
    }
    return false;
}

function isOverdueReturned($rental){
    $currentDate = date('Y-m-d');
    $endDate = calculateEndDate($rental['startDate'], getPeriod());
    if ($currentDate > $endDate && ($rental['returnDate'] > $endDate)){
      return true;
    }
    return false;
}

function wasOverdueWhenReturned($rental){
    $endDate = calculateEndDate($rental['startDate'], getPeriod());
    if ($rental['returnDate'] !== NULL){
      if ($rental['returnDate'] > $endDate){
        return true;
      }
      return false;
    }
}

function h($string="") {
    return htmlspecialchars($string);
}

function u($string="") {
    return urlencode($string);
}
function urlFor($script_path) {
    // add the leading '/' if not present
    if($script_path[0] != '/') {
        $script_path = "/" . $script_path;
    }
    return WWW_ROOT . $script_path;
}

function isCurrentlyAvailable($gameID){
    $rental = getRentalByGame($gameID);
    return !isCurrentRental($rental) || !isInRental($gameID) ;
}

function makeLinksClickable($text){
    return preg_replace('!(((f|ht)tp(s)?://)[-a-zA-Zа-яА-Я()0-9@:%_+.~#?&;//=]+)!i', '$1', $text);
}


function notBannedMembers(){
    $members = [];
    $member =  getMemberData();
    while($m = mysqli_fetch_assoc($member)) {
        if (!isBanned($m['memberID'])) array_push($members, $m['memberID']);
    }
    return $members;
}

?>
