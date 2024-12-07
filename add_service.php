<?php
// Подключение к базе данных
include('db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Получаем данные из формы
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $contact_info = mysqli_real_escape_string($conn, $_POST['contact_info']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);

    // Вставляем данные в таблицу services
    $query = "INSERT INTO services (title, description, contact_info, category) VALUES ('$title', '$description', '$contact_info', '$category')";
    if (mysqli_query($conn, $query)) {
        header('Location: services.php'); // Перенаправление на страницу поиска услуг после добавления
        exit;
    } else {
        $error = "Ошибка при добавлении услуги.";
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Добавить услугу</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #4c3b6e;
            color: white;
            padding: 20px;
            text-align: center;
        }

        main {
            padding: 20px;
        }

        .form-container {
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            max-width: 600px;
            margin: 0 auto;
        }

        .form-container input, .form-container textarea {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .form-container button {
            background-color: #4c3b6e;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .form-container button:hover {
            background-color: #6f57a1;
        }

        footer {
            text-align: center;
            background-color: #4c3b6e;
            color: white;
            padding: 10px;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>
    <header>
        <h1>Добавить услугу</h1>
    </header>

    <main>
        <div class="form-container">
            <?php if (isset($error)): ?>
                <p style="color: red;"><?php echo $error; ?></p>
            <?php endif; ?>
            <form action="add_service.php" method="post">
                <input type="text" name="title" placeholder="Название услуги" required>
                <textarea name="description" placeholder="Описание услуги" rows="4" required></textarea>
                <input type="text" name="contact_info" placeholder="Контактная информация" required>
                <input type="text" name="category" placeholder="Категория (например, репетитор, фотограф)" required>
                <button type="submit">Добавить</button>
            </form>
        </div>
    </main>

    <footer>
        <p>&copy; 2024 Поиск услуг, Все права защищены</p>
    </footer>
</body>
</html>

<?php
// Закрытие подключения к базе данных
mysqli_close($conn);
?>
