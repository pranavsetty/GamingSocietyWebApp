<?php

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
  $dbname = 'demo_db';

  // 1. Create a database connection
  $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

  // 2. Perform database query
  $query = "SELECT * FROM things";
  $result_set = mysqli_query($connection, $query);
?>

<html>
  <head>
    <title>Database connection</title>
  </head>
  <body>
    <h1>
      Database connection
    </h1>
    <table border="1">
      <tr><td>Name</td><td>Price</td></tr>
      <?php
        // 3. Use returned data (if any)
        while($thing = mysqli_fetch_assoc($result_set)) {
          echo "<tr><td>" . $thing["name"] . "</td><td>" . $thing["price"] . "</td></tr>";
        }
      ?>
    </table>



  </body>
</html>

<?php
  // 4. Release returned data
  mysqli_free_result($result_set);

  // 5. Close database connection
  mysqli_close($connection);
?>
