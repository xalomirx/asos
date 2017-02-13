<?php
/**
 * Created by PhpStorm.
 * User: spicecowboy
 * Date: 10.02.17
 * Time: 19:07
 */

//Connect with DB MySQL
$db_connect = mysqli_connect($db_server, $db_username, $db_password, $db_name);

mysqli_query($db_connect, 'SET NAMES utf8');

