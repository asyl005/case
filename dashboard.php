<?php
session_start();

// Проверка авторизации
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Перенаправление на страницу входа, если не авторизован
    exit();
}

// Имя пользователя
$username = $_SESSION['username']; 
?>

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
        }

        .header {
            font-size: 24px;
            font-weight: bold;
            color: #4c3b6e;
            margin-bottom: 20px;
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
    </style>
</head>
<body>

    <!-- Боковое меню -->
    <div class="sidebar">
        <div class="logo">StudyLife+</div>
        <ul class="menu">
            <li class="active"><a href="#">🏠 Главная</a></li>
            <li><a href="#">🏆 Мои достижения</a></li>
            <li><a href="#">📊 Рейтинги</a></li>
            <li><a href="#">📚 Задания</a></li>
            <li><a href="#">🎮 Соревнования</a></li>

            <!-- Социальная часть -->
            <li><a href="#">🤝 Обмен вещами</a></li>
            <li><a href="#">🛠️ Поиск услуг</a></li>
            <li><a href="#">🎉 Досуг</a></li>
            <li><a href="#">💬 Сообщество</a></li>

            <!-- Дополнительные разделы -->
            <li><a href="#">🗓 Календарь</a></li>
            <li><a href="#">🎯 Мои цели</a></li>
            <li><a href="profile.php">👤 Профиль</a></li>
            <li><a href="#">⚙️ Настройки</a></li>
        </ul>
        <div class="footer">
            &copy; 2024 StudyLife+
        </div>
    </div>

    <!-- Основной контент -->
    <div class="main-content">
        <div class="header">Добро пожаловать в StudyLife+, <?php echo $username; ?>!</div>

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

</body>
</html>
