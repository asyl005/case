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
        <h1>Обмен вещами</h1>
    </header>

    <main>
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
    </main>

    <footer>
        <p>&copy; 2024 Обмен вещами, Все права защищены</p>
    </footer>
</body>
</html>

<?php
// Закрытие подключения к базе данных
mysqli_close($conn);
?>
