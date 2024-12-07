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
            <a href="about.php">About</a>
            <a href="contact.php">Contact</a>
            <a href="login.php">Log in</a>
            <a href="register.php">Sign up</a>
        </nav>
    </header>

    <div class="contact-section">
        <h1>Contact Us</h1>
        <p>
            Have questions or feedback? Reach out to us! We'd love to hear from you and will get back to you as soon as possible.
        </p>

        <div class="contact-form">
            <form action="send_message.php" method="POST">
                <input type="text" name="name" placeholder="Your Name" required>
                <input type="email" name="email" placeholder="Your Email" required>
                <textarea name="message" rows="5" placeholder="Your Message" required></textarea>
                <button type="submit">Send Message</button>
            </form>
        </div>
    </div>
</body>
</html>
