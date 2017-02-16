<?php
/**
 * Created by PhpStorm.
 * User: spicecowboy
 * Date: 10.02.17
 * Time: 18:46
 */


error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

session_start();

$mode = isset($_GET['mode']) ? $_GET['mode'] : false;
$user = isset($_SESSION['username']) ? $_SESSION['username'] : null;


include 'funct.php';
$dbSettings = require 'db.php';

//Connect with DB MySQL
$db_connect = mysqli_connect(
    $dbSettings['server'],
    $dbSettings['username'],
    $dbSettings['password'],
    $dbSettings['db']
);



switch($mode) {
    case 'reg':
        include 'registration.php';
        include '../html/registration.html';
        die;
    case 'auth':
        include 'authentication.php';
        include '../html/auth.html';
        die;
    case 'usr':
        include '../html/users.html';
        die();
}


include '../html/index.html';