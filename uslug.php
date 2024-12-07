<?php
// Подключение к базе данных
include('db.php');

// Получаем все услуги
$query_services = "SELECT * FROM services ORDER BY created_at DESC";
$services_result = mysqli_query($conn, $query_services);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Поиск услуг</title>
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

        .service-list {
            background-color: #fff;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .service-list h2 {
            color: #4c3b6e;
            margin-bottom: 10px;
        }

        .service {
            background-color: #fff;
            border: 1px solid #ddd;
            margin: 5px 0;
            padding: 15px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .service strong {
            display: block;
            font-size: 18px;
            color: #4c3b6e;
        }

        .service p {
            color: #555;
            margin-top: 5px;
        }

        .add-service-btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #4c3b6e;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
        }

        .add-service-btn:hover {
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
        <h1>Поиск услуг</h1>
    </header>

    <main>
        <div class="service-list">
            <h2>Все услуги</h2>
            <?php if (mysqli_num_rows($services_result) > 0): ?>
                <div id="service-list">
                    <?php while ($service = mysqli_fetch_assoc($services_result)): ?>
                        <div class="service">
                            <strong><?= htmlspecialchars($service['title']) ?></strong>
                            <p><strong>Описание:</strong> <?= htmlspecialchars($service['description']) ?></p>
                            <p><strong>Контакт:</strong> <?= htmlspecialchars($service['contact_info']) ?></p>
                            <p><strong>Категория:</strong> <?= htmlspecialchars($service['category']) ?></p>
                            <p><strong>Дата добавления:</strong> <?= date('d.m.Y', strtotime($service['created_at'])) ?></p>
                        </div>
                    <?php endwhile; ?>
                </div>
            <?php else: ?>
                <p>Нет доступных услуг.</p>
            <?php endif; ?>
        </div>

        <a href="add_service.php" class="add-service-btn">Добавить услугу</a>
    </main>

    <footer>
        <p>&copy; 2024 Поиск услуг, Все права защищены</p>
    </footer>
</body>
</html>

<?php
// Закрытие подключения к базе данных
mysqli_close($conn);
?>
