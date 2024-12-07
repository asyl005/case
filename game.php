<?php
// Массив текущих соревнований
$currentCompetitions = [
    [
        'name' => 'Квиз по искусству',
        'date' => '2024-12-07',
        'description' => 'Проверьте свои знания о мировой живописи.'
    ],
    [
        'name' => 'Челлендж на выживание',
        'date' => '2024-12-10',
        'description' => 'Тестируем вашу выносливость и умение выживать в экстремальных условиях.'
    ]
];

// Массив будущих соревнований
$futureCompetitions = [
    [
        'name' => 'Тематический конкурс "Эко-стиль"',
        'date' => '2025-01-15',
        'description' => 'Конкурс на лучший экологически чистый проект.'
    ],
    [
        'name' => 'Конкурс для программистов',
        'date' => '2025-02-01',
        'description' => 'Представьте свой проект на конкурс для программистов.'
    ]
];
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Соревнования</title>
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
            margin-bottom: 30px;
        }

        h2 {
            color: #4c3b6e;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            background-color: #fff;
            border: 1px solid #ddd;
            margin: 5px 0;
            padding: 15px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        li strong {
            display: block;
            font-size: 18px;
            color: #4c3b6e;
        }

        p {
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
        <h1>Соревнования</h1>
    </header>

    <main>
        <section id="current-competitions">
            <h2>Текущие соревнования</h2>
            <ul id="current-list">
                <?php foreach ($currentCompetitions as $competition): ?>
                    <li>
                        <strong><?= htmlspecialchars($competition['name']) ?></strong> - <?= htmlspecialchars($competition['date']) ?>
                        <p><?= htmlspecialchars($competition['description']) ?></p>
                    </li>
                <?php endforeach; ?>
            </ul>
        </section>

        <section id="future-competitions">
            <h2>Будущие соревнования</h2>
            <ul id="future-list">
                <?php foreach ($futureCompetitions as $competition): ?>
                    <li>
                        <strong><?= htmlspecialchars($competition['name']) ?></strong> - <?= htmlspecialchars($competition['date']) ?>
                        <p><?= htmlspecialchars($competition['description']) ?></p>
                    </li>
                <?php endforeach; ?>
            </ul>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 Соревнования, Все права защищены</p>
    </footer>
</body>
</html>
