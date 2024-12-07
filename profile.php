<?php
session_start();
include 'db.php';

// Проверяем, вошел ли пользователь
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$role = $_SESSION['role'];

// Запрашиваем информацию о профиле из базы данных
$query = "SELECT * FROM profiles WHERE user_id = $user_id";
$result = $conn->query($query);
$profile = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Панель пользователя</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #4c3b6e;
            color: #ffffff;
        }
        .container {
            max-width: 1000px;
            margin: 20px auto;
            padding: 20px;
            background-color: #3a2c59;
            border-radius: 8px;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        h1 {
            margin: 0;
            font-size: 24px;
        }
        .stats {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .stats div {
            background-color: #4e3c6f;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
            width: 30%;
        }
        .stats div h3 {
            margin: 10px 0;
            color: #a37fdc;
        }
        .chart {
            margin: 20px 0;
        }
        img {
            border-radius: 50%;
            margin-top: 20px;
        }
        a {
            display: inline-block;
            margin-top: 20px;
            color: #6f57a1;
            text-decoration: none;
            font-size: 18px;
        }
        a:hover {
            color: #fff;
            text-decoration: underline;
        }
        .calendar {
            margin-top: 20px;
            background-color: #4e3c6f;
            padding: 20px;
            border-radius: 8px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Добро пожаловать, <?php echo $_SESSION['username']; ?>!</h1>
            <img src="<?php echo $profile['profile_picture']; ?>" alt="Фото профиля" width="100" height="100">
        </div>

        <div class="stats">
            <div>
                <h3><?php echo $profile['level']; ?></h3>
                <p>Текущий уровень</p>
            </div>
            <div>
                <h3><?php echo $profile['points']; ?></h3>
                <p>Баллы</p>
            </div>
            <div>
                <h3><?php echo $role; ?></h3>
                <p>Роль</p>
            </div>
        </div>

        <div class="chart">
            <h2>Обзор активности</h2>
            <img src="chart-placeholder.png" alt="График активности" width="100%">
        </div>

        <div class="calendar">
            <h2>Календарь</h2>
            <p>Событий пока нет</p>
        </div>

        <a href="edit_profile.php">Редактировать профиль</a>
    </div>
</body>
</html>
