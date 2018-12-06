<?php
$stylePath = "../../style/";
$styleFileName = "login.css";
require_once('../../../private/initialize.php');


if(is_post_request()) {

  $member = [];
  $member['Title'] = $_POST['Title'] ?? '';
  $member['FName'] = $_POST['FName'] ?? '';
  $member['LName'] = $_POST['LName'] ?? '';
  $member['DoB'] = $_POST['DoB'] ?? '';
  $member['PhoneNo'] = $_POST['PhoneNo'] ?? '';
  $member['Email'] = $_POST['Email'] ?? '';
  $member['Address'] = $_POST['Address'] ?? '';


  $result = insert_member($member);
  if($result === true) {
    //$new_id = mysqli_insert_id($db); Not sure what this is for
    echo '<script language = "javascript">';
    echo 'window.location.href = "../dashboard.php";';
    echo 'alert ("You have successfully added a new Member");';
    echo '</script>';
  }
  else {
    echo '<script language = "javascript">';
    echo 'alert ("Error: Could not add new Memeber");';
    echo '</script>';
  }

}
?>

<!DOCTYPE html>
<html lang="en">

<?php include(PRIVATE_PATH . '/head.php'); ?>

<body>


  <div class="container">

      <form class="form-signin" action="addMember.php" method="post">

        <h1 class="mb-4 mt-3 text-uppercase" align = "center">Add Memeber</h1>
        <div class = 'form-group'>
          <label for="Title">Title</label>
          <input type="text" name="Title" id = "Title" class="form-control mb-2" placeholder="Title" required autofocus>
        </div>

        <div class = 'form-group'>
          <label for="FName">Name</label>
          <input type="text" name="FName" id = "FName"class="form-control mb-2" placeholder="First Name" required autofocus>
        </div>

        <div class = 'form-group'>
          <label for="LName">Surname</label>
          <input type="text" name="LName" id = "LName" class="form-control mb-2" placeholder="Last Name" required>
        </div>

        <div class = 'form-group'>
          <label for="DoB">Date of Birth</label>
          <input type="date" name="DoB" id = "DoB" class="form-control mb-2" placeholder="Last Name" required>
        </div>

        <div class = 'form-group'>
          <label for="PhoneNo">Phone Number</label>
          <input type="text" name="PhoneNo" id = "PhoneNo" class="form-control mb-2" placeholder="Phone Number" required>
        </div>

        <div class = 'form-group'>
          <label for="Email">Email</label>
          <input type="email" name="Email" id = "Email" class="form-control mb-2" placeholder="Email" required>
        </div>

        <div class = 'form-group'>
          <label for="Address">Address</label>
          <input type="text" name="Address" id = "Address" class="form-control mb-2" placeholder="Home Address" required>
        </div>

        <button class="mt-3 btn btn-lg btn-login btn-block" type="submit" name ="Add member">Add member</button>

      </form>
    </div>

    <?php include(PRIVATE_PATH . '/footer.php'); ?>

</body>
</html>
