<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Сайт NSA</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            display: flex;
        }

        /* Стили бокового меню */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            width: 250px;
            background-color: #4c3b6e;
            color: white;
            overflow-y: auto;
            transform: translateX(0);
            transition: transform 0.3s ease;
            z-index: 1000;
        }

        .sidebar.closed {
            transform: translateX(-100%);
        }

        .logo {
            font-size: 24px;
            text-align: center;
            padding: 15px 0;
            background-color: #3c2a56;
            border-bottom: 1px solid #ddd;
        }

        .menu {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        .menu li {
            margin: 10px 0;
        }

        .menu li a {
            text-decoration: none;
            color: white;
            padding: 10px 20px;
            display: block;
            transition: background-color 0.3s ease;
        }

        .menu li a:hover,
        .menu li.active a {
            background-color: #3c2a56;
        }

        .footer {
            text-align: center;
            padding: 10px 0;
            background-color: #3c2a56;
            position: absolute;
            bottom: 0;
            width: 100%;
        }

        /* Стили основного контента */
        .main-content {
            margin-left: 250px;
            width: calc(100% - 250px);
            padding: 20px;
            transition: margin-left 0.3s ease;
        }

        .main-content.closed {
            margin-left: 0;
            width: 100%;
        }

        .header {
            display: flex;
            align-items: center;
            background-color: #f7f7f7;
            padding: 10px 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .header .icon {
            font-size: 24px;
            cursor: pointer;
            margin-right: 10px;
        }

        .header .text {
            font-size: 18px;
        }

        .section {
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>

    <!-- Боковое меню -->
    <div class="sidebar" id="sidebar">
        <div class="logo">NSA</div>
        <ul class="menu">
            <li class="active"><a href="dashboard.php">🏠 Главная</a></li>
            <li><a href="dost.php">🏆 Мои достижения</a></li>
            <li><a href="reiting.php">📊 Рейтинги</a></li>
            <li><a href="task.php">📚 Задания</a></li>
            <li><a href="game.php">🎮 Соревнования</a></li>
            <li><a href="obmen.php">🤝 Обмен вещами</a></li>
            <li><a href="uslug.php">🛠️ Поиск услуг</a></li>
            <li><a href="dosug.php">🎉 Досуг</a></li>
            <li><a href="sob.php">💬 Сообщество</a></li>
            <li><a href="data.php">🗓 Календарь</a></li>
            <li><a href="goals.php">🎯 Мои цели</a></li>
            <li><a href="profile.php">👤 Профиль</a></li>
            <li><a href="user_settings.php">⚙️ Настройки</a></li>
            <li><a href="logout2.php">Шығу</a></li>
        </ul>
        <div class="footer">
            &copy; 2024 StudyLife+
        </div>
    </div>

    <!-- Основной контент -->
    <div class="main-content closed" id="mainContent">
        <div class="header">
            <span class="icon" onclick="toggleSidebar()">☰</span>
            <div class="text">Добро пожаловать в NSA <?php echo $username; ?>!</div>
        </div>

        <div class="section">
            <h2>Мои достижения</h2>
            <p>Здесь будут отображаться ваши достижения, значки и трофеи.</p>
        </div>
    </div>

    <script>
        // Функция для переключения бокового меню
        function toggleSidebar() {
            const sidebar = document.getElementById("sidebar");
            const mainContent = document.getElementById("mainContent");

            sidebar.classList.toggle("closed");
            mainContent.classList.toggle("closed");
        }
    </script>

</body>
</html>
