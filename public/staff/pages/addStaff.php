<?php
$stylePath = "../../style/";
$styleFileName = "add.css";
require_once('../../../private/initialize.php');
require_login();

if(isPostRequest()) {
    if ($_POST['Password']==$_POST['confirmPassword']) {
        $staff = [];
        $staff['Title'] = $_POST['Title'] ?? '';
        $staff['FName'] = $_POST['FName'] ?? '';
        $staff['LName'] = $_POST['LName'] ?? '';
        $staff['DoB'] = $_POST['DoB'] ?? '';
        $staff['PhoneNo'] = $_POST['PhoneNo'] ?? '';
        $staff['Email'] = $_POST['Email'] ?? '';
        $staff['Address'] = $_POST['Address'] ?? '';
        $staff['Password'] = $_POST['Password'] ?? '';
        $staff['confirmPassword'] = $_POST['confirmPassword'] ?? '';


        $result = insertStaff($staff);
        if ($result === true) {
            echo '<script language = "javascript">';
            echo 'window.location.href = "../dashboard.php";';
            echo 'alert ("You have successfully added a new Staff Member");';
            echo '</script>';
        } else {
            echo '<script language = "javascript">';
            echo 'alert ("Error: Could not add new Staff Member");';
            echo '</script>';
        }
    }
    else {
        echo '<script language = "javascript">';
        echo 'window.location.href = "addStaff.php";';
        echo 'alert ("Error: Your password and confirmation password do not match.");';
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

    <form class="form" action="addStaff.php" method="post">

        <div class="row d-flex justify-content-center">
            <h1 class="mb-5 mt-3 text-uppercase">Add Staff</h1>
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
        <div class="row">
            <div class="col-6 form-group">
                <label for="Password">Password</label>
                <input type="password" name="Password" id = "Password" class="form-control mb-2" placeholder="Password" required>
            </div>
            <div class="col-6 form-group">
                <label for="confirmPassword">Confirm Password</label>
                <input type="password" name="confirmPassword" id = "confirmPassword" class="form-control mb-2" placeholder="Confirm Password" required>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-6 d-flex justify-content-center">
                <button class="mt-5 btn btn-lg btn-login" type="submit" name ="Add Staff">Add Staff</button>
            </div>
        </div>

    </form>
</div>

<?php include(PRIVATE_PATH . '/shared/footer.php'); ?>

</body>
</html>