<?php
// Подключение к базе данных
include('db.php');

// Получаем данные для разных категорий
$categories = ['week', 'month', 'semester'];
$leaderboards = [];

foreach ($categories as $category) {
    $query = "
        SELECT u.username, sp.progress 
        FROM student_progress sp
        JOIN users u ON sp.user_id = u.id
        WHERE sp.category = '$category'
        ORDER BY sp.progress DESC
        LIMIT 10"; // Топ 10 студентов по прогрессу

    $result = mysqli_query($conn, $query);
    $leaderboards[$category] = mysqli_fetch_all($result, MYSQLI_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Рейтинги</title>
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

        .leaderboard {
            background-color: #fff;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .leaderboard h2 {
            color: #4c3b6e;
            margin-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f4f5fa;
            color: #4c3b6e;
        }

        .rank {
            width: 50px;
        }

        .username {
            width: 200px;
        }

        .progress {
            text-align: center;
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
        <div class="footer">
            &copy; 2024 StudyLife+
        </div>
    </div>

    <!-- Основной контент -->
    <div class="main-content closed" id="mainContent">
        <div class="header">
            <span class="icon" onclick="toggleSidebar()">☰</span>
            <div>Рейтинги студентов</div>
        </div>

        <?php foreach ($leaderboards as $category => $students): ?>
            <div class="leaderboard">
                <h2>Рейтинг за <?php echo ucfirst($category); ?></h2>
                <table>
                    <thead>
                        <tr>
                            <th class="rank">Место</th>
                            <th class="username">Студент</th>
                            <th class="progress">Прогресс</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($students as $index => $student): ?>
                            <tr>
                                <td class="rank"><?php echo $index + 1; ?></td>
                                <td class="username"><?php echo $student['username']; ?></td>
                                <td class="progress"><?php echo $student['progress']; ?>%</td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endforeach; ?>

    </div>

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
