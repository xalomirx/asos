<?php
/**
 * Created by PhpStorm.
 * User: spicecowboy
 * Date: 10.02.17
 * Time: 18:46
 */

/**
 * Вообще вот тут найс, получилась такая своеобразная единая точка входа.
 * Да, *немного* неудобно, костыльно, очень запутанно. В таком коже разбираться
 * сложно. Но намного легче, чем если бы все это было размазано равномерно по файлам.
 * Когд хуй поймешь где какая функция у тебя объявлено, где что вызывается.
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

// usredit? А чего не назвал udt? Называй нормально. твой код
// должен читаться блегко и понятно не только тобой, но и другими
// людьми. Плохой тон - использовать такие сокрашения.
switch($mode) {
    case 'reg': // registration
        include 'registration.php';
        include '../html/registration.html';
        die;
    case 'auth': // authentication
        include 'authentication.php';
        include '../html/auth.html';
        die;
    case 'usr': // users-list
        include 'users-list.php';
        include 'delete-user.php';
        include 'users-search.php';
        include '../html/users.html';
        die();
    case 'usradd': // user-add
        include 'users-add.php';
        include '../html/user-form.html';
        die();
    case 'usredit': //user-edit
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