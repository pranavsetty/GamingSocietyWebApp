<?php
require_once('credentials.php');
  // ---
  // The code in this file is taken (with only minor changes) from
  // PHP with MySQL Essential Training: 1 The Basics
  // by Kevin Skoglund
  //
  // This code aims to demonstrate the steps needed to set up a connection to a database.
  // It is intended to be used as an exercise to show how to set up a database connection
  // between your PHP application and a MySQL database within a CodeAnywhere container.
  // Reusing this file in its current form in your applications would be ill-advised as
  // you should not combine this many concerns in a single file.
  // ---

  // Switch on all errors
  error_reporting(E_ALL);
  ini_set('display_errors', TRUE);
  ini_set('display_startup_errors', TRUE);

  // Credentials
  $dbhost = 'localhost';
  $dbuser = 'root';
  $dbpass = '';
  $dbname = 'omega_db';

  // 1. Create a database connection
  //$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

  function db_connect() {
    $connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
    confirm_db_connect();
    return $connection;
  }
  
  function db_disconnect($connection) {
    if(isset($connection)) {
      mysqli_close($connection);
    }
  }
  
  function confirm_db_connect() {
    if(mysqli_connect_errno()) {
      $msg = "Database connection failed: ";
      $msg .= mysqli_connect_error();
      $msg .= " (" . mysqli_connect_errno() . ")";
      exit($msg);
    }
  }

  // 2. Perform database query
  //$query = "SELECT * FROM Member";
  //$result_set = mysqli_query($connection, $query);
  
  function confirm_result_set($result_set) {
    if (!$result_set) {
    	exit("Database query failed.");
    }
  }
?>
