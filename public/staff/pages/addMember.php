<?php
$stylePath = "../../style/";
$styleFileName = "add.css";
require_once('../../../private/initialize.php');
require_login();

if(isPostRequest()) {

    $member = [];
    $member['Title'] = $_POST['Title'] ?? '';
    $member['FName'] = $_POST['FName'] ?? '';
    $member['LName'] = $_POST['LName'] ?? '';
    $member['DoB'] = $_POST['DoB'] ?? '';
    $member['PhoneNo'] = $_POST['PhoneNo'] ?? '';
    $member['Email'] = $_POST['Email'] ?? '';
    $member['Address'] = $_POST['Address'] ?? '';


    $result = insertMember($member);
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

<?php include(PRIVATE_PATH . '/shared/head.php'); ?>

<body>
<?php include(PRIVATE_PATH . '/shared/navigationStaff.php'); ?>

<div class="container mb-5">

    <form class="form" action="addMember.php" method="post">

        <div class="row d-flex justify-content-center">
            <h1 class="mb-5 mt-3 text-uppercase">Add Member</h1>
        </div>
        <div class="row">
            <div class="col-6 form-group">
                <label for="sel1">Members:</label>
                <select class="form-control" id="sel1" name ="Title">
                    <option value= "Mr">Mr</option>
                    <option value= "Mrs">Mrs</option>
                    <option value= "Mss">Mss</option>
                    <option value= "Lord">Lord</option>
                    <option value= "Lord">Sir</option>
                    <option value= "Lord">Dr</option>
                    <option value= "Lord">Lady</option>
                    <option value= "Lord">Mx</option>
                </select>
                <input type = "submit" style ="display:none"/>
            </div>
            <div class="col-6 form-group">
                <label for="DoB">Date of Birth</label>
                <input type="date" name="DoB" id = "DoB" class="form-control mb-2" placeholder="Last Name" required>
            </div>
        </div>
        <div class="row">
            <div class="col-6 form-group">
                <label for="FName">Name</label>
                <input type="text" name="FName" id = "FName" class="form-control mb-2" placeholder="First Name" required autofocus>
            </div>
            <div class="col-6 form-group">
                <label for="LName">Surname</label>
                <input type="text" name="LName" id = "LName" class="form-control mb-2" placeholder="Last Name" required>
            </div>
        </div>
        <div class="row">
            <div class="col-6 form-group">
                <label for="PhoneNo">Phone Number</label>
                <input type="text" name="PhoneNo" id = "PhoneNo" class="form-control mb-2" placeholder="Phone Number" required>
            </div>
            <div class="col-6 form-group">
                <label for="Email">Email</label>
                <input type="email" name="Email" id = "Email" class="form-control mb-2" placeholder="Email" required>
            </div>
        </div>
        <div class="row">
            <div class="col-6 form-group">
                <label for="Address">Address</label>
                <input type="text" name="Address" id = "Address" class="form-control mb-2" placeholder="Home Address" required>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-6 d-flex justify-content-center">
                <button class="mt-5 btn btn-lg btn-login" type="submit" name ="Add Member">Add Member</button>
            </div>
        </div>

    </form>
</div>

<?php include(PRIVATE_PATH . '/shared/footer.php'); ?>

</body>
</html>
