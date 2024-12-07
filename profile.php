<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="style.css">
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
            <h2>About</h2>
            <p>Adele (born 5 May 1988) is an English singer-songwriter...</p>
        </div>

        <div class="profile-actions">
            <button class="follow-btn">Follow</button>
            <a href="edit_profile.php"><button class="view-btn">Edit Profile</button></a>
        </div>
    </div>
</body>
</html>
