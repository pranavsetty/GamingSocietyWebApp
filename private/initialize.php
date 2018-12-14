<?php
session_name("omega");
session_start();
define("PRIVATE_PATH", dirname(__FILE__));
define("PROJECT_PATH", dirname(PRIVATE_PATH));
define("PUBLIC_PATH", PROJECT_PATH . '/public');
define("SHARED_PATH", PRIVATE_PATH . '/shared');

$public_end = strpos($_SERVER['SCRIPT_NAME'], '/public') + 7;
$doc_root = substr($_SERVER['SCRIPT_NAME'], 0, $public_end);
define("WWW_ROOT", $doc_root);

require_once('functions.php');
require_once('setup/db.php');
require_once('validationFunctions.php');
require_once('queryFunctions.php');
require_once('loginFunctions.php');
 $db = db_connect();
 $errors = [];

 $errorsMembers =[];

 $errorsRules = [];


?>
