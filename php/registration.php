<?php
/**
 * Created by PhpStorm.
 * User: spicecowboy
 * Date: 10.02.17
 * Time: 21:03
 */

//require_once 'db.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require_once 'funct.php';

$form_data = $_POST['registration'];




//Проверка на заполненность полей формы

$required_field = [
    'email' => FILTER_VALIDATE_EMAIL,
    'username' => '',
    'password' => ''
];

foreach ($required_field as $field => $validation) {
    if (!array_key_exists($field, $form_data)) {
        ServerMessage("Вы не заполнили обязательное поле $field", '../html/registration.html');
    }

    if (!empty($validation) && !filter_var($form_data[$field], $validation)) {
        ServerMessage('Ошибка валидации', '../html/registration.html');
    }

    ${$field} = $form_data[$field];
}

//Проверим поля на длинну.
if (strlen($form_data['password']) < '8') {
    ServerMessage('Пароль должен быть длиннее 8ми символов', '../html/registration.html');
}

//Если все впорядке ,то задаем переменные.
$email = $form_data['email'];
$username = $form_data['username'];
$password = md5($form_data['password']);
$age = $form_data['age'];
$db_connect = mysqli_connect('localhost', 'root', 'love1lost', 'asos');

if (!$db_connect) {
    ServerMessage('GOVNO', '../html/registration.html');
}

mysqli_query($db_connect, 'SET NAMES utf8');

unique_field('email', $email, $db_connect);
unique_field('username', $username, $db_connect);

$write_db = mysqli_query($db_connect, "INSERT INTO users (email, username, password, age) VALUES ('$email','$username', '$password', '$age')");
if (!$write_db) {
    ServerMessage('Ошибка записи в БД', '../html/registration.html');
} else {
    ServerMessage('Вы успешно зарегистрированны', '../html/successful_reg.html');
}



