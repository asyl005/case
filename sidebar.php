<?php
// Получаем текущую страницу
$current_page = basename($_SERVER['PHP_SELF']);
?>

<!-- Боковое меню -->
<div class="sidebar" id="sidebar">
    <div class="logo">NSA</div>
    <ul class="menu">
        <li class="<?= ($current_page == 'dashboard.php') ? 'active' : '' ?>"><a href="dashboard.php">🏠 Главная</a></li>
        <li class="<?= ($current_page == 'dost.php') ? 'active' : '' ?>"><a href="dost.php">🏆 Мои достижения</a></li>
        <li class="<?= ($current_page == 'reiting.php') ? 'active' : '' ?>"><a href="reiting.php">📊 Рейтинги</a></li>
        <li class="<?= ($current_page == 'task.php') ? 'active' : '' ?>"><a href="task.php">📚 Задания</a></li>
        <li class="<?= ($current_page == 'game.php') ? 'active' : '' ?>"><a href="game.php">🎮 Соревнования</a></li>
        <li class="<?= ($current_page == 'obmen.php') ? 'active' : '' ?>"><a href="obmen.php">🤝 Обмен вещами</a></li>
        <li class="<?= ($current_page == 'uslug.php') ? 'active' : '' ?>"><a href="uslug.php">🛠️ Поиск услуг</a></li>
        <li class="<?= ($current_page == 'dosug.php') ? 'active' : '' ?>"><a href="dosug.php">🎉 Досуг</a></li>
        <li class="<?= ($current_page == 'sob.php') ? 'active' : '' ?>"><a href="sob.php">💬 Сообщество</a></li>
        <li class="<?= ($current_page == 'data.php') ? 'active' : '' ?>"><a href="data.php">🗓 Календарь</a></li>
        <li class="<?= ($current_page == 'goals.php') ? 'active' : '' ?>"><a href="goals.php">🎯 Мои цели</a></li>
        <li class="<?= ($current_page == 'profile.php') ? 'active' : '' ?>"><a href="profile.php">👤 Профиль</a></li>
        <li class="<?= ($current_page == 'user_settings.php') ? 'active' : '' ?>"><a href="user_settings.php">⚙️ Настройки</a></li>
        <li><a href="logout2.php">Шығу</a></li>
    </ul>
    <div class="footer">
        &copy; 2024 StudyLife+
    </div>
</div>

<!-- Стили для бокового меню -->
<style>
    body {
        margin: 0;
        font-family: Arial, sans-serif;
        display: flex;
    }

    .sidebar {
        position: fixed;
        top: 0;
        left: 0;
        height: 100%;
        width: 250px;
        background-color: #4c3b6e;
        color: white;
        overflow-y: auto;
        z-index: 1000;
    }

    .logo {
        font-size: 24px;
        text-align: center;
        padding: 15px 0;
        background-color: #3c2a56;
        border-bottom: 1px solid #ddd;
    }

    .menu {
        list-style-type: none;
        padding: 0;
        margin: 0;
    }

    .menu li {
        margin: 10px 0;
    }

    .menu li a {
        text-decoration: none;
        color: white;
        padding: 10px 20px;
        display: block;
        transition: background-color 0.3s ease;
    }

    .menu li a:hover,
    .menu li.active a {
        background-color: #3c2a56;
        font-weight: bold;
    }

    .footer {
        text-align: center;
        padding: 10px 0;
        background-color: #3c2a56;
        position: absolute;
        bottom: 0;
        width: 100%;
    }
</style>
