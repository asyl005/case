<?php
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'gamification';

// Подключение к базе данных
$conn = new mysqli($host, $user, $password, $dbname);

// Проверка подключения
if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}

// Получаем все события
$query_eventsdata = "SELECT * FROM eventsdata ORDER BY event_date ASC";
$events_result = mysqli_query($conn, $query_eventsdata);

// Преобразуем события в формат для календаря
$eventsdata = [];
while ($event = mysqli_fetch_assoc($events_result)) {
    $eventsdata[] = [
        'title' => htmlspecialchars($event['title']),
        'start' => date('Y-m-d H:i:s', strtotime($event['event_date'])),  // Форматируем дату
        'description' => htmlspecialchars($event['description']),
        'type' => $event['type'],
    ];
}

// Закрытие подключения к базе данных
mysqli_close($conn);

// Проверим, есть ли события
if (empty($eventsdata)) {
    echo "Нет событий для отображения.";
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Календарь событий</title>
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@3.2.0/dist/fullcalendar.min.css" rel="stylesheet">
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

        footer {
            text-align: center;
            background-color: #4c3b6e;
            color: white;
            padding: 10px;
            position: fixed;
            bottom: 0;
            width: 100%;
        }

        #calendar {
            margin-top: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>

<header>
    <h1>Календарь событий</h1>
</header>

<main>
    <div id="calendar"></div>
</main>

<footer>
    <p>&copy; 2024 Календарь, Все права защищены</p>
</footer>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@3.2.0/dist/fullcalendar.min.js"></script>
<script>
    $(document).ready(function() {
        console.log('Данные событий:', <?php echo json_encode($eventsdata); ?>);  // Диагностика данных

        $('#calendar').fullCalendar({
            events: <?php echo json_encode($eventsdata); ?>,
            eventRender: function(event, element) {
                element.attr('title', event.description);  // Показывать описание при наведении
                element.css('background-color', event.type === 'assignment' ? '#ffadad' :
                            event.type === 'deadline' ? '#ffcc00' :
                            event.type === 'competition' ? '#4caf50' :
                            '#2196f3');  // Цвет для разных типов событий
            }
        });
    });
</script>

</body>
</html>
