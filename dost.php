<?php
// Подключение к базе данных
include('db.php');

// Получение данных о пользователе (например, из сессии)
$username = 'Пользователь'; // Пример, замените на реальные данные пользователя

// Получение достижений пользователя
$query_achievements = "SELECT * FROM gamification_achievements WHERE user_id = 1"; // Замените user_id на текущий
$achievements_result = mysqli_query($conn, $query_achievements);

// Получение целей пользователя
$query_goals = "SELECT * FROM gamification_goals WHERE user_id = 1"; // Замените user_id на текущий
$goals_result = mysqli_query($conn, $query_goals);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Мои достижения</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            display: flex;
            background-color: #f7f7f7;
        }

        /* Боковое меню */
        .sidebar {
            width: 250px;
            height: 100vh;
            background-color: #ffffff;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
            position: fixed;
            display: flex;
            flex-direction: column;
            transform: translateX(-250px);
            transition: transform 0.3s ease-in-out;
        }

        .sidebar.open {
            transform: translateX(0);
        }

        .logo {
            font-size: 22px;
            font-weight: bold;
            color: #4c3b6e;
            text-align: center;
            padding: 20px 0;
            border-bottom: 1px solid #eee;
        }

        .menu {
            list-style: none;
            padding: 0;
            margin: 0;
            flex-grow: 1;
        }

        .menu li {
            border-bottom: 1px solid #f4f5fa;
        }

        .menu li a {
            text-decoration: none;
            display: flex;
            align-items: center;
            padding: 15px 20px;
            color: #333;
            font-size: 16px;
            transition: all 0.3s;
        }

        .menu li a:hover {
            background-color: #f4f5fa;
            color: #4c3b6e;
        }

        .menu li.active a {
            background-color: #4c3b6e;
            color: white;
        }

        .footer {
            padding: 20px;
            text-align: center;
            font-size: 12px;
            color: #888;
        }

        /* Основная часть страницы */
        .main-content {
            margin-left: 250px;
            padding: 20px;
            width: calc(100% - 250px);
            background-color: #f7f7f7;
            transition: margin-left 0.3s ease-in-out;
        }

        .header {
            font-size: 24px;
            font-weight: bold;
            color: #4c3b6e;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .header .icon {
            font-size: 28px;
            cursor: pointer;
            margin-right: 10px;
        }

        .header .text {
            flex-grow: 1;
        }

        .section {
            background-color: #ffffff;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .section h2 {
            font-size: 20px;
            margin-bottom: 10px;
        }

        .section p {
            font-size: 16px;
            color: #555;
        }

        .achievement-list, .goal-list {
            display: flex;
            flex-wrap: wrap;
        }

        .achievement, .goal {
            background-color: #f4f5fa;
            margin-right: 20px;
            margin-bottom: 20px;
            padding: 20px;
            border-radius: 8px;
            width: 150px;
            text-align: center;
        }

        .achievement img, .goal img {
            width: 60px;
            height: 60px;
            margin-bottom: 10px;
        }

        .progress-bar {
            background-color: #ddd;
            width: 100%;
            height: 10px;
            border-radius: 5px;
            margin-top: 10px;
        }

        .progress-bar span {
            display: block;
            height: 100%;
            background-color: #4c3b6e;
            border-radius: 5px;
        }

        /* Кнопка для открытия меню */
        .open-btn {
            font-size: 28px;
            color: #fff;
            background-color: #4c3b6e;
            padding: 15px;
            border: none;
            cursor: pointer;
            position: fixed;
            top: 20px;
            left: 20px;
            z-index: 1000;
        }

        .open-btn:hover {
            background-color: #6f57a1;
        }
    </style>
</head>
<body>

    <!-- Боковое меню -->
    <div class="sidebar" id="sidebar">
        <div class="logo">StudyLife+</div>
        <ul class="menu">
            <li><a href="index.php">🏠 Главная</a></li>
            <li class="active"><a href="#">🏆 Мои достижения</a></li>
            <li><a href="reiting.php">📊 Рейтинги</a></li>
            <li><a href="#">📚 Задания</a></li>
            <li><a href="#">🎮 Соревнования</a></li>
            <li><a href="#">🤝 Обмен вещами</a></li>
            <li><a href="#">🛠️ Поиск услуг</a></li>
            <li><a href="#">🎉 Досуг</a></li>
            <li><a href="#">💬 Сообщество</a></li>
            <li><a href="#">🗓 Календарь</a></li>
            <li><a href="#">🎯 Мои цели</a></li>
            <li><a href="edit_profile.php">👤 Профиль</a></li>
            <li><a href="#">⚙️ Настройки</a></li>
        </ul>
        <div class="footer">
            &copy; 2024 StudyLife+
        </div>
    </div>

    <!-- Основной контент -->
    <div class="main-content" id="mainContent">
        <div class="header">
            <span class="icon" onclick="toggleSidebar()">☰</span>
            <div class="text">Добро пожаловать в StudyLife+, <?php echo $username; ?>!</div>
        </div>

        <div class="section">
            <h2>Мои достижения</h2>
            <div class="achievement-list">
                <?php while ($achievement = mysqli_fetch_assoc($achievements_result)) { ?>
                    <div class="achievement">
                        <img src="<?php echo $achievement['icon']; ?>" alt="Иконка">
                        <h3><?php echo $achievement['name']; ?></h3>
                        <p><?php echo $achievement['description']; ?></p>
                    </div>
                <?php } ?>
            </div>
        </div>

        <div class="section">
            <h2>Мои цели</h2>
            <div class="goal-list">
                <?php while ($goal = mysqli_fetch_assoc($goals_result)) { ?>
                    <div class="goal">
                        <h3><?php echo $goal['name']; ?></h3>
                        <p>Прогресс: <?php echo $goal['progress']; ?>%</p>
                        <div class="progress-bar">
                            <span style="width: <?php echo $goal['progress']; ?>%"></span>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <script>
        // Функция для переключения бокового меню
        function toggleSidebar() {
            document.getElementById("sidebar").classList.toggle("open");
            document.getElementById("mainContent").classList.toggle("open");
        }
    </script>

</body>
</html>

<?php
// Закрытие подключения к базе данных
mysqli_close($conn);
?>
