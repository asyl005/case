<?php
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'gamification';

// Подключение к базе данных
$conn = new mysqli($host, $user, $password, $dbname);

// Проверка подключения
if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}
?>
