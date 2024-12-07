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
        /* Стиль для страницы рейтингов */
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #4c3b6e;
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

    </style>
</head>
<body>

<h1>Рейтинги студентов</h1>

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

</body>
</html>

<?php
// Закрытие подключения к базе данных
mysqli_close($conn);
?>
