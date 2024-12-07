<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $role = $_POST['role'];

    // Проверяем, существует ли пользователь
    $query = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $error = "Пользователь с таким именем уже существует!";
    } else {
        // Добавляем нового пользователя
        $query = "INSERT INTO users (username, password, role) VALUES ('$username', '$password', '$role')";
        if ($conn->query($query)) {
            $user_id = $conn->insert_id;

            // Создаем профиль для пользователя
            $query = "INSERT INTO profiles (user_id) VALUES ($user_id)";
            $conn->query($query);

            $success = "Регистрация прошла успешно! Теперь вы можете войти.";
        } else {
            $error = "Ошибка регистрации! Попробуйте снова.";
        }
    }
// Добавление достижения "Зарегистрирован"
$achievement_query = "SELECT * FROM achievements WHERE name = 'Зарегистрирован'";
$achievement_result = $conn->query($achievement_query);
$achievement = $achievement_result->fetch_assoc();

$query = "INSERT INTO user_achievements (user_id, achievement_id) VALUES ($user_id, " . $achievement['id'] . ")";
$conn->query($query);

}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Регистрация</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Регистрация</h1>
        <?php if (!empty($error)) echo "<p class='error'>$error</p>"; ?>
        <?php if (!empty($success)) echo "<p class='success'>$success</p>"; ?>
        
        <form method="POST">
            <input type="text" name="username" placeholder="Имя пользователя" required>
            <input type="password" name="password" placeholder="Пароль" required>
            <select name="role" required>
                <option value="student">Студент</option>
                <option value="teacher">Учитель</option>
            </select>
            <button type="submit">Зарегистрироваться</button>
        </form>
        <p>Уже есть аккаунт? <a href="index.php">Войти</a></p>
    </div>
</body>
</html>
