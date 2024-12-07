<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Профиль пользователя</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #E3DEEE;
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
            background-color: #fff;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #4c3b6e;
            margin-bottom: 10px;
        }

        .achievement, .goal {
            background-color: #fff;
            border: 1px solid #ddd;
            margin: 5px 0;
            padding: 15px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .achievement h3, .goal h3 {
            font-size: 18px;
            color: #4c3b6e;
            margin-bottom: 5px;
        }

        .achievement p, .goal p {
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

        .profile-container {
            margin: 20px auto;
            max-width: 900px;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .profile-header {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            justify-content: center;
        }

        .profile-image {
            position: relative;
            margin-bottom: 20px; /* Добавлено место сверху */
        }

        .profile-image img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover; /* Сохраняет пропорции изображения, обрезая его, если необходимо */
            border: 5px solid #fff; /* Белая рамка вокруг фото */
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .profile-info h1 {
            margin: 0;
            font-size: 24px;
            color: #4c3b6e;
        }

        .profile-info p {
            font-size: 16px;
            color: #777;
        }

        .social-media a {
            margin-right: 15px;
            text-decoration: none;
            color: #4c3b6e;
        }

        .profile-stats p {
            font-size: 18px;
            margin: 10px 0;
            color: #555;
        }

        .profile-about h2 {
            font-size: 20px;
            margin-bottom: 10px;
            color: #4c3b6e;
        }

        .profile-actions button {
            background-color: #4c3b6e;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            margin-top: 20px;
        }

        .profile-actions .follow-btn {
            background-color: #6f57a1;
        }

        .profile-actions button:hover {
            opacity: 0.8;
        }
    </style>
</head>
<body>
    <?php
    // Подключение к базе данных
    include 'db.php';
    
    // Получаем ID пользователя из сессии
    session_start();
    $user_id = $_SESSION['user_id']; // Это ID текущего пользователя
    
    // Получаем данные пользователя из базы данных
    $query = "SELECT * FROM users WHERE id = $user_id";
    $result = $conn->query($query);
    $user = $result->fetch_assoc();
    
    // Если пользователь не найден, выводим ошибку
    if (!$user) {
        echo "Пользователь не найден.";
        exit;
    }
    ?>

    <div class="profile-container">
        <header>
            <h1>Профиль пользователя</h1>
        </header>

        <div class="profile-header">
            <div class="profile-image">
                <!-- Используем путь к изображению из базы данных, если оно существует -->
                <img src="<?php echo $user['profile_picture'] ? $user['profile_picture'] : 'uploads/default.png'; ?>" alt="Profile Picture" />
            </div>
            <div class="profile-info">
                <h1><?php echo htmlspecialchars($user['username']); ?></h1>
                <p>Autrice - Compositrice & Interprète</p>
                <div class="social-media">
                    <a href="#">Twitter</a>
                    <a href="#">Instagram</a>
                    <a href="#">YouTube</a>
                    <a href="#">SoundCloud</a>
                </div>
            </div>
        </div>

        <div class="profile-stats">
            <p><strong>3K</strong> Following</p>
            <p><strong>30.5M</strong> Followers</p>
            <p><strong>90.6M</strong> Views</p>
        </div>

        <div class="profile-about">
            <h2>О пользователе</h2>
            <p>Adele (родилась 5 мая 1988 года) — английская певица и автор песен...</p>
        </div>

        <div class="profile-actions">
            <a href="edit_profile.php"><button class="view-btn">Редактировать профиль</button></a>
        </div>
    </div>

    <footer>
        &copy; 2024 StudyLife+
    </footer>
</body>
</html>
