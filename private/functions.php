<?php
function checkActive($navItem) {
    $className = "nav-link";
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
    $isNull = false;
    foreach ($rental as $r){
        if ($r == NULL) $isNull = true;
    }return $isNull;
}

function isOverdue($rental){
    $currentDate = date('Y-m-d');
    $endDate = calculateEndDate($rental['startDate'], $rental['period']);
    if ($currentDate > $endDate && ($rental['returnDate'] === NULL)){
      return true;
    }
    return false;
}

function isOverdueReturned($rental){
    $currentDate = date('Y-m-d');
    $endDate = calculateEndDate($rental['startDate'], $rental['period']);
    if ($currentDate > $endDate && ($rental['returnDate'] > $endDate)){
      return true;
    }
    return false;

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


function isCurrentlyAvailable($gameID){
    $rental = getGameRental($gameID);
    return !isCurrentRental($rental) || !is_game_being_rented($gameID) ;
}


function not_banned_members(){
    $members = [];
    $member =  get_simple_member_data();
          while($m = mysqli_fetch_assoc($member)) {
            if (!isBanned($m['memberID'])) array_push($members, $m['memberID']);
        }
   return $members;
}


function checkIfCorrectTitle($title){
    return $title == "Sir" || "Mr" || "Mrs"|| "Ms" || "Miss"||"Mx"||"Sir"|| "Lord"||"Lady";
}

?>
