<?php
session_start();
include_once ('helpers.php');

if (isset($_SESSION['employee'])) {
    unset($_SESSION['employee']);
    header("Location: /public/?page=login");
    exit();
}