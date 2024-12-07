<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $role = $_POST['role'];
    $profile_picture = $_FILES['profile_picture'];

    // Проверка на существование пользователя
    $query = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $error = "Пользователь с таким именем уже существует!";
    } else {
        // Обработка загрузки фото профиля
        if ($profile_picture['error'] === 0) {
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($profile_picture["name"]);
            move_uploaded_file($profile_picture["tmp_name"], $target_file);
            $profile_picture_path = $target_file;
        } else {
            $profile_picture_path = 'uploads/default.png'; // Фото по умолчанию
        }

        // Добавление пользователя
        $query = "INSERT INTO users (username, password, role) VALUES ('$username', '$password', '$role')";
        if ($conn->query($query)) {
            $user_id = $conn->insert_id;

            // Создание профиля
            $query = "INSERT INTO profiles (user_id, profile_picture) VALUES ($user_id, '$profile_picture_path')";
            $conn->query($query);

            $success = "Регистрация прошла успешно!";
        } else {
            $error = "Ошибка регистрации!";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Регистрация</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Регистрация</h1>
        <?php if (!empty($error)) echo "<p class='error'>$error</p>"; ?>
        <?php if (!empty($success)) echo "<p class='success'>$success</p>"; ?>

        <form method="POST" enctype="multipart/form-data">
            <input type="text" name="username" placeholder="Имя пользователя" required>
            <input type="password" name="password" placeholder="Пароль" required>
            <select name="role" required>
                <option value="student">Студент</option>
                <option value="teacher">Учитель</option>
            </select>
            <input type="file" name="profile_picture" accept="image/*">
            <button type="submit">Зарегистрироваться</button>
        </form>
        <p>Уже есть аккаунт? <a href="index.php">Войти</a></p>
    </div>
</body>
</html>
