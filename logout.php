<?php
session_start();
include_once ('helpers.php');

if (isset($_SESSION['employee'])) {
    unset($_SESSION['employee']);
    //session_destroy();
    redirect('/public/index');
    exit();
}