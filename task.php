<?php
// Подключение к базе данных
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gamification";

$conn = new mysqli($servername, $username, $password, $dbname);

// Проверка подключения
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Получение заданий
$sql_assignments = "SELECT * FROM assignments";
$result_assignments = $conn->query($sql_assignments);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Задания (Assignments)</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            padding: 20px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        h2 {
            color: #4c3b6e;
            margin-bottom: 10px;
        }

        p {
            font-size: 16px;
            color: #555;
            margin-bottom: 20px;
        }

        .assignments-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .assignments-table th, .assignments-table td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            font-size: 16px;
        }

        .assignments-table th {
            background-color: #4c3b6e;
            color: white;
            text-transform: uppercase;
        }

        .assignments-table tr:hover {
            background-color: #f9f9f9;
        }

        .assignments-table .status {
            font-weight: bold;
            text-align: center;
        }

        .status.completed {
            color: green;
        }

        .status.pending {
            color: orange;
        }

        .status.missed {
            color: red;
        }

        footer {
            text-align: center;
            background-color: #4c3b6e;
            color: white;
            padding: 10px;
            margin-top: auto;
        }
    </style>
</head>
<body>
    <h2>Тапсырмалар</h2>
    <p>Мерзімдері, ұпайлары және орындалу мәртебесі бар барлық білім беру тапсырмалары.</p>

    <table class="assignments-table">
        <thead>
            <tr>
                <th>Тапсырмалар</th>
                <th>Дедлайн</th>
                <th>Очки</th>
                <th>Статус</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result_assignments->num_rows > 0) {
                while ($row = $result_assignments->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['title']}</td>
                            <td>{$row['deadline']}</td>
                            <td>{$row['points']}</td>
                            <td class='status " . strtolower($row['status']) . "'>{$row['status']}</td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='4'>Тапсырмалар жоқ</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <footer>&copy; 2024 NSA</footer>

<?php
// Закрытие подключения
$conn->close();
?>
</body>
</html>
