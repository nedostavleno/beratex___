<?php

$config = [
    'host' => 'localhost',
    'user' => 'user',
    'pass' => 'pass',
    'name' => 'namedb'
];

$conn = new mysqli($config['host'], $config['user'], $config['pass'], $config['name']);

if ($conn->connect_error) {
    die("Ошибка подключения к базе данных: " . $conn->connect_error);
}

?>