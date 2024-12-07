<?php
session_start();
include 'db.php';

// Получаем ID пользователя из сессии
$user_id = $_SESSION['user_id']; // Это ID текущего пользователя

// Получаем данные пользователя из базы данных
$query = "SELECT * FROM users WHERE id = $user_id";
$result = $conn->query($query);
$user = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_username = $_POST['new_username'];
    $new_password = md5($_POST['new_password']);
    $profile_picture = $_FILES['profile_picture'];

    // Обработка загрузки фото профиля
    if ($profile_picture['error'] === 0) {
        $target_dir = "uploads/";
        $filename = basename($profile_picture["name"]);
        $filename = preg_replace("/[^a-zA-Z0-9.]/", "_", $filename); // Санитизация имени файла
        $target_file = $target_dir . $filename;

        if (move_uploaded_file($profile_picture["tmp_name"], $target_file)) {
            $profile_picture_path = $target_file;
        } else {
            $profile_picture_path = 'uploads/default.png'; // Фотография по умолчанию, если загрузка не удалась
        }
    } else {
        $profile_picture_path = $user['profile_picture']; // Оставляем текущую фотографию, если новая не выбрана
    }

    // Обновляем данные пользователя
    $update_user_query = "UPDATE users SET username = '$new_username', password = '$new_password' WHERE id = $user_id";
    $conn->query($update_user_query);

    // Обновляем фотографию профиля
    $update_profile_query = "UPDATE users SET profile_picture = '$profile_picture_path' WHERE id = $user_id";
    $conn->query($update_profile_query);

    $success = "Профиль успешно обновлен!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <style>
        /* Стили остаются без изменений */
    </style>
</head>
<body>
    <div class="profile-container">
        <h1>Редактировать профиль</h1>

        <?php if (!empty($success)) echo "<p class='success'>$success</p>"; ?>

        <div class="profile-card">
            <div class="profile-image">
                <img src="<?php echo $user['profile_picture'] ? $user['profile_picture'] : 'uploads/default.png'; ?>" alt="Profile Picture">
            </div>
            <form method="POST" enctype="multipart/form-data" class="profile-form">
                <label for="new_username">Имя пользователя</label>
                <input type="text" name="new_username" id="new_username" value="<?php echo htmlspecialchars($user['username']); ?>" required>

                <label for="new_password">Новый пароль</label>
                <input type="password" name="new_password" id="new_password" required>

                <label for="profile_picture">Фото профиля</label>
                <input type="file" name="profile_picture" id="profile_picture" accept="image/*">

                <button type="submit" class="btn-submit">Сохранить изменения</button>
            </form>
        </div>
    </div>
</body>
</html>
