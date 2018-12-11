<?php
$stylePath = "../../style/";
$styleFileName = "add.css";
require_once('../../../private/initialize.php');


if (is_post_request()) {

    $rental = [];
    $rental['MemberID'] = $_POST['memberID'] ?? '';
    echo $_POST['memberID'];
    $rental['GameID'] = $_POST['GameID'] ?? '';
    //$member['Period'] = $_POST['Period'] ?? '';

    $result = insert_rental($rental);
    if ($result === true) {
        //$new_id = mysqli_insert_id($db); Not sure what this is for
        echo '<script language = "javascript">';
        echo 'window.location.href = "../dashboard.php";';
        echo 'alert ("You have successfully added a new Rental");';
        echo '</script>';
    } else {
        echo '<script language = "javascript">';
        echo 'window.location.href = "addRental.php";';
        echo 'alert ("Error: Could not add new Rental");';
        echo '</script>';
    }

}
?>


<!DOCTYPE html>
<html lang="en">

<?php include(PRIVATE_PATH . '/head.php'); ?>

<body>
<?php include(PRIVATE_PATH . '/navigationStaff.php'); ?>

<div class="container mb-5">
    <!--    TODO: Add by dropdown-->

    <form class="form" action="addRental.php" method="post">

        <div class="row d-flex justify-content-center">
            <h1 class="mb-5 mt-3 text-uppercase">Add Rental</h1>
        </div>
        <div class="row">
            <!-- <div class="col-6 form-group">
                <label for="MemberID">Member ID</label>
                <input type="text" name="MemberID" id="MemberID" class="form-control mb-2" placeholder="Member ID"
                       required autofocus>
            </div> -->



            <div class="col-6 form-group">
              <label for="sel1">Members:</label>
              <select class="form-control" id="sel1">
                <?php $members =  not_banned_members();
                      foreach($members as $member) {
                      ?>
                      <option><a><?php echo get_member_name_by_ID($member); ?></a></option>
                <?php
              } ?>

              </select>
            </div>


            <div class="col-6 form-group">
                <div class='form-group'>
                    <label for="GameID">Game ID</label>
                    <input type="text" name="GameID" id="GameID" class="form-control mb-2" placeholder="Game ID"
                           required autofocus>
                </div>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-6 d-flex justify-content-center">
                <button class="mt-5 btn btn-lg btn-login" type="submit" name="Add Game">Add Game</button>
            </div>
        </div>

    </form>
</div>

<?php include(PRIVATE_PATH . '/footer.php'); ?>

</body>
</html>
