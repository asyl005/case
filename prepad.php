<?php
// Мәліметтер базасына қосылу
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gamification";

$conn = new mysqli($servername, $username, $password, $dbname);

// Қосылу қатесін тексеру
if ($conn->connect_error) {
    die("Қосылу қатесі: " . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html lang="kk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Мұғалім интерфейсі</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            display: flex;
        }

        .sidebar {
            width: 250px;
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
        <div class="logo">Мұғалім интерфейсі</div>
        <ul class="menu">
            <li class="active"><a href="#">🏠 Негізгі бет</a></li>
            <li><a href="assignments.php">📚 Тапсырмалар</a></li>
            <li><a href="leaderboards.php">📊 Рейтингтер</a></li>
            <li><a href="profile.php">👤 Профиль</a></li>
            <li><a href="settings.php">⚙️ Настройкалар</a></li>
            <li><a href="logout.php">🚪 Шығу</a></li>
        </ul>
    </div>

    <!-- Негізгі контент -->
    <div class="main-content closed" id="mainContent">
        <div class="header">
            <span class="icon" onclick="toggleSidebar()">☰</span>
            <div>Негізгі бет</div>
        </div>

        <h2>Қош келдіңіз, Мұғалім!</h2>
        <p>Мұнда сіз тапсырмаларды басқарып, студенттердің жетістіктерін және рейтингтерін көре аласыз.</p>

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

</body>
</html>

<?php
// Қосылымды жабу
$conn->close();
?>
