<?php
/**
 * Created by PhpStorm.
 * User: spicecowboy
 * Date: 17.02.17
 * Time: 20:02
 */

error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

if (isset($_POST['userform'])) {
    $form_data = $_POST['userform'];


//Проверка на заполненность полей формы

    $required_field = [
        'email' => FILTER_VALIDATE_EMAIL,
        'username' => '',
        'password' => '',
        'id' => ''
    ];

    required_field($required_field,$form_data);

    $email = $form_data['email'];
    $username = $form_data['username'];
    $password = md5($form_data['password']);
    $userid = $form_data['id'];
    $age = $form_data['age'];

    mysqli_query($db_connect, 'SET NAMES utf8');

    unique_field('email', $email, $db_connect, '../html/user-form.html');
    unique_field('username', $username, $db_connect, '../html/user-form.html');
    unique_field('id', $userid, $db_connect, '../html/user-form.html');

    $write_db = mysqli_query($db_connect, "INSERT INTO users (id, email, username, password, age)
                                           VALUES ('$userid','$email','$username', '$password', '$age')");
    if (!$write_db) {
        ServerMessage('Ошибка записи в БД', '../html/user-form.html');
    } else {
        ServerMessage('null', '../html/successful_reg.html');
    }

}

