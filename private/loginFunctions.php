<?php

function log_in($staff) {
    session_regenerate_id();
    $_SESSION['staff_id'] = $staff['staffID'];
    $_SESSION['username'] = $staff['email'];
    return true;
}

function log_out() {
    unset($_SESSION['staff_id']);
    unset($_SESSION['username']);
    return true;
}

function is_logged_in() {
    return isset($_SESSION['staff_id']);
}

function require_login() {
    if(!is_logged_in()) {
        redirect_to(url_for('/staffLogin.php'));
    } else {
    }
}

?>
