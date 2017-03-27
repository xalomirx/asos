<?php
/**
 * Created by PhpStorm.
 * User: spicecowboy
 * Date: 17.02.17
 * Time: 13:58
 */

error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

//делаю запрос к бд.

/**
 * От следующей инструкции ты опять можешь избавиться,
 * сделам SELECT COUNT(*).
 * Не забывай про функции мускула!
 *
 * Запомни, если что-то можно сделать и в мускуле, и в пыхе,
 * то лучше сделать это в мускуле, а в пыхе уже работать
 * с более красивыми и нужными данными.
 *
 * Причем, ты можешь в запросе мускула еще и поделить кол-во юзеров на 10,
 * и сразу округлить, если вдруг захочется :)
 * Такое, конечно, редко делают, т.к. помнишь, мы храним запросы в отельном файле,
 * а такая специфика делает запрос менее универсальным.
 * Но и даже такое имеет право на жизнь, если используешь более 1 раза.
 */
$db_query = mysqli_query($db_connect, "SELECT * FROM users");
//получаю кол-во строк в таблице
$row_count = mysqli_num_rows($db_query);
//задаю кол-во строк, которое должно отображаться на одной странице
$row_per_page = 10;
//узнаю суммарное кол-во страниц
$page_count = ceil($row_count/$row_per_page);
//задаем стартовый шаблом таблицы
$result = '<tr>';

//Получение номера страницы
if (isset($_GET['page'])) {
    $page=($_GET['page']-1);
} else {
    $page = 0;
}

$cur_page = $page + 1;

/**
 * Пиздец, тебе удобно такое читать? Мне вот не очень.
 */
$limit_start = abs($page*$row_per_page);
$db_users_query = mysqli_query($db_connect, "SELECT * FROM users LIMIT $limit_start, $row_per_page");
while ($row = mysqli_fetch_array($db_users_query)) {
    $result .='<td>'.$row['id'].'</td><td>'.$row['email'].'</td><td>'.$row['username'].'</td><td>'.$row['age'].
        '</td><td><a href="?mode=usr&del='.$row['id'].'&page='.$cur_page.'">X</a></td><td>
        <a href="?mode=usredit&id='.$row['id'].'">ED</a></td></tr>';
}


/**
 * А тут я продублировал код выше. Так ведь приятнее глазу, и читается быстрее, правда?
 */
$limit_start = abs($page * $row_per_page);

$db_users_query = mysqli_query($db_connect, "SELECT * FROM users LIMIT $limit_start, $row_per_page");

while ($row = mysqli_fetch_array($db_users_query)) {
    $result .='<td>'.$row['id'].'</td>'.
              '<td>'.$row['email'].'</td>'.
              '<td>'.$row['username'].'</td>'.
              '<td>'.$row['age'].'</td>'.
              '<td><a href="?mode=usr&del='.$row['id'].'&page='.$cur_page.'">X</a></td>'.
              '<td><a href="?mode=usredit&id='.$row['id'].'">ED</a></td></tr>';
}


//делаем вывод ссылок на страницу
$pag = ' ';

for ($i = 1; $i<=$page_count; $i++) {
    if ($i-1 == $page) {
        $pag.= '<a>'.$i.'</a> ';
    } else {
        $pag.= '<a href="'.$_SERVER['PHP_SELF'].'?mode=usr'.'&page='.$i.'">'.$i."</a> ";
    }
}

