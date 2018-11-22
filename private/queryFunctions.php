<?php 
//require_once('setup/db.php');
function find_staff_by_email($email){
    global $db;
    $sql = "SELECT email FROM Member ";
    $sql .= "WHERE email='" . $email . "'";
    $result = mysqli_query($db, $sql);
    //echo $result;
    confirm_result_set($result);
    $subject = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $subject;
}

?>