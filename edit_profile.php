<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];
    $new_username = $_POST['new_username'];
    $new_password = md5($_POST['new_password']); // Обработка пароля через md5

    // Обновляем имя пользователя и пароль в базе данных
    $query = "UPDATE users SET username = '$new_username', password = '$new_password' WHERE id = $user_id";
    if ($conn->query($query)) {
        $_SESSION['username'] = $new_username; // Обновляем имя в сессии
        echo "Профиль успешно обновлен!";
    } else {
        echo "Ошибка обновления профиля.";
    }
}
?>
