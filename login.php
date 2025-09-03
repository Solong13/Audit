<?php include_once ('header.php');?>

<form action="../handler_for_login.php" method="POST">
        <div class="container">
            <h1>Увійти</h1>
            <p>Будь ласка заповніть всі поля для того щоб увійти</p>
            <hr>

            <label for="fullname"><b>Ваш ПІП</b></label>
            <input type="text" placeholder="Вашe ПІП" name="fullname" required>

            <label for="table_number"><b>Табельний номер</b></label>
            <input type="text" placeholder="Табельний номер" name="table_number" required>
            <hr>

            <button type="submit" class="registerbtn">Увійти</button>

                <?php
                    if (isset($_SESSION['errors'])) {
                        foreach ($_SESSION['errors'] as $key => $value) {?>
                        <p style="color: red;"><?= $value; 
                            $_SESSION['errors'] = null; // вирішення проблеми з безкінечним виводом помилки після перезавантаження сторінки
                        ?> </p>
                <?php   }    
                    } 
                    if (isset($_SESSION['success'])) {
                       ?>
                            <p style="color: green;"><?= $_SESSION['success']; 
                                $_SESSION['success'] = null; 
                            ?> </p>
                
                  <?php } ?>

            <div class="container signin">
            <p>Не маєте акаунта? <a href="registration.php">Реєстрація</a>.</p>
            </div>
        </div>

    </form>


<?php include_once ('footer.php');?>