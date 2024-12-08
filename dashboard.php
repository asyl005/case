<!DOCTYPE html>
<html lang="kk">
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
            font-family: 'Arial', sans-serif;
            background-color: #f7f7f7;
            display: flex;
            height: 100vh;
            flex-direction: column;
        }

        /* Боковое меню */
        .sidebar {
            width: 250px;
            height: 100%;
            background-color: #ffffff;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
            position: fixed;
            top: 0;
            left: -250px;
            transform: translateX(-250px);
            opacity: 0;
            transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1), opacity 0.5s ease-in-out;
            z-index: 1000;
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
            position: absolute;
            bottom: 0;
            width: 100%;
        }

        /* Основная часть страницы */
        .main-content {
            margin-left: 250px;
            padding: 20px;
            width: calc(100% - 250px);
            transition: margin-left 0.5s cubic-bezier(0.4, 0, 0.2, 1);
            background-color: #f7f7f7;
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
<html lang="kk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Статистика</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
        }

        .container {
            display: flex;
            justify-content: space-between;
            padding: 20px;
            margin: 50px auto;
            max-width: 1200px;
        }

        .card {
            width: 45%;
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .card h3 {
            font-size: 24px;
            margin-bottom: 20px;
            color: #4c3b6e;
        }

        .pie-chart {
            position: relative;
            width: 200px;
            height: 200px;
            margin: 0 auto;
            border-radius: 50%;
            background: conic-gradient(
                #4c3b6e 0% 95%, 
                #f4f5fa 95% 100%
            );
        }

        .pie-chart .inner-text {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 18px;
            font-weight: bold;
            color: #4c3b6e;
        }

        .details {
            text-align: left;
            font-size: 14px;
            margin-top: 20px;
            color: #555;
        }

        .footer {
            padding: 20px;
            text-align: center;
            font-size: 12px;
            color: #888;
        }

        /* Стильдер для календаря */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .calendar {
            width: 350px;
            padding: 20px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .calendar-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .calendar-header h2 {
            font-size: 24px;
            color: #4c3b6e;
        }

        .calendar-days {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            grid-gap: 5px;
            text-align: center;
        }

        .calendar-days div {
            padding: 10px;
            background-color: #f4f5fa;
            border-radius: 5px;
            cursor: pointer;
        }

        .calendar-days div:hover {
            background-color: #ddd;
        }

        .calendar-days div.active {
            background-color: #4c3b6e;
            color: white;
        }

        .calendar-days div.disabled {
            color: #ccc;
        }
    </style>
</head>
<body>

    <div class="container">
        <!-- Белсенді қолданушылар туралы ақпарат -->
        <div class="card">
            <h3>Белсенді оқушылар туралы</h3>
            <div class="pie-chart">
                <div class="inner-text" style="color: #FF5733;">153 Оқушы</div>
            </div>
            <div class="details">
                <p>Белсенді оқушылар: <span style="color: #FF5733;">147</span></p>
                <p>Орташа қауіп-қатер факторлары: <span style="color: #FF5733;">1</span></p>
                <p>Жоғары қауіп-қатер факторлары: <span style="color: #FF5733;">5</span></p>
            </div>
        </div>

        <!-- Қолданушының уақытты пайдалану -->
        <div class="card">
            <h3>Оқушылардың уақытты пайдалану</h3>
            <div class="pie-chart">
                <div class="inner-text" style="color: #FF5733;">2540.7 Сағат</div>
            </div>
            <div class="details">
                <p>Қоғамдық белсенділік: <span style="color: #FF5733;">1520.9</span></p>
                <p>Тапсырмалар: <span style="color: #FF5733;">440.4</span></p>
                <p>Сабақ материалдары: <span style="color: #FF5733;">350.6</span></p>
            </div>
        </div>

        <!-- Календарьді қосу -->
        <div class="calendar">
            <div class="calendar-header">
                <span id="prev-month" style="cursor: pointer;">&#10094;</span>
                <h2 id="current-month"></h2>
                <span id="next-month" style="cursor: pointer;">&#10095;</span>
            </div>
            <div class="calendar-days" id="calendar-days">
                <!-- Күндер автоматты түрде толтырылады -->
            </div>
        </div>
    </div>

    <div class="footer">
        &copy; 2024 NSA
    </div>

    <script>
        const daysOfWeek = ["Дс", "Сс", "Ср", "Бс", "Жм", "Сб", "Жс"]; // Аптаның күндері өзгертілді
        const months = ["Қаңтар", "Ақпан", "Наурыз", "Сәуір", "Мамыр", "Маусым", 
                       "Шілде", "Тамыз", "Қыркүйек", "Қазан", "Қараша", "Желтоқсан"]; // Айлар

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

        // Бірінші кезекте ағымдағы айды көрсету
        renderCalendar(currentMonth, currentYear);
    </script>

</body>
</html>
