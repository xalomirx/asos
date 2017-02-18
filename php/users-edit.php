<?php
/**
 * Created by PhpStorm.
 * User: spicecowboy
 * Date: 17.02.17
 * Time: 20:42
 */

error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

mysqli_query($db_connect, 'SET NAMES utf8');

$db_query = mysqli_query($db_connect, "SELECT * FROM users WHERE id ='$editid'");
$db_info = mysqli_fetch_array($db_query);
$db_id = $db_info['id'];
$db_email = $db_info['email'];
$db_username = $db_info['username'];
$db_age = $db_info['age'];


if (isset($_POST['userform'])) {
    $form_data = $_POST['userform'];


//Проверка на заполненность полей формы

    $required_field = [
        'email' => FILTER_VALIDATE_EMAIL,
        'username' => '',
        'password' => '',
        'id' => ''
    ];

    foreach ($required_field as $field => $validation) {
        if (!array_key_exists($field, $form_data)) {
            ServerMessage("Вы не заполнили обязательное поле $field", '../html/user-form.html');
        }

        if (!empty($validation) && !filter_var($form_data[$field], $validation)) {
            ServerMessage('Ошибка валидации', '../html/user-form.html');
        }

        ${$field} = $form_data[$field];
    }

    $email = $form_data['email'];
    $username = $form_data['username'];
    $password = md5($form_data['password']);
    $userid = $form_data['id'];
    $age = $form_data['age'];


    $a = mysqli_query($db_connect, "SELECT * FROM users WHERE email = '$email' AND id != '$editid'");
    if ($a->num_rows) {
        ServerMessage("Такой email уже занят", '../html/user-form.html');
    }
    $a = mysqli_query($db_connect, "SELECT * FROM users WHERE username = '$username' AND id != '$editid'");
    if ($a->num_rows) {
        ServerMessage("Такое имя уже занято", '../html/user-form.html');
    }
    $a = mysqli_query($db_connect, "SELECT * FROM users WHERE id = '$userid' AND id != '$editid'");
    if ($a->num_rows) {
        ServerMessage("Такой ID уже занят", '../html/user-form.html');
    }

    $db_update = mysqli_query($db_connect, "UPDATE users SET
    id='$userid', email = '$email',username = '$username', password = '$password', age = '$age'
    WHERE id = '$editid'");
    if (!$db_update) {
        ServerMessage('Ошибка записи в БД', '../html/user-form.html');
    } else {
        ServerMessage('null', '../html/successful_reg.html');
    }

}