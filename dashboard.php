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
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Добро пожаловать!</h1>
        <p>Роль: <?php echo $role; ?></p>
        <p>Текущий уровень: <?php echo $profile['level']; ?></p>
        <p>Баллы: <?php echo $profile['points']; ?></p>
    </div>
    <?php if ($role == 'teacher'): ?>
        <h2>Добавить баллы студенту</h2>
        <form action="add_points.php" method="POST">
            <input type="number" name="student_id" placeholder="ID студента" required>
            <input type="number" name="points" placeholder="Баллы" required>
            <button type="submit">Добавить</button>
        </form>
    <?php endif; ?>

    <a href="leaderboard.php">Рейтинг студентов</a>
</body>
</html>