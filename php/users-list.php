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

$limit_start = abs($page*$row_per_page);
$db_users_query = mysqli_query($db_connect, "SELECT * FROM users LIMIT $limit_start, $row_per_page");
while ($row = mysqli_fetch_array($db_users_query)) {
    $result .='<td>'.$row['id'].'</td><td>'.$row['email'].'</td><td>'.$row['username'].'</td><td>'.$row['age'].
        '</td><td><a href="?mode=usr&del='.$row['id'].'&page='.$cur_page.'">X</a></td><td>
        <a href="?mode=usredit&id='.$row['id'].'">ED</a></td></tr>';
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

