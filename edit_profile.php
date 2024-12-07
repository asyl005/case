<?php
session_start();
include 'db.php';

$user_id = $_SESSION['user_id'];
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
        $filename = preg_replace("/[^a-zA-Z0-9.]/", "_", $filename); // Заменим специальные символы на нижнее подчеркивание
        $target_file = $target_dir . $filename;
        
        if (move_uploaded_file($profile_picture["tmp_name"], $target_file)) {
            $profile_picture_path = $target_file;
        } else {
            $profile_picture_path = 'uploads/default.png';  // Фото по умолчанию, если загрузка не удалась
        }
    } else {
        $profile_picture_path = $user['profile_picture']; // оставляем старое фото
    }

    // Обновление данных пользователя
    $update_user_query = "UPDATE users SET username = '$new_username', password = '$new_password' WHERE id = $user_id";
    $conn->query($update_user_query);

    // Обновление фото профиля
    $update_profile_query = "UPDATE profiles SET profile_picture = '$profile_picture_path' WHERE user_id = $user_id";
    $conn->query($update_profile_query);

    $success = "Профиль успешно обновлен!";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Редактировать профиль</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Редактировать профиль</h1>
        <?php if (!empty($success)) echo "<p class='success'>$success</p>"; ?>

        <form method="POST" enctype="multipart/form-data">
            <input type="text" name="new_username" placeholder="Новое имя пользователя" value="<?php echo $user['username']; ?>" required>
            <input type="password" name="new_password" placeholder="Новый пароль" required>
            <input type="file" name="profile_picture" accept="image/*">
            <button type="submit">Сохранить изменения</button>
        </form>
    </div>
</body>
</html>
