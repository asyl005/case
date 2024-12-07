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
    $new_about = $_POST['new_about']; // Получаем новый текст "О пользователе"

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
    $update_user_query = "UPDATE users SET username = '$new_username', password = '$new_password', about = '$new_about' WHERE id = $user_id";
    $conn->query($update_user_query);

    // Обновляем фотографию профиля
    $update_profile_query = "UPDATE users SET profile_picture = '$profile_picture_path' WHERE id = $user_id";
    $conn->query($update_profile_query);

    $success = "Профиль успешно обновлен!";
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Редактировать профиль</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }

        body {
            background-color: #f7f7f7;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        /* Profile Container */
        .profile-container {
            width: 100%;
            max-width: 600px;
            background: #fff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .profile-container h1 {
            font-size: 28px;
            margin-bottom: 30px;
            color: #4c3b6e;
        }

        /* Success Message */
        .success {
            background-color: #d4edda;
            color: #155724;
            padding: 12px;
            border-radius: 5px;
            margin-bottom: 15px;
            font-size: 14px;
        }

        /* Profile Image */
        .profile-card {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .profile-image img {
            width: 180px;
            height: 180px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 20px;
            border: 4px solid #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        /* Form Styling */
        .profile-form {
            width: 100%;
        }

        .profile-form label {
            display: block;
            margin-bottom: 8px;
            text-align: left;
            font-weight: bold;
            color: #555;
        }

        .profile-form input, .profile-form textarea {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 14px;
            transition: border-color 0.3s ease;
        }

        .profile-form input:focus, .profile-form textarea:focus {
            border-color: #4c3b6e;
            outline: none;
        }

        .profile-form input[type="file"] {
            padding: 0;
            font-size: 14px;
        }

        /* Submit Button */
        .btn-submit {
            width: 100%;
            padding: 12px;
            background-color: #4c3b6e;
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-submit:hover {
            background-color: #6f57a1;
        }

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

                <label for="new_about">О пользователе</label>
                <textarea name="new_about" id="new_about" rows="4"><?php echo htmlspecialchars($user['about']); ?></textarea>

                <button type="submit" class="btn-submit" onclick="window.location.href='profile.php'>Сохранить изменения</button>
            </form>

            <script>
                function redirectToProfile() 
                    window.location.href = 'profile.php';
                }
</script>
        </div>
    </div>

</body>
</html>
