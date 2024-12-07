<?php
// Подключение к базе данных
include('db.php');

// Получаем все объявления о вещах
$query_items = "SELECT * FROM exchange_items ORDER BY created_at DESC";
$items_result = mysqli_query($conn, $query_items);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Обмен вещами</title>
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
            padding: 10px 0;
        }

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

        .item-list {
            background-color: #fff;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .item-list h2 {
            color: #4c3b6e;
            margin-bottom: 10px;
        }

        .item {
            background-color: #fff;
            border: 1px solid #ddd;
            margin: 5px 0;
            padding: 15px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            opacity: 0; /* Начальная прозрачность для анимации */
            transform: translateY(20px); /* Начальная позиция для анимации */
            animation: fadeInUp 0.5s forwards;
        }

        .item strong {
            display: block;
            font-size: 18px;
            color: #4c3b6e;
        }

        .item p {
            color: #555;
            margin-top: 5px;
        }

        .add-item-btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #4c3b6e;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
        }

        .add-item-btn:hover {
            background-color: #6f57a1;
        }

        /* Анимация появления элементов */
        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Ожидание перед анимацией элементов */
        .item:nth-child(1) {
            animation-delay: 0s;
        }

        .item:nth-child(2) {
            animation-delay: 0.1s;
        }

        .item:nth-child(3) {
            animation-delay: 0.2s;
        }

        .item:nth-child(4) {
            animation-delay: 0.3s;
        }

        .item:nth-child(5) {
            animation-delay: 0.4s;
        }

        /* Подвал */
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
            <li><a href="#">🏠 Главная</a></li>
            <li><a href="dost.php">🏆 Мои достижения</a></li>
            <li><a href="reiting.php">📊 Рейтинги</a></li>
            <!-- другие элементы меню -->
        </ul>
        <div class="footer">
            &copy; 2024 StudyLife+
        </div>
    </div>

    <!-- Основной контент -->
    <div class="main-content closed" id="mainContent">
        <div class="header">
            <span class="icon" onclick="toggleSidebar()">☰</span>
            <div>Обмен вещами</div>
        </div>

        <div class="item-list">
            <h2>Все объявления</h2>
            <?php if (mysqli_num_rows($items_result) > 0): ?>
                <div id="item-list">
                    <?php while ($item = mysqli_fetch_assoc($items_result)): ?>
                        <div class="item">
                            <strong><?= htmlspecialchars($item['title']) ?></strong>
                            <p><strong>Описание:</strong> <?= htmlspecialchars($item['description']) ?></p>
                            <p><strong>Контакт:</strong> <?= htmlspecialchars($item['contact_info']) ?></p>
                            <p><strong>Дата добавления:</strong> <?= date('d.m.Y', strtotime($item['created_at'])) ?></p>
                        </div>
                    <?php endwhile; ?>
                </div>
            <?php else: ?>
                <p>Нет объявлений.</p>
            <?php endif; ?>
        </div>

        <a href="add_item.php" class="add-item-btn">Добавить вещь</a>
    </div>

    <footer>
        <p>&copy; 2024 Обмен вещами, Все права защищены</p>
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

<?php
// Закрытие подключения к базе данных
mysqli_close($conn);
?>
