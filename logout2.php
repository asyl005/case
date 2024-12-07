<?php
session_start(); // Запускаем сессию

// Уничтожаем все данные сессии
session_unset(); 
session_destroy();

// Перенаправляем пользователя на страницу входа
header("Location: main.php");
exit();
?>
