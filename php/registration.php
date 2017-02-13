<?php
/**
 * Created by PhpStorm.
 * User: spicecowboy
 * Date: 10.02.17
 * Time: 21:03
 */


if (isset($_POST['submit'])) {
    $form_data = $_POST['registration'];

//Проверка на заполненность полей формы

    $required_field = [
        'email' => FILTER_VALIDATE_EMAIL,
        'username' => '',
        'password' => ''
    ];

    foreach ($required_field as $field => $validation) {
        if (!array_key_exists($field, $form_data)) {
            ServerMessage("Вы не заполнили обязательное поле $field");
        }

        if (!empty($validation) && !filter_var($form_data[$field], $validation)) {
            ServerMessage('Ошибка валидации');
        }

        ${$field} = $form_data[$field];
    }

//Проверим поля на длинну.
    field_length(8, strlen($form_data['password']));

//Если все впорядке ,то задаем переменные.
    $email = $form_data['email'];
    $username = $form_data['username'];
    $password = md5($form_data['password']);
    $age = $form_data['age'];
    $credit_card = $form_data['money'];

    unique_field('email', $email);
    unique_field('username', $username);

$write_db = mysqli_query($db_connect, "INSERT INTO users (email, username, password, age, credit_card) VALUES ('$email',
'$username', '$password', '$age', '$credit_card')");
    if(!$write_db) {
        ServerMessage('Ошибка записи в БД');
    }
}

