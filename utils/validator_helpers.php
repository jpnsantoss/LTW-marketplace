<?php
function isLoggedIn()
{
    // Start a session if it's not already started
    if (session_status() == PHP_SESSION_NONE) {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        };
    }

    // Check if the user is logged in
    return isset($_SESSION['user']);
}

function isAdmin()
{
    // Start a session if it's not already started
    if (session_status() == PHP_SESSION_NONE) {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        };
    }

    // Check the user's role
    return isset($_SESSION['user']) && $_SESSION['user']['isAdmin'] == 1;
}

function isSeller()
{
    // Start a session if it's not already started
    if (session_status() == PHP_SESSION_NONE) {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        };
    }

    // Check the user's role
    return isset($_SESSION['user']) && $_SESSION['user']['isSeller'] == 1;
}

function hasRequested()
{
    // Start a session if it's not already started
    if (session_status() == PHP_SESSION_NONE) {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        };
    }

    // Check the user's role
    return isset($_SESSION['user']) && $_SESSION['user']['hasRequested'] == 1;
}

function getCSRF()
{
    if (session_status() == PHP_SESSION_NONE) {
        if (!@session_start()) {
            die('Could not start session');
        }
    }

    // Check the user's role
    if (!isset($_SESSION)) {
        die('$_SESSION is not set');
    }

    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
}

function checkCSRF()
{
    if (session_status() == PHP_SESSION_NONE) {
        if (!@session_start()) {
            die('Could not start session');
        }
    }
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
            die('Invalid CSRF Token');
        }
    }
}
