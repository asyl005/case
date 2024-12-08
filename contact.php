<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Networked Student Access</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #4c3b6e;
            color: #ffffff;
        }
        header {
            background-color: #3a2c59;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        header .logo {
            font-size: 24px;
            font-weight: bold;
            color: #fff;
        }
        header nav a {
            color: #ddd;
            text-decoration: none;
            margin: 0 10px;
            font-size: 18px;
        }
        header nav a:hover {
            color: #ffffff;
        }
        .contact-section {
            padding: 50px;
            background: linear-gradient(135deg, #5c4a8e, #302347);
            color: white;
            text-align: center;
        }
        .contact-section h1 {
            font-size: 48px;
            margin-bottom: 20px;
        }
        .contact-section p {
            font-size: 18px;
            line-height: 1.6;
            max-width: 800px;
            margin: 0 auto 30px auto;
        }
        .contact-form {
            max-width: 600px;
            margin: 0 auto;
            background-color: #3a2c59;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        }
        .contact-form input,
        .contact-form textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
        }
        .contact-form button {
            background-color: #6f57a1;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
        }
        .contact-form button:hover {
            background-color: #543c80;
        }
    </style>
</head>
<body>
    <header>
        <div class="logo">NSA</div>
        <nav>
            <a href="about.php">Біз жайлы</a>
            <a href="contact.php">Байланыс</a>
            <a href="login.php">Кіру</a>
            <a href="register.php">Тіркелу</a>
        </nav>
    </header>

    <div class="contact-section">
        <h1>Байланыс</h1>
        <p>
            Сұрақтарыңыз немесе пікірлеріңіз бар ма? Бізге хабарласыңыз! Біз сіздің пікіріңізді тыңдағымыз келеді және мүмкіндігінше тезірек сізбен байланысқа шығатын боламыз.
        </p>

        <div class="contact-form">
            <form action="send_message.php" method="POST">
                <input type="text" name="name" placeholder="Есіміңіз" required>
                <input type="email" name="email" placeholder="Почта" required>
                <textarea name="message" rows="5" placeholder="Хабарлама" required></textarea>
                <button type="submit">Жіберу</button>
            </form>
        </div>
    </div>
</body>
</html>
