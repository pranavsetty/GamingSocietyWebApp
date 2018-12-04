<?php
$loggingIn = false;
$active = "About";
$styleFileName = "about.css";
require_once('../private/initialize.php');
?>

<!DOCTYPE html>
<html lang="en">

<?php include(PRIVATE_PATH . '/head.php'); ?>

<body>
<?php include(PRIVATE_PATH . '/navigation.php'); ?>
<?php $page_title = 'About us'; ?>

<img src="images/about.png" alt="Company Picture" class="center" style="width:80%">
<p>&nbsp</p>
<p>&nbsp</p>
<h1>- Welcome -</h1>
<h3>We are Team Omega and this is our game management system for the Computer Gaming Society.</h3>
<p>&nbsp</p>
<p>&nbsp</p>
<h2>- About us -</h2>
<p>
    At team omega, you as a user will be able to have access to the collection </br>
    of games such as CDs, DVDs and cartridges that are currently available.</br>
    Some of our games include Mario Kart, Fallout and Call of Duty.</br>
    You are able to use our website to browse, view and search for games that you</br>
    might be interested in and you can also view links and ratings to the related game.</br>
    At team omega, you as a user will be able to have access to the collection </br>
    of games such as CDs, DVDs and cartridges that are currently available.</br>
    Some of our games include Mario Kart, Fallout and Call of Duty.</br>
    You are able to use our website to browse, view and search for games that you</br>
    might be interested in and you can also view links and ratings to the related game.</br>
</p>
<p>
    We as a company are dedicated to bringing you the best possible system that you</br>
    are able to access and use with ease. With a team of five, we are committed to</br>
    give you the best access in the best way possible. We are passionate about what</br>
    we do and our mission is to be the best in what we do. We as a company are</br>
    dedicated to bringing you the best possible system that you are able to</br>
    access and use with ease. With a team of five, we are committed to give</br>
    you the best access in the best way possible. We are passionate about what</br>
    we do and our mission is to be the best in what we do.
</p>
<p>
    Please note that you are currently only allowed to rent each game for 3 weeks.</br>
    However, you are able to extend each game by one week.
</p>
<p>&nbsp</p>
<p>As staff you will be able to login to our administrative server to make changes for each user.</br>
    Please contact the admin if you have any persisting issue regarding this website.</p>
<p>&nbsp</p>
<p>&nbsp</p>
<h2>- Our team -</h2>
<div class="grid-container">
    <div class="card">
        <img src="images/maleavatar.png" alt="Male Avatar" style="width:30%" class="center">
        <div class="container">
            <h4><b>Pranav Bheemsetty</b></h4>
            <h4>Put description here</h4>
            <p>&nbsp</p>
            <h4>pranav@gmail.com</h4>
        </div>
    </div>
    <div class="card">
        <img src="images/maleavatar.png" alt="Male Avatar" style="width:30%" class="center">
        <div class="container">
            <h4><b>Marc Murphy</b></h4>
            <h4>Put description here</h4>
            <p>&nbsp</p>
            <h4>marc@gmail.com</h4>
        </div>
    </div>
    <div class="card">
        <img src="images/maleavatar.png" alt="Male Avatar" style="width:30%" class="center">
        <div class="container">
            <h4><b>Nihadur (Nihad) Rahman</b></h4>
            <h4>Put description here</h4>
            <p>&nbsp</p>
            <h4>nihad@gmail.com</h4>
        </div>
    </div>
    <div class="card">
        <img src="images/femaleavatar.jpg" alt="Female Avatar" style="width:30%" class="center">
        <div class="container">
            <h4><b>Mananchaya (Mai) Khumtai</b></></h4>
            <h4>Put description here</h4>
            <p>&nbsp</p>
            <h4>mai@gmail.com</h4>
        </div>
    </div>
    <div class="card">
        <img src="images/femaleavatar.jpg" alt="Female Avatar" style="width:30%" class="center">
        <div class="container">
            <h4><b>Karolina Szafranek</b></h4>
            <h4>Put description here</h4>
            <p>&nbsp</p>
            <h4>karolina@gmail.com</h4>
        </div>
    </div>
</div>

<?php include(PRIVATE_PATH . '/footer.php'); ?>

</body>
</html>
