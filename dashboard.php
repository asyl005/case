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
            transition: transform 0.3s ease-in-out; /* Анимация для бокового меню */
        }

        .sidebar.open {
            transform: translateX(0);
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
            transition: margin-left 0.3s ease-in-out; /* Анимация для контента */
        }

        .header {
            font-size: 24px;
            font-weight: bold;
            color: #4c3b6e;
            margin-bottom: 20px;
            display: flex;
            align-items: center; /* Вертикальное выравнивание иконки и текста */
            justify-content: space-between; /* Размещение иконки слева, текста справа */
        }

        .header .icon {
            font-size: 28px; /* Размер иконки */
            cursor: pointer; /* Указатель для кликабельности */
            margin-right: 10px; /* Отступ между иконкой и текстом */
        }

        .header .text {
            flex-grow: 1; /* Оставляет пространство для текста */
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
        <div class="logo">StudyLife+</div>
        <ul class="menu">
            <li class="active"><a href="#">🏠 Главная</a></li>
            <li><a href="dost.php">🏆 Мои достижения</a></li>
            <li><a href="reiting.php">📊 Рейтинги</a></li>
            <li><a href="task.php">📚 Задания</a></li>
            <li><a href="#">🎮 Соревнования</a></li>
            <li><a href="#">🤝 Обмен вещами</a></li>
            <li><a href="#">🛠️ Поиск услуг</a></li>
            <li><a href="#">🎉 Досуг</a></li>
            <li><a href="#">💬 Сообщество</a></li>
            <li><a href="#">🗓 Календарь</a></li>
            <li><a href="#">🎯 Мои цели</a></li>
            <li><a href="edit_profile.php">👤 Профиль</a></li>
            <li><a href="#">⚙️ Настройки</a></li>
        </ul>
        <div class="footer">
            &copy; 2024 StudyLife+
        </div>
    </div>

    <!-- Основной контент -->
    <div class="main-content" id="mainContent">
        <div class="header">
            <span class="icon" onclick="toggleSidebar()">☰</span> <!-- Иконка для открытия меню -->
            <div class="text">Добро пожаловать в StudyLife+, <?php echo $username; ?>!</div>
        </div>

        <div class="section">
            <h2>Мои достижения</h2>
            <p>Здесь будут отображаться ваши достижения, значки и трофеи, полученные за выполнение заданий и участие в соревнованиях.</p>
        </div>

        <div class="section">
            <h2>Рейтинги</h2>
            <p>Посмотрите, как вы себя сравниваете с другими студентами в различных категориях.</p>
        </div>

        <div class="section">
            <h2>Задания</h2>
            <p>Просмотрите все текущие задания и дедлайны, а также их статус выполнения.</p>
        </div>

        <div class="section">
            <h2>Соревнования</h2>
            <p>Примите участие в различных соревнованиях и челленджах, организованных на платформе.</p>
        </div>

        <div class="section">
            <h2>Обмен вещами</h2>
            <p>Обменивайтесь вещами с другими студентами: книги, техника, спортинвентарь и многое другое.</p>
        </div>

        <div class="section">
            <h2>Поиск услуг</h2>
            <p>Ищите услуги от студентов: репетиторы, фотографы, дизайнеры и другие.</p>
        </div>

        <div class="section">
            <h2>Досуг</h2>
            <p>Организуйте мероприятия с друзьями: киновечера, походы, клубы по интересам и многое другое.</p>
        </div>
    </div>

    <script>
        // Функция для переключения бокового меню
        function toggleSidebar() {
            document.getElementById("sidebar").classList.toggle("open");
            document.getElementById("mainContent").classList.toggle("open");
        }
    </script>

</body>
</html>
