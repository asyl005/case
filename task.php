<?php
// Подключение к базе данных
include('db.php');

// Получаем текущего пользователя (например, из сессии)
$username = 'Пользователь'; // Пример, замените на реальные данные пользователя
$user_id = 1; // Замените на реальный user_id текущего пользователя

// Получаем все задания
$query_assignments = "SELECT * FROM assignments ORDER BY deadline ASC";
$assignments_result = mysqli_query($conn, $query_assignments);

// Получаем статусы заданий текущего пользователя
$query_user_assignments = "
    SELECT ua.assignment_id, ua.status 
    FROM user_assignments ua 
    WHERE ua.user_id = $user_id";
$user_assignments_result = mysqli_query($conn, $query_user_assignments);
$user_assignments = [];
while ($row = mysqli_fetch_assoc($user_assignments_result)) {
    $user_assignments[$row['assignment_id']] = $row['status'];
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Задания</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #4c3b6e;
        }

        .assignment-list {
            background-color: #fff;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .assignment-list h2 {
            color: #4c3b6e;
            margin-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f4f5fa;
            color: #4c3b6e;
        }

        .status {
            padding: 5px;
            border-radius: 5px;
            text-align: center;
        }

        .not_started {
            background-color: #ffeb3b;
        }

        .in_progress {
            background-color: #2196f3;
            color: #fff;
        }

        .completed {
            background-color: #4caf50;
            color: #fff;
        }

        .submit-btn {
            padding: 8px 15px;
            background-color: #4c3b6e;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .submit-btn:hover {
            background-color: #6f57a1;
        }
    </style>
</head>
<body>

<h1>Задания</h1>

<div class="assignment-list">
    <h2>Все задания</h2>
    <table>
        <thead>
            <tr>
                <th>Название задания</th>
                <th>Описание</th>
                <th>Баллы</th>
                <th>Дедлайн</th>
                <th>Статус</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($assignment = mysqli_fetch_assoc($assignments_result)) { 
                $status = isset($user_assignments[$assignment['id']]) ? $user_assignments[$assignment['id']] : 'not_started';
                ?>
                <tr>
                    <td><?php echo $assignment['title']; ?></td>
                    <td><?php echo $assignment['description']; ?></td>
                    <td><?php echo $assignment['points']; ?></td>
                    <td><?php echo date('d.m.Y H:i', strtotime($assignment['deadline'])); ?></td>
                    <td>
                        <span class="status <?php echo $status; ?>">
                            <?php 
                                echo ucfirst(str_replace('_', ' ', $status)); 
                            ?>
                        </span>
                    </td>
                    <td>
                        <?php if ($status == 'not_started') { ?>
                            <button class="submit-btn" onclick="updateStatus(<?php echo $assignment['id']; ?>, 'in_progress')">Начать</button>
                        <?php } elseif ($status == 'in_progress') { ?>
                            <button class="submit-btn" onclick="updateStatus(<?php echo $assignment['id']; ?>, 'completed')">Завершить</button>
                        <?php } ?>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<script>
// Функция для обновления статуса задания
function updateStatus(assignment_id, status) {
    // Здесь можно сделать AJAX-запрос для обновления статуса в базе данных
    fetch('update_status.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            assignment_id: assignment_id,
            status: status
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            location.reload(); // Обновить страницу после изменения статуса
        } else {
            alert('Ошибка при обновлении статуса');
        }
    });
}
</script>

</body>
</html>

<?php
// Закрытие подключения к базе данных
mysqli_close($conn);
?>
