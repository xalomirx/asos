<?php
/**
 * Created by PhpStorm.
 * User: spicecowboy
 * Date: 17.02.17
 * Time: 16:46
 */


if (isset($del) && isset($user)) {
    $db_del_query = mysqli_query($db_connect, "DELETE FROM users WHERE id='$del'");
} elseif (isset($del)) {
    $not_auth_del = 1;
}