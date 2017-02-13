<?php
/**
 * Created by PhpStorm.
 * User: spicecowboy
 * Date: 10.02.17
 * Time: 18:46
 */

session_start();

$mode = isset($_GET['mode']) ? $_GET['mode'] : false;

include 'config.php';

include 'php/funct.php';

include 'db/db.php';

switch($mode) {
    case 'reg':
        include 'php/registration.php';
        include 'html/registration.html';
        die;
    case 'auth':
        include 'html/auth.html';
        die;
}


include 'html/index.html';