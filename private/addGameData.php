<?php
$connection = mysql_connect("localhost", "root", "");
$db = mysql_select_db("Game", $connection);
if(isset($_POST['submit']));
$name = $_POST['name'];
$platform  = $_POST['platform'];
$ageLimit = $_POST['ageLimit'];
$cost = $_POST['cost'];
$releaseYear = $_POST['releaseYear'];
$rating = $_POST['rating'];
$ID = $_POST['ID'];

$query = mysql_query("insert into Games(game_name, game_platform, game_ageLimit, game_cost, game_releaseYear, game_rating) values ('$name', '$platform', '$ageLimit', '$cost', '$releaseYear', '$ID')");
echo "<br/><br/><span>Data Inserted successfully...!!</span>";
}
else{
echo "<p>Insertion Failed <br/> Some Fields are Blank....!!</p>";
}
}
mysql_close($connection);
?>
