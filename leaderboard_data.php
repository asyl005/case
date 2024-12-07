<?php
session_start();
include 'db.php';

$query = "SELECT u.username, p.points, p.level FROM profiles p JOIN users u ON p.user_id = u.id ORDER BY p.points DESC";
$result = $conn->query($query);

echo '<table border="1">
        <tr>
            <th>Имя</th>
            <th>Баллы</th>
            <th>Уровень</th>
        </tr>';

while ($row = $result->fetch_assoc()) {
    echo '<tr>
            <td>' . $row['username'] . '</td>
            <td>' . $row['points'] . '</td>
            <td>' . $row['level'] . '</td>
          </tr>';
}

echo '</table>';
?>
