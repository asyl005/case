<?php
session_start();
include 'db.php';

if ($_SESSION['role'] !== 'teacher') {
    header("Location: dashboard.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $student_id = $_POST['student_id'];
    $points = $_POST['points'];

    // Обновление баллов
    $query = "UPDATE profiles SET points = points + $points WHERE user_id = $student_id";
    $conn->query($query);

    // Обновление уровня
    $query = "SELECT points FROM profiles WHERE user_id = $student_id";
    $result = $conn->query($query);
    $profile = $result->fetch_assoc();

    $level = 'Novice';
    if ($profile['points'] >= 500) $level = 'Expert';
    elseif ($profile['points'] >= 300) $level = 'Master';
    elseif ($profile['points'] >= 100) $level = 'Apprentice';

    $query = "UPDATE profiles SET level = '$level' WHERE user_id = $student_id";
    $conn->query($query);

    header("Location: dashboard.php");
    exit();
}
?>
