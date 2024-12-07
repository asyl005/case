<!-- Боковое меню -->
<div class="sidebar" id="sidebar">
    <div class="logo">NSA</div>
    <ul class="menu">
        <li class="active"><a href="#">🏠 Главная</a></li>
        <li><a href="dost.php">🏆 Мои достижения</a></li>
        <li><a href="reiting.php">📊 Рейтинги</a></li>
        <li><a href="task.php">📚 Задания</a></li>
        <li><a href="game.php">🎮 Соревнования</a></li>
        <li><a href="obmen.php">🤝 Обмен вещами</a></li>
        <li><a href="uslug.php">🛠️ Поиск услуг</a></li>
        <li><a href="dosug.php">🎉 Досуг</a></li>
        <li><a href="sob.php">💬 Сообщество</a></li>
        <li><a href="data.php">🗓 Календарь</a></li>
        <li><a href="goals.php">🎯 Мои цели</a></li>
        <li><a href="profile.php">👤 Профиль</a></li>
        <li><a href="user_settings.php">⚙️ Настройки</a></li>
        <li><a href="logout2.php">Шығу</a></li>
    </ul>
    <div class="footer">
        &copy; 2024 StudyLife+
    </div>
</div>

<!-- Кнопка для открытия меню -->
<button class="open-btn" onclick="toggleSidebar()">☰</button>

<style>
    /* Стили для бокового меню */
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

    <script>
        // Функция для переключения бокового меню
        function toggleSidebar() {
            const sidebar = document.getElementById("sidebar");
            const mainContent = document.getElementById("mainContent");

            sidebar.classList.toggle("open");
            mainContent.classList.toggle("closed");
        }
    </script>