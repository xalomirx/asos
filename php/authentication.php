<?php
/**
 * Created by PhpStorm.
 * User: spicecowboy
 * Date: 15.02.17
 * Time: 15:49
 */

error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require_once 'funct.php';

$form_data = $_POST['authentication'];

$required_field = [
    'email' => FILTER_VALIDATE_EMAIL,
    'password' => ''
];

foreach ($required_field as $field => $validation) {
    if (!array_key_exists($field, $form_data)) {
        ServerMessage("Вы не заполнили обязательное поле $field", '../html/auth.html');
    }

    if (!empty($validation) && !filter_var($form_data[$field], $validation)) {
        ServerMessage('Ошибка валидации', '../html/auth.html');
    }

    ${$field} = $form_data[$field];
}

$email = $form_data['email'];
$password = md5($form_data['password']);
$db_connect = mysqli_connect('localhost', 'root', 'love1lost', 'asos');

if (!$db_connect) {
    ServerMessage('GOVNO', '../html/auth.html');
}

mysqli_query($db_connect, 'SET NAMES utf8');

$check_email = mysqli_query($db_connect, "SELECT * FROM users WHERE email='$email'");
if (!$check_email->num_rows) {
    ServerMessage('Такая почта не зарегистрированна', '../html/auth.html');
}

$check_password = mysqli_fetch_assoc($check_email);
if ($password !== $check_password['password']) {
    ServerMessage('неправильно введен пароль', '../html/auth.html');
}

if (isset($form_data['remember_me'])) {
    SetCookie('remember_me', 'checkbox', time() + 60 * 60 * 24, '/');
}

header('Location: ../html/index.html');
die;



