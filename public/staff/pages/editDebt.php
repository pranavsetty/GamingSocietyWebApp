<?php
$stylePath = "../../style/";
$styleFileName = "add.css";
require_once('../../../private/initialize.php');
require_login();
if(!isset($_GET['id'])) {
    redirect_to(url_for('../overviewTab.php'));
}
$memberID = $_GET['id'];

if(is_post_request()) {
    $member = [];
    $member['memberID'] = $memberID;

    $member['debt'] = $_POST['debt'];
    $result = updateDebt($member);
    if ($result === true) {
      if (getDebt($member['memberID']) == 0) removeFromBan($member['memberID']);
      redirect_to(url_for('../public/staff/dashboard.php?tab=overview'));
    } else {
        $errorsMembers = $result;
        // var_dump($errors);
    }
}
else{
  $member = find_member_id($memberID);
}
    $member_set = find_member_data();
    $member_count = mysqli_num_rows($member_set);
    mysqli_free_result($member_set);
?>



<!DOCTYPE html>
<html lang="en">

<?php include(PRIVATE_PATH . '/shared/head.php'); ?>

<body>
<?php include(PRIVATE_PATH . '/shared/navigationStaff.php'); ?>

<div class="container mb-5">

    <form class="form" action="<?php echo url_for('/staff/pages/editDebt.php?id=' . h(u($memberID))); ?>" method="post">
        <div class="row d-flex justify-content-center">
            <h1 class="mb-5 mt-3 text-uppercase">Edit Debt</h1>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-6 form-group">
                <label for="name">Debt</label>
                <input type="text" id="debt" name="debt" class="form-control mb-2" value="<?php echo h($member['debt']); ?>">
                <?php if(isset($errorsMembers['debt'])) { echo $errorsMembers['debt']; } ?>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-6 d-flex justify-content-center">
                <button class="mt-5 btn btn-lg btn-login" type="submit" name="submit">Submit Changes</button>
            </div>
        </div>

</div>
<?php include(PRIVATE_PATH . '/shared/footer.php'); ?>

</body>
</html>
