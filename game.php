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
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
        }

        /* Общие стили */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        header {
            background-color: #4c3b6e;
            color: white;
            padding: 20px;
            text-align: center;
        }

        main {
            padding: 20px;
            margin-left: 250px;
            transition: margin-left 0.5s ease;
        }

        section {
            margin-bottom: 30px;
        }

        h2 {
            color: #4c3b6e;
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
    <main id="mainContent">
        <header>
            <button class="open-btn" onclick="toggleSidebar()">☰</button>
            <h1>Соревнования</h1>
        </header>

        <section id="current-competitions">
            <h2>Текущие соревнования</h2>
            <ul id="current-list">
                <?php foreach ($currentCompetitions as $competition): ?>
                    <li>
                        <strong><?= htmlspecialchars($competition['name']) ?></strong> - <?= htmlspecialchars($competition['date']) ?>
                        <p><?= htmlspecialchars($competition['description']) ?></p>
                    </li>
                <?php endforeach; ?>
            </ul>
        </section>

        <section id="future-competitions">
            <h2>Будущие соревнования</h2>
            <ul id="future-list">
                <?php foreach ($futureCompetitions as $competition): ?>
                    <li>
                        <strong><?= htmlspecialchars($competition['name']) ?></strong> - <?= htmlspecialchars($competition['date']) ?>
                        <p><?= htmlspecialchars($competition['description']) ?></p>
                    </li>
                <?php endforeach; ?>
            </ul>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 Соревнования, Все права защищены</p>
    </footer>

    <script>
        // Функция для переключения бокового меню
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('open');
            document.getElementById('mainContent').classList.toggle('closed');
        }
    </script>
</body>
</html>
