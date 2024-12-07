<?php
// Массив текущих соревнований
$currentCompetitions = [
    [
        'name' => 'Квиз по искусству',
        'date' => '2024-12-07',
        'description' => 'Проверьте свои знания о мировой живописи.'
    ],
    [
        'name' => 'Челлендж на выживание',
        'date' => '2024-12-10',
        'description' => 'Тестируем вашу выносливость и умение выживать в экстремальных условиях.'
    ]
];

// Массив будущих соревнований
$futureCompetitions = [
    [
        'name' => 'Тематический конкурс "Эко-стиль"',
        'date' => '2025-01-15',
        'description' => 'Конкурс на лучший экологически чистый проект.'
    ],
    [
        'name' => 'Конкурс для программистов',
        'date' => '2025-02-01',
        'description' => 'Представьте свой проект на конкурс для программистов.'
    ]
];
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Соревнования</title>
    <style>
        /* Общие стили */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            display: flex;
            min-height: 100vh;
            flex-direction: column;
        }

        /* Боковое меню */
        .sidebar {
            width: 250px;
            height: 100vh;
            background-color: #ffffff;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
            position: fixed;
            top: 0;
            left: 0;
            transform: translateX(-250px);
            opacity: 0;
            transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1), opacity 0.5s ease-in-out;
        }

        .sidebar.open {
            transform: translateX(0);
            opacity: 1;
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

        /* Основной контент */
        .main-content {
            margin-left: 250px;
            padding: 20px;
            width: calc(100% - 250px);
            background-color: #f7f7f7;
            transition: margin-left 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .main-content.closed {
            margin-left: 0;
            width: 100%;
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

        section {
            background-color: #fff;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            transition: box-shadow 0.3s ease, transform 0.3s ease;
            opacity: 0;
            transform: translateY(20px);
        }

        section.visible {
            opacity: 1;
            transform: translateY(0);
        }

        section:hover {
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        h2 {
            color: #4c3b6e;
            margin-bottom: 10px;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            background-color: #fff;
            border: 1px solid #ddd;
            margin: 5px 0;
            padding: 15px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            opacity: 0;
            transform: translateY(20px);
        }

        li.visible {
            opacity: 1;
            transform: translateY(0);
        }

        li:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        li strong {
            display: block;
            font-size: 18px;
            color: #4c3b6e;
        }

        p {
            color: #555;
            margin-top: 5px;
        }

        footer {
            text-align: center;
            background-color: #4c3b6e;
            color: white;
            padding: 10px;
            position: fixed;
            bottom: 0;
            width: 100%;
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
        <div class="logo">NSA</div>
        <ul class="menu">
            <li><a href="#">🏠 Главная</a></li>
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
            <div>Соревнования</div>
        </div>

        <section id="current-competitions" class="visible">
            <h2>Текущие соревнования</h2>
            <ul id="current-list">
                <?php foreach ($currentCompetitions as $competition): ?>
                    <li class="visible">
                        <strong><?= htmlspecialchars($competition['name']) ?></strong> - <?= htmlspecialchars($competition['date']) ?>
                        <p><?= htmlspecialchars($competition['description']) ?></p>
                    </li>
                <?php endforeach; ?>
            </ul>
        </section>

        <section id="future-competitions" class="visible">
            <h2>Будущие соревнования</h2>
            <ul id="future-list">
                <?php foreach ($futureCompetitions as $competition): ?>
                    <li class="visible">
                        <strong><?= htmlspecialchars($competition['name']) ?></strong> - <?= htmlspecialchars($competition['date']) ?>
                        <p><?= htmlspecialchars($competition['description']) ?></p>
                    </li>
                <?php endforeach; ?>
            </ul>
        </section>
    </div>

    <footer>
        <p>&copy; 2024 Соревнования, Все права защищены</p>
    </footer>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('mainContent');
            sidebar.classList.toggle('open');
            mainContent.classList.toggle('closed');
        }
    </script>

</body>
</html>
