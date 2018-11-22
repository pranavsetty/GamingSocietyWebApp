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
    if (find_staff_by_email($inputUsername)["email"] == $inputUsername) {
    echo "Well done!";
    }
    else{
        redirect_to("../staff-login.php");
        prompt("FUCK ME");
   }
    echo "Form parameters<br />";
    echo "Username: " . $inputUsername . "<br />";
    echo "Password: " . $inputPassword . "<br />";
    
    
} else {
  redirect_to('../staff-login.php');
  //redirection doesn't work??

}


?>
