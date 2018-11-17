<?php 
$loggingIn = true;
$active = "staff login";
$styleFileName = "login.css";
define("PUBLIC_PATH1", dirname(__FILE__));
define("PROJECT", dirname(PUBLIC_PATH1));
require_once(PROJECT . '/private/initialize.php'); 
//???? cannot do require_once('../private/initialize.php')

?>

<!DOCTYPE html>
<html lang="en">

<?php include(PRIVATE_PATH . '/head.php'); ?>

<body>
    <?php include(PRIVATE_PATH . '/navigation.php'); ?>

        
  <div class="container text-center">
      <form class="form-signin">
        <h1 class="mb-4 upperCase">Staff Login</h1>
        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="text" id="inputUsername" class="form-control mb-2" placeholder="Username" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" class="form-control" placeholder="Password" required>

        <button class="mt-3 btn btn-lg btn-dark btn-block" type="submit">Sign in</button>

      </form>
    </div>
    
    <?php include(PRIVATE_PATH . '/footer.php'); ?>

</body>
</html>
