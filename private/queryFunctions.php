<?php
require_once('setup/db.php');
require_once('validationFunctions.php');
require_once('functions.php');
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



function getGameRental($gameID){
  global $db;
  $sql = "SELECT returnDate, startDate, period FROM Rental ";
  $sql .= "WHERE gameID= '" . $gameID . "'";
  $result = mysqli_query($db, $sql);
  confirm_result_set($result);
  $subject = mysqli_fetch_assoc($result);
  mysqli_free_result($result);
  return $subject; // returns an assoc. array
}


function insert_game_data($game){
    global $db;

    $errors = validate_game($game);
    if(!empty($errors)){
        return $errors;
    }

    $sql = "INSERT INTO Game ";
    $sql .= "(cost, type, platform, ageLimit, name, isCurrentlyAvailable, releaseYear, imageLink, gameDescription) ";
    $sql .= "VALUES (";
    $sql .= "'" . $game['cost'] . "',";
    $sql .= "'" . $game['type'] . "',";
    $sql .= "'" . $game['platform'] . "',";
    $sql .= "'" . $game['ageLimit'] . "',";
    $sql .= "'" . $game['name'] . "',";
    $sql .= "'" . $game['isCurrentlyAvailable'] . "',";
    $sql .= "'" . $game['releaseYear'] . "',";
    $sql .= "'" . $game['imageLink'] . "',";
    $sql .= "'" . $game['gameDescription'] . "' ";
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
function update_game_data($game){
    global $db;

    $errors = validate_game($game);
        if(!empty($errors)){
            return $errors;
         }

    $sql = "UPDATE Game SET ";
    $sql .= "cost='" . $game['cost'] . "', ";
    $sql .= "type='" . $game['type'] . "', ";
    $sql .= "platform='" . $game['platform'] . "', ";
    $sql .= "ageLimit='" . $game['ageLimit'] . "', ";
    $sql .= "name='" . $game['name'] . "', ";
    $sql .= "isCurrentlyAvailable='" . $game['isCurrentlyAvailable'] . "', ";
    $sql .= "releaseYear='" . $game['releaseYear'] . "', ";
    $sql .= "imageLink='" . $game['imageLink'] . "', ";
    $sql .= "gameDescription='" . $game['gameDescription'] . "' ";
    $sql .= "WHERE gameID='" . $game['gameID'] . "' ";
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

  function get_default_ban_period(){ //Since they should all have the same value, getttin the first one should be the default
    global $db;
    $sql = "SELECT period FROM Ban ";
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
    $sql = "SELECT gameID FROM Rental WHERE gameID = $gameID;";
    $result = mysqli_query($db, $sql);
    if (mysqli_num_rows($result)==0) return false;
    else return true;
  }

  function insert_rental($rental){
    global $db;
    $start_date = date('Y-m-d');
    if (isCurrentlyAvailable($rental['GameID'])) return false;
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
    $sql = "SELECT name, firstname, startDate,period,extension, returnDate, rentalID, Rental.memberID as memberID ";
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

  function get_member_name_by_ID($memberID){
        global $db;
        $sql = "SELECT firstName FROM Member ";
        $sql .= "WHERE memberID='" . $memberID . "'";
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
        $subject = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
        return reset($subject);
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

    function isAdmin($username) {
    global $db;
    $sql = "SELECT Staff.email as adminEmail FROM Admin, Staff WHERE Admin.isCurrent = TRUE AND Admin.staffID = Staff.staffID";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $emails = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    if ($emails['adminEmail'] == $username) return true;
    else return false;
    }

    function getStaffData($staffUsername) {
        global $db;
        $sql = "SELECT firstname, surname FROM Staff WHERE Staff.email = '$staffUsername'";
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
        $data = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
        return $data;

    }

    function addMemberToBan($memberID){
      global $db;
      $startDate = date('Y-m-d');
      $period = get_default_ban_period();
      $periodInWeeks = $period * 4.345;
      //$endDate = calculateEndDate($startDate, round($periodInWeeks));
      $sql = "INSERT INTO Ban ";
      $sql .= "(memberID, startDate, endDate) ";
      $sql .= "VALUES (";
      $sql .= "'" . $memberID . "',";
      $sql .= "'" . $startDate . "',";
      $sql .= "NULL";
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
function search_games($search)
{
    global $db;
    $sql = "SELECT * FROM Game WHERE name LIKE '%" . $search . "%'";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
}

    function returnRental($rental,$isDamaged){
      global $db;
      $currentDate = date('Y-m-d');
      //$rental['returnDate'] = $currentDate;
      $overdue = [];
      $overdue['startDate'] = $rental['startDate'];
      $overdue['period'] = $rental['period'];
      $overdue['returnDate'] = $currentDate;
      if (isOverdueReturned($overdue) && !$isDamaged) increaseViolation($rental);
      if ($isDamaged) addMemberToBan($rental['memberID']);
      $sql = "UPDATE Rental set returnDate = ";
      $sql .= "'" . $currentDate . "'";
      $sql .= " WHERE " . $rental['rentalID'] . "= rentalID;";
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

    function getNumRows(){
    global $db;
    $sql = "SELECT * FROM Game";
    $result = mysqli_query($db, $sql);
    $numRows = mysqli_num_rows($result);
    return $numRows;
    }

    function increaseViolation($rental){
      global $db;
      $sql = "UPDATE Member set violations = violations+1";
      $sql .= " WHERE " . $rental['memberID'] . "= memberID;";
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
