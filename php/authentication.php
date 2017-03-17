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


if (isset($_POST['authentication'])) {
    $form_data = $_POST['authentication'];

    $required_field = [
        'email' => FILTER_VALIDATE_EMAIL,
        'password' => ''
    ];

    required_field($required_field,$form_data);


    $email = $form_data['email'];
    $password = md5($form_data['password']);


    mysqli_query($db_connect, 'SET NAMES utf8');

    $check_email = mysqli_query($db_connect, "SELECT * FROM users WHERE email='$email'");
    if (!$check_email->num_rows) {
        ServerMessage('Такая почта не зарегистрированна', '../html/auth.html');
    }

    $check_password = mysqli_fetch_assoc($check_email);
    if ($password !== $check_password['password']) {
        ServerMessage('неправильно введен пароль', '../html/auth.html');
    }

    $username_query = mysqli_query($db_connect, "SELECT username FROM users WHERE email='$email'");
    $username = mysqli_fetch_assoc($username_query);

    $_SESSION['username'] = $username['username'];

    header('Location: index.php');
    die;

}



