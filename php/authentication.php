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

/**
 * Вот тут что я тебе как-то говорил? Если есть воможность
 * надо изегать "вложенности". Вот тут у тебя
 * if (все хорошо) { ...Дофига кода... }
 *
 * намного лучше бы было сделать:
 * if (!все хорошо){die('Системная ошибка такая-то')};
 * ...а вот тут уже код, без вложения в фигурные скобки...
 *
 * Так визуально код воспринимается легче. Это правило
 * хорошего тона так делать.
 */
if (isset($_POST['authentication'])) {
    $form_data = $_POST['authentication'];

    $required_field = [
        'email' => FILTER_VALIDATE_EMAIL,
        'password' => ''
    ];

    required_field($required_field,$form_data);


    $email = $form_data['email'];
    $password = md5($form_data['password']);

    /**
     * Хорошо бы держать все запросы к бд отдельно.
     * Называется вроде Table Gateway щаблон, или
     * как-то так. Он очень простой, для простых сайтов
     * и приложений. Его смысл в том, что для каждой таблички в базе
     * ты заводишь отдельный файл (читай: класс), в котором хранишь
     * все обращения к бд. Зачем? УВспомни: DRY
     * Не повторяй себя. не дублируй код. Представь, что тебе пришлось
     * поменять схему базы, такое часто случается в реальной жизни. И поле email
     * у тебя теперь называется post_addres. Тебе нужно найти среди всех файлов
     * все места, где ты писал запросы к этой табличке и везде поменять названия столбца.
     * Если же у тебя все щзапросы в одном файле, то тебе нужно поменять
     * это только в одном месте.
     *
     * Учти это, мотай на ус, но для твоего нынешнего уровня и так все достаточно тут хорошо.
     * Просто помни про DRY и почему это важно.
     * Кстати, сегодня на работе то, что я стараюсь не дублировать код сэкономило мне
     * много сил и времени.
     *
     */
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



