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
    $result1 = mysqli_query($db, $sql); 
    confirm_result_set($result1);
    $subject = mysqli_fetch_assoc($result1);
    mysqli_free_result($result1);
    return $subject; 
    
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