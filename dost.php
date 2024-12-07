<?php
// Подключение к базе данных
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "achievements_db";

$conn = new mysqli($servername, $username, $password, $dbname);

// Проверка подключения
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Получаем список достижений
$sql_achievements = "SELECT * FROM achievements_dost";
$result_achievements = $conn->query($sql_achievements);

// Получаем список целей
$sql_goals = "SELECT * FROM goals_dost";
$result_goals = $conn->query($sql_goals);

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Мои достижения</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
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

        section {
            background-color: #fff;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #4c3b6e;
            margin-bottom: 10px;
        }

        .achievement, .goal {
            background-color: #fff;
            border: 1px solid #ddd;
            margin: 5px 0;
            padding: 15px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .achievement h3, .goal h3 {
            font-size: 18px;
            color: #4c3b6e;
            margin-bottom: 5px;
        }

        .achievement p, .goal p {
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
    </style>
</head>
<body>

<header>
    <h1>Мои достижения</h1>
</header>

<main>
    <!-- Секция для достижений -->
    <section>
        <h2>Значки, трофеи и сертификаты</h2>
        <div class="achievements">
            <?php if ($result_achievements->num_rows > 0): ?>
                <?php while($row = $result_achievements->fetch_assoc()): ?>
                    <div class="achievement">
                        <h3><?php echo htmlspecialchars($row['title']); ?></h3>
                        <p><?php echo htmlspecialchars($row['description']); ?></p>
                        <p>Тип: <?php echo ucfirst($row['type']); ?></p>
                        <?php if ($row['type'] == 'badge'): ?>
                            <div class="badge-progress">
                                Прогресс: <?php echo $row['progress']; ?>%
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>Нет достижений.</p>
            <?php endif; ?>
        </div>
    </section>

    <!-- Секция для целей -->
    <section>
        <h2>Мои цели</h2>
        <div class="goals">
            <?php if ($result_goals->num_rows > 0): ?>
                <?php while($row = $result_goals->fetch_assoc()): ?>
                    <div class="goal">
                        <h3><?php echo htmlspecialchars($row['goal_title']); ?></h3>
                        <p><?php echo htmlspecialchars($row['goal_description']); ?></p>
                        <p>Цель: <?php echo $row['target_value']; ?></p>
                        <div class="goal-progress">
                            Прогресс: <?php echo $row['current_value']; ?> / <?php echo $row['target_value']; ?> (<?php echo round(($row['current_value'] / $row['target_value']) * 100); ?>%)
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>Нет целей.</p>
            <?php endif; ?>
        </div>
    </section>
</main>

<footer>
    <p>&copy; 2024 Мои достижения, Все права защищены</p>
</footer>

</body>
</html>

<?php
// Закрытие подключения
$conn->close();
?>
