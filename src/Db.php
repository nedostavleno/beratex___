<?php

$config = [
    'host' => 'localhost',
    'user' => 'a0844247_almazix',
    'pass' => '3BPw9On4',
    'name' => 'a0844247_new'
];

$conn = new mysqli($config['host'], $config['user'], $config['pass'], $config['name']);

if ($conn->connect_error) {
    die("Ошибка подключения к базе данных: " . $conn->connect_error);
}

?>