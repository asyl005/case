<?php
// Подключение к базе данных
include('db.php');

// Получаем все чаты, группы и форумы
$query_community = "
    SELECT * FROM community_groups
    ORDER BY created_at DESC
";
$community_result = mysqli_query($conn, $query_community);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Сообщество</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            color: #333;
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

        .community-list {
            background-color: #fff;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .community-list h2 {
            color: #4c3b6e;
            margin-bottom: 10px;
        }

        .community-item {
            background-color: #fff;
            border: 1px solid #ddd;
            margin: 5px 0;
            padding: 15px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .community-item strong {
            display: block;
            font-size: 18px;
            color: #4c3b6e;
        }

        .community-item p {
            color: #555;
            margin-top: 5px;
        }

        .community-item a {
            color: #4c3b6e;
            text-decoration: none;
            padding: 8px 15px;
            border: 1px solid #4c3b6e;
            border-radius: 5px;
            display: inline-block;
            margin-top: 10px;
        }

        .community-item a:hover {
            background-color: #4c3b6e;
            color: white;
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
        <h1>Сообщество</h1>
    </header>

    <main>
        <div class="community-list">
            <h2>Чаты и Группы</h2>
            <?php if (mysqli_num_rows($community_result) > 0): ?>
                <div id="community-list">
                    <?php while ($community = mysqli_fetch_assoc($community_result)): ?>
                        <div class="community-item">
                            <strong><?= htmlspecialchars($community['name']) ?></strong>
                            <p><strong>Описание:</strong> <?= htmlspecialchars($community['description']) ?></p>
                            <p><strong>Тип:</strong> <?= htmlspecialchars($community['type']) ?></p>
                            <p><strong>Дата создания:</strong> <?= date('d.m.Y H:i', strtotime($community['created_at'])) ?></p>
                            <a href="join_group.php?group_id=<?= $community['id'] ?>">Присоединиться</a>
                        </div>
                    <?php endwhile; ?>
                </div>
            <?php else: ?>
                <p>Нет доступных чатов, групп и форумов.</p>
            <?php endif; ?>
        </div>
    </main>

    <footer>
        <p>&copy; 2024 Сообщество, Все права защищены</p>
    </footer>
</body>
</html>

<?php
// Закрытие подключения к базе данных
mysqli_close($conn);
?>
