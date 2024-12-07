<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Календарь событий</title>
    <!-- Подключаем стили FullCalendar -->
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

<!-- Подключаем jQuery и FullCalendar -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@3.2.0/dist/fullcalendar.min.js"></script>
<script>
    $(document).ready(function() {
        $('#calendar').fullCalendar({
            events: [
                {
                    title: 'Мероприятие 1',
                    start: '2024-12-10',
                    description: 'Описание события'
                },
                {
                    title: 'Мероприятие 2',
                    start: '2024-12-15',
                    description: 'Описание события'
                }
            ]
        });
    });
</script>

</body>
</html>
