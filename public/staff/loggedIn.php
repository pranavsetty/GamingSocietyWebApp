<?php 
define("STAFF_PATH", dirname(__FILE__));
define("PUBLIC_PATH2", dirname(STAFF_PATH));
define("PROJECT", dirname(PUBLIC_PATH2));
require_once(PROJECT . '/private/initialize.php'); 
//???? cannot do require_once('../private/initialize.php')

?>


<?php

// Handle form values sent by new.php

$inputUsername = $_POST['inputUsername'] ?? '';
$inputPassword = $_POST['inputPassword'] ?? '';
//echo $inputusername;
//echo $inputPassword;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (find_staff_by_email($inputUsername)["email"] == $inputUsername
        && get_staff_password_by_email($inputUsername)["password"] == $inputPassword) {
    $_SESSION['username'] = $inputUsername;
    $_SESSION['password'] = $inputPassword;
    session_write_close();
    redirect_to ("dashboard.php");
    }
    else{
        echo '<script language = "javascript">';
        echo 'window.location.href = "../staff-login.php";';
        echo 'alert ("Incorrect email or password");';
        echo '</script>';
   }
} else {
  redirect_to('../staff-login.php');
}


?>
