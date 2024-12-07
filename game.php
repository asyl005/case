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
            background-color: #4c3b6e;
            color: white;
            position: fixed;
            top: 0;
            left: -250px;
            opacity: 0;
            transform: translateX(-250px);
            transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1), opacity 0.5s ease-in-out;
            padding-top: 20px;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
        }

        .sidebar.open {
            transform: translateX(0);
            opacity: 1;
        }

        .logo {
            font-size: 22px;
            font-weight: bold;
            color: white;
            text-align: center;
            margin-bottom: 20px;
        }

        .menu {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .menu li {
            border-bottom: 1px solid #eee;
        }

        .menu li a {
            text-decoration: none;
            display: block;
            padding: 15px;
            color: white;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        .menu li a:hover {
            background-color: #6f57a1;
        }

        /* Основной контент */
        main {
            flex: 1;
            margin-left: 250px;
            padding: 20px;
            transition: margin-left 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }

        main.closed {
            margin-left: 0;
        }

        /* Кнопка открытия меню */
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

        header {
            background-color: #4c3b6e;
            color: white;
            padding: 20px;
            text-align: center;
        }

        footer {
            text-align: center;
            background-color: #4c3b6e;
            color: white;
            padding: 10px;
        }

        ul {
            list-style: none;
            padding: 0;
        }

        li {
            background-color: #fff;
            border: 1px solid #ddd;
            margin: 10px 0;
            padding: 15px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #4c3b6e;
            margin-bottom: 10px;
        }

        li strong {
            display: block;
            font-size: 18px;
            color: #4c3b6e;
        }

        li p {
            margin-top: 5px;
            color: #555;
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
        </ul>
    </div>

    <!-- Основной контент -->
    <main id="mainContent">
        <header>
            <button class="open-btn" onclick="toggleSidebar()">☰</button>
            <h1>Соревнования</h1>
        </header>

        <!-- Текущие соревнования -->
        <section>
            <h2>Текущие соревнования</h2>
            <ul>
                <?php foreach ($currentCompetitions as $competition): ?>
                    <li>
                        <strong><?= htmlspecialchars($competition['name']) ?></strong> - <?= htmlspecialchars($competition['date']) ?>
                        <p><?= htmlspecialchars($competition['description']) ?></p>
                    </li>
                <?php endforeach; ?>
            </ul>
        </section>

        <!-- Будущие соревнования -->
        <section>
            <h2>Будущие соревнования</h2>
            <ul>
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
            const sidebar = document.getElementById("sidebar");
            const mainContent = document.getElementById("mainContent");

            sidebar.classList.toggle("open");
            mainContent.classList.toggle("closed");
        }
    </script>
</body>
</html>
