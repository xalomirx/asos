<?php
/**
 * Created by PhpStorm.
 * User: spicecowboy
 * Date: 10.02.17
 * Time: 19:56
 */

$message = null;

function dd($value) {
    echo '<pre>';
    var_dump($value);
    die();
}

function ServerMessage($message, $path) {
    include $path;
    die;
}

function field_length($min, $max) {
    if (!$min < $max) {
        ServerMessage('Поле не соответствует приемлимой длинне');
    }
}

function unique_field($db_field, $form_field, $db_connect, $path) {
    $a = mysqli_query($db_connect, "SELECT * FROM users WHERE $db_field = '$form_field'");
    if ($a->num_rows) {
        ServerMessage("Такой $db_field уже занят", $path);
    }
}

//
//function mysqli_query($db,$sqli) {
//    $res = mysqli_query($db,$sqli);
//
//    if (!$res) {
//        ServerMessage('Неверный запрос к БД');
//    }
//
//    return $res;
//}
//

