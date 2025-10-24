<!-- Portfolio -->
<section id="portfolio" class="two">
	<div class="container">
		<header>
			<h1>Employee financial information</h1>
		</header>
        <?php if ($_SESSION['employee']['employee_role'] == true) : 
            
        // Вивести всіх працівників
        $allEmployee = getAllEmployeeAndTheirPositions($dbh);
        // echo "<pre>";
        // var_dump($allEmployee);
        ?> 
<h3>Список працівників цеху</h3>

<ol class="employee-list">
    <?php foreach($allEmployee as $employee) : ?>
  <li>
    <a href="/employee_page.php?id_employee=<?=$employee['id_employee'];?> "><?= $employee['fullname'];?></a>
    <span class="position"><?= $employee['position_name'];?></span>
  </li>
  <?php endforeach; ?>
</ol>

            <!-- <form action="../handler_for_portfolio.php" method="POST">
                <div class="container">
                    <h1>Заробітна відомість</h1>
                    <p>Будь ласка заповніть всі поля для того щоб зареєструватись</p>

                    <div class="custom-select">
                        <label for="current_salary"><b>Актуальний оклад</b></label>
                        <select name="current_salary">
                            <option value="<?= $_SESSION['employee']['current_salary'] ?? null?>"><?= $_SESSION['employee']['current_salary'] ?? null?></option>
                        </select>
                    </div>
                    
                    <label for="All_hours_c6"><b>Планові години</b></label>
                    <input type="text" placeholder="Планові години" name="All_hours_c6" required>

                    <label for="Night_shift_hours_c11"><b>Нічні години</b></label>
                    <input type="text" placeholder="Нічні години" name="Night_shift_hours_c11" required>

                    <label for="Salary_indexation_c150"><b>Індексація</b></label>
                    <input type="text" placeholder="Індексація" name="Salary_indexation_c150" required>

                    <label for="Overtime_hours_c29"><b>Понаднормові години</b></label>
                    <input type="text" placeholder="Понаднормові години" name="Overtime_hours_c29" required>

                    <label for="premium_c116"><b>Заводська премія</b></label>
                    <input type="text" placeholder="Заводська премія" name="premium_c116" required>

                    <label for="Health_allowance"><b>Оздоровчі</b></label>
                    <input type="text" placeholder="Оздоровчі" name="Health_allowance" required>

                    <label for="Vacation_pay"><b>Відпускні</b></label>
                    <input type="text" placeholder="Відпускні" name="Vacation_pay" required>

                    <button type="submit" class="registerbtn">Заповнити</button>

                        <?php
                            if (isset($_SESSION['errors'])) {
                                foreach ($_SESSION['errors'] as $key => $value) {?>
                                <p style="color: red;"><?= $value; ?> </p>
                        <?php   }    
                            } 
                            if (isset($_SESSION['success'])) {
                            ?>
                                    <p style="color: green;"><?= $_SESSION['success']; ?> </p>
                        
                        <?php } ?>
                </div>
            </form> -->

        <?php else: ?> 

			<?php 
				// Витягнули Всі Зп данаго робітника(плюс подумати, як їх виводити Наприклад цільки за 2 місяці)
				$getSalaryEmployee = getSalaryCurrentEmployee($_SESSION['employee']['id_employee'], $dbh);
                $sortedData = sortedDataEmployee($getSalaryEmployee);
                $baseSalary = getCurrentPosition($getSalaryEmployee[0]['id_position'], $dbh);
                echo "<pre>";
                print_r($baseSalary['base_salary']);
                echo "</pre>";
			?>

			<!-- Створити таблицю для виводу зарплати -->
            <?php if(!empty($sortedData)){
                foreach ($sortedData as $valEmployee) { 
                   print_r($valEmployee['year']);
                    ?>
                <br>
            <table class="pay-slip">
                <!-- Заголовок -->
                <tr class="date-and-time">
                    <td colspan="6" class="no-border left"><?= $valEmployee['year']; ?></td>
                    <td colspan="3" class="no-border right"><?= $valEmployee['time']; ?></td>
                </tr>
                <tr>
                    <td colspan="9" class="no-border"></td>
                </tr>
                <tr class="workshop-and-table_number">   
                    <td colspan="2" class="no-border left"><?= $valEmployee["workshop"]; ?></td>
                    <td colspan="3" class="no-border center">ТАБЛN <?= $valEmployee["table_number"]; ?></td>
                    <td colspan="3" class="no-border right"><?= $valEmployee["fullname"]; ?></td>
                    <td colspan="2" class="no-border right">код н/п = <?= $valEmployee['year']; ?></td>
                </tr>
                <tr>
                    <td colspan="4" class="no-border left">Пл.час:23 <?= $valEmployee['All_hours_c6']; ?></td>
                    <td colspan="5" class="no-border right">оклад/тариф <?= $baseSalary['base_salary'] ?></td>
                </tr>

                <!-- Шапка табличної частини -->
                <tr class="section-head">
                    <td colspan="4">НАРАХУВАННЯ</td>
                    <td colspan="2">ОПОДАТКОВ СУМА</td>
                    <td colspan="3">УТРИМАННЯ</td>
                </tr>
                <tr class="section-subhead">
                    <td>М-Ц:</td>
                    <td>ВИД:</td>
                    <td>ДНІ</td>
                    <td>ГОДИНИ</td>
                    <td>СУМА</td>
                    <td>СУМА</td>
                    <td>М-Ц:</td>
                    <td>ВИД:</td>
                    <td>СУМА</td>
                </tr>

                <!-- Приклади рядків -->
                <tr>   
                    <td><?= $valEmployee['month']; ?></td>
                    <td>6</td>
                    <td>23</td>
                    <td><?= $valEmployee["All_hours_c6"]; ?></td>
                    <td><?= $baseSalary['base_salary'] ?></td>
                    <td><?= $valEmployee['gross_salary']; ?></td>
                    <td><?= $valEmployee['month']; ?></td>
                    <td>532</td>
                    <td>-<?= $valEmployee["PDFO_tax_c532"]; ?></td>
                </tr>
                <tr>

                    <td><?= $valEmployee['month']; ?></td>
                    <td>11</td>
                    <td></td>
                    <td><?= $valEmployee["Night_shift_hours_c11"]; ?></td>
                    <td><?= $valEmployee["money_for_night_shift"]; ?></td>
                    <td></td>
                    <td><?= $valEmployee['month']; ?></td>
                    <td>555</td>
                    <td>-<?= $valEmployee["Trade_union_tax_c555"]; ?></td>
                </tr>
                <tr>
                    <td><?= $valEmployee['month']; ?></td>
                    <td>29</td>
                    <td></td>
                    <td><?= $valEmployee["Overtime_hours_c29"]; ?></td>
                    <td><?= $valEmployee["money_for_overtime"]; ?></td>
                    <td></td>
                    <td><?= $valEmployee['month']; ?></td>
                    <td>590</td>
                    <td>-<?= $valEmployee["Military_Service_tax_c590"]; ?></td>
                </tr>
                    <tr>
                    <td><?= $valEmployee['month']; ?></td>
                    <td>116</td>
                    <td></td>
                    <td></td>
                    <td><?= $valEmployee["premium_c116"]; ?></td>
                    <td></td>
                    <td><?= $valEmployee['month']; ?></td>
                    <td></td>
                    <td></td>
                </tr>
                </tr>
                    <tr>
                    <td><?= $valEmployee['month']; ?></td>
                    <td>150</td>
                    <td></td>
                    <td></td>
                    <td><?= $valEmployee["Salary_indexation_c150"]; ?></td>
                    <td></td>
                    <td><?= $valEmployee['month']; ?></td>
                    <td></td>
                    <td></td>
                </tr>
                <?php if ($valEmployee["Code295"]) : ?>
                    </tr>
                        <tr>
                        <td><?= $valEmployee['month']; ?></td>
                        <td>295</td>
                        <td></td>
                        <td></td>
                        <td><?= $valEmployee["Code295"]; ?></td>
                        <td></td>
                        <td><?= $valEmployee['month']; ?></td>
                        <td></td>
                        <td></td>
                    </tr>
                <?php endif; ?>
                <tr>
                    <td colspan="4" class="bold left">РАЗОМ</td>
                    <td><?= $valEmployee['gross_salary']; ?></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td colspan="2">-<?= ($valEmployee['net_salary'] * 0.3); ?></td>
                </tr>

                <tr>
                    <td colspan="4" class="bold left">НА БАНКОМАТ: З/ПЛ</td>
                    <td colspan="1"><?= $valEmployee['net_salary']; ?></td>
                </tr>
            </table>
                    
            <?php }}?>

        <?php endif; ?>
	</div>
</section>