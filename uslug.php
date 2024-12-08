<!DOCTYPE html>
<html lang="kk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Қызметтерді іздеу</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
            transition: margin-left 0.3s; /* Плавный переход для основного контента */
        }

        /* Стили для бокового меню */
        .sidebar {
            height: 100%;
            width: 250px;
            background-color: #4c3b6e;
            position: fixed;
            top: 0;
            left: -250px; /* Начальное положение скрыто */
            overflow-x: hidden;
            transition: 0.3s; /* Плавное открытие меню */
            z-index: 1000;
            padding-top: 20px;
        }

        .sidebar.open {
            left: 0; /* Меню выезжает, когда добавляется класс open */
        }

        .logo {
            color: white;
            font-size: 30px;
            text-align: center;
            margin-bottom: 30px;
        }

        .menu {
            list-style-type: none;
            padding: 0;
        }

        .menu li {
            padding: 15px;
            text-align: center;
        }

        .menu li a {
            color: white;
            text-decoration: none;
            display: block;
        }

        .menu li a:hover {
            background-color: #6f57a1;
        }

        .open-btn {
            font-size: 30px;
            position: absolute;
            top: 20px;
            left: 20px;
            cursor: pointer;
            z-index: 1001;
        }

        .main-content {
            transition: margin-left 0.3s;
            padding: 20px;
        }

        .shifted {
            margin-left: 250px; /* Сдвиг контента вправо при открытии меню */
        }

        header {
            background-color: #4c3b6e;
            color: white;
            padding: 20px;
            text-align: center;
        }

        main {
            padding: 20px;
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
    </style>
</head>

<body>
    <!-- Боковое меню -->
    <div class="sidebar" id="sidebar">
        <div class="logo">NSA</div>
        <ul class="menu">
            <li class="active"><a href="#">🏠 Басты бет</a></li>
            <li><a href="dost.php">🏆 Менің жетістіктерім</a></li>
            <li><a href="reiting.php">📊 Рейтинг</a></li>
            <li><a href="task.php">📚 Тапсырмалар</a></li>
            <li><a href="game.php">🎮 Жарыстар</a></li>
            <li><a href="obmen.php">🤝 Алмасу</a></li>
            <li><a href="uslug.php">🛠️ Қызметтерді іздеу</a></li>
            <li><a href="dosug.php">🎉 Бос уақыт</a></li>
            <li><a href="sob.php">💬 Чат</a></li>
            <li><a href="goals.php">🎯 Менің мақсаттарым</a></li>
            <li><a href="profile.php">👤 Профиль</a></li>
            <li><a href="user_settings.php">⚙️ Баптаулар</a></li>
            <li><a href="logout2.php">Шығу</a></li>
        </ul>
    </div>

    <!-- Основной контент -->
    <div id="mainContent" class="main-content">
        <button class="open-btn" onclick="toggleSidebar()">☰</button>

        <header>
            <h1>Қызметтерді іздеу</h1>
        </header>

        <main>
            <div class="service-list">
                <h2>Барлық қызметтер</h2>
                <!-- Контент -->
            </div>
        </main>

        <footer>
            <p>&copy; 2024 Қызметтерді іздеу, Барлық құқықтар қорғалған</p>
        </footer>
    </div>

    <script>
        // Функция для переключения бокового меню
        function toggleSidebar() {
            const sidebar = document.getElementById("sidebar");
            const mainContent = document.getElementById("mainContent");

            sidebar.classList.toggle("open");
            mainContent.classList.toggle("shifted");
        }
    </script>
</body>
</html>
