<?php
session_start();
include 'db.php';

// Dummy session user ID for testing
$_SESSION['user_id'] = 1; // Replace with your login logic
$user_id = $_SESSION['user_id'];

// Fetch user data from database
$query = "SELECT * FROM users WHERE id = $user_id";
$result = $conn->query($query);
$user = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_username = $_POST['new_username'];
    $new_password = md5($_POST['new_password']);
    $profile_picture = $_FILES['profile_picture'];

    // Handle profile picture upload
    if ($profile_picture['error'] === 0) {
        $target_dir = "uploads/";
        $filename = basename($profile_picture["name"]);
        $filename = preg_replace("/[^a-zA-Z0-9.]/", "_", $filename); // Sanitize filename
        $target_file = $target_dir . $filename;

        if (move_uploaded_file($profile_picture["tmp_name"], $target_file)) {
            $profile_picture_path = $target_file;
        } else {
            $profile_picture_path = 'uploads/default.png'; // Default photo if upload fails
        }
    } else {
        $profile_picture_path = $user['profile_picture']; // Keep the current photo
    }

    // Update user data
    $update_user_query = "UPDATE users SET username = '$new_username', password = '$new_password' WHERE id = $user_id";
    $conn->query($update_user_query);

    // Update profile picture
    $update_profile_query = "UPDATE profiles SET profile_picture = '$profile_picture_path' WHERE user_id = $user_id";
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
        /* Global Styling */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background-color: #f3f4f7;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        /* Profile Container */
        .profile-container {
            width: 100%;
            max-width: 500px;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        .profile-container h1 {
            font-size: 24px;
            margin-bottom: 20px;
            color: #333;
        }

        /* Success Message */
        .success {
            background-color: #d4edda;
            color: #155724;
            padding: 10px;
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
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 20px;
        }

        /* Form Styling */
        .profile-form {
            width: 100%;
        }

        .profile-form label {
            display: block;
            margin-bottom: 5px;
            text-align: left;
            font-weight: bold;
            color: #555;
        }

        .profile-form input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }

        .profile-form input:focus {
            border-color: #007bff;
            outline: none;
        }

        /* Submit Button */
        .btn-submit {
            width: 100%;
            padding: 10px 15px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn-submit:hover {
            background-color: #0056b3;
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

                <button type="submit" class="btn-submit">Сохранить изменения</button>
            </form>
        </div>
    </div>
</body>
</html>
