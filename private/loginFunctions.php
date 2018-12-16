<?php

function logIn($staff) {
    session_regenerate_id();
    $_SESSION['staff_id'] = $staff['staffID'];
    $_SESSION['username'] = $staff['email'];
    return true;
}

function logOut() {
    unset($_SESSION['staff_id']);
    unset($_SESSION['username']);
    return true;
}

function isLoggedIn() {
    return isset($_SESSION['staff_id']);
}

function require_login() {
    if(!isLoggedIn()) {
        redirectTo(urlFor('/staffLogin.php'));
    } else {
    }
}

?>
