<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$role = $_SESSION['role'];

$query = "SELECT * FROM profiles WHERE user_id = $user_id";
$result = $conn->query($query);
$profile = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Панель пользователя</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Добро пожаловать!</h1>
        <p>Роль: <?php echo $role; ?></p>
        <p>Текущий уровень: <?php echo $profile['level']; ?></p>
        <p>Баллы: <?php echo $profile['points']; ?></p>
        <img src="<?php echo $profile['profile_picture']; ?>" alt="Фото профиля" width="100" height="100">
        <br>
        <a href="edit_profile.php">Редактировать профиль</a>
    </div>
</body>
</html>
