<?php
/**
 * Created by PhpStorm.
 * User: spicecowboy
 * Date: 10.02.17
 * Time: 21:03
 */

error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);


/**
 * Тут та же претензяи по поводу вложенности
 * @see authentication.php
 */
if (isset($_POST['registration'])) {
    $form_data = $_POST['registration'];


//Проверка на заполненность полей формы

    $required_field = [
        'email' => FILTER_VALIDATE_EMAIL,
        'username' => '',
        'password' => ''
    ];

    required_field($required_field, $form_data);


//Проверим поля на длинну.
    if (strlen($form_data['password']) < '8') {
        ServerMessage('Пароль должен быть длиннее 8ми символов', '../html/registration.html');
    }

//Если все впорядке ,то задаем переменные.
    $email = $form_data['email'];
    $username = $form_data['username'];
    $password = md5($form_data['password']);
    $age = $form_data['age'];

    mysqli_query($db_connect, 'SET NAMES utf8');

    unique_field('email', $email, $db_connect, '../html/registration.html');
    unique_field('username', $username, $db_connect, '../html/registration.html');

    $write_db = mysqli_query($db_connect, "INSERT INTO users (email, username, password, age) VALUES ('$email','$username', '$password', '$age')");
    if (!$write_db) {
        ServerMessage('Ошибка записи в БД', '../html/registration.html');
    } else {
        ServerMessage('null', '../html/successful_reg.html');
    }
}



