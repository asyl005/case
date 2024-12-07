<?php
session_start();
include 'db.php';

$query = "SELECT u.username, p.points, p.level FROM profiles p JOIN users u ON p.user_id = u.id ORDER BY p.points DESC";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Рейтинг студентов</title>
</head>
<body>
    <h1>Рейтинг</h1>
    <table border="1">
        <tr>
            <th>Имя</th>
            <th>Баллы</th>
            <th>Уровень</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['username']; ?></td>
            <td><?php echo $row['points']; ?></td>
            <td><?php echo $row['level']; ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
    <button id="refreshLeaderboard">Обновить рейтинг</button>
<div id="leaderboardTable">
    <!-- Таблица будет загружаться через AJAX -->
</div>

<script>
document.getElementById('refreshLeaderboard').addEventListener('click', function() {
    fetch('leaderboard_data.php')
        .then(response => response.text())
        .then(data => {
            document.getElementById('leaderboardTable').innerHTML = data;
        });
});
</script>

</body>
</html>
