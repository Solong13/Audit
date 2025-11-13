<?php
    
    $dataOfPosition = getPosition($dbh);
    $workshop = reset($dataOfPosition);
    $slaryDependsOfPosition = null;
?>
    <form action="?page=handler_for_registretionDB" method="POST">
        <div class="container">
            <h1>Реєстрація</h1>
            <p>Будь ласка заповніть всі поля для того щоб зареєструватись</p>
            <hr>

            <label for="fullname"><b>Ваш ПІП</b></label>
            <input type="text" placeholder="Вашe ПІП" name="fullname" required>

          <div class="custom-select">
                <label for="current_position"><b>Актуальна посада</b></label>
                    <select name="current_position">
                    <?php foreach($dataOfPosition as $positotn) :?>
                        <option value="<?=$positotn['position_name']?>"><?=$positotn['position_name']?></option> 
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="custom-select">
                <label for="workshop"><b>Цex</b></label>
                <select name="workshop">
                    <option value="<?=$workshop['workshop']?>"><?=$workshop['workshop']?></option>
                </select>
            </div>

            <label for="table_number"><b>Введіть табельний номер</b></label>
            <input type="text" placeholder="Введіть табельний номер" name="table_number" required>

            <label for="password"><b>Придумайте пароль</b></label>
            <input type="text" placeholder="Введіть пароль" name="password" required>
            <hr>

            <button type="submit" class="registerbtn">Зареєструвати</button>

                <?php
                    if (isset($_SESSION['error'])) {?>
                        <p style="color: red;"><?= $_SESSION['error']; ?> </p>
                <?php       unset($_SESSION['error']);
                    } 
                    if (isset($_SESSION['success'])) {
                       ?>
                            <p style="color: green;"><?= $_SESSION['success']; ?> </p>
                
                  <?php }unset($_SESSION['success']); ?>
        </div>
    </form>


