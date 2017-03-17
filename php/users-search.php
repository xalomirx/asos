<?php
/**
 * Created by PhpStorm.
 * User: spicecowboy
 * Date: 17.02.17
 * Time: 22:14
 */

error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

if (isset($_GET['search'])) {


    $search = trim($_GET['search']);
    $search = htmlspecialchars($_GET['search']);
    $search_result = '<tr>';

    $db_search = mysqli_query($db_connect, "SELECT * FROM users
                              WHERE email LIKE '%$search%' OR username LIKE '%$search%'");

    if ($db_search->num_rows != 0) {
        while ($row = mysqli_fetch_array($db_search)) {
            $search_result .= '<td>' . $row['id'] . '</td><td>' . $row['email'] . '</td><td>' . $row['username'] . '</td><td>' . $row['age'] .
                '</td><td><a href="?mode=usr&del=' . $row['id'] . '">X</a></td><td>
        <a href="?mode=usredit&id=' . $row['id'] . '">ED</a></td></tr>';
        }
    } else {
        $search_result = 'По вашему запросу ничего не найденно';
    }
}







