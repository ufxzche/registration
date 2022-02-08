<?php

$servername = "localhost";
$database = "#";
$username = "#";
$password = "#";
// Устанавливаем соединение
$connect = mysqli_connect($servername, $username, $password, $database);
// Проверяем соединение
if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
}


?>