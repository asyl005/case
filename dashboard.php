<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Платформа для студентов</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            display: flex;
            background-color: #f7f7f7;
        }

        /* Боковое меню */
        .sidebar {
            width: 250px;
            height: 100vh;
            background-color: #ffffff;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
            position: fixed;
            display: flex;
            flex-direction: column;
            transform: translateX(-250px);
            opacity: 0;
            transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1), opacity 0.5s ease-in-out;
        }

        .sidebar.open {
            transform: translateX(0);
            opacity: 1;
        }

        .logo {
            font-size: 22px;
            font-weight: bold;
            color: #4c3b6e;
            text-align: center;
            padding: 20px 0;
            border-bottom: 1px solid #eee;
        }

        .menu {
            list-style: none;
            padding: 0;
            margin: 0;
            flex-grow: 1;
        }

        .menu li {
            border-bottom: 1px solid #f4f5fa;
        }

        .menu li a {
            text-decoration: none;
            display: flex;
            align-items: center;
            padding: 15px 20px;
            color: #333;
            font-size: 16px;
            transition: all 0.3s;
        }

        .menu li a:hover {
            background-color: #f4f5fa;
            color: #4c3b6e;
        }

        .menu li.active a {
            background-color: #4c3b6e;
            color: white;
        }

        .footer {
            padding: 20px;
            text-align: center;
            font-size: 12px;
            color: #888;
        }

        /* Основная часть страницы */
        .main-content {
            margin-left: 250px;
            padding: 20px;
            width: calc(100% - 250px);
            background-color: #f7f7f7;
            transition: margin-left 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .main-content.closed {
            margin-left: 0;
            width: 100%;
        }

        .header {
            font-size: 24px;
            font-weight: bold;
            color: #4c3b6e;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .header .icon {
            font-size: 28px;
            cursor: pointer;
            margin-right: 10px;
        }

        .section {
            background-color: #ffffff;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .section h2 {
            font-size: 20px;
            margin-bottom: 10px;
        }

        .section p {
            font-size: 16px;
            color: #555;
        }

        /* Кнопка для открытия меню */
        .open-btn {
            font-size: 28px;
            color: #fff;
            background-color: #4c3b6e;
            padding: 15px;
            border: none;
            cursor: pointer;
            position: fixed;
            top: 20px;
            left: 20px;
            z-index: 1000;
        }

        .open-btn:hover {
            background-color: #6f57a1;
        }
    </style>
</head>
<body>

    <!-- Боковое меню -->
    <div class="sidebar" id="sidebar">
        <div class="logo">NSA</div>
        <ul class="menu">
            <li class="active"><a href="#">🏠 Басты бет</a></li>
            <li><a href="dost.php">🏆 Менің жетістіктерім</a></li>
            <li><a href="reiting.php">📊 Рейтинг</a></li>
            <li><a href="task.php">📚 Тапсырмалар</a></li>
            <li><a href="game.php">🎮 Жарыстар</a></li>
            <li><a href="obmen.php">🤝 Алмасу</a></li>
            <li><a href="uslug.php">🛠️ Қызметтерді іздеу</a></li>
            <li><a href="dosug.php">🎉 Бос уақыт</a></li>
            <li><a href="sob.php">💬 Чат</a></li>
            <li><a href="data.php">🗓 Календарь</a></li>
            <li><a href="goals.php">🎯 Менің мақсаттарым</a></li>
            <li><a href="profile.php">👤 Профиль</a></li>
            <li><a href="user_settings.php">⚙️ Баптаулар</a></li>
            <li><a href="logout2.php">Шығу</a></li>
        </ul>
        <div class="footer">
            &copy; 2024 NSA
        </div>
    </div>

    <!-- Основной контент -->
    <div class="main-content closed" id="mainContent">
        <div class="header">
            <span class="icon" onclick="toggleSidebar()">☰</span>
            <div class="text">Қош келдіңіз !</div>
        </div>

        <div class="section">
            <h2>Менің жетістіктерім</h2>
            <p>Сіздің жетістіктеріңіз әзірге бос.</p>
        </div>
    </div>

    <script>
        // Функция для переключения бокового меню
        function toggleSidebar() {
            const sidebar = document.getElementById("sidebar");
            const mainContent = document.getElementById("mainContent");

            sidebar.classList.toggle("open");
            mainContent.classList.toggle("closed");
        }
    </script>

</body>
</html> 
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Календарь</title>
    <style>
        #calendar-days {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 5px;
            text-align: center;
            margin-top: 20px;
        }

        #calendar-days div {
            padding: 10px;
            font-size: 16px;
        }

        #calendar-days div:hover {
            background-color: #f0f0f0;
            cursor: pointer;
        }

        #calendar-days .empty {
            background-color: #f7f7f7;
        }

        #current-month {
            font-size: 20px;
            margin-bottom: 20px;
            font-weight: bold;
        }

        button {
            margin: 5px;
            padding: 10px;
            background-color: #4c3b6e;
            color: white;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #6f57a1;
        }
    </style>
</head>
<body>
<div class="section">
            <h4>Календарь</h4>
            <div id="current-month"></div>
            <button id="prev-month">◀</button>
            <button id="next-month">▶</button>
            <div id="calendar-days"></div>
        </div>
    </div>

    <script>
        const daysOfWeek = ["Дс", "Сс", "Ср", "Бс", "Жм", "Сб", "Жс"];
        const months = ["Қаңтар", "Ақпан", "Наурыз", "Сәуір", "Мамыр", "Маусым", 
                        "Шілде", "Тамыз", "Қыркүйек", "Қазан", "Қараша", "Желтоқсан"];

        let currentDate = new Date();
        let currentMonth = currentDate.getMonth();
        let currentYear = currentDate.getFullYear();

        // Ағымдағы айды көрсету
        function renderCalendar(month, year) {
            const firstDayOfMonth = new Date(year, month, 1);
            const lastDayOfMonth = new Date(year, month + 1, 0);
            const lastDateOfMonth = lastDayOfMonth.getDate();
            const firstDayOfWeek = firstDayOfMonth.getDay();

            // Күндер тақырыбы
            document.getElementById('current-month').innerText = months[month] + " " + year;

            const calendarDays = document.getElementById('calendar-days');
            calendarDays.innerHTML = '';

            // Аптаның күндерін көрсету
            daysOfWeek.forEach(day => {
                const dayElement = document.createElement('div');
                dayElement.innerText = day;
                calendarDays.appendChild(dayElement);
            });

            // Алғашқы бос орындарды қосу
            for (let i = 0; i < firstDayOfWeek; i++) {
                const emptyCell = document.createElement('div');
                emptyCell.classList.add('empty');
                calendarDays.appendChild(emptyCell);
            }

            // Айдың күндерін қосу
            for (let i = 1; i <= lastDateOfMonth; i++) {
                const dayElement = document.createElement('div');
                dayElement.innerText = i;
                calendarDays.appendChild(dayElement);
            }
        }

        // Айды өзгерту функциялары
        document.getElementById('prev-month').addEventListener('click', () => {
            if (currentMonth === 0) {
                currentMonth = 11;
                currentYear--;
            } else {
                currentMonth--;
            }
            renderCalendar(currentMonth, currentYear);
        });

        document.getElementById('next-month').addEventListener('click', () => {
            if (currentMonth === 11) {
                currentMonth = 0;
                currentYear++;
            } else {
                currentMonth++;
            }
            renderCalendar(currentMonth, currentYear);
        });

        renderCalendar(currentMonth, currentYear);
    </script>

</body>
</html>

