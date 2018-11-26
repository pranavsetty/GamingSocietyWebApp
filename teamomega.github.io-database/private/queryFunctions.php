<?php
require_once('setup/db.php');
function find_staff_by_email($email){
    global $db;
    $sql = "SELECT email FROM Staff ";
    $sql .= "WHERE email='" . $email . "'";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $subject = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $subject;
}

function find_game_data($gameData){
    global $db;
    $sql = "SELECT * FROM Game ";
    $sql .= "WHERE game ='" . $gameData . "'";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $subject = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $subject;

}

function insert_game_data($cost, $type, $platform, $age_limit, $name, $is_currently_available, $release_year, $image_link){
  global $db;
  $sql = "INSERT INTO Game ";
  $sql .= "(cost, type, platform, ageLimit, name, isCurrentlyAvailable, releaseYear, imageLink) ";
  $sql .= "VALUES (";
  $sql .= "'" . $cost . "',";
  $sql .= "'" . $type . "',";
  $sql .= "'" . $platform . "',";
  $sql .= "'" . $age_limit . "',";
  $sql .= "'" . $name . "',";
  $sql .= "'" . $is_currently_available . "',";
  $sql .= "'" . $release_year . "',";
  $sql .= "'" . $image_link . "'";
  $sql .= ")";
  $result = mysqli_query($db, $sql);
  if($result){
    return true;
  }else{
    echo mysqli_error($db);
    db_disconnect($db);
    exit;
  }
}
function find_game_id($gameID) {
  global $db;
  $sql = "SELECT * FROM Game ";
  $sql .= "WHERE gameID='" . $id . "'";
  $result = mysqli_query($db, $sql);
  confirm_result_set($result);
  $subject = mysqli_fetch_assoc($result);
  mysqli_free_result($result);
  return $subject; // returns an assoc. array
}
function update_game_data($subject){
  global $db;
  $sql = "UPDATE Game SET ";
  $sql .= "cost='" . $subject['cost'] . "', ";
  $sql .= "type='" . $subject['type'] . "', ";
  $sql .= "platform='" . $subject['platform'] . "', ";
  $sql .= "ageLimit='" . $subject['ageLimit'] . "', ";
  $sql .= "name='" . $subject['name'] . "', ";
  $sql .= "isCurrentlyAvailable='" . $subject['isCurrentlyAvailable'] . "', ";
  $sql .= "releaseYear='" . $subject['releaseYear'] . "', ";
  $sql .= "imageLink='" . $subject['imageLink'] . "' ";
  $sql .= "WHERE gameID='" . $subject['gameID'] . "' ";
  $sql .= "LIMIT 1";

  $result = mysqli_query($db, $sql);

  if($result) {
    return true;
  } else {
    // UPDATE failed
    echo mysqli_error($db);
    db_disconnect($db);
    exit;
  }
}



//function add_game_data(){

//}

function get_staff_password_by_email($email){
    global $db;
    $sql = "SELECT password FROM Staff ";
    $sql .= "WHERE email='" . $email . "'";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $subject = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $subject;
}


?>
