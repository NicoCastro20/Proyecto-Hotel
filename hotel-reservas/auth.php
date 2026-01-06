<?php
session_start();

function esAdmin() {
    return isset($_SESSION['rol']) && $_SESSION['rol'] == 'admin';
}

function protegerAdmin() {
    if (!esAdmin()) {
        header("Location: login.php");
        exit();
    }
}
