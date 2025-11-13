<form action="?page=handler_for_login" method="POST">
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
            
            <?php // Потрібно винести
            if (isset($_SESSION['error'])) :
                    foreach ($_SESSION as $key => $value) : ?>
                        <p style="color: red;"><?= $_SESSION['error'] ; ?> 
                        </p>
                        <?php $_SESSION['error'] = null; ?> 
                <?php endforeach; ?>
            <?php endif; ?>

        </div>
</form>

