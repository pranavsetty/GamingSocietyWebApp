<?php
$loggingIn = false;
$active = "About";
$styleFileName = "about.css";
require_once('../private/initialize.php');
?>

<!DOCTYPE html>
<html lang="en">

<?php include(PRIVATE_PATH . '/shared/head.php'); ?>

<body>
<?php include(PRIVATE_PATH . '/shared/navigation.php'); ?>
<div class="container-fluid">
    <div class="row d-flex justify-content-center mb-5">
        <div class="col-10 content text-center">

            <h2 class="mb-5">About us</h2>
            <p>We are Team Omega and this is our game management system for the Computer Gaming Society.</p>
            <p class="text-justify">At team omega, you as a user will be able to have access to the collection
                of games such as CDs, DVDs and cartridges that are currently available.
                Some of our games include Mario Kart, Fallout and Call of Duty.
                You are able to use our website to browse, view and search for games that you
                might be interested in and you can also view links and ratings to the related game.
                At team omega, you as a user will be able to have access to the collection
                of games such as CDs, DVDs and cartridges that are currently available.
                Some of our games include Mario Kart, Fallout and Call of Duty.
                You are able to use our website to browse, view and search for games that you
                might be interested in and you can also view links and ratings to the related game.
            </p>
            <p class="text-justify">
                We as a company are dedicated to bringing you the best possible system that you
                give you the best access in the best way possible. We are passionate about what
                we do and our mission is to be the best in what we do. We as a company are
                dedicated to bringing you the best possible system that you are able to
                access and use with ease. With a team of five, we are committed to give
                you the best access in the best way possible. We are passionate about what
                we do and our mission is to be the best in what we do.
            </p>
            <p class="text-justify">
                Please note that you are currently only allowed to rent each game for 3 weeks.
                However, you are able to extend each game by one week.
            </p>
            <h2 class="mt-7 mb-5">Our Team</h2>
            <div class="row mt-5">
                <?php $staff =  getStaffData();
                while($staffMember = mysqli_fetch_assoc($staff)) { ?>
                    <div class="col-4 mb-5">
                        <div class="card mx-auto text-center">
                            <img src="images/maleavatar.png" alt="Male Avatar" class="d-block">
                            <?php echo $staffMember['firstname'] . " " . $staffMember['surname']; ?><br>
                            <?php echo $staffMember['email']; ?>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<?php include(PRIVATE_PATH . '/shared/footer.php'); ?>




</body>
</html>
