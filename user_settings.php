<?php
// Подключение к базе данных
include('db.php');
session_start();

// Пример ID пользователя
$user_id = 1; // Замените на ID из сессии, если он есть

// Получаем текущие настройки пользователя
$query_settings = "SELECT * FROM user_settings WHERE user_id = $user_id";
$settings_result = mysqli_query($conn, $query_settings);
if (mysqli_num_rows($settings_result) > 0) {
    $settings = mysqli_fetch_assoc($settings_result);
} else {
    // Если настроек нет, задаём значения по умолчанию
    $settings = [
        'theme' => 'light',
        'notifications_enabled' => true,
        'privacy_level' => 'public'
    ];
}

// Обновляем настройки, если форма отправлена
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $theme = mysqli_real_escape_string($conn, $_POST['theme']);
    $notifications_enabled = isset($_POST['notifications_enabled']) ? 1 : 0;
    $privacy_level = mysqli_real_escape_string($conn, $_POST['privacy_level']);

    $update_query = "
        UPDATE user_settings 
        SET theme = '$theme', notifications_enabled = $notifications_enabled, privacy_level = '$privacy_level'
        WHERE user_id = $user_id
    ";
    mysqli_query($conn, $update_query);

    // Перезагружаем страницу для применения изменений
    header("Location: settings.php");
    exit();
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Настройки</title>
    <style>
        /* Тема оформления через CSS переменные */
        .light-theme {
            --background-color: #f7f7f7;
            --text-color: #333;
        }

        .dark-theme {
            --background-color: #333;
            --text-color: #f7f7f7;
        }

        body {
            background-color: var(--background-color);
            color: var(--text-color);
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }

        h1, h2 {
            text-align: center;
        }

        form {
            max-width: 600px;
            margin: 20px auto;
            background: var(--background-color);
            border: 1px solid #ccc;
            padding: 20px;
            border-radius: 8px;
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        select, input[type="checkbox"] {
            margin-bottom: 20px;
        }

        button {
            display: block;
            margin: 0 auto;
            padding: 10px 20px;
            background-color: #4c3b6e;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #3c2a56;
        }
    </style>
</head>
<body class="<?php echo $settings['theme'] === 'dark' ? 'dark-theme' : 'light-theme'; ?>">

<h1>Настройки</h1>

<form method="POST">
    <h2>Тема оформления</h2>
    <label for="theme">Выберите тему:</label>
    <select name="theme" id="theme">
        <option value="light" <?php echo $settings['theme'] === 'light' ? 'selected' : ''; ?>>Светлая</option>
        <option value="dark" <?php echo $settings['theme'] === 'dark' ? 'selected' : ''; ?>>Тёмная</option>
    </select>

    <h2>Управление уведомлениями</h2>
    <label>
        <input type="checkbox" name="notifications_enabled" <?php echo $settings['notifications_enabled'] ? 'checked' : ''; ?>>
        Включить уведомления
    </label>

    <h2>Приватность</h2>
    <label for="privacy_level">Уровень приватности:</label>
    <select name="privacy_level" id="privacy_level">
        <option value="public" <?php echo $settings['privacy_level'] === 'public' ? 'selected' : ''; ?>>Публичный</option>
        <option value="private" <?php echo $settings['privacy_level'] === 'private' ? 'selected' : ''; ?>>Приватный</option>
        <option value="friends" <?php echo $settings['privacy_level'] === 'friends' ? 'selected' : ''; ?>>Только для друзей</option>
    </select>

    <button type="submit">Сохранить изменения</button>
</form>

</body>
</html>
