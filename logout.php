<?php
session_start();
include_once ('helpers.php');

if (isset($_SESSION['user'])) {
    unset($_SESSION['user']);
    //session_destroy();
    redirect('/public/index');
    exit();
}