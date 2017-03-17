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

function required_field($required_field, $form_data) {
    foreach ($required_field as $field => $validation) {
        if (!array_key_exists($field, $form_data)) {
            ServerMessage("Вы не заполнили обязательное поле $field", '../html/registration.html');
        }

        if (!empty($validation) && !filter_var($form_data[$field], $validation)) {
            ServerMessage('Ошибка валидации', '../html/registration.html');
        }

        ${$field} = $form_data[$field];
    }
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

