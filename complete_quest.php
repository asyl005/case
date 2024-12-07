<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];
    $quest_id = $_POST['quest_id'];

    // Проверяем, что квест еще не выполнен
    $check_query = "SELECT * FROM user_quests WHERE user_id = $user_id AND quest_id = $quest_id";
    $check_result = $conn->query($check_query);

    if ($check_result->num_rows == 0) {
        // Добавление квеста в выполненные
        $query = "INSERT INTO user_quests (user_id, quest_id, completed_at) VALUES ($user_id, $quest_id, NOW())";
        $conn->query($query);

        // Добавление баллов за квест
        $quest_query = "SELECT points FROM quests WHERE id = $quest_id";
        $quest_result = $conn->query($quest_query);
        $quest = $quest_result->fetch_assoc();
        $points = $quest['points'];

        $update_points_query = "UPDATE profiles SET points = points + $points WHERE user_id = $user_id";
        $conn->query($update_points_query);

        // Выдача достижения за выполнение квеста
        $achievement_id = $quest['achievement_id'];
        $achievement_query = "INSERT INTO user_achievements (user_id, achievement_id) VALUES ($user_id, $achievement_id)";
        $conn->query($achievement_query);

        header("Location: dashboard.php");
        exit();
    } else {
        echo "Этот квест уже выполнен!";
    }
}
