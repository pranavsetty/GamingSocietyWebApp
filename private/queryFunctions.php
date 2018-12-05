<?php
require_once('setup/db.php');
require_once('validationFunctions.php');
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

function find_game_data(){
    global $db;
    $sql = "SELECT * FROM Game ";
    $sql .= "ORDER BY gameID ASC";
    $result = mysqli_query($db, $sql);
    return $result;

}
// TODO
// function find_simple_game_data(){
//   global $db;
//   $sql = "SELECT * FROM Game ";
//   $sql .= "ORDER BY gameID ASC";
//   $result = mysqli_query($db, $sql);
//   return $result;
// }

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
    $sql .= ");";
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
    $sql .= "WHERE gameID='" . $gameID . "'";
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
    $sql .= "LIMIT 1;";

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


function insert_member($member) {
    global $db;
    $sql = "INSERT INTO Member ";
    $sql .= "(title, firstname, surname, DoB, phoneNo, email, homeAdress) ";
    $sql .= "VALUES (";
    $sql .= "'" . $member['Title'] . "',";
    $sql .= "'" . $member['FName'] . "',";
    $sql .= "'" . $member['LName'] . "',";
    $sql .= "'" . $member['DoB'] . "',";
    $sql .= "'" . $member['PhoneNo'] . "',";
    $sql .= "'" . $member['Email'] . "',";
    $sql .= "'" . $member['Address'] . "'";
    $sql .= ");";
    $result = mysqli_query($db, $sql);
    // For INSERT statements, $result is true/false
    if($result) {
      return true;
    } else {
      // INSERT failed
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
  }

  function get_default_period(){ //Since they should all have the same value, getttin the first one should be the default
    global $db;
    $sql = "SELECT period FROM Rental ";
    $sql .= "ORDER BY period ASC ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $subject = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return reset($subject);
  }

  function is_game_being_rented($gameID){
    global $db;
    $sql = "SELECT COUNT(1) FROM Rental WHERE gameID = $gameID;";
    $result = mysqli_query($db, $sql);
    if (mysqli_num_rows($result)==0) return false;
    else return true;
  }

  function insert_rental($rental){
    global $db;
    $start_date = date('Y-m-d');
    if (is_game_being_rented($rental['MemberID'])) return false;
    $sql = "INSERT INTO Rental ";
    $sql .= "(memberID, gameID, startDate) ";
    $sql .= "VALUES (";
    $sql .= "'" . $rental['MemberID'] . "',";
    $sql .= "'" . $rental['GameID'] . "',";
    $sql .= "'" . $start_date . "'";
    $sql .= ");";
    $result = mysqli_query($db, $sql);
    // For INSERT statements, $result is true/false
    if($result) {
      return true;
    } else {
      // INSERT failed
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
  }

  function changeDefaultPeriod($newPeriod){
    global $db;
    $sql = "ALTER TABLE Rental ALTER period SET DEFAULT $newPeriod";
    $result = mysqli_query($db, $sql);
    if($result) {
      return true;
    } else {
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
  }

  function findRentals(){
    global $db;
    $sql = "SELECT name, firstname, startDate,period,extension, returnDate, rentalID ";
    $sql .= "FROM Game, Rental, Member ";
    $sql .= "WHERE Game.gameID = Rental.gameID AND Rental.memberID = Member.memberID";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
  }

  function get_simple_member_data(){
    global $db;
    $sql = "SELECT memberID,firstname, phoneNo, DoB, email, homeAddress, violations ";
    $sql .= "FROM  Member;";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
  }

  function isBanned($memberID){
    global $db;
    $sql = "SELECT memberID FROM Ban WHERE Ban.memberID = $memberID;";
    $result = mysqli_query($db, $sql);
    if (mysqli_num_rows($result)==0) return false;
    else return true;
  }

  function findGame(){
    global $db;
    $sql = "SELECT * FROM Game WHERE name LIKE '%query%'";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
    }


    function returnRental($rentalID){
      global $db;
      $currentDate = date('Y-m-d');
      $sql = "UPDATE Rental set returnDate = ";
      $sql .= "'" . $currentDate . "'";
      $sql .= " WHERE " . $rentalID . "= rentalID;";
      $result = mysqli_query($db, $sql);
    // For UPDATE statements, $result is true/false
      if($result) {
        return true;
      } else {
      // UPDATE failed
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
      }
    }

?>
