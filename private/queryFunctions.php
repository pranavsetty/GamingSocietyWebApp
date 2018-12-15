<?php
require_once('setup/db.php');
require_once('validationFunctions.php');
require_once('functions.php');

function hasEndDate($memberID) {
    global $db;
    $sql = "SELECT IF (EXISTS (SELECT * FROM Ban WHERE memberID='" . $memberID . "'";
    $sql .= " AND endDate IS NOT NULL), 'yes', 'no') AS 'hasEndDate'";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $answer = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    if ($answer['hasEndDate'] == 'yes') {
        return true;
    } else {
        return false;
    }
}
function getBanByMember($memberID) {
    global $db;
    $sql = "SELECT * FROM Ban ";
    $sql .= "WHERE memberID='" . $memberID . "'";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $ban = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $ban;
}

function getGameByID($game)
{
    global $db;
    $sql = "SELECT * FROM Game ";
    $sql .= "WHERE gameID='" . $game['gameID'] . "'";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $game = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $game;
}

function get_staff_by_email($email)
{
    global $db;
    $sql = "SELECT staffID, email, password FROM Staff ";
    $sql .= "WHERE email='" . $email . "'";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $staff = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $staff;
}

function find_game_data()
{
    global $db;
    $sql = "SELECT * FROM Game ";
    $sql .= "ORDER BY gameID ASC";
    $result = mysqli_query($db, $sql);
    return $result;
}

function find_member_data()
{
    global $db;
    $sql = "SELECT * FROM Member ";
    $sql .= "ORDER BY memberID ASC";
    $result = mysqli_query($db, $sql);
    return $result;

}

function find_game_data_filter($order, $type, $platform, $search)
{
    global $db;
    $sql = "SELECT * FROM Game";
    if ($search != '') {
        $sql .= " WHERE name LIKE '%" . $search . "%'";
        if ($type != '') {
            $sql .= " AND type='" . $type . "'";
        }
        if ($platform != '') {
            $sql .= " AND platform='" . $platform . "'";
        }
    } else {
        if ($type != '') {
            $sql .= " WHERE type='" . $type . "'";
            if ($platform != '') {
                $sql .= " AND platform='" . $platform . "'";
            }

        } else {
            if ($platform != '') {
                $sql .= " WHERE platform='" . $platform . "'";
            }
        }

    }

    if ($order == 'yearDesc') {
        $sql .= " ORDER BY releaseYear DESC";
    } else if ($order == 'yearAsc') {
        $sql .= " ORDER BY releaseYear ASC";
    } else {
        $sql .= " ORDER BY name ASC";
    }

    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;

}

function getGameByRental($rentalID) {
    global $db;
    $sql = "SELECT gameID FROM Rental ";
    $sql .= "WHERE rentalID= '" . $rentalID . "'";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $game = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $game;
}

function getGameRental($gameID)
{
    global $db;
    $sql = "SELECT returnDate, startDate, period FROM Rental ";
    $sql .= "WHERE gameID= '" . $gameID . "'";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $rentals = array();
    while($subject = mysqli_fetch_assoc($result)){
        $rentals[] = $subject['returnDate'];
    }
    mysqli_free_result($result);
    return $rentals; // returns an assoc. array
}


function insert_game_data($game)
{
    global $db;

    $errors = validate_game($game);
    if (!empty($errors)) {
        return $errors;
    }

    $sql = "INSERT INTO Game ";
    $sql .= "(cost, type, platform, ageLimit, name, releaseYear, imageLink, gameDescription) ";
    $sql .= "VALUES (";
    $sql .= "'" . $game['cost'] . "',";
    $sql .= "'" . $game['type'] . "',";
    $sql .= "'" . $game['platform'] . "',";
    $sql .= "'" . $game['ageLimit'] . "',";
    $sql .= "'" . $game['name'] . "',";
    $sql .= "'" . $game['releaseYear'] . "',";
    $sql .= "'" . $game['imageLink'] . "',";
    $sql .= "'" . $game['gameDescription'] . "' ";
    $sql .= ");";
    $result = mysqli_query($db, $sql);
    if ($result) {
        return true;
    } else {
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}

function find_game_id($gameID)
{
    global $db;
    $sql = "SELECT * FROM Game ";
    $sql .= "WHERE gameID='" . $gameID . "'";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $subject = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $subject; // returns an assoc. array
}

function find_member_id($memberID)
{
    global $db;
    $sql = "SELECT * FROM Member ";
    $sql .= "WHERE memberID='" . $memberID . "'";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $subject = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $subject; // returns an assoc. array
}

function update_game_data($game)
{
    global $db;

    $errors = validate_game($game);
    if (!empty($errors)) {
        return $errors;
    }

    $sql = "UPDATE Game SET ";
    $sql .= "cost='" . $game['cost'] . "', ";
    $sql .= "type='" . $game['type'] . "', ";
    $sql .= "platform='" . $game['platform'] . "', ";
    $sql .= "ageLimit='" . $game['ageLimit'] . "', ";
    $sql .= "name='" . $game['name'] . "', ";
    $sql .= "releaseYear='" . $game['releaseYear'] . "', ";
    $sql .= "imageLink='" . $game['imageLink'] . "', ";
    $sql .= "gameDescription='" . $game['gameDescription'] . "' ";
    $sql .= "WHERE gameID='" . $game['gameID'] . "' ";
    $sql .= "LIMIT 1;";

    $result = mysqli_query($db, $sql);

    if ($result) {
        return true;
    } else {
        // UPDATE failed
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}

function updateRentalExtension($rental){
  global $db;
  $sql = "UPDATE Rental set extension = extension +1 " ;
  $sql .= " WHERE " . $rental['rentalID'] . " = rentalID;";
  $result = mysqli_query($db, $sql);
    if ($result) {
        return true;
    } else {
        // UPDATE failed
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}


function updateRentalPeriod($rental){
    global $db;
    $sql = "UPDATE Rental set period = period +1 " ;
    $sql .= " WHERE " . $rental['rentalID'] . " = rentalID;";
    $result = mysqli_query($db, $sql);
    if ($result) {
        return true;
    } else {
        // UPDATE failed
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}

function updateDebt($member){
    global $db;
    $errorsMembers = validate_debt($member);
    if (!empty($errorsMembers)) {
        return $errorsMembers;
    }
    $sql = "UPDATE Member SET ";
    $sql .= "debt='" . $member['debt'] . "' ";
    $sql .= "WHERE memberID='" . $member['memberID'] . "' ";
    $sql .= "LIMIT 1;";
    $result = mysqli_query($db, $sql);

    if ($result) {
        return true;
    } else {
        // UPDATE failed
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}

function add_debt($memberID, $cost){
    global $db;
    $sql = "UPDATE Member SET ";
    $sql .= "debt= debt + '" . $cost . "' ";
    $sql .= "WHERE memberID='" . $memberID . "' ";
    $sql .= "LIMIT 1;";
    $result = mysqli_query($db, $sql);

    if ($result) {
        return true;
    } else {
        // UPDATE failed
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}

function get_staff_password_by_email($email)
{
    global $db;
    $sql = "SELECT password FROM Staff ";
    $sql .= "WHERE email='" . $email . "'";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $subject = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $subject;
}


function insert_member($member)
{
    global $db;
    $sql = "INSERT INTO Member ";
    $sql .= "(title, firstname, surname, DoB, phoneNo, email, homeAddress) ";
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
    if ($result) {
        return true;
    } else {
        // INSERT failed
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}

//function get_default_period()
//{   global $db;
//    $sql = "SELECT period FROM Rental ";
//    $sql .= "ORDER BY period ASC ";
//    $sql .= "LIMIT 1";
//    $result = mysqli_query($db, $sql);
//    confirm_result_set($result);
//    $subject = mysqli_fetch_assoc($result);
//    mysqli_free_result($result);
//    return reset($subject);
//}

function get_ban_period()
{
    global $db;
    $sql = "SELECT value FROM Rules ";
    $sql .= "WHERE description = ";
    $sql .= "'ban_period';";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $subject = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return reset($subject);
}

function is_game_being_rented($gameID)
{
    global $db;
    $sql = "SELECT gameID FROM Rental WHERE gameID = $gameID;";
    $result = mysqli_query($db, $sql);
    if (mysqli_num_rows($result) == 0) return false;
    else return true;
}

function insert_rental($rental)
{
    global $db;
    $start_date = date('Y-m-d');
    if (!isCurrentlyAvailable($rental['GameID'])) return false;
    if (!canRentMoreGames($rental['MemberID'], $rental['GameID'])) return false;
    $sql = "INSERT INTO Rental ";
    $sql .= "(memberID, gameID, startDate, period) ";
    $sql .= "VALUES (";
    $sql .= "'" . $rental['MemberID'] . "',";
    $sql .= "'" . $rental['GameID'] . "',";
    $sql .= "'" . $start_date . "',";
    $sql .= "'" . getPeriod() . "'";
    $sql .= ");";
    $result = mysqli_query($db, $sql);
    // For INSERT statements, $result is true/false
    if ($result) {
        return true;
    } else {
        // INSERT failed
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}

function canRentMoreGames($memberID, $gameID){
    global $db;
    $sql = "SELECT COUNT(*) as count FROM Rental ";
    $sql .= "WHERE memberID = " . $memberID ." AND returnDate IS NULL ";
    $sql .= "GROUP BY memberID ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $rental = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return ($rental['count'] < getRentGames());
}

function getRentGames(){
    global $db;
    $sql = "SELECT value FROM Rules ";
    $sql .= "WHERE description = ";
    $sql .= "'max_number_of_games_at_once';";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $subject = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return reset($subject);
}

function getPeriod(){
  global $db;
  $sql = "SELECT value FROM Rules ";
  $sql .= " WHERE description = ";
  $sql .= " 'period_in_weeks'; ";
  $result = mysqli_query($db, $sql);
    return resultToInt($result);
}

function findRentals()
{
    global $db;
    $sql = "SELECT name, firstname, surname, startDate,extension, returnDate, rentalID, Rental.memberID as memberID ";
    $sql .= "FROM Game, Rental, Member ";
    $sql .= "WHERE Game.gameID = Rental.gameID AND Rental.memberID = Member.memberID";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
}

function findMemberRentals($memberID)
{
    global $db;
    $sql = "SELECT startDate,returnDate ";
    $sql .= "FROM Rental ";
    $sql .= "WHERE memberID = ".$memberID."";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
}

function get_rules_data()
{
    global $db;
    $sql = "SELECT description, value FROM Rules";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
}



function get_staff_data()
{
    global $db;
    $sql = "SELECT staffID, firstname, surname, phoneNo, DoB, email, homeAddress ";
    $sql .= "FROM  Staff;";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
}

function get_simple_member_data()
{
    global $db;
    $sql = "SELECT memberID, firstname, surname, phoneNo, DoB, email, homeAddress, violations, debt ";
    $sql .= "FROM  Member;";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
}

function get_member_by_ID($memberID)
{
    global $db;
    $sql = "SELECT firstName, surname FROM Member ";
    $sql .= "WHERE memberID='" . $memberID . "'";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $member = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $member;
}

function get_member_with_fees()
{
    global $db;
    $sql = "SELECT memberID, firstname, surname, phoneNo, DoB, email, homeAddress, violations, debt ";
    $sql .= "FROM  Member WHERE debt > 0;";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
}


function isBanned($memberID)
{
    global $db;
    $sql = "SELECT memberID FROM Ban WHERE Ban.memberID = $memberID;";
    $result = mysqli_query($db, $sql);
    if (mysqli_num_rows($result) == 0) return false;
    else return true;
}

function findGame()
{
    global $db;
    $sql = "SELECT * FROM Game WHERE name LIKE '%query%'";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;

}

function getAdmin(){
  global $db;
  $sql = "SELECT staffID FROM Admin ";
  $sql .= "WHERE isCurrent = true;";
  $result = mysqli_query($db, $sql);
  confirm_result_set($result);
  $subject = mysqli_fetch_assoc($result);
  mysqli_free_result($result);
  return reset($subject);
}

function makeAdmin($staffID, $adminID){
  global $db;
  $sql = "UPDATE Admin SET staffID = ". $staffID ." WHERE staffID = ". $adminID ." ";
  $result = mysqli_query($db, $sql);
  // For UPDATE statements, $result is true/false
  if ($result) {
      return true;
  } else {
      // UPDATE failed
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
  }
}

function isAdmin($username)
{
    global $db;
    $sql = "SELECT Staff.email as adminEmail FROM Admin, Staff WHERE Admin.isCurrent = TRUE AND Admin.staffID = Staff.staffID";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $emails = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    if ($emails['adminEmail'] == $username) return true;
    else return false;
}

function getStaffDataByEmail($staffUsername)
{
    global $db;
    $sql = "SELECT firstname, surname FROM Staff WHERE Staff.email = '$staffUsername'";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $data = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $data;
}


function addMemberToBan($memberID, $checker)
{
    global $db;
    $startDate = date('Y-m-d');
    $period = get_ban_period();
    $endDate = calculateEndDate($startDate, $period);
    if (isBanned($memberID)) {
        $sql = "UPDATE Ban SET ";
        $sql .= "startDate='" . $startDate . "' ";
        $sql .= "WHERE memberID='" . $memberID . "' ";
        $sql .= "LIMIT 1;";
    }
        else if ($checker == 1){
          $sql = "INSERT INTO Ban ";
          $sql .= "(memberID, startDate, endDate, period) ";
          $sql .= "VALUES (";
          $sql .= "'" . $memberID . "',";
          $sql .= "'" . $startDate . "',";
          $sql .= "'" .$endDate. " ', ";
          $sql .= "'".$period."'";
          $sql .= ");";
        }
        else {
        $sql = "INSERT INTO Ban ";
        $sql .= "(memberID, startDate, endDate, period) ";
        $sql .= "VALUES (";
        $sql .= "'" . $memberID . "',";
        $sql .= "'" . $startDate . "',";
        $sql .= "NULL, ";
        $sql .= "'".$period."'";
        $sql .= ");";
    }

    $result = mysqli_query($db, $sql);
    // For INSERT statements, $result is true/false
    if ($result) {
        return true;
    } else {
        // INSERT failed
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}

function removeFromBan($memberID){
  global $db;
  $sql = "Delete FROM Ban WHERE memberID = " .$memberID." ";
  $result = mysqli_query($db, $sql);
  // For UPDATE statements, $result is true/false
  if ($result) {
      return true;
  } else {
      // UPDATE failed
      echo mysqli_error($db);
      db_disconnect($db);
      return false;
      exit;
  }
}


function getDebt($memberID){
  global $db;
  $sql = "SELECT debt FROM Member ";
  $sql .= "WHERE memberID = ".$memberID." ";
  $result = mysqli_query($db, $sql);
  confirm_result_set($result);
  $subject = mysqli_fetch_assoc($result);
  mysqli_free_result($result);
  return reset($subject);
}



function search_games($search)
{
    global $db;
    $sql = "SELECT * FROM Game WHERE name LIKE '%" . $search . "%'";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
}

function make_links_clickable($text){
    return preg_replace('!(((f|ht)tp(s)?://)[-a-zA-Zа-яА-Я()0-9@:%_+.~#?&;//=]+)!i', '$1', $text);
}

function returnRental($rental, $isDamaged)
{
    global $db;
    $currentDate = date('Y-m-d');
    //$rental['returnDate'] = $currentDate;
    $overdue = [];
    $overdue['startDate'] = $rental['startDate'];
    $overdue['period'] = $rental['period'];
    $overdue['returnDate'] = $currentDate;
    if (isOverdueReturned($overdue) && !$isDamaged) increaseViolation($rental);
    if ($isDamaged) {
        addMemberToBan($rental['memberID']);
        $gameID = getGameByRental($rental['rentalID']);
        $game = getGameByID($gameID);
        add_debt($rental['memberID'], $game['cost']);
    }
    $sql = "UPDATE Rental set returnDate = ";
    $sql .= "'" . $currentDate . "'";
    $sql .= " WHERE " . $rental['rentalID'] . "= rentalID;";
    $result = mysqli_query($db, $sql);
    // For UPDATE statements, $result is true/false
    if ($result) {
        return true;
    } else {
        // UPDATE failed
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}

function countGames()
{
    global $db;
    $sql = "SELECT * FROM Game";
    $result = mysqli_query($db, $sql);
    $numGames = mysqli_num_rows($result);
    return $numGames;
}

function countRentals()
{
    global $db;
    $sql = "SELECT * FROM Rental";
    $result = mysqli_query($db, $sql);
    $numRentals = mysqli_num_rows($result);
    return $numRentals;
}


function countBanMembers()
{
    global $db;
    $sql = "SELECT DISTINCT(memberID) FROM Ban";
    $result = mysqli_query($db, $sql);
    $numBanMembers = mysqli_num_rows($result);
    return $numBanMembers;
}

function countMembers()
{
    global $db;
    $sql = "SELECT * FROM Member";
    $result = mysqli_query($db, $sql);
    $numMembers = mysqli_num_rows($result);
    $numCurrentMembers = $numMembers - countBanMembers();
    return $numCurrentMembers;
}


function countStaff()
{
    global $db;
    $sql = "SELECT * FROM Staff";
    $result = mysqli_query($db, $sql);
    $numStaff = mysqli_num_rows($result);
    return $numStaff;
}

function countRules()
{
    global $db;
    $sql = "SELECT * FROM Rules";
    $result = mysqli_query($db, $sql);
    $numRules = mysqli_num_rows($result);
    return $numRules;
}

function countTotalDebt()
{
    global $db;
    $sql = "SELECT * FROM Member";
    $result = mysqli_query($db, $sql);
    $numDebt = 0;
    while ($num = mysqli_fetch_assoc($result)) {
        $numDebt += $num['debt'];
    }
    return $numDebt;
}

function getViolations($memberID){
  global $db;
  $sql = "SELECT violations FROM Member ";
  $sql .= "WHERE memberID = ".$memberID. " ";
  $result = mysqli_query($db, $sql);
  confirm_result_set($result);
  $subject = mysqli_fetch_assoc($result);
  mysqli_free_result($result);
  return reset($subject);
}

function getMaxViolationsPerYear(){
  global $db;
  $sql = "SELECT value FROM Rules ";
  $sql .= " WHERE description = ";
  $sql .= " 'max_violations_per_year'; ";
    $result = mysqli_query($db, $sql);
    return resultToInt($result);
}


function increaseViolation($rental)
{
    global $db;
    if (getViolations($rental['memberID']) == getMaxViolationsPerYear()){
      $pastOverdue =[];
      $counter = 0;
      $dates = findMemberRentals($rental['memberID']);
      while ($memberRental = mysqli_fetch_assoc($dates)) {
          if (wasOverdueWhenReturned($memberRental)) {
          array_push($pastOverdue, $memberRental['returnDate']);
          $counter++;
    }
  }
  $firstOverdue = date((min($pastOverdue)));
  $lastOverdue = date((max($pastOverdue)));
  //$diff = abs(strtotime($lastOverdue) - strtotime($firstOverdue));
  echo gettype($firstOverdue);
  echo gettype($lastOverdue);
  //echo "DIFF IS     " . $diff . "    ";
  echo "The first overdue rental date is = " . $firstOverdue. "   ";
  echo "The last overdue rental date is = " . $lastOverdue. "   ";
  echo "The count is = " . $counter. "";
  if ($counter >= getMaxViolationsPerYear() && date_diff($firstOverdue,$lastOverdue) <= 365){
    addMemberToBan($rental['memberID'], 1);
    echo '<script language = "javascript">';
    echo 'alert ("Member is added to ban");';
    echo '</script>';
  }
}else{
    $sql = "UPDATE Member set violations = violations+1";
    $sql .= " WHERE " . $rental['memberID'] . "= memberID;";
    $result = mysqli_query($db, $sql);
    // For UPDATE statements, $result is true/false
    if ($result) {
        return true;
    } else {
        // UPDATE failed
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
  }
}

function insert_staff($staff){
    global $db;
    $hashed_password = password_hash($staff['Password'], PASSWORD_BCRYPT);

    $sql = "INSERT INTO Staff ";
    $sql .= "(title, firstname, surname, DoB, phoneNo, email, homeAddress, password) ";
    $sql .= "VALUES (";
    $sql .= "'" . $staff['Title'] . "',";
    $sql .= "'" . $staff['FName'] . "',";
    $sql .= "'" . $staff['LName'] . "',";
    $sql .= "'" . $staff['DoB'] . "',";
    $sql .= "'" . $staff['PhoneNo'] . "',";
    $sql .= "'" . $staff['Email'] . "',";
    $sql .= "'" . $staff['Address'] . "',";
    $sql .= "'" . $hashed_password . "'";
    $sql .= ");";
    $result = mysqli_query($db, $sql);
    // For INSERT statements, $result is true/false
    if ($result) {
        return true;
    } else {
        // INSERT failed
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }

}


function getRules(){
  global $db;
  $sql = "SELECT * FROM Rules";
  $result = mysqli_query($db, $sql);
  return $result;
}
function resultToInt($result){
    confirm_result_set($result);
    $subject = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return intval(reset($subject));
}

function getMaxExtensions(){
  global $db;
  $sql = "SELECT value FROM Rules ";
  $sql .= " WHERE description = ";
  $sql .= " 'max_number_of_extensions'; ";
    $result = mysqli_query($db, $sql);
    return resultToInt($result);
}




function getExtension($rental)
{
    global $db;
    $sql = "SELECT extension FROM Rental ";
    $sql .= " WHERE " . $rental['rentalID'] . " = rentalID;";
    $result = mysqli_query($db, $sql);
    return resultToInt($result);
}

function find_types() {
    global $db;
    $sql = "SELECT DISTINCT(type) FROM Game";
    $result = mysqli_query($db, $sql);
    return $result;
}

function find_platforms() {
    global $db;
    $sql = "SELECT DISTINCT(platform) FROM Game";
    $result = mysqli_query($db, $sql);
    return $result;

}

function deleteStaff($staffID){
  global $db;
  $sql = "Delete FROM Staff WHERE staffID = " .$staffID." ";
  $result = mysqli_query($db, $sql);
  // For UPDATE statements, $result is true/false
  if ($result) {
      return true;
  } else {
      // UPDATE failed
      echo mysqli_error($db);
      db_disconnect($db);
      return false;
      exit;
  }
}

function editRule($description,$value){
  global $db;
  $errorsRules = validate_rules($value);
  if (!empty($errorsRules)) {
      return $errorsRules;
  }
  $sql = "UPDATE Rules set value = '$value' WHERE  '$description' = description;";
  $result = mysqli_query($db, $sql);
  // For UPDATE statements, $result is true/false
  if ($result) {
      return true;
  } else {
      // UPDATE failed
      echo mysqli_error($db);
      db_disconnect($db);
      return false;
      exit;
  }
}
?>
