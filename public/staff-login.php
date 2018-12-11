<?php
$loggingIn = true;
$active = "staff login";
$styleFileName = "login.css";
require_once('../private/initialize.php');
?>

<!DOCTYPE html>
<html lang="en">

<?php include(PRIVATE_PATH . '/shared/head.php'); ?>

<body>
<?php include(PRIVATE_PATH . '/shared/navigation.php'); ?>


  <div class="container text-center">

      <form class="form-signin" action="staff/dashboard.php" method="post">
        <h1 class="mb-4 mt-3 text-uppercase">Staff Login</h1>
        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="text" name="inputUsername" class="form-control mb-2" placeholder="Username" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" name="inputPassword" class="form-control" placeholder="Password" required>

        <button class="mt-3 btn btn-lg btn-login btn-block" type="submit" name ="btn">Sign in</button>

      </form>
    </div>

    <?php include(PRIVATE_PATH . '/shared/footer.php'); ?>

</body>
</html>
