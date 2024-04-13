<?php
function isLoggedIn()
{
    // Start a session if it's not already started
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    // Check if the user is logged in
    return isset($_SESSION['user']);
}

function hasRole($role)
{
    // Start a session if it's not already started
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    // Check the user's role
    return isset($_SESSION['user']) && $_SESSION['user']['role'] == $role;
}

function isAdmin()
{
    // Start a session if it's not already started
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    // Check the user's role
    return isset($_SESSION['user']) && $_SESSION['user']['isAdmin'] == 1;
}

function isSeller()
{
    // Start a session if it's not already started
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    // Check the user's role
    return isset($_SESSION['user']) && $_SESSION['user']['isSeller'] == 1;
}
