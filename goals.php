<?php
// Подключение к базе данных
include('db.php');

// Получаем все цели
$query_goals = "SELECT * FROM goals ORDER BY target_date ASC";
$goals_result = mysqli_query($conn, $query_goals);

// Добавление новой цели
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['goal_name'])) {
    $goal_name = mysqli_real_escape_string($conn, $_POST['goal_name']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $target_date = mysqli_real_escape_string($conn, $_POST['target_date']);
    
    $insert_goal_query = "INSERT INTO goals (goal_name, description, target_date, status) 
                          VALUES ('$goal_name', '$description', '$target_date', 'Не начато')";
    mysqli_query($conn, $insert_goal_query);
    header("Location: goals.php"); // Перезагрузка страницы после добавления цели
}

// Закрытие подключения к базе данных
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Мои цели</title>
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

        .goal-list {
            background-color: #fff;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .goal-list h2 {
            color: #4c3b6e;
            margin-bottom: 10px;
        }

        .goal {
            background-color: #fff;
            border: 1px solid #ddd;
            margin: 5px 0;
            padding: 15px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .goal strong {
            display: block;
            font-size: 18px;
            color: #4c3b6e;
        }

        .goal p {
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

        .form-container {
            margin-top: 20px;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        input, textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            border: 1px solid #ddd;
        }

        button {
            padding: 10px 20px;
            background-color: #4c3b6e;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #3c2a56;
        }
    </style>
</head>
<body>

<header>
    <h1>Мои цели</h1>
</header>

<main>
    <div class="goal-list">
        <h2>Все цели</h2>
        <?php if (mysqli_num_rows($goals_result) > 0): ?>
            <?php while ($goal = mysqli_fetch_assoc($goals_result)): ?>
                <div class="goal">
                    <strong><?= htmlspecialchars($goal['goal_name']) ?></strong>
                    <p><strong>Описание:</strong> <?= htmlspecialchars($goal['description']) ?></p>
                    <p><strong>Целевая дата:</strong> <?= date('d.m.Y', strtotime($goal['target_date'])) ?></p>
                    <p><strong>Статус:</strong> <?= htmlspecialchars($goal['status']) ?></p>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>Нет доступных целей.</p>
        <?php endif; ?>
    </div>

    <!-- Форма для добавления новой цели -->
    <div class="form-container">
        <h2>Добавить новую цель</h2>
        <form method="POST">
            <input type="text" name="goal_name" placeholder="Название цели" required>
            <textarea name="description" placeholder="Описание цели" required></textarea>
            <input type="date" name="target_date" required>
            <button type="submit">Добавить цель</button>
        </form>
    </div>
</main>

<footer>
    <p>&copy; 2024 Мои цели, Все права защищены</p>
</footer>

</body>
</html>
