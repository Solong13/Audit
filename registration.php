<?php include_once ('header.php');?>
		<!-- Main -->
			<div id="main">

				<!-- Intro -->
					<section id="top" class="one dark cover">
						<div class="container">

							<header>
								<h2 class="alt">Hi! I'm <strong>Prologue</strong>, a <a href="http://html5up.net/license">free</a> responsive<br />
								site template designed by <a href="http://html5up.net">HTML5 UP</a>.</h2>
								<p>Ligula scelerisque justo sem accumsan diam quis<br />
								vitae natoque dictum sollicitudin elementum.</p>
							</header>

							<footer>
								<a href="#portfolio" class="button scrolly">Magna Aliquam</a>
							</footer>

						</div>
					</section>

  <form action="handler_for_registretionDB.php" method="POST">
        <div class="container">
            <h1>Реєстрація</h1>
            <p>Будь ласка заповніть всі поля для того щоб зареєструватись</p>
            <hr>

            <label for="fullname"><b>Ваш ПІП</b></label>
            <input type="text" placeholder="Вашe ПІП" name="fullname" required>

            <div class="custom-select">
                <label for="current_position"><b>Актуальна посада</b></label>
                    <select name="current_position">
                    <option value="Апаратник підготовки напівсировини та готової продукції">Апаратник підготовки напівсировини та готової продукції</option>
                    <option value="Апаратник теплоізоляції">Апаратник теплоізоляції</option>
                    <option value="Машиніст компресорних установок">Машиніст компресорних установок</option>
                    <option value="Апаратник абсорбції">Апаратник абсорбції</option>
                    <option value="Старший апаратник абсорбції">Старший апаратник абсорбції</option>
                    <option value="Старший майстер зміни">Старший майстер зміни</option>
                    <option value="Черговий елктромонтер">Черговий елктромонтер</option>
                    <option value="Черговий КВПіА">Черговий КВПіА</option>
                </select>
            </div>

            <div class="custom-select">
                <label for="workshop"><b>Цex</b></label>
                <select name="workshop">
                    <option value="М-5">М-5</option>
                    <option value="А-7">А-7</option>
                </select>
            </div>

            <label for="table_number"><b>Табельний номер</b></label>
            <input type="text" placeholder="Табельний номер" name="table_number" required>

            <label for="current_salary"><b>Актуальний оклад</b></label>
            <input type="text" placeholder="Актуальний оклад" name="current_salary" required>
            <hr>

            <button type="submit" class="registerbtn">Зареєструвати</button>

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
            <p>Ви вже маєте акаунт? <a href="login.php">Увійти</a>.</p>
            </div>
        </div>

    </form>

			</div>

<?php include_once ('footer.php');?>