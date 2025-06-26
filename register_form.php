<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Реєстрація найманої особи</title>
    <link rel="stylesheet" type="text/css" href="styles/styles.css">
</head>
<body>
    <form action="handler.php" method="POST">
        <div class="container">
            <h1>Реєстрація</h1>
            <p>Будь ласка заповніть всі поля для того щоб зареєструватись</p>
            <hr>

            <label for="fullname"><b>Ваш ПІП</b></label>
            <input type="text" placeholder="Вашe ПІП" name="fullname" required>
            <p style="color: red;"><?= isset($_GET['fullname']) ? $_GET['fullname'] : null?></p>

            <div class="custom-select">
                <label for="current_position"><b>Актуальна посада</b></label>
                <select name="current_position">

                    <option value="Старший майстер зміни">Старший майстер зміни</option>

                </select>
            </div>

            <div class="custom-select">
                <label for="workshop"><b>Цex</b></label>
                <select name="workshop">
                    <option value="11">М-5</option>
                    <option value="А22">А-7</option>
                </select>
            </div>

            <label for="table_number"><b>Табельний номер</b></label>
            <input type="text" placeholder="Табельний номер" name="table_number" required>

            <label for="current_salary"><b>Актуальний оклад</b></label>
            <input type="text" placeholder="Актуальний оклад" name="current_salary" required>
            <hr>

            <button type="submit" class="registerbtn">Зареєструвати</button>

            <p style="color: red;"><?= isset($_GET['errors']) ? $_GET['errors'] : null; ?></p>

            <div class="container signin">
            <p>Ви вже маєте акаунт? <a href="#">Увійти</a>.</p>
            </div>
        </div>

    </form>

<script type="text/javascript" src="styles/file.js"></script>
</body>
</html>

