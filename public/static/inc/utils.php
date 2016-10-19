<?php
if (!isset($_SESSION['UserId']) || !$_SESSION['UserId']) {
    header('Location: /');
}

function isAdmin () {
    if (isset($_SESSION['UserRole']) && $_SESSION['UserRole'] === "admin") {
        return true;
    } else {
        return false;
    }
}

function isSuperAdmin () {
    if (isset($_SESSION['UserRole']) && $_SESSION['UserRole'] === "superadmin") {
        return true;
    } else {
        return false;
    }
}
