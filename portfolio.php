<!-- Portfolio -->
<section id="portfolio" class="two">
	<div class="container">
		<header>
			<h1>Employee financial information</h1>
		</header>


<ol class="employee-list">

    <?php if (isset($_SESSION['employee']['employee_role']) && (int)$_SESSION['employee']['employee_role'] === 1) : ?>
        <h3>Список працівників цеху</h3>
    <?php
        // Вивести всіх працівників
        $allEmployee = getAllEmployeeAndTheirPositions($dbh);
        foreach ($allEmployee as $employee) :     
    ?>
  <li>
    <a href="?page=employee_page&&id_employee=<?=$employee['id_employee'];?> "><?= $employee['fullname'];?></a>
    <span class="position"><?= ' - ' . $employee['position_name'];?></span>
  </li>
  <?php endforeach; ?>

</ol>


    <?php
        if (isset($_SESSION['errors'])) {
            foreach ($_SESSION['errors'] as $key => $value) {?>
                <p style="color: red;"><?= $value; ?> </p>
            <?php   }    
        } 
            if (isset($_SESSION['success'])) { ?>
                <p style="color: green;"><?= $_SESSION['success']; ?> </p>
            <?php } ?>
     </div>
    

        <?php else: ?> 
            <h3>Фінансові надходження працівника</h3>
			<?php 
           

				// Витягнули Всі Зп данаго робітника(плюс подумати, як їх виводити Наприклад цільки за 2 місяці)
				$getSalaryEmployee = getSalaryCurrentEmployee($_SESSION['employee']['id_employee'], $dbh);
                
                if (!$getSalaryEmployee) {
                    echo 'Надходжень не знайдено!';
    
                } else { 
                    $sortedData = sortedDataEmployee($getSalaryEmployee);
                    $baseSalary = getCurrentPosition($getSalaryEmployee['id_position'] ?? $getSalaryEmployee[0]['id_position'], $dbh);
                }
               
                // echo "<pre>";
                // print_r($sortedData);
                // echo "</pre>";

                // Масив якщо один то [], якщо їх багато то як зробити
			?>

			<!-- Створити таблицю для виводу зарплати -->
            <?php if(!empty($sortedData)) {
                foreach ($sortedData as $key => $valEmployee) { ?>
                
                <br>
            <table class="pay-slip">
                <!-- Заголовок -->
                <tr class="date-and-time">
                    <td colspan="6" class="no-border left"><?= $sortedData[$key]['year']; ?></td>
                    <td colspan="3" class="no-border right"><?= $sortedData[$key]['time']; ?></td>
                </tr>
                <tr>
                    <td colspan="9" class="no-border"></td>
                </tr>
                <tr class="workshop-and-table_number">   
                    <td colspan="2" class="no-border left"><?= $sortedData[$key]["workshop"]; ?></td>
                    <td colspan="3" class="no-border center">ТАБЛN <?= $sortedData[$key]["table_number"]; ?></td>
                    <td colspan="3" class="no-border right"><?= $sortedData[$key]["fullname"]; ?></td>
                    <td colspan="2" class="no-border right">код н/п = <?= $sortedData[$key]['year']; ?></td>
                </tr>
                <tr>
                    <td colspan="4" class="no-border left">Пл.час:23 <?= $sortedData[$key]['All_hours_c6']; ?></td>
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
                    <td><?= $sortedData[$key]['month']; ?></td>
                    <td>6</td>
                    <td>23</td>
                    <td><?= $sortedData[$key]["All_hours_c6"]; ?></td>
                    <td><?= $baseSalary['base_salary'] ?></td>
                    <td><?= $sortedData[$key]['gross_salary']; ?></td>
                    <td><?= $sortedData[$key]['month']; ?></td>
                    <td>532</td>
                    <td>-<?= $sortedData[$key]["PDFO_tax_c532"]; ?></td>
                </tr>
                <tr>

                    <td><?= $sortedData[$key]['month']; ?></td>
                    <td>11</td>
                    <td></td>
                    <td><?= $sortedData[$key]["Night_shift_hours_c11"]; ?></td>
                    <td><?= $sortedData[$key]["money_for_night_shift"]; ?></td>
                    <td></td>
                    <td><?= $sortedData[$key]['month']; ?></td>
                    <td>555</td>
                    <td>-<?= $sortedData[$key]["Trade_union_tax_c555"]; ?></td>
                </tr>
                <tr>
                    <td><?= $sortedData[$key]['month']; ?></td>
                    <td>29</td>
                    <td></td>
                    <td><?= $sortedData[$key]["Overtime_hours_c29"]; ?></td>
                    <td><?= $sortedData[$key]["money_for_overtime"]; ?></td>
                    <td></td>
                    <td><?= $sortedData[$key]['month']; ?></td>
                    <td>590</td>
                    <td>-<?= $sortedData[$key]["Military_Service_tax_c590"]; ?></td>
                </tr>
                    <tr>
                    <td><?= $sortedData[$key]['month']; ?></td>
                    <td>116</td>
                    <td></td>
                    <td></td>
                    <td><?= $sortedData[$key]["premium_c116"]; ?></td>
                    <td></td>
                    <td><?= $sortedData[$key]['month']; ?></td>
                    <td></td>
                    <td></td>
                </tr>
                </tr>
                    <tr>
                    <td><?= $sortedData[$key]['month']; ?></td>
                    <td>150</td>
                    <td></td>
                    <td></td>
                    <td><?= $sortedData[$key]["Salary_indexation_c150"]; ?></td>
                    <td></td>
                    <td><?= $sortedData[$key]['month']; ?></td>
                    <td></td>
                    <td></td>
                </tr>
                <?php if ($sortedData[$key]["Code295"]) : ?>
                    </tr>
                        <tr>
                        <td><?= $sortedData[$key]['month']; ?></td>
                        <td>295</td>
                        <td></td>
                        <td></td>
                        <td><?= $sortedData[$key]["Code295"]; ?></td>
                        <td></td>
                        <td><?= $sortedData[$key]['month']; ?></td>
                        <td></td>
                        <td></td>
                    </tr>
                <?php endif; ?>
                <tr>
                    <td colspan="4" class="bold left">РАЗОМ</td>
                    <td><?= $sortedData[$key]['gross_salary']; ?></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td colspan="2">-<?= ($sortedData[$key]['net_salary'] * 0.3); ?></td>
                </tr>

                <tr>
                    <td colspan="4" class="bold left">НА БАНКОМАТ: З/ПЛ</td>
                    <td colspan="1"><?= $sortedData[$key]['net_salary']; ?></td>
                </tr>
            </table>
                    
            <?php }}?>

        <?php endif; ?>
	</div>
</section>