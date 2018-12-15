<?php
$stylePath = "../../style/";
$styleFileName = "add.css";
require_once('../../../private/initialize.php');
require_login();

if (is_post_request()) {

    $rental = [];
    $rental['MemberID'] = $_POST['member'] ?? '';
    $rental['GameID'] = $_POST['game'] ?? '';
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

<?php include(PRIVATE_PATH . '/shared/head.php'); ?>

<body>
<?php include(PRIVATE_PATH . '/shared/navigationStaff.php'); ?>

<div class="container mb-5">
    <form class="form" action="addRental.php" method="post">

        <div class="row d-flex justify-content-center">
            <h1 class="mb-5 mt-3 text-uppercase">Add Rental</h1>
        </div>
        <div class="row mt-5">
            <div class="col-6 form-group">
                <label for="sel1">Members:</label>
                <select class="form-control" id="sel1" name="member">
                    <?php $members = not_banned_members();
                    foreach ($members as $member) {
                        $names = get_member_by_ID($member);
                        echo "<option value=" . $member . ">" . $names['firstName'] . " " . $names['surname'] . "</option>";
                    }
                    ?>

                </select>
                <input type="submit" name="member" value="member" style="display:none"/>
            </div>


            <div class="col-6 form-group">
                <label for="sel1">Available Games:</label>
                <select class="form-control" id="sel1" name="game">
                    <?php $games = find_game_data();
                    while ($game = mysqli_fetch_assoc($games)) {
                        if (isCurrentlyAvailable($game['gameID'])) echo "<option value=" . $game['gameID'] . ">" . $game['name'] . "</option>";
                    }

                    ?>

                </select>
                <input type="submit" name="game" value="game" style="display:none"/>
            </div>
        </div>
        <div class="row mt-5 d-flex justify-content-center">
            <div class="col-6 d-flex justify-content-center">
                <button class="mt-5 btn btn-lg btn-login" type="submit" name="Add Rental">Add Rental</button>
            </div>
        </div>
    </form>
</div>

<?php include(PRIVATE_PATH . '/shared/footer.php'); ?>

</body>
</html>
