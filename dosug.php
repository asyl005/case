<?php
// Подключение к базе данных
include('db.php');

// Получаем все мероприятия
$query_events = "SELECT * FROM events ORDER BY event_date DESC";
$events_result = mysqli_query($conn, $query_events);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Досуг</title>
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

        .event-list {
            background-color: #fff;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .event-list h2 {
            color: #4c3b6e;
            margin-bottom: 10px;
        }

        .event {
            background-color: #fff;
            border: 1px solid #ddd;
            margin: 5px 0;
            padding: 15px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .event strong {
            display: block;
            font-size: 18px;
            color: #4c3b6e;
        }

        .event p {
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
        <h1>Досуг</h1>
    </header>

    <main>
        <div class="event-list">
            <h2>Все мероприятия</h2>
            <?php if (mysqli_num_rows($events_result) > 0): ?>
                <div id="event-list">
                    <?php while ($event = mysqli_fetch_assoc($events_result)): ?>
                        <div class="event">
                            <strong><?= htmlspecialchars($event['title']) ?></strong>
                            <p><strong>Дата:</strong> <?= date('d.m.Y H:i', strtotime($event['event_date'])) ?></p>
                            <p><strong>Описание:</strong> <?= htmlspecialchars($event['description']) ?></p>
                            <p><strong>Место:</strong> <?= htmlspecialchars($event['location']) ?></p>
                            <p><strong>Организатор:</strong> <?= htmlspecialchars($event['organizer']) ?></p>
                        </div>
                    <?php endwhile; ?>
                </div>
            <?php else: ?>
                <p>Нет доступных мероприятий.</p>
            <?php endif; ?>
        </div>
    </main>

    <footer>
        <p>&copy; 2024 Досуг, Все права защищены</p>
    </footer>
</body>
</html>

<?php
// Закрытие подключения к базе данных
mysqli_close($conn);
?>
