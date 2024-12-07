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
    <link rel="stylesheet" href="styles.css"> <!-- Стили для страницы -->
</head>
<body>
    <h1>Мои достижения</h1>
    
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

    <!-- Подключение скриптов -->
    <script src="script.js"></script>
</body>
</html>

<?php
// Закрытие подключения
$conn->close();
?>
