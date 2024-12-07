<?php
session_start();
include 'db.php'; // Подключение к базе данных

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    // Проверяем, существует ли пользователь
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $error = "Пользователь с таким именем уже существует!";
    } else {
        // Хэшируем пароль
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Добавляем нового пользователя
        $stmt = $conn->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $hashed_password, $role);

        if ($stmt->execute()) {
            $user_id = $stmt->insert_id;

            // Создаем профиль для пользователя
            $stmt = $conn->prepare("INSERT INTO profiles (user_id) VALUES (?)");
            $stmt->bind_param("i", $user_id);
            $stmt->execute();

            // Добавляем достижение "Зарегистрирован", если оно существует
            $achievement_query = "SELECT id FROM achievements WHERE name = 'Зарегистрирован'";
            $achievement_result = $conn->query($achievement_query);

            if ($achievement_result->num_rows > 0) {
                $achievement = $achievement_result->fetch_assoc();
                $stmt = $conn->prepare("INSERT INTO user_achievements (user_id, achievement_id) VALUES (?, ?)");
                $stmt->bind_param("ii", $user_id, $achievement['id']);
                $stmt->execute();
            }

            // Редирект на страницу входа
            header("Location: login.php");
            exit();
        } else {
            $error = "Ошибка регистрации! Попробуйте снова.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация - Networked Student Access</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #4c3b6e;
            color: #ffffff;
        }
        header {
            background-color: #3a2c59;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        header .logo {
            font-size: 24px;
            font-weight: bold;
            color: #fff;
        }
        header nav a {
            color: #ddd;
            text-decoration: none;
            margin: 0 10px;
            font-size: 18px;
        }
        header nav a:hover {
            color: #ffffff;
        }
        .register-section {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 80vh;
            text-align: center;
        }
        .register-form {
            background-color: #3a2c59;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            max-width: 400px;
            width: 100%;
        }
        .register-form h1 {
            font-size: 32px;
            margin-bottom: 20px;
        }
        .register-form input, .register-form select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
        }
        .register-form button {
            width: 100%;
            padding: 10px;
            background-color: #6f57a1;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
        }
        .register-form button:hover {
            background-color: #543c80;
        }
        .register-form p {
            margin-top: 15px;
        }
        .register-form a {
            color: #6f57a1;
            text-decoration: none;
        }
        .register-form a:hover {
            color: #543c80;
        }
        .error {
            color: red;
            margin-bottom: 15px;
        }
        .success {
            color: green;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <header>
        <div class="logo">NSA</div>
        <nav>
            <a href="about.php">About</a>
            <a href="contact.php">Contact</a>
            <a href="login.php">Log in</a>
            <a href="register.php">Sign up</a>
        </nav>
    </header>

    <div class="register-section">
        <div class="register-form">
            <h1>Регистрация</h1>
            <?php if (!empty($error)) echo "<p class='error'>$error</p>"; ?>
            <form method="POST">
                <input type="text" name="username" placeholder="Имя пользователя" required>
                <input type="password" name="password" placeholder="Пароль" required>
                <select name="role" required>
                    <option value="student">Студент</option>
                    <option value="teacher">Учитель</option>
                </select>
                <button type="button" onclick="window.location.href='login.php'">Зарегистрироваться</button>
            </form>
            <p>Уже есть аккаунт? <a href="login.php">Войти</a></p>
        </div>
    </div>
</body>
</html>
