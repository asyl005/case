<?php
// Подключение к базе данных
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gamification";

$conn = new mysqli($servername, $username, $password, $dbname);

// Проверка подключения
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Получение заданий
$sql_assignments = "SELECT * FROM assignments";
$result_assignments = $conn->query($sql_assignments);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Тапсырмалар</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            min-height: 100vh;
            display: flex;
        }

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
            transition: 0.5s ease;
        }

        .sidebar.open {
            transform: translateX(0);
            opacity: 1;
        }

        .sidebar .logo {
            font-size: 22px;
            font-weight: bold;
            color: #4c3b6e;
            text-align: center;
            padding: 20px 0;
            border-bottom: 1px solid #eee;
        }

        .sidebar .menu {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sidebar .menu li {
            border-bottom: 1px solid #f4f5fa;
        }

        .sidebar .menu li a {
            text-decoration: none;
            display: block;
            padding: 15px 20px;
            color: #333;
            font-size: 16px;
            transition: all 0.3s;
        }

        .sidebar .menu li a:hover {
            background-color: #f4f5fa;
            color: #4c3b6e;
        }

        .main-content {
            margin-left: 250px;
            width: calc(100% - 250px);
            padding: 20px;
            transition: margin-left 0.5s ease;
        }

        .main-content.closed {
            margin-left: 0;
            width: 100%;
        }

        .header {
            font-size: 24px;
            font-weight: bold;
            color: #4c3b6e;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header .icon {
            font-size: 28px;
            cursor: pointer;
            margin-right: 10px;
        }

        h2 {
            color: #4c3b6e;
            margin-bottom: 10px;
        }

        .assignments-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .assignments-table th, .assignments-table td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            font-size: 16px;
        }

        .assignments-table th {
            background-color: #4c3b6e;
            color: white;
        }

        .assignments-table tr:hover {
            background-color: #f9f9f9;
        }

        .assignments-table .status {
            font-weight: bold;
            text-align: center;
        }

        .status.completed { color: green; }
        .status.pending { color: orange; }
        .status.missed { color: red; }

        footer {
            text-align: center;
            background-color: #4c3b6e;
            color: white;
            padding: 10px;
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
    <div class="main-content closed" id="mainContent">
        <div class="header">
            <span class="icon" onclick="toggleSidebar()">☰</span>
            <div>Тапсырмалар</div>
        </div>

        <h2>Мерзімдері, ұпайлары және орындалу мәртебесі бар барлық білім беру тапсырмалары.</h2>

        <table class="assignments-table">
            <thead>
                <tr>
                    <th>Тапсырмалар</th>
                    <th>Дедлайн</th>
                    <th>Очки</th>
                    <th>Статус</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result_assignments->num_rows > 0) {
                    while ($row = $result_assignments->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['title']}</td>
                                <td>{$row['deadline']}</td>
                                <td>{$row['points']}</td>
                                <td class='status " . strtolower($row['status']) . "'>{$row['status']}</td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>Тапсырмалар жоқ</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <footer>&copy; 2024 NSA</footer>
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById("sidebar");
            const mainContent = document.getElementById("mainContent");

            sidebar.classList.toggle("open");
            mainContent.classList.toggle("closed");
        }
    </script>

<?php
$conn->close();
?>
</body>
</html>
