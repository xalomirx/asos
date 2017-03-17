<?php
/**
 * Created by PhpStorm.
 * User: spicecowboy
 * Date: 10.02.17
 * Time: 19:07
 */


//Connect with DB MySQL
$db_connect = mysqli_connect('localhost', 'root', 'love1lost', 'asos');

if (!$db_connect) {
    ServerMessage('DB connect error', '../html/auth.html');
}



