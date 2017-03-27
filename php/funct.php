<?php
/**
 * Created by PhpStorm.
 * User: spicecowboy
 * Date: 10.02.17
 * Time: 19:56
 */

$message = null;

/**
 * Когда ты объявляешь ГЛОБАЛЬНЫЕ функции, то лучше сделать вот так:
 * См. пример ф-ии dd ниже.
 *
 * Почему? Потому что вдруг в пхп, или в какой-то либе или фреймворке УЖЕ
 * объявлена такая функция? И если ты ее ПЕРЕОПРЕДЕЛИШЬ, то что-то может сломаться,
 * и тебе еще потом предстоит найти ошибку. А делая так, как ниже, ты себя
 * от этого обезопасишь.
 */
if (!function_exists('dd')) {
    function dd($value) {
        echo '<pre>';
        var_dump($value);
        die();
    }
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

        /**
         * Не забыл что это за покемон? :)
         */
        ${$field} = $form_data[$field];
    }
}

function field_length($min, $max) {
    if (!$min < $max) {
        ServerMessage('Поле не соответствует приемлимой длинне');
    }
}

function unique_field($db_field, $form_field, $db_connect, $path) {
    /**
     * Тут было бы логичнее отпарвить немного другой запрос.
     * Тебе не нужны данные, тебе нужно кол-во. А ыт получешь данные, а потмо смотришь
     * кол-во.
     *
     * Почему не отправить SELECT COUNT(*)?
     */
    $a = mysqli_query($db_connect, "SELECT * FROM users WHERE $db_field = '$form_field'");
    if ($a->num_rows) {
        ServerMessage("Такой $db_field уже занят", $path);
    }
}

