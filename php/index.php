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

$mode = isset($_GET['mode']) ? $_GET['mode'] : null;
$user = isset($_SESSION['username']) ? $_SESSION['username'] : null;
$del = isset($_GET['del']) ? $_GET['del'] : null;
$editid = isset($_GET['id']) ? $_GET['id'] : null;
$search_toggle = isset($_GET['search']) ? $_GET['search'] : null;

include 'funct.php';
include 'db.php';

if (isset($_GET['auth'])) {
unset($_SESSION['username']);
    header('location: index.php');
}


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
        include 'users-list.php';
        include 'delete-user.php';
        include 'users-search.php';
        include '../html/users.html';
        die();
    case 'usradd':
        include 'users-add.php';
        include '../html/user-form.html';
        die();
    case 'usredit':
        include 'users-edit.php';
        include '../html/user-form.html';
        die();
}

if (isset($search_toggle)) {
    include 'users-list.php';
    include 'delete-user.php';
    include 'users-search.php';
    include '../html/users.html';
    die();
}


include '../html/index.html';