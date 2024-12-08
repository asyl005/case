<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gamified Learning System</title>
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
            font-size: 24px;2
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
        .hero {
            display: flex;
            align-items: center;
            justify-content: space-around;
            padding: 50px;
            background: linear-gradient(135deg, #5c4a8e, #302347);
            color: white;
        }
        .hero .content {
            max-width: 500px;
        }
        .hero h1 {
            font-size: 48px;
            margin-bottom: 20px;
        }
        .hero p {
            font-size: 18px;
            line-height: 1.6;
        }
        .hero .cta {
            margin-top: 20px;
        }
        .hero .cta a {
            text-decoration: none;
            padding: 10px 20px;
            background-color: #6f57a1;
            color: white;
            border-radius: 5px;
            font-size: 20px;
            font-weight: bold;
        }
        .hero .cta a:hover {
            background-color: #543c80;
        }
        .hero img {
            max-width: 400px;
            border-radius: 15px;
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

    <div class="hero">
        <div class="content">
            <h1>Networked Student Access</h1>
            <p>Студенттердің желілік қол жетімділігі-білім беру ресурстарына қол жеткізуді қамтамасыз ету жүйесі.</p>
            <div class="cta">
                <a href="login.php">Бастау!</a>
            </div>
        </div>
        <img src="logo.jpg" alt="Gamified Learning Illustration">
    </div>
</body>
</html>
