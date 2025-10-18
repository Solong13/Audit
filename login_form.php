<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Реєстрація найманої особи</title>
    <link rel="stylesheet" type="text/css" href="styles/styles.css">
</head>
<body>
    <form action="handler_for_loginDB.php" method="POST">
        <div class="container">
            <h1>Авторизація особи</h1>
            <p>Будь ласка заповніть всі поля для того щоб зареєструватись</p>
            <hr>

            <label for="fullname"><b>Ваш ПІП</b></label>
            <input type="text" placeholder="Вашe ПІП" name="fullname" required>

            <label for="password"><b>Введіть пароль</b></label>
            <input type="text" placeholder="Введіть пароль" name="password" required>
            <hr>

            <button type="submit" class="registerbtn">Увійти</button>
            <div class="container signin">
            <p>Ще не маєте акаунт? <a href="registration.php">Реєстрація</a>.</p>
            </div>
        </div>

    </form>

<script type="text/javascript" src="styles/file.js"></script>
</body>
</html>

