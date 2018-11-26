<?php
define("PRIVATE_PATH", dirname(__FILE__));
define("PROJECT_PATH", dirname(PRIVATE_PATH));
define("PUBLIC_PATH", PROJECT_PATH . '/public');

require_once('functions.php');
require_once('setup/db.php');
require_once('validationFunctions.php');
require_once('queryFunctions.php');
 $db = db_connect()

?>
